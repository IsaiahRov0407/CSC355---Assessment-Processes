<?php

try {
    $db = new SQLite3('CSC355.db');
} 
catch (Exception $exc){
    echo 'Exception: Cannot connect to the database: ', $exc->getMessage(), "\n";
}

$query = "SELECT * FROM COURSES ORDER BY COURSEID";
$result = $db->query($query);

$courseCodes = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $courseCodes[] = $row['COURSEID'];
}

function generateCourseIDDropdown($name, $options) {
    $html = "<select name='$name'>";
    foreach ($options as $option) {
        $html .= "<option value='$option'>$option</option>";
    }
    $html .= "</select>";
    return $html;
}


$profquery = "SELECT * FROM PROFESSORS ORDER BY NAME";
$profresult = $db->query($profquery);

$profName = [];
while ($row = $profresult->fetchArray(SQLITE3_ASSOC)) {
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


$semquery = "SELECT * FROM SEMESTERS";
$semresult = $db->query($semquery);

$semName = [];
while ($row = $semresult->fetchArray(SQLITE3_ASSOC)) {
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

$assessmentquery = "SELECT * FROM FOCUSES";
$assessmentresult = $db->query($assessmentquery);

$assessmentName = [];
while ($row = $assessmentresult->fetchArray(SQLITE3_ASSOC)) {
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
</style>
</head>
<body>

<h2></h2>

<form id="courseForm">
    <label for="courseCode">Course Code:</label>
    <?php echo generateCourseIDDropdown('courseCode', $courseCodes);?><br></br>

    <label for="courseName">Course Name:</label>
    <input type="text" id="courseName" required><br><br>

    <label for="courseSection">Course Section:</label>
    <input type="text" id="courseSection" required><br><br>

    <label for="semester">Semester:</label>
    <?php echo generateSemesterDropdown('Semester', $semName);?><br><br>

    <label for="instructor">Instructor:</label>
    <?php echo generateProfNameDropdown('NAME', $profName);?><br></br>

    <label for="type">Type of Assessment:</label>
    <?php echo generateAssessmentDropdown('Assessment', $assessmentName);?><br></br>

    <label for="numStudents">Number of Students:</label>
    <input type="number" id="numStudents" min="1" required><br><br>

    <button id = "button1" type="button" onclick="addStudents()">Add Students</button>
	<button id = "button2" type="button" onclick="removeStudents()" style= "display: none;">Remove Students</button>
	<button id = "button3" type="button" onclick="deleteData()">Delete Data</button>
</form>

</div class="table-container">
  <table id="studentsTable">
    <tr>
      <th>Student Number</th>
      <th>Major</th>
      <th colspan="3">CSIT-1</th>
	  <th colspan="3">CSIT-2</th>
	  <th colspan="3">CSIT-3</th>
	  <th colspan="3">CSIT-4</th>
	  <th colspan="3">CSIT-5</th>
	  <th colspan="2">CS-6</th>
	  <th colspan="4">IT-6</th>
    </tr>
  </table>
</div>
<script>
function addStudents() {
  document.getElementById("button1").style.display = "none";
  document.getElementById("button2").style.display = "initial";	
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

  var courseCodes = ["CSIT-1", "CSIT-2", "CSIT-3", "CSIT-4", "CSIT-5", "CS-6", "IT-6"];
  var selectOptions = ["E (exemplary)", "S (satisfactory)", "D (developing)", "U (unsatisfactory)"];

for (var j = 2; j < 17; j++) {
    var cell = row.insertCell(j);
    var csitIndex = Math.floor((j - 2) / 3) + 1; 
    var csitNumber = (j - 2) % 3 + 1; 
    var csitCode = "CSIT-" + csitIndex + csitNumber; 
    var selectHTML = "<div><b>" + csitCode + "</b></div><select>";
    for (var k = 0; k < selectOptions.length; k++) {
        selectHTML += "<option value='" + selectOptions[k].charAt(0) + "'>" + selectOptions[k] + "</option>";
    }
    selectHTML += "</select>";
    cell.innerHTML = selectHTML;
  }
  var csCell1 = row.insertCell(17); 
  csCell1.innerHTML = "<div><b>CS-61</b></div><select>" +
    "<option value='E'>E (exemplary)</option>" +
    "<option value='S'>S (satisfactory)</option>" +
    "<option value='D'>D (developing)</option>" +
    "<option value='U'>U (unsatisfactory)</option>" +
    "</select>";

  var csCell2 = row.insertCell(18); 
  csCell2.innerHTML = "<div><b>CS-62</b></div><select>" +
    "<option value='E'>E (exemplary)</option>" +
    "<option value='S'>S (satisfactory)</option>" +
    "<option value='D'>D (developing)</option>" +
    "<option value='U'>U (unsatisfactory)</option>" +
    "</select>";
	
	
  var itCell1 = row.insertCell(19); 
  itCell1.innerHTML = "<div><b>IT-61</b></div><select>" +
    "<option value='E'>E (exemplary)</option>" +
    "<option value='S'>S (satisfactory)</option>" +
    "<option value='D'>D (developing)</option>" +
    "<option value='U'>U (unsatisfactory)</option>" +
    "</select>";
  var itCell2 = row.insertCell(20); 
  itCell2.innerHTML = "<div><b>IT-62</b></div><select>" +
    "<option value='E'>E (exemplary)</option>" +
    "<option value='S'>S (satisfactory)</option>" +
    "<option value='D'>D (developing)</option>" +
    "<option value='U'>U (unsatisfactory)</option>" +
    "</select>";
  var itCell3= row.insertCell(21); 
  itCell3.innerHTML = "<div><b>IT-63</b></div><select>" +
    "<option value='E'>E (exemplary)</option>" +
    "<option value='S'>S (satisfactory)</option>" +
    "<option value='D'>D (developing)</option>" +
    "<option value='U'>U (unsatisfactory)</option>" +
    "</select>";
  var itCell4 = row.insertCell(22); 
  itCell4.innerHTML = "<div><b>IT-64</b></div><select>" +
    "<option value='E'>E (exemplary)</option>" +
    "<option value='S'>S (satisfactory)</option>" +
    "<option value='D'>D (developing)</option>" +
    "<option value='U'>U (unsatisfactory)</option>" +
    "</select>";

}


function removeStudents() {
  document.getElementById("button1").style.display = "initial";
  document.getElementById("button2").style.display = "none";
  var table = document.getElementById("studentsTable");
  var rowCount = table.rows.length;


  for (var i = rowCount - 1; i > 0; i--) {
    table.deleteRow(i);
  }
}

function deleteData() {
	var confirmation = confirm("Are you sure you want to delete all data?");
	if (confirmation) {
		var inputs = document.querySelectorAll('input[type="text"]');
		var inputsNum = document.querySelectorAll('input[type="number"]');

		inputs.forEach(function(input) {
			input.value = '';
		});
		inputsNum.forEach(function(input) {
			input.value = '';
		});

        alert("Data cleared successfully!");
		} 
	else {
        return;
			}
}

</script>

</body>
</html>