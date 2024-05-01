<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Usage Instructions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        /* Style for the header image */
        #header-img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
        }
        p {
            margin-bottom: 15px;
        }
        ol {
            padding-left: 20px;
        }
        li {
            margin-bottom: 10px;
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
        .header {
            background-color: #67001a;
            color: white;
            padding: 10px 0;
            text-align: center;
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
<div class="header"></div>
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
    
    <h1>Project User Guide</h1>
    
    <h2>1. Home Page</h2>
    <p>On the Home Page you will find:</p>
    <ul>
        <li>A master calendar for courses being evaluated for the current semester, along with upcoming evaluations for the next 10 semesters.</li>
        <li>Page selections for updating evaluations both present and future.</li>
    </ul>
    
    <h2>2. Evaluating a Course</h2>
    <p>If you wish to evaluate a course:</p>
    <ol>
        <li>Navigate to the Home Page.</li>
        <li>Select "Enter Evaluation" from the page selector.</li>
        <li>Fill in all relative information.</li>
        <li>Select "Submit Evaluation Form".</li>
        <li>A chart will populate with student count.</li>
        <li>Fill in student information.</li>
        <li>Select "Submit Evaluation Form".</li>
        <li>You will be returned to the Home Page.</li>
        <li>Evaluation is complete.</li>
    </ol>
    
    <h2>3. Evaluating a Future Course</h2>
    <p>If you wish to begin evaluating a future course:</p>
    <ol>
        <li>Navigate to the Home Page.</li>
        <li>Select "Enter Future Evaluation" from the page selector.</li>
        <li>Fill in all relative information.</li>
        <li>Select "Submit Evaluation Form".</li>
        <li>You will be returned to the Home Page.</li>
        <li>Evaluation setup is complete.</li>
    </ol>

    <h2>4. Edit an Existing Evaluation</h2>
    <p>If you wish to edit an existing evaluation:</p>
    <ol>
        <li>Navigate to the Home Page.</li>
        <li>Select "Edit Evaluation" from the page selector.</li>
        <li>Enter the course data you wish to modify.</li>
        <li>Select "Submit".</li>
        <li>A page will open prompting for more information.</li>
        <li>Fill in all relative information.</li>
        <li>Select "Submit".</li>
        <li>A chart will populate with student count.</li>
        <li>Fill in student information.</li>
        <li>Select "Submit Evaluation Form".</li>
        <li>You will be returned to the Home Page.</li>
        <li>Evaluation is complete.</li>
    </ol>

    <h2>5. Entering a New Professor</h2>
    <p>If you wish to enter a new professor into the database:</p>
    <ol>
        <li>Navigate to the Home Page.</li>
        <li>Select "Enter New Professor" from the page selector.</li>
        <li>Enter new professor information in the following format:</li>
        <ul>
            <li>Firstname, Lastname</li>
        </ul>
        <li>Select Submit.</li>
        <li>New Professor information will be saved to the database.</li>
        <li>You will be returned to the Home Page.</li>
    </ol>

    <h2>6. Entering a New Course</h2>
    <p>If you wish to enter a new course into the database:</p>
    <ol>
        <li>Navigate to the Home Page.</li>
        <li>Select "Enter New Course" from the page selector.</li>
        <li>Enter new course information.</li>
        <li>Select Submit.</li>
        <li>New Course information will be saved to the database.</li>
        <li>You will be returned to the Home Page.</li>
    </ol>

    <h2>7. Entering a New Performance Indicator</h2>
    <p>If you wish to enter a new performance indicator:</p>
    <ol>
        <li>Navigate to the Home Page.</li>
        <li>Select "Enter New Performance Indicator" from the page selector.</li>
        <li>Enter new indicator information.</li>
        <li>Select Submit.</li>
        <li>New indicator information will be saved to the database.</li>
        <li>You will be returned to the Home Page.</li>
    </ol>

    <h2>8. Viewing Performance Indicator Descriptions</h2>
    <p>If you wish to see performance indicator descriptions:</p>
    <ol>
        <li>Navigate to the Home Page.</li>
        <li>Select "Performance Indicator Descriptions" from the page selector.</li>
        <li>You will be taken to a page with performance indicator information.</li>
        <li>Find relevant indicator.</li>
        <li>When information is found, click "Home" to return to Home Page.</li>
    </ol>
    
</body>
</html>
