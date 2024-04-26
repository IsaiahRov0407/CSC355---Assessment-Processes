<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Evaulation</title>
</head>
<style>
</style>
<body>
    <h1>Edit Evaluations</h1>
    <h2>Enter the Course Data you Want to Modify</h2>
    <form style = "text-align: center;" id="profForm" method="POST" action='https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/changeEvaluation.php'>
    <label for="courseCode">Course Code:</label>
    <input type="text" id="courseCode" name="courseCode" required size="7"><br><br>
    <label for="semester">Semester:</label>
    <input type="text" id="semester" name="semester" required size="20"><br><br>
    <label for="courseSec">Course Section (if known):</label>
    <input type="text" id="courseSec" name="courseSec"  size="10"><br><br>
    <button type="submit">Submit</button>
    <button onclick="backToHomepage()">Back to Homepage</button>
    </form>

</body>
<script>
        function backToHomepage(){
            window.location.href = "https://unixweb.kutztown.edu/~dclea255/CourseEvaluator/home.php";
        }
</script>
</html>