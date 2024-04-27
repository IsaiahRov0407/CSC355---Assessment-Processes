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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Fill in the Remaining Data</h1>
    <form class="text-center" id="profForm" method="POST" action="https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/updateEvaluation.php">
        <div class="mb-3">
            <label for="courseCode" class="form-label">Course Code:</label>
            <input type="text" id="courseCode" name="courseCode" readonly value="<?php echo $courseCode; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="semester" class="form-label">Semester:</label>
            <input type="text" id="semester" name="semester" readonly value="<?php echo $semester; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="courseSec" class="form-label">Course Section:</label>
            <input type="text" id="courseSec" name="courseSec" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="professor" class="form-label">Professor:</label>
            <?php echo generateProfNameDropdown($db); ?>
        </div>
        <div class="mb-3">
            <label for="assessment" class="form-label">Type of Assessment:</label>
            <?php echo generateAssessmentDropdown($db); ?>
        </div>
        <div class="mb-3">
            <label for="numStudents">Number of Students:</label>
            <input type="number" id="numStudents" name="numStudents" min="1"><br><br>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" onclick="backToHomepage()" class="btn btn-secondary">Back to Homepage</button>
    </form>
</div>
</body>
<script>
function backToHomepage() {
    window.location.href = "https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/home.php";
}
</script>
</html>