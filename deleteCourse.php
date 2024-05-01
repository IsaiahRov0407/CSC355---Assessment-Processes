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
    $courseSection = $_POST["courseSection"];
    $semester = $_POST["semester"];
}
$deleteStudents = $db->prepare("DELETE FROM StudentTable WHERE ID = (SELECT ID FROM EVAL WHERE CourseCode=:courseCode AND CourseSection=:courseSection AND Semester=:semester)");
$deleteStudents->bindParam(':courseCode', $courseCode);
$deleteStudents->bindParam(':courseSection', $courseSection);
$deleteStudents->bindParam(':semester', $semester);
//query to get course ids and course names from the database to display them on the webpage
$query = $db->prepare("DELETE FROM EVAL WHERE CourseCode = :courseCode AND CourseSection = :courseSection AND Semester = :semester");
$query->bindParam(':courseCode', $courseCode);
$query->bindParam(':courseSection', $courseSection);
$query->bindParam(':semester', $semester);
$query->execute();

header("Location: https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/home.php");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter New Course</title>
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
<script>
</script>
</body>
</html>