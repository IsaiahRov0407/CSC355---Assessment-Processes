<?php

try {
    $db = new PDO('sqlite:CSC355.db');
} 
catch (Exception $exc){
    echo 'Exception: Cannot connect to the database: ', $exc->getMessage(), "\n";
}

//query to get CSIT-1 Main and Sub Objects
$BigObj1Query = $db->prepare("SELECT * FROM  BigObj WHERE Obj LIKE 'CSIT-1'");
$BigObj1Query->execute();
$BigObj1 = [];
$perfObjNames = [];
while ($row = $BigObj1Query->fetch(PDO::FETCH_ASSOC)) {
    $BigObj1[] = $row['Obj'];
    $BigObj1Desc[] = $row['Description'];
}
function generateBigObj1($name, $options, $optionTexts) {
  $html = "";
    foreach ($options as $index =>$option) {
    $optionText = $optionTexts[$index];
      $html .= "<label style = 'font-weight: bold; font-size: 18px;' for='{$option}'>{$option}</label><br><br>";
      $html .= "<div style='margin-left: 20px; font-weight: bold; font-size: 18px;'>{$optionText}</div><br><br>";
    }
    return $html;
}

$subObj1Query = $db ->prepare("SELECT * FROM AssessmentObj WHERE name LIKE 'CSIT-1%'");
$subObj1Query -> execute();
$subObj1 = [];
$subObj1Desc = [];

while ($row = $subObj1Query->fetch(PDO::FETCH_ASSOC)) {
    $subObj1[] = $row["name"];
    $subObj1Desc[] = $row["descriptions"];
}

function generateSubObj1($names, $descriptions, $options, $optionTexts) {
    $html = "";
    foreach ($options as $index => $option) {
        $optionText = $optionTexts[$index];
        $name = $names[$index];
        $description = $descriptions[$index];
        $html .= "<label for='{$option}'>{$option} {$optionText}</label><br>";
        $html .= "<div style='margin-left: 20px;'>{$description}</div><br><br>";
    }
    return $html;
}


//Query to get CSIT-2 and Sub Objectives
$BigObj2Query = $db->prepare("SELECT * FROM  BigObj WHERE Obj LIKE 'CSIT-2'");
$BigObj2Query->execute();
$BigObj2 = [];
$perfObjNames = [];
while ($row = $BigObj2Query->fetch(PDO::FETCH_ASSOC)) {
    $BigObj2[] = $row['Obj'];
    $BigObj2Desc[] = $row['Description'];
}
function generateBigObj2($name, $options, $optionTexts) {
  $html = "";
    foreach ($options as $index =>$option) {
    $optionText = $optionTexts[$index];
        $html .= "<label style = 'font-weight: bold; font-size: 18px;' for='{$option}'>{$option}</label><br><br>";
        $html .= "<div style='margin-left: 20px; font-weight: bold; font-size: 18px;'>{$optionText}</div><br><br>";
    }
    return $html;
}


$subObj2Query = $db ->prepare("SELECT * FROM AssessmentObj WHERE name LIKE 'CSIT-2%'");
$subObj2Query -> execute();
$subObj2 = [];
$subObj2Desc = [];

while ($row = $subObj2Query->fetch(PDO::FETCH_ASSOC)) {
    $subObj2[] = $row["name"];
    $subObj2Desc[] = $row["descriptions"];
}

function generateSubObj2($names, $descriptions, $options, $optionTexts) {
    $html = "";
    foreach ($options as $index => $option) {
        $optionText = $optionTexts[$index];
        $name = $names[$index];
        $description = $descriptions[$index];
        $html .= "<label for='{$option}'>{$option} {$optionText}</label><br>";
        $html .= "<div style='margin-left: 20px;'>{$description}</div><br><br>";
    }
    return $html;
}
//Query to get CSIT-3 and Sub Objectives
$BigObj3Query = $db->prepare("SELECT * FROM  BigObj WHERE Obj LIKE 'CSIT-3'");
$BigObj3Query->execute();
$BigObj3 = [];
$perfObjNames = [];
while ($row = $BigObj3Query->fetch(PDO::FETCH_ASSOC)) {
    $BigObj3[] = $row['Obj'];
    $BigObj3Desc[] = $row['Description'];
}
function generateBigObj3($name, $options, $optionTexts) {
  $html = "";
    foreach ($options as $index =>$option) {
    $optionText = $optionTexts[$index];
        $html .= "<label style = 'font-weight: bold; font-size: 18px;' for='{$option}'>{$option}</label><br><br>";
        $html .= "<div style='margin-left: 20px; font-weight: bold; font-size: 18px;'>{$optionText}</div><br><br>";
    }
    return $html;
}

