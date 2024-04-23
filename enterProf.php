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
<title>Course Registration</title>
</head>
<style>
</style>
<body>
    <h2 style="text-align: center;">Enter Professor in the Format Last Name, First Name</h2>
    <form style = "text-align: center;" id="profForm" method="POST" action='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterProf.php'>
    <label for="profName">Enter New Professor Name:</label>
    <input type="text" id="profName" name="profName" required size="45"><br><br>
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