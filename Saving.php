<?php
//Take the data submitted from the form and store it into variables for table insertion
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $courseCode = $_POST["courseCode"];
    $courseName = $_POST["courseName"];
    $courseSection = $_POST["courseSection"];
    $semester = $_POST["Semester"];
    $professor = $_POST["NAME"];
    $assessment = $_POST["Assessment"];
    if (isset($_POST["objective"]) && is_array($_POST["objective"]) && !empty($_POST["objective"])) {
        // Retrieve array data from form
        $performanceObjectives = $_POST["objective"];
    } else {
        echo "Array data is missing, not an array, or empty.";
    }
    //$numStudents = $_POST["numStudents"];
}

//change teh array into a string to insert it into the database
$perfObjString = implode(", ", $performanceObjectives);

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

//check for duplicates that may already be in the table and inform the user that they are trying to submit duplicate data
$dupcheck = $db->prepare("SELECT COUNT(*) FROM EVAL WHERE CourseCode = :courseCode AND Semester = :semester AND CourseSection = :courseSection");
$dupcheck->bindParam(':courseCode', $courseCode);
$dupcheck->bindParam(':semester', $semester);
$dupcheck->bindParam(':courseCode', $courseCode);
$dupcheck->execute();
$count = $dupcheck->fetchColumn();

//check for duplicates, if none, submit data to the database
if ($count > 0) {
    echo 'Error '. $courseCode . ' and ' . $semester . ' already exist together in the table. ';
    echo ' Please either delete the row if need be or update the information.';
    $db = null;
} 
else {
    $stmt = $db->prepare("INSERT INTO EVAL (Instructor, CourseCode, Semester, Assessment, CourseName, CourseSection, PerformanceIndicator) VALUES (:professor, :courseCode, :semester, :assessment, :courseName, :courseSection, :perfObjString)");
    $stmt->bindParam(':professor', $professor);
    $stmt->bindParam(':courseCode', $courseCode);
    $stmt->bindParam(':semester', $semester);
    $stmt->bindParam(':assessment', $assessment);
    $stmt->bindParam(':courseName', $courseName);
    $stmt->bindParam(':courseSection', $courseSection);
    $stmt->bindParam(':perfObjString', $perfObjString);
    
    $result = $stmt->execute();

    //$result = $stmt->execute();
    if ($result) {
        //echo "Data Saved Successfully";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    //query to get all data that has been entered in the database
    $query = "SELECT * FROM EVAL";
    $result2 = $db->query($query);

    //print the data from the database int a table format
    if ($result2) {
        echo "<table border='1'>
                <tr>
                    <th>Instructor</th>
                    <th>Course Code</th>
                    <th>Semester</th>
                    <th>Assessment</th>
                    <th>Course Name</th>
                    <th>Course Section</th>
                    <th>Performance Indicators</th>
                </tr>";

        // Iterate over the result set and print out each row
        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['Instructor'] . "</td>";
            echo "<td>" . $row['CourseCode'] . "</td>";
            echo "<td>" . $row['Semester'] . "</td>";
            echo "<td>" . $row['Assessment'] . "</td>";
            echo "<td>" . $row['CourseName'] . "</td>";
            echo "<td>" . $row['CourseSection'] . "</td>";
            echo "<td>". $row["PerformanceIndicator"] . "</td>";
            echo "</tr>";
    }

        echo "</table>";
    } else {
        echo "No data available";
    }

    //temporary query to delete all entries added to the database through testing
    $query2 = "DELETE FROM EVAL";
    $result3 = $db->query($query2);
    $db = null;
    }

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