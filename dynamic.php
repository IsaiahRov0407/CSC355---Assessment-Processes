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
$semesters = $db->prepare("SELECT SEMESTER FROM SEMESTERS;");
$semesters->execute();

while ($row = $semesters->fetch(PDO::FETCH_ASSOC)) {
    $semesterName[] = $row['SEMESTER'];
}
function generateSemesterList($options) {
    $html = "<ul>";
    foreach ($options as $option) {
        $html .= "<li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/fullSemester.php?semester=" . urlencode($option) . "'>$option</a></li>";
    }
    $html .= "</ul>";
    return $html;
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
<div>
    <label for="Semesters">Semesters:</label><br><br>
    <?php echo generateSemesterList($semesterName);?>
</div>
</body>
</html>