$subObj3Query = $db ->prepare("SELECT * FROM AssessmentObj WHERE name LIKE 'CSIT-3%'");
$subObj3Query -> execute();
$subObj3 = [];
$subObj3Desc = [];

while ($row = $subObj3Query->fetch(PDO::FETCH_ASSOC)) {
    $subObj3[] = $row["name"];
    $subObj3Desc[] = $row["descriptions"];
}

function generateSubObj3($names, $descriptions, $options, $optionTexts) {
    $html = "";
    foreach ($options as $index => $option) {
        $optionText = $optionTexts[$index];
        $name = $names[$index];
        $description = $descriptions[$index];
        $html .= "<label for='{$option}'>{$option} {$optionText}</label><br>";
        $html .= "<div style='margin-left: 20px;'>{$description}</div><br><br>";
    }
    return $html;
}
//Query to get CSIT-4 and Sub Objectives
$BigObj4Query = $db->prepare("SELECT * FROM  BigObj WHERE Obj LIKE 'CSIT-4'");
$BigObj4Query->execute();
$BigObj4 = [];
$perfObjNames = [];
while ($row = $BigObj4Query->fetch(PDO::FETCH_ASSOC)) {
    $BigObj4[] = $row['Obj'];
    $BigObj4Desc[] = $row['Description'];
}
function generateBigObj4($name, $options, $optionTexts) {
  $html = "";
    foreach ($options as $index =>$option) {
    $optionText = $optionTexts[$index];
        $html .= "<label style = 'font-weight: bold; font-size: 18px;' for='{$option}'>{$option}</label><br><br>";
        $html .= "<div style='margin-left: 20px; font-weight: bold; font-size: 18px;'>{$optionText}</div><br><br>";
    }
    return $html;
}

$subObj4Query = $db ->prepare("SELECT * FROM AssessmentObj WHERE name LIKE 'CSIT-4%'");
$subObj4Query -> execute();
$subObj4 = [];
$subObj4Desc = [];

while ($row = $subObj4Query->fetch(PDO::FETCH_ASSOC)) {
    $subObj4[] = $row["name"];
    $subObj4Desc[] = $row["descriptions"];
}

function generateSubObj4($names, $descriptions, $options, $optionTexts) {
    $html = "";
    foreach ($options as $index => $option) {
        $optionText = $optionTexts[$index];
        $name = $names[$index];
        $description = $descriptions[$index];
        $html .= "<label for='{$option}'>{$option} {$optionText}</label><br>";
        $html .= "<div style='margin-left: 20px;'>{$description}</div><br><br>";
    }
    return $html;
}
//Query to get CSIT-5 and Sub Objectives
$BigObj5Query = $db->prepare("SELECT * FROM  BigObj WHERE Obj LIKE 'CSIT-5'");
$BigObj5Query->execute();
$BigObj5 = [];
$perfObjNames = [];
while ($row = $BigObj5Query->fetch(PDO::FETCH_ASSOC)) {
    $BigObj5[] = $row['Obj'];
    $BigObj5Desc[] = $row['Description'];
}
function generateBigObj5($name, $options, $optionTexts) {
  $html = "";
    foreach ($options as $index =>$option) {
    $optionText = $optionTexts[$index];
        $html .= "<label style = 'font-weight: bold; font-size: 18px;' for='{$option}'>{$option}</label><br><br>";
        $html .= "<div style='margin-left: 20px; font-weight: bold; font-size: 18px;'>{$optionText}</div><br><br>";
    }
    return $html;
}

