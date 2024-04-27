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
    $professor = $_POST["professor"];
    $numStudents = $_POST["numStudents"];
}
$update = $db->prepare("UPDATE EVAL SET CourseSection=:courseSec, Instructor=:professor WHERE CourseCode=:courseCode AND Semester=:semester");
$update->bindParam(":courseSec", $courseSec);
$update->bindParam("professor", $professor);
$update->bindParam(":courseCode", $courseCode);
$update->bindParam(":semester", $semester);
$update->execute();

header("Location: https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/studentEvaluationUpdate.php?student=" 
. urlencode($numStudents) . "&coursecode=" . urlencode($courseCode) . "&coursesection=" . urlencode($courseSec) . "&semester=" . urlencode($semester));

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

</body>
<script>
</script>
</html>