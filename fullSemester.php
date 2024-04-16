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

// Check if the semester parameter is set in the GET data
if (isset($_GET['semester'])) {
    // Retrieve the semester value from the GET data
    $semester = $_GET['semester'];

    // Query to select all information related to the selected semester
    $stmt = $db->prepare("SELECT * FROM EVAL WHERE SEMESTER = :semester");
    $stmt->bindParam(':semester', $semester);
    $stmt->execute();

    // Display the information in a table
    echo "<h1>Information for Semester: $semester</h1>";
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
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
    // If semester parameter is not set, display an error message
    echo "Error: Semester parameter not provided.";
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
</body>
</html>