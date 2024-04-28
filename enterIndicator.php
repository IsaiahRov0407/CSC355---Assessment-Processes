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
    $indicatorName = $_POST["newIndicator"];
	$indicatorDesc = $_POST["newDesc"];
}

if($indicatorName && $indicatorDesc != NULL){
$query = $db->prepare("INSERT INTO AssessmentObj (name) VALUES (:indicatorName)");
$query = $db->prepare("INSERT INTO AssessmentObj (descriptions) VALUES (:indicatorDesc)");
$query->bindParam(":indicatorName", $indicatorName);
$query->bindParam(":indicatorDesc", $indicatorDesc);
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
    <title>Enter Performance Indicators</title>
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
                <h2 class="text-center mt-5">Enter New Performance Indicators</h2>
                <h3 class="text-center">Format: Indicator-Indicator#</h3>
                <h4 class="text-center">Example: CSIT-11</h4>
                <form class="mt-3" id="indicatorForm" method="POST" action='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterIndicator.php'>
                    <div class="mb-3">
                        <label for="newIndicator" class="form-label">Enter New Indicator:</label>
                        <input type="text" class="form-control" id="newIndicator" name="newIndicator" required size="45">
                    </div>
					<div class="mb-3">
                        <label for="newDesc" class="form-label">Enter New Description:</label>
                        <input type="text" class="form-control" id="newDesc" name="newDesc" required size="45">
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