<?php

try {
    $db = new PDO('sqlite:CSC355.db');
} 
catch (Exception $exc){
    echo 'Exception: Cannot connect to the database: ', $exc->getMessage(), "\n";
}

//query to get course ids and course names from the database to display them on the webpage
$query = $db->prepare("SELECT * FROM COURSES ORDER BY COURSEID");
$query->execute();

$courseCodes = [];
$courseName = [];
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $courseCodes[] = $row['COURSEID'];
    $courseName[] = $row['NAME'];
}

function generateCourseIDDropdown($name, $options) {
    $html = "<select name='$name' id = '$name' onchange='updateCourseName()'>";
    foreach ($options as $option) {
        $html .= "<option value='$option'>$option</option>";
    }
    $html .= "</select>";
    return $html;
}


//query to get professor names 
$profquery = $db->prepare("SELECT * FROM PROFESSORS ORDER BY NAME");
$profquery->execute();

$profName = [];
while ($row = $profquery->fetch(PDO::FETCH_ASSOC)) {
    $profName[] = $row['NAME'];
}

function generateProfNameDropdown($name, $options) {
    $html = "<select name='$name'>";
    foreach ($options as $option) {
        $html .= "<option value='$option'>$option</option>";
    }
    $html .= "</select>";
    return $html;
}

//query to get semesters 
$semquery = $db->prepare("SELECT * FROM SEMESTERS");
$semquery->execute();

$semName = [];
while ($row = $semquery->fetch(PDO::FETCH_ASSOC)) {
    $semName[] = $row['SEMESTER'];
}

function generateSemesterDropdown($name, $options) {
    $html = "<select name='$name'>";
    foreach ($options as $option) {
        $html .= "<option value='$option'>$option</option>";
    }
    $html .= "</select>";
    return $html;
}

//query to get the assessment focuses 
$assessmentquery = $db->prepare("SELECT * FROM FOCUSES ORDER BY TYPE");
$assessmentquery->execute();

$assessmentName = [];
while ($row = $assessmentquery->fetch(PDO::FETCH_ASSOC)) {
    $assessmentName[] = $row['TYPE'];
}

function generateAssessmentDropdown($name, $options) {
    $html = "<select name='$name'>";
    foreach ($options as $option) {
        $html .= "<option value='$option'>$option</option>";
    }
    $html .= "</select>";
    return $html;
}

//query to get performance indicators 
$performanceObjectiveQuery = $db->prepare("SELECT * FROM AssessmentObj");
$performanceObjectiveQuery->execute();

$performanceObjective = [];
$perfObjNames = [];
while ($row = $performanceObjectiveQuery->fetch(PDO::FETCH_ASSOC)) {
    $performanceObjective[] = $row["name"];
    $perfObjNames[] = $row["descriptions"];
}

function generateAssessmentObjective($name, $options, $optionTexts) {
  $html = "";
    foreach ($options as $index =>$option) {
    $optionText = $optionTexts[$index];
      $html .= "<input type='checkbox' name='{$name}[]' value='{$option}' id='{$option}'>";
      $html .= "<label for='{$option}'>{$option} {$optionText}</label><br><br>";
    }
    return $html;
}
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ddd; 
        }

        .form-container {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white; 
        }

        .header {
            background-color: #67001a;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        .navigation {
            background-color: #ccc;
            overflow: hidden;
        }

        .navigation ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .navigation li {
            width: 12.52%;
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
        .dropbtn {
    display: block;
    color: #67001a;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    cursor: pointer;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    z-index: 1;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #ddd;
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
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/editEvaluation.php'>Edit Future Evaluations</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterProf.php'>Enter New Professor</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterCourse.php'>Enter New Course</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterIndicator.php'>Enter New Performance Indicator</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/Reports.php' class='dropbtn'>Reports</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/PID.php'>Performance Indicator Descriptions</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/instructions.php'>Instructions</a></li>
    </ul>
</div>

<h2></h2>

<form id="courseForm" method="POST" action="https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/Saving.php">
<div class ="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="form-container">
                <div class="mb-3">
                    <label for="courseCode" class="form-label">Course Code:</label>
                    <?php echo generateCourseIDDropdown('courseCode', $courseCodes);?><br></br>
                
                    <label for="courseName" class="form-label">Course Name:</label>
                    <input type="text" class="form-control" id="courseName" name="courseName" required readonly size="45"><br><br>
                
                
                    <label for="courseSection" class="form-label">Course Section:</label>
                    <input type="text" class="form-control" id="courseSection" name="courseSection"><br><br>
                
                
                    <label for="semester" class="form-label">Semester:</label>
                    <?php echo generateSemesterDropdown('Semester', $semName);?><br><br>

                
                    <label for="instructor" class="form-label">Instructor:</label>
                    <?php echo generateProfNameDropdown('NAME', $profName);?><br></br>
                

                
                    <label for="type" class="form-label">Type of Assessment:</label>
                    <?php echo generateAssessmentDropdown('Assessment', $assessmentName);?><br></br>
                

                
                    <label for="Performance Indicators" class="form-label">Performance Indicators:</label><br>
                    <?php echo generateAssessmentObjective("objective", $performanceObjective, $perfObjNames) ?>
                

                
                    <label for="numStudents" class="form-label">Number of Students:</label>
                    <input type="number" class="form-control" id="numStudents" name="numStudents" min="1"><br><br>
                </div>

                <button type="submit" class="btn btn-primary">Submit Evaluation Form</button>
            </div>
        </div>
    </div>
</div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function updateCourseName() {
        var courseCodeDropdown = document.getElementById('courseCode');
        var courseNameInput = document.getElementById('courseName');
        var selectedCourseCode = courseCodeDropdown.value;

        var index = <?php echo json_encode($courseCodes); ?>.indexOf(selectedCourseCode);

        if (index !== -1) {
            var courseNames = <?php echo json_encode($courseName); ?>;
            courseNameInput.value = courseNames[index];
        } else {
            courseNameInput.value = '';
        }
    }

document.querySelectorAll('input[name="Performance_Indicator"]').forEach(function(checkbox) {
              checkbox.addEventListener('change', function() {
                var subCheckboxesId = this.id + "SubCheckboxes";
                var subCheckboxes = document.getElementById(subCheckboxesId);
                if (this.checked) {
                    subCheckboxes.style.display = "block";
                } 
                else {
                    subCheckboxes.style.display = "none";
                }
            });
        });
</script>

</body>
</html>