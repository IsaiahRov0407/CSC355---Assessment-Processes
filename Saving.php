<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $courseCode = $_POST["courseCode"];
    $courseName = $_POST["courseName"];
    $courseSection = $_POST["courseSection"];
    $semester = $_POST["Semester"];
    $professor = $_POST["NAME"];
    $assessment = $_POST["Assessment"];
    //$numStudents = $_POST["numStudents"];
}

try {
    $db = new SQLite3('CSC355.db');
    if (!$db) {
        echo "Error: Could not connect to the database";
    }
} 
catch (Exception $exc){
    echo 'Exception: Cannot connect to the database: ', $exc->getMessage(), "\n";
}

$sql = "INSERT INTO EVAL (Instructor, CourseCode, Semester, Assessment, CourseName, CourseSection) 
        VALUES ('$professor', '$courseCode', '$semester', '$assessment', '$courseName', '$courseSection')";

$result = $db->exec($sql);
if (($result !== false)) {
    echo "Data Saved Successfully";
    }
    else {
        echo "Error" . $db->lastErrorMsg();
    }
    
    $query = "SELECT * FROM EVAL";
$result2 = $db->query($query);

// Check if there are any rows returned
if ($result2) {
    echo "<table border='1'>
            <tr>
                <th>Instructor</th>
                <th>Course Code</th>
                <th>Semester</th>
                <th>Assessment</th>
                <th>Course Name</th>
                <th>Course Section</th>
            </tr>";

    // Iterate over the result set and print out each row
    while ($row = $result2->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['Instructor'] . "</td>";
        echo "<td>" . $row['CourseCode'] . "</td>";
        echo "<td>" . $row['Semester'] . "</td>";
        echo "<td>" . $row['Assessment'] . "</td>";
        echo "<td>" . $row['CourseName'] . "</td>";
        echo "<td>" . $row['CourseSection'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}
//$query2 = "DELETE FROM EVAL";
//$result3 = $db->query($query2);
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Registration</title>