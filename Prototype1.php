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
$performanceObjectiveQuery = $db->prepare("SELECT name FROM AssessmentObj");
$performanceObjectiveQuery->execute();

$performanceObjective = [];
while ($row = $performanceObjectiveQuery->fetch(PDO::FETCH_ASSOC)) {
    $performanceObjective[] = $row["name"];
}

function generateAssessmentObjective($name, $options) {
  $html = "";
    foreach ($options as $option) {
      $html .= "<input type='checkbox' name='{$name}[]' value='{$option}' id='{$option}'>";
      $html .= "<label for='{$option}'>{$option}</label><br>";
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
<style>
    table {
        border-collapse: collapse;
        width: 100%;
		color: #67001a;
    }
	table-container{
		color: #67001a;	
	}
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    th {
        background-color: #7e0303;
        color: white;
    }
	.table-container {
		width: 800px;
		overflow-x: auto;
		margin: 0 auto;
	}
    .sub-checkbox {
      margin-left: 20px;
    }
  
    .form-container button {
            background-color: #67001a;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
    }
	.form-container {
		text-align: center;
		color: #67001a;
	}
</style>
</head>
<body>

<h2></h2>

<form id="courseForm" method="POST" action="https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/Saving.php">
<div class ="form-container">
    <label for="courseCode">Course Code:</label>
    <?php echo generateCourseIDDropdown('courseCode', $courseCodes);?><br></br>

    <label for="courseName">Course Name:</label>
    <input type="text" id="courseName" name="courseName" required readonly size="45"><br><br>

    <label for="courseSection">Course Section:</label>
    <input type="text" id="courseSection" name="courseSection"><br><br>

    <label for="semester">Semester:</label>
    <?php echo generateSemesterDropdown('Semester', $semName);?><br><br>

    <label for="instructor">Instructor:</label>
    <?php echo generateProfNameDropdown('NAME', $profName);?><br></br>

    <label for="type">Type of Assessment:</label>
    <?php echo generateAssessmentDropdown('Assessment', $assessmentName);?><br></br>

    <label for="Performance Indicators">Performance Indicators:</label><br>
         <?php echo generateAssessmentObjective("objective", $performanceObjective)?>

    <label for="numStudents">Number of Students:</label>
    <input type="number" id="numStudents" min="1"><br><br>

    <button id = "button1" type="button" onclick="addStudents()">Add Students</button>
	<button id = "button2" type="button" onclick="editStudents()" style= "display: none;">Edit Students</button>
  <button type="submit">Submit Evaluation Form</button>
</div> 
</form>

</div class="table-container" style="color: #67001a;">
  <table id="studentsTable">
    <tr id="columnHeaders" style="display: none;">
      <th>Student Number</th>
      <th>Major</th>
      <th>Student Evaluation</th>
    </tr>
  </table>
</div>
<script>
function addStudents() {
   document.getElementById("button1").style.display = "none";
  document.getElementById("button2").style.display = "initial";
  document.getElementById("columnHeaders").style.display = "table-row";
  
  var numStudentsInput = document.getElementById("numStudents");
  var numStudents = parseInt(numStudentsInput.value);
  
  for (var i = 0; i < numStudents; i++) {
    addStudentRow(i);
  }
}


function addStudentRow(i) {
  var table = document.getElementById("studentsTable");
  var row = table.insertRow(-1);

  row.insertCell(0).innerHTML = i + 1;
  row.insertCell(1).innerHTML = "<input type='text' placeholder='Major'>";
  var selectOptions = ["E (exemplary)", "S (satisfactory)", "D (developing)", "U (unsatisfactory)"];
  var selectElement = document.createElement("select");
  for (var j = 0; j < selectOptions.length; j++) {
    var option = document.createElement("option");
    option.value = selectOptions[j];
    option.text = selectOptions[j];
    selectElement.appendChild(option);
  }
  row.insertCell(2).appendChild(selectElement);
}


function updateCourseName() {
    var courseCodeDropdown = document.getElementById('courseCode');
    var courseNameInput = document.getElementById('courseName');
    var selectedCourseCode = courseCodeDropdown.value;

    // Fetch the index of the selected course code in the courseCodes array
    var index = <?php echo json_encode($courseCodes); ?>.indexOf(selectedCourseCode);

    
    if (index !== -1) {
        var courseNames = <?php echo json_encode($courseName); ?>;
        courseNameInput.value = courseNames[index];
    } else {
        courseNameInput.value = ''; 
    }
}

function editStudents() {
  document.getElementById("button1").style.display = "initial";
  document.getElementById("button2").style.display = "none";
  //document.getElementById("studentsTable").style.display = "none";
  var table = document.getElementById("studentsTable");
  var rowCount = table.rows.length;


  for (var i = rowCount - 1; i > 0; i--) {
    table.deleteRow(i);
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
</body>
</html>
