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
}

if($indicatorName != NULL){
$query = $db->prepare("INSERT INTO AssessmentObj (name) VALUES (:indicatorName)");
$query->bindParam(":indicatorName", $indicatorName);
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
    <h2 style="text-align: center;">Enter new performance indicators in the format indicator-indicator#</h2>
    <h3 style="text-align: center;">Example: CSIT-11</h3>
    <form style = "text-align: center;" id="indicatorForm" method="POST" action='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterIndicator.php'>
    <label for="profName">Enter New Indicator:</label>
    <input type="text" id="newIndicator" name="newIndicator" required size="45"><br><br>
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