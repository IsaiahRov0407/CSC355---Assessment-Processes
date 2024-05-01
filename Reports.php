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


$getPerformanceInd = $db->prepare("SELECT PerformanceIndicator FROM EVAL WHERE Instructor IS NOT NULL"); 
$getPerformanceInd->execute();
$perfObjective = [];
while ($row = $getPerformanceInd->fetch(PDO::FETCH_ASSOC)) {
    $perfObjective[] = $row['PerformanceIndicator'];
}
$separateValues = [];
    foreach ($perfObjective as $string){
        $values = explode(',', $string);
        foreach ($values as $value){
            $separateValues[] = $value;
        }
    }
$getEvaluation = $db->prepare("SELECT EvaluationScore FROM StudentTable");
$getEvaluation->execute();
$evalScore = [];
while ($row = $getEvaluation->fetch(PDO::FETCH_ASSOC)) {
    $evalScore[] = $row['EvaluationScore'];
}
$separateValues2 = [];
        foreach ($evalScore as $string){
            $values = explode(', ', $string);
            foreach ($values as $value){
                $separateValues2[] = $value;
            }
        }
        $eScore = 0;
        $sScore = 0;
        $dScore = 0;
        $uScore = 0;
$dCount = 0;
foreach($evalScore as $row){
    $explodes = explode(',', $row);
    $dCount += count($explodes);
}

        for($i = 0; $i < $dCount; $i++){
            if ($separateValues2[$i] == 'E'){
                $eScore++;
            }
            else if($separateValues2[$i]== 'S'){
                $sScore++;
            }
            
            else if($separateValues2[$i] == 'D'){
                $dScore++;
            }
            else if($separateValues2[$i] == 'U'){
                $uScore++;
            }
            else{
            }
        }



    $percentageEScore = ($eScore / $dCount) * 100;
	$percentageSScore = ($sScore / $dCount) * 100;
	$percentageDScore = ($dScore / $dCount) * 100;
	$percentageUScore = ($uScore / $dCount) * 100;
    $percentageEScoreFormatted = number_format($percentageEScore, 2); // Rounds to 2 decimal places
    $percentageSScoreFormatted = number_format($percentageSScore, 2); // Rounds to 2 decimal places
    $percentageDScoreFormatted = number_format($percentageDScore, 2); // Rounds to 2 decimal places
    $percentageUScoreFormatted = number_format($percentageUScore, 2); // Rounds to 2 decimal places
    echo "<div class='header'></div>
    <div class='navigation'>
    <ul>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/home.php'>Home</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/Prototype1.php'>Enter Evaluation</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterFutureEvaluation.php'>Enter Future Evaluations</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/editEvaluation.php'>Edit Future Evaluations</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterProf.php'>Enter New Professor</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterCourse.php'>Enter New Course</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterIndicator.php'>Enter New Performance Indicator</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/Reports.php' class='dropbtn'>Reports</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/PID.php'>Performance Indicator Descriptions</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/instructions.php'>Instructions</a></li>
    </ul>
</div>";
    echo "<h1 style = 'text-align: center;'>Percentage of Students That Recieved Each Evaluation Score from Every Class Entered</h1>";
    echo "<table>
        <tr>
            <th>Exemplary</th>
            <th>Satisfactory</th>
            <th>Developing</th>
            <th>Unsatisfactory</th>
        </tr>";
    echo "<tr>
        <td>$percentageEScoreFormatted %</td>
        <td>$percentageSScoreFormatted %</td>
        <td>$percentageDScoreFormatted %</td>
        <td>$percentageUScoreFormatted %</td>
    </tr>";
    
    $semesterQuery = $db->prepare("SELECT DISTINCT SEMESTER FROM SEMESTERS");
    $semesterQuery->execute();

    $semesters = [];
        while ($row = $semesterQuery->fetch(PDO::FETCH_ASSOC)) {
            $semesters[] = $row['SEMESTER'];
        }

    echo "<div class='classes'>";    
    echo "<table border='1'>";
	echo "<tr>";
	foreach ($semesters as $semester) {
		echo "<th colspan='1'><a style = 'color: #ffffff;' href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/fullReport.php?semester=" . urlencode($semester) . "'>$semester</th>";
	}
	echo "</tr>";

		
			echo "<tr>";
			foreach ($semesters as $semester) {
                echo "<td style='height: 700px; background-color: #bbb7bf'>";
                $stmt = $db->prepare("SELECT * FROM EVAL WHERE SEMESTER = :semester AND Instructor IS NOT NULL");
                $stmt->bindParam(':semester', $semester);
                $stmt->execute();
                echo "<ul>";
                while ($courseRow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($courseRow['CourseSection'] != NULL) {
                        echo "<li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/fullReport.php?semester=" . urlencode($semester) . "&code=" . urlencode($courseRow['CourseCode']) . "'>" . $courseRow['CourseCode'] . "-" . $courseRow['CourseSection'] . " " . $courseRow['Assessment'] . "</a></li><br>";
                    }
                    else{
                        echo "<li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/fullReport.php?semester=" . urlencode($semester) . "&code=" . urlencode($courseRow['CourseCode']) . "&sec=" .urlencode($courseRow['CourseSection']) . "'>" . $courseRow['CourseCode'] . " " . $courseRow['Assessment'] . "</a></li><br>";
                        //echo "<li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/fullSemester.php?semester=" . urlencode($semester) . "&code=" . urlencode($courseRow['CourseCode']) . "'>" . $courseRow['CourseCode'] . " " . $courseRow['Assessment'] . "</a></li><br>";
                    }
                    echo "</ul>";
			}
            echo "</ul>";
            echo "</td>";
        }
		echo "</tr>";

		echo "</table>";
        echo "</div>";
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
        width: 100%;
        margin: 0 auto;
        border-collapse: collapse;
    }
    td{
        padding: 20px;
        border: 1px solid black;
        text-align: center;
    }
    .table1{
        margin-bottom: 30px;
    }
    .navigation {
            display: flex;
            justify-content: space-between;
            background-color: #ccc;
            overflow: hidden;
            width: 100%;
            margin-bottom: 50px;
        }

        .navigation ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            width: 100%;
            border: 5px solid black;
        }

        .navigation li {
            width: 25%; /* Each navigation link takes up 1/4 of the width */
        }

        .navigation li a {
            display: block;
            color: #67001a;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navigation li a:hover:not(.active) {
            background-color: #ddd;
        }




th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #67001a;
    color: white;
}
.header {
            background-color: #67001a;
            color: white;
            padding: 10px 0;
            text-align: center;
            border: 5px solid black;
        }
    body {
            background-color: #f0f0f0; /* Change to your desired background color */
    }
    .dropbtn {
    display: block;
    color: #67001a;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    cursor: pointer;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    z-index: 1;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #ddd;
}
.classes{
    padding: 20px;
}
</style>
<body>

</body>
</html>