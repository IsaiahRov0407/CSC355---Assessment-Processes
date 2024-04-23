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
    $courseName = $_POST["courseName"];
    $courseCode = $_POST["courseCode"];
}

if($courseName != NULL){
$query = $db->prepare("INSERT INTO COURSES (COURSEID, NAME) VALUES (:courseCode, :courseName)");
$query->bindParam(":courseCode", $courseCode);
$query->bindParam(":courseName", $courseName);
$query->execute();
echo "<script>window.alert('Data has been submitted successfully.');</script>";
echo "<script>window.location.href = 'https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/home.php'</script>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Registration</title>
</head>
<style>
</style>
<body>
    <h2 style = "text-align: center;">Enter New Course Code and Course Name (i.e. CSC 111)</h2>
    <form style = "text-align: center;" id="courseForm" method="POST" action='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterCourse.php'>
        <label for="profName">Enter New Course Code:</label>
        <input type="text" id="courseCode" name="courseCode" required size="45"><br><br>
        <label for="profName">Enter New Course Name:</label>
        <input type="text" id="courseName" name="courseName" required size="45"><br><br>
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