$subObj5Query = $db ->prepare("SELECT * FROM AssessmentObj WHERE name LIKE 'CSIT-5%'");
$subObj5Query -> execute();
$subObj5 = [];
$subObj5Desc = [];

while ($row = $subObj5Query->fetch(PDO::FETCH_ASSOC)) {
    $subObj5[] = $row["name"];
    $subObj5Desc[] = $row["descriptions"];
}

function generateSubObj5($names, $descriptions, $options, $optionTexts) {
    $html = "";
    foreach ($options as $index => $option) {
        $optionText = $optionTexts[$index];
        $name = $names[$index];
        $description = $descriptions[$index];
        $html .= "<label for='{$option}'>{$option} {$optionText}</label><br>";
        $html .= "<div style='margin-left: 20px;'>{$description}</div><br><br>";
    }
    return $html;
}
//Query to get CS-6 and Sub Objectives
$BigObj6Query = $db->prepare("SELECT * FROM  BigObj WHERE Obj LIKE 'CS-6'");
$BigObj6Query->execute();
$BigObj6 = [];
$perfObjNames = [];
while ($row = $BigObj6Query->fetch(PDO::FETCH_ASSOC)) {
    $BigObj6[] = $row['Obj'];
    $BigObj6Desc[] = $row['Description'];
}
function generateBigObj6($name, $options, $optionTexts) {
  $html = "";
    foreach ($options as $index =>$option) {
    $optionText = $optionTexts[$index];
        $html .= "<label style = 'font-weight: bold; font-size: 18px;' for='{$option}'>{$option}</label><br><br>";
        $html .= "<div style='margin-left: 20px; font-weight: bold; font-size: 18px;'>{$optionText}</div><br><br>";
    }
    return $html;
}

$subObj6Query = $db ->prepare("SELECT * FROM AssessmentObj WHERE name LIKE 'CS-6%'");
$subObj6Query -> execute();
$subObj6 = [];
$subObj6Desc = [];

while ($row = $subObj6Query->fetch(PDO::FETCH_ASSOC)) {
    $subObj6[] = $row["name"];
    $subObj6Desc[] = $row["descriptions"];
}

function generateSubObj6($names, $descriptions, $options, $optionTexts) {
    $html = "";
    foreach ($options as $index => $option) {
        $optionText = $optionTexts[$index];
        $name = $names[$index];
        $description = $descriptions[$index];
        $html .= "<label for='{$option}'>{$option} {$optionText}</label><br>";
        $html .= "<div style='margin-left: 20px;'>{$description}</div><br><br>";
    }
    return $html;
}

//Query to get IT-6 and Sub Objectives
$BigObj7Query = $db->prepare("SELECT * FROM  BigObj WHERE Obj LIKE 'IT-6'");
$BigObj7Query->execute();
$BigObj7 = [];
$perfObjNames = [];
while ($row = $BigObj7Query->fetch(PDO::FETCH_ASSOC)) {
    $BigObj7[] = $row['Obj'];
    $BigObj7Desc[] = $row['Description'];
}
function generateBigObj7($name, $options, $optionTexts) {
  $html = "";
    foreach ($options as $index =>$option) {
    $optionText = $optionTexts[$index];
        $html .= "<label style = 'font-weight: bold; font-size: 18px;' for='{$option}'>{$option}</label><br><br>";
        $html .= "<div style='margin-left: 20px; font-weight: bold; font-size: 18px;'>{$optionText}</div><br><br>";
    }
    return $html;
}

$subObj7Query = $db ->prepare("SELECT * FROM AssessmentObj WHERE name LIKE 'IT-6%'");
$subObj7Query -> execute();
$subObj7 = [];
$subObj7Desc = [];

while ($row = $subObj7Query->fetch(PDO::FETCH_ASSOC)) {
    $subObj7[] = $row["name"];
    $subObj7Desc[] = $row["descriptions"];
}

