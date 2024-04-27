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
    <title>Enter New Course</title>
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
                <h2 class="text-center mb-4">Enter New Course Code and Course Name</h2>
                <form id="courseForm" method="POST" action='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterCourse.php'>
                    <div class="mb-3">
                        <label for="courseCode" class="form-label">Course Code:</label>
                        <input type="text" class="form-control" id="courseCode" name="courseCode" required>
                    </div>
                    <div class="mb-3">
                        <label for="courseName" class="form-label">Course Name:</label>
                        <input type="text" class="form-control" id="courseName" name="courseName" required>
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
</script>
</body>
</html>