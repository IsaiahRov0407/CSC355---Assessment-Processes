<?php
//Take the data submitted from the form and store it into variables for table insertion
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["studentNum"]) && is_array($_POST["studentNum"]) && !empty($_POST["studentNum"])) {
        // Retrieve array data from form
        $studentNum = $_POST["studentNum"];
    } else {
        echo "Array data is missing, not an array, or empty.";
    }
    if (isset($_POST["major"]) && is_array($_POST["major"]) && !empty($_POST["major"])) {
        // Retrieve array data from form
        $major = $_POST["major"];
    } else {
        echo "Array data is missing, not an array, or empty.";
    }
    if (isset($_POST["evaluation"]) && is_array($_POST["evaluation"]) && !empty($_POST["evaluation"])) {
        // Retrieve array data from form
        $evaluation = $_POST["evaluation"];
    } else {
        echo "Array data is missing, not an array, or empty.";
    }
}
var_dump($_POST);

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
for ($i = 0; $i < count($studentNum); $i++){
    $num = $studentNum[$i];
    $maj = $major[$i];
    $evalu = implode(", ", $evaluation);
    $stmt = $db->prepare("INSERT INTO StudentTable (StudentNumbers, Major, EvaluationScore) VALUES (:studentNum, :major, :evaluation)");    
    $stmt->bindParam(':studentNum', $num);
    $stmt->bindParam(':major', $maj);
    $stmt->bindParam(':evaluation', $evalu);
    $stmt->execute();
}
$query = "SELECT * FROM StudentTable";
$result2 = $db->query($query);
echo "<table border='1'>
                <tr>
                    <th>Student Number</th>
                    <th>Major</th>
                    <th>Evaluations</th>
                </tr>";

        // Iterate over the result set and print out each row
        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['StudentNumbers'] . "</td>";
            echo "<td>" . $row['Major'] . "</td>";
            echo "<td>" . $row['EvaluationScore'] . "</td>";
            echo "</tr>";
    }






    //temporary query to delete all entries added to the database through testing
    //$query2 = "DELETE FROM EVAL";
    //$result3 = $db->query($query2);
    $db = null;
    //header("Location: https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/Prototype1.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Registration</title>
</head>
<body>
<!-- HTML here -->
</body>
</html>