<?php>

$pdo = new PDO('sqlite:test.db');
$statement = $pdo->query("SELECT * FROM table1");
$instructors = $statement->fetchAll(PDO::FETCH_ASSOC);


foreach($instructors as $row => $table1){
	echo $movie['Instructor]      .     "</li>"       ;
}
