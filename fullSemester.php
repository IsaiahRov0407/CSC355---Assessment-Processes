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
if((isset($_GET['semester']) && isset( $_GET['code']) && isset($_GET['sec']))){
    // Retrieve the semester value from the GET data
    $semester = $_GET['semester'];
    $code = $_GET['code'];
    $sec = $_GET['sec'];

    // Query to select all information related to the selected semester
    $stmt = $db->prepare("SELECT * FROM EVAL WHERE SEMESTER = :semester AND CourseCode = :code AND CourseSection = :sec");
    $stmt->bindParam(':semester', $semester);
    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':sec', $sec);
    $stmt->execute();
    $perfObjective = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $perfObjective[] = $row['PerformanceIndicator'];
    }
    $separateValues = [];
    foreach ($perfObjective as $string){
        $values = explode(',', $string);
        foreach ($values as $value){
            $separateValues[] = $value;
        }
    }

    $stmt2 = $db->prepare("SELECT * FROM EVAL WHERE SEMESTER = :semester AND CourseCode = :code AND CourseSection = :sec");
    $stmt2->bindParam(':semester', $semester);
    $stmt2->bindParam(':code', $code);
    $stmt2->bindParam(':sec', $sec);
    $stmt2->execute();

    // Display the information in a table
    echo "<h1 style = 'text-align: center;'>Information for Course Evaluation</h1>";
    echo "<h2 style = 'text-align: center;'>Semester: $semester</h2>";
    echo "<h2 style = 'text-align: center;'>Course Code: $code</h2>";
    echo "<div>";
    echo "<table border='1'>
            <tr>
                <th>Instructor</th>
                <th>Course Code</th>
                <th>Semester</th>
                <th>Assessment</th>
                <th>Course Name</th>
                <th>Course Section</th>
            </tr>";
    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
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
echo "</div>";

// Query to select all information related to the selected semester
$stmt3 = $db->prepare("SELECT StudentNumbers, Major, EvaluationScore FROM StudentTable WHERE ID = (SELECT ID FROM EVAL WHERE SEMESTER = :semester AND CourseCode = :code AND CourseSection = :sec)");
$stmt3->bindParam(':semester', $semester);
$stmt3->bindParam(':code', $code);
$stmt3->bindParam(':sec', $sec);
$stmt3->execute();

// Initialize an array to store evaluation scores for each student
$studentEvaluations = [];

// Fetch each row of data
while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
    $studentNumber = $row['StudentNumbers'];
    $major = $row['Major'];
    $evaluationScores = explode(',', $row['EvaluationScore']); // Split scores by comma

    // Combine each score with its corresponding performance indicator
    $combinedScores = array_combine($separateValues, $evaluationScores);

    // Store combined scores for each student
    $studentEvaluations[] = [
        'studentNumber' => $studentNumber,
        'major' => $major,
        'scores' => $combinedScores
    ];
}

// Display the information in a table
echo "<div>";
echo "<table border='1'>
        <tr>
            <th>Student Number</th>
            <th>Major</th>";
            foreach ($separateValues as $header){
                echo "<th>$header</th>";
            }
        echo "</tr>";
foreach ($studentEvaluations as $student) {
    echo "<tr>";
        echo "<td>" . $student['studentNumber'] . "</td>";
        echo "<td>" . $student['major'] . "</td>";
        foreach ($separateValues as $indicator) {
            echo "<td>" . $student['scores'][$indicator] . "</td>";
        }
        echo "</tr>";
}
echo "</table>";
echo "</div>";
}
elseif (isset($_GET['semester']) && isset($_GET['code']) && (empty($_GET['sec']) || is_null($_GET['sec']))) {
    // Retrieve the semester value from the GET data
    $semester = $_GET['semester'];
    $code = $_GET['code'];
    $sec = $_GET['sec'];

    // Query to select all information related to the selected semester
    $stmt = $db->prepare("SELECT * FROM EVAL WHERE SEMESTER = :semester AND CourseCode = :code AND CourseSection = :sec");
    $stmt->bindParam(':semester', $semester);
    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':sec', $sec);
    $stmt->execute();

    // Display the information in a table
    echo "<h1 style = 'text-align: center;'>Information for Course Evaluation</h1>";
    echo "<h2 style = 'text-align: center;'>Semester: $semester</h2>";
    echo "<h2 style = 'text-align: center;'>Course Code: $code</h2>";
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
}
elseif (isset($_GET['semester'])) {
    // Retrieve the semester value from the GET data
    $semester = $_GET['semester'];

    // Query to select all information related to the selected semester
    $stmt = $db->prepare("SELECT * FROM EVAL WHERE SEMESTER = :semester");
    $stmt->bindParam(':semester', $semester);
    $stmt->execute();

    // Display the information in a table
    echo "<h1 style = 'text-align: center;'>Information for Course Evaluation</h1>";
    echo "<h2 style = 'text-align: center;'>Semester: $semester</h2>";
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
    table {
        width: 50%;
        margin: 0 auto;
        border-collapse: collapse;
    }
    td{
        padding: 20px;
        border: 1px solid black;
        text-align: center;
    }
    div{
        margin-bottom: 30px;
    }
</style>
<body>
</body>
</html>