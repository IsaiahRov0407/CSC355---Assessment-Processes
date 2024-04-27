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
    $profName = $_POST["profName"];
}

if($profName != NULL){
$query = $db->prepare("INSERT INTO PROFESSORS (NAME) VALUES (:profName)");
$query->bindParam(":profName", $profName);
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
    <title>Enter Professor</title>
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
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="form-container">
                <h2 class="text-center mt-5">Enter Professor in the Format Last Name, First Name</h2>
                <form class="mt-3" id="profForm" method="POST" action='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterProf.php'>
                    <div class="mb-3">
                        <label for="profName" class="form-label">Enter New Professor Name:</label>
                        <input type="text" class="form-control" id="profName" name="profName" required size="45">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
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