function generateSubObj7($names, $descriptions, $options, $optionTexts) {
    $html = "";
    foreach ($options as $index => $option) {
        $optionText = $optionTexts[$index];
        $name = $names[$index];
        $description = $descriptions[$index];
        $html .= "<label for='{$option}'>{$option} {$optionText}</label><br>";
        $html .= "<div style='margin-left: 20px;'>{$description}</div><br><br>";
    }
    return $html;
}
//Query to get GD Objectives
/*$BigObj8Query = $db->prepare("SELECT * FROM  BigObj WHERE Obj LIKE 'GD-%'");
$BigObj8Query->execute();
$BigObj8 = [];
$perfObjNames = [];
while ($row = $BigObj8Query->fetch(PDO::FETCH_ASSOC)) {
    $BigObj8[] = $row['Obj'];
    $BigObj8Desc[] = $row['Description'];
}
function generateBigObj8($name, $options, $optionTexts) {
  $html = "";
    foreach ($options as $index =>$option) {
    $optionText = $optionTexts[$index];
      $html .= "<label for='{$option}'>{$option} {$optionText}</label><br><br>";
    }
    return $html;
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Registration</title>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
		color: #67001a;
    }
	table-container{
		color: #67001a;	
	}
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    th {
        background-color: #7e0303;
        color: white;
    }
	.table-container {
		width: 800px;
		overflow-x: auto;
		margin: 0 auto;
	}
    .sub-checkbox {
      margin-left: 20px;
    }
  
    .form-container button {
            background-color: #67001a;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
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
    .horizontal-line{
        width: 100%;
        height: 2px; 
        background-color: black;
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
</style>
</head>
<body>
<div class='header'></div>
<div class='navigation'>
    <ul>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/home.php'>Home</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/Prototype1.php'>Enter Evaluation</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterFutureEvaluation.php'>Enter Future Evaluations</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/editEvaluation.php'>Edit Future Evaluations</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterProf.php'>Enter New Professor</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterCourse.php'>Enter New Course</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/enterIndicator.php'>Enter New Performance Indicator</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/Reports.php' class="dropbtn">Reports</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/PID.php'>Performance Indicator Descriptions</a></li>
        <li><a href='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/instructions.php'>Instructions</a></li>
    </ul>
</div>

<h2></h2>

<form id="courseForm" method="POST" action="https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/Saving.php">
<div class ="form-container">

         <?php echo generateBigObj1("objective", $BigObj1, $BigObj1Desc)?>
		 <?php echo generateSubObj1($subObj1, $subObj1Desc, $subObj1,$perfObjNames); ?>
         <div class="horizontal-line"></div>
		 <?php echo generateBigObj2("objective", $BigObj2, $BigObj2Desc)?>
		 <?php echo generateSubObj2($subObj2, $subObj2Desc, $subObj2,$perfObjNames); ?>
         <div class="horizontal-line"></div>
		 <?php echo generateBigObj3("objective", $BigObj3, $BigObj3Desc)?>
		 <?php echo generateSubObj3($subObj3, $subObj3Desc, $subObj3,$perfObjNames); ?>
         <div class="horizontal-line"></div>
		 <?php echo generateBigObj4("objective", $BigObj4, $BigObj4Desc)?>
		 <?php echo generateSubObj4($subObj4, $subObj4Desc, $subObj4,$perfObjNames); ?>
         <div class="horizontal-line"></div>
		 <?php echo generateBigObj5("objective", $BigObj5, $BigObj5Desc)?>
		 <?php echo generateSubObj5($subObj5, $subObj5Desc, $subObj5,$perfObjNames); ?>
         <div class="horizontal-line"></div>
		 <?php echo generateBigObj6("objective", $BigObj6, $BigObj6Desc)?>
		 <?php echo generateSubObj6($subObj6, $subObj6Desc, $subObj6,$perfObjNames); ?>
         <div class="horizontal-line"></div>
		 <?php echo generateBigObj7("objective", $BigObj7, $BigObj7Desc)?>
		 <?php echo generateSubObj7($subObj7, $subObj7Desc, $subObj7,$perfObjNames); ?>
		 
</div> 
</form>

<script>