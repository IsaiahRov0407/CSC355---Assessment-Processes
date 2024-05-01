<?php
//open the database
try {
    $db = new PDO('sqlite:CSC355.db');
    if (!$db) {
        echo "Error: Could not connect to the database";
    }
} 
catch (Exception $exc){
    echo 'Exception: Cannot connect to the database: ', $exc->getMessage(), "\n";
}
//query to get course ids and course names from the database to display them on the webpage
$query = $db->prepare("SELECT * FROM EVAL ORDER BY CourseCode");
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
    <title>Delete Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ddd; 
            padding-top: 50px; 
        }

        .form-container {
            background-color: #fff; 
            border-radius: 10px; 
            padding: 30px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="text-center mb-4">Enter Course Code of Course You Want Deleted</h2>
                <form id="courseForm" method="POST" action='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/deleteCourse.php'>
                    <div class="mb-3">
                        <label for="courseCode" class="form-label">Course Code:</label>
                        <?php echo generateCourseIDDropdown('courseCode', $courseCodes);?><br></br>
                    </div>
                    <div class="mb-3">
                        <label for="courseSection" class="form-label">Course Section:</label>
                        <input type = 'text' name='courseSection' id='courseSection' required></input>
                    </div>
                    <div class="mb-3">
                    <label for="semester" class="form-label">Semester:</label>
                    <input type="text" id="semester" name="semester" required readonly class="form-control" size="20">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" onclick="backToHomepage()">Back to Homepage</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function backToHomepage() {
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
</body>
</html>