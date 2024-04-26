<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            text-align: center;
            color: #67001a;
        }

        .header {
            background-color: #67001a;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            background-color: #ccc;
            overflow: hidden;
            width: 100%;
        }

        .navigation ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            width: 100%;
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

        .active {
            background-color: #04AA6D;
        }

        .content-container {
            margin-top: 20px;
            text-align: center;
        }

        .table-container {
            display: inline-block;
            text-align: center; 
			width: 80%;
			margin-top: 100px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
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

    </style>
</head>
<body>
    <h1 class="burgundy-text">Course Evaluator</h1>
    <div class="header"></div>
    <div class="navigation">
        <ul>
            <li><a href="https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/home.php">Home</a></li>
            <li><a href="https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/Prototype1.php">Enter Evaluation</a></li>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterFutureEvaluation.php'>Enter Future Evaluations</a></li>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/editEvaluation.php'>Edit Evaluation</a></li>
            <li><a href="https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterProf.php">Enter New Professor</a></li>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterCourse.php'>Enter New Course</a></li>
            <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterIndicator.php'>Enter New Performance Indicator</a></li>
            <li><a href="https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/PID.php">Performance Indicator Descriptions</a></li>
            <li><a href="https://unixweb.kutztown.edu/~irove/instructions.php">Instructions</a></li>
        </ul>
    </div>
    <div class="content-container">
        <div class="table-container">
            <?php
            try {
                $db = new PDO('sqlite:CSC355.db');
            } 
            catch (Exception $exc){
                echo 'Exception: Cannot connect to the database: ', $exc->getMessage(), "\n";
            }

            $semesterQuery = $db->prepare("SELECT DISTINCT SEMESTER FROM SEMESTERS");
            $semesterQuery->execute();

            $semesters = [];
            while ($row = $semesterQuery->fetch(PDO::FETCH_ASSOC)) {
                $semesters[] = $row['SEMESTER'];
            }

            echo "<table border='1'>";
			echo "<tr>";
			foreach ($semesters as $semester) {
				echo "<th colspan='1'><a style = 'color: #ffffff;' href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/fullSemester.php?semester=" . urlencode($semester) . "'>$semester</th>";
			}
			echo "</tr>";

		
			echo "<tr>";
			foreach ($semesters as $semester) {
                echo "<td style='height: 700px; background-color: #bbb7bf'>";
                $stmt = $db->prepare("SELECT * FROM EVAL WHERE SEMESTER = :semester");
                $stmt->bindParam(':semester', $semester);
                $stmt->execute();
                echo "<ul>";
                while ($courseRow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($courseRow['CourseSection'] != NULL) {
                        echo "<li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/fullSemester.php?semester=" . urlencode($semester) . "&code=" . urlencode($courseRow['CourseCode']) . "&sec=" .urlencode($courseRow['CourseSection']) . "'>" . $courseRow['CourseCode'] . "-" . $courseRow['CourseSection'] . " " . $courseRow['Assessment'] . "</a></li><br>";
                    }
                    else{
                        echo "<li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/fullSemester.php?semester=" . urlencode($semester) . "&code=" . urlencode($courseRow['CourseCode']) . "&sec=" .urlencode($courseRow['CourseSection']) . "'>" . $courseRow['CourseCode'] . " " . $courseRow['Assessment'] . "</a></li><br>";
                        //echo "<li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/fullSemester.php?semester=" . urlencode($semester) . "&code=" . urlencode($courseRow['CourseCode']) . "'>" . $courseRow['CourseCode'] . " " . $courseRow['Assessment'] . "</a></li><br>";
                    }
                    echo "</ul>";
			}
            echo "</ul>";
            echo "</td>";
        }
		echo "</tr>";

		echo "</table>";
			?>
        </div>
    </div>
</body>
</html>