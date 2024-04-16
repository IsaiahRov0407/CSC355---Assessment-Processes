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
            <li><a href="#">Home</a></li>
            <li><a href="https://unixweb.kutztown.edu/~irove/CSC355/prototype1.php">Enter/Edit Evaluation</a></li>
            <li><a href="#">Performance Indicator Descriptions</a></li>
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
            echo "<tr><th colspan='" . count($semesters) . "'>Semester View</th></tr>";
            echo "<tr>";
            foreach ($semesters as $semester) {
                echo "<th>$semester</th>";
            }
            echo "</tr>";
            $num_rows = 3;
            for ($i = 0; $i < $num_rows; $i++) {
                echo "<tr>";
                echo "<td></td>"; // Placeholder for actions
                for ($j = 0; $j < count($semesters); $j++) {
                    echo "<td></td>"; // Empty column
                }
                echo "</tr>";
            }
            echo "</table>";
            ?>
        </div>
    </div>
</body>
</html>