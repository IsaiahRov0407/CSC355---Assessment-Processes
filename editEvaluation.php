<?php
try {
    $db = new PDO('sqlite:CSC355.db');
} 
catch (Exception $exc){
    echo 'Exception: Cannot connect to the database: ', $exc->getMessage(), "\n";
}

//query to get course ids and course names from the database to display them on the webpage
$query = $db->prepare("SELECT * FROM EVAL WHERE Instructor IS NULL ORDER BY CourseCode");
$query->execute();

$courseCodes = [];
$semester = [];
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $courseCodes[] = $row['CourseCode'];
    $semester[] = $row['Semester'];
}

function generateCourseIDDropdown($name, $options) {
    $html = "<select name='$name' id = '$name' onchange='updateSemester()'>";
    foreach ($options as $option) {
        $html .= "<option value='$option'>$option</option>";
    }
    $html .= "</select>";
    return $html;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Evaluation</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #ddd;
    }

    .navigation {
        display: flex;
        justify-content: space-between;
        background-color: #ccc;
        overflow: hidden;
        width: 100%;
    }

    .navigation ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .navigation li {
        width: 25%; /* Each navigation link takes up 1/4 of the width */
    }

    .navigation li a {
        display: block;
        color: #67001a;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .navigation li a:hover:not(.active) {
        background-color: #ddd;
    }

    .active {
         background-color: #04AA6D;
    }

    /* Custom styling for the container */
    .container-box {
        background-color: #fff; /* White background */
        border-radius: 10px; /* Rounded corners */
        padding: 20px; /* Padding inside the box */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
    }
</style>
</head>
<body>
<div class='header'></div>
    <div class='navigation'>
        <ul>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/home.php'>Home</a></li>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/Prototype1.php'>Enter Evaluation</a></li>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterFutureEvaluation.php'>Enter Future Evaluations</a></li>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/editEvaluation.php'>Edit Evaluation</a></li>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterProf.php'>Enter New Professor</a></li>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterCourse.php'>Enter New Course</a></li>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterIndicator.php'>Enter New Performance Indicator</a></li>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/PID.php'>Performance Indicator Descriptions</a></li>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/instructions.php'>Instructions</a></li>
        </ul>
    </div>
    <div class="container mt-5">
        <div class="container-box"> <!-- Add container-box class -->
            <h1>Edit Evaluations</h1>
            <h2>Enter the Course Data you Want to Modify</h2>
            <form class="text-center" id="profForm" method="POST" action='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/changeEvaluation.php'>
                <div class="mb-3">
                    <label for="courseCode" class="form-label">Course Code:</label>
                    <?php echo generateCourseIDDropdown('courseCode', $courseCodes);?>
                </div>
                <div class="mb-3">
                    <label for="semester" class="form-label">Semester:</label>
                    <input type="text" id="semester" name="semester" required readonly class="form-control" size="20">
                </div>
                <div class="mb-3">
                    <label for="courseSec" class="form-label">Course Section (if known):</label>
                    <input type="text" id="courseSec" name="courseSec" class="form-control" size="10">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>
<script>
function backToHomepage(){
    window.location.href = "https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/home.php";
}

function updateSemester() {
    var courseCodeDropdown = document.getElementById('courseCode');
    var semesterInput = document.getElementById('semester');
    var selectedCourseCode = courseCodeDropdown.value;

    var courseCodes = <?php echo json_encode($courseCodes); ?>;
    var semesterData = <?php echo json_encode($semester); ?>;

    // Find the index of the selected course code
    var index = courseCodes.indexOf(selectedCourseCode);

    if (index !== -1) {
        semesterInput.value = semesterData[index];
    } else {
        semesterInput.value = ''; 
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>