<?php

try {
    $db = new PDO('sqlite:CSC355.db');
} 
catch (Exception $exc){
    echo 'Exception: Cannot connect to the database: ', $exc->getMessage(), "\n";
}
if(isset( $_GET['student'])){
    // Retrieve the semester value from the GET data
    $students = $_GET['student'];
    $courseCode= $_GET['coursecode'];
    $courseSec=$_GET['coursesection'];
    $semester=$_GET['semester'];
}
$stmt = $db->prepare('SELECT PerformanceIndicator FROM EVAL WHERE ID = (SELECT ID from EVAL WHERE CourseCode=:courseCode AND Semester=:semester AND CourseSection=:courseSec)');
$stmt->bindParam('courseCode', $courseCode);
$stmt->bindParam('semester', $semester);
$stmt->bindParam('courseSec', $courseSec);
$stmt->execute();

$perfObjective = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $perfObjective[] = $row['PerformanceIndicator'];
}
$separateValues = [];
foreach ($perfObjective as $string){
    $values = explode(',', $string);
    foreach ($values as $value){
        $separateValues[] = $value;
    }
}
function generateStudentTable($separateValues, $students, $courseCode, $semester, $courseSec) {
    $html = '<p>Key: </p>';
    $html .= '<p>E = Exemplary</p>';
    $html .= '<p>S = Satisfactory</p>';
    $html .= '<p>D = Developing</p>';
    $html .= '<p>U = Unsatisfactory</p>';
    $html .= '<form method="POST" action="https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/savingStudentUpdate.php">';
    $html .="<input style='display: none; 'id='courseCode' name='courseCode' value='$courseCode'>";
    $html .="<input style='display: none; 'id='semester' name='semester' value='$semester'>";
    $html .="<input style='display: none; 'id='courseSec' name='courseSec' value='$courseSec'>";
    $html .= '<div class="table-container" style="color: #67001a;">
                <table id="studentsTable">
                    <tr id="columnHeaders">
                        <th>Student Number</th>
                        <th>Major</th>';
                        foreach ($separateValues as $header){
                            $html .= "<th>$header</th>";
                        }
                    $html .= '</tr>';
                    $html .="<input style='display: none; 'id='courseCode' name='courseCode' value='$courseCode'>";
                    $html .="<input style='display: none; 'id='semester' name='semester' value='$semester'>";
                    $html .="<input style='display: none; 'id='courseSec' name='courseSec' value='$courseSec'>";


                    for ($i = 0; $i < $students; $i++) {
                        $html .= "<tr>";
                        $html .= "<td style = 'text-align: center;'><input type='text' name='studentNum[]' value='" . ($i + 1) . "' readonly></td>";
                        $html .= "<td><input type='text' name = 'major[]' placeholder='Major'></td>";
                        foreach ($separateValues as $header) {
                            $html .= "<td><select name = 'evaluation[$i][]' style = 'width: 100px;'>
                                        <option value='E'>E</option>
                                        <option value='S'>S</option>
                                        <option value='D'>D</option>
                                        <option value='U'>U</option>
                                    </select></td>";
                        }
                        $html .= "</tr>";
                    }
                    $html .= "<button type='submit'>Submit Evaluation Form</button>";

    

    return $html;
}


echo generateStudentTable($separateValues, $students, $courseCode, $semester, $courseSec);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Evaluations</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #ddd;
        color: #67001a;
    }

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

    p {
        text-align: right;
    }
</style>
</head>
<body>
</body>
