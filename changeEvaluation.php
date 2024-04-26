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
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $courseCode = $_POST["courseCode"];
    $semester = $_POST["semester"];
    $courseSec = $_POST["courseSec"];
}

if ($courseSec == NULL){
    $gatherInfo = $db->prepare("SELECT * FROM EVAL WHERE CourseCode=:courseCode AND Semester=:semester");
    $gatherInfo->bindParam(":courseCode", $courseCode);
    $gatherInfo->bindParam(":semester", $semester);
    echo "<h1>Fill in the Remaining Data</h1>";
    echo "<form style = 'text-align: center;' id='profForm' method='POST' action='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/updateEvaluation.php'>";
    echo "<label for='courseCode'>Course Code:</label>
    <input type='text' id='courseCode' name='courseCode' readonly value='$courseCode'><br><br>";
    echo "<label for='semester'>Semester:</label>
    <input type='text' id='semester' name='semester' readonly value='$semester'><br><br>";
    echo "<label for='courseSec'>Course Section:</label>
    <input type='text' id='courseSec' name='courseSec' required><br><br>";
    echo "<label for='professor'>Professor:</label>";
    echo generateProfNameDropdown($db);"required <br><br>";
    echo "<label for='assessment'>Type of Assessment:</label>";
    echo generateAssessmentDropdown($db);"required <br><br>";
}

function generateProfNameDropdown($db) {
    $profquery = $db->prepare("SELECT * FROM PROFESSORS ORDER BY NAME");
    $profquery->execute();

    $profName = [];
    while ($row = $profquery->fetch(PDO::FETCH_ASSOC)) {
        $profName[] = $row['NAME'];
}
    $html = "<select name='professor'>";
    foreach ($profName as $option) {
        $html .= "<option value='$option'>$option</option>";
    }
    $html .= "</select>";
    return $html;
}



function generateAssessmentDropdown($db) {
    $assessmentquery = $db->prepare("SELECT * FROM FOCUSES ORDER BY TYPE");
    $assessmentquery->execute();
    $assessmentName = [];
    while ($row = $assessmentquery->fetch(PDO::FETCH_ASSOC)) {
        $assessmentName[] = $row['TYPE'];
}
    $html = "<select name='assessment'>";
    foreach ($assessmentName as $option) {
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
<title>Edit Evaulation</title>
</head>
<style>
</style>
<body>
    <label for="numStudents">Number of Students:</label>
    <input type="number" id="numStudents" name="numStudents" min="1"><br><br>
    <button type="submit">Submit</button>
    <button onclick="backToHomepage()">Back to Homepage</button>
</form>

</body>
<script>
        function backToHomepage(){
            window.location.href = "https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/home.php";
        }
</script>
</html>