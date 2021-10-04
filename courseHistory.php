<!DOCTYPE html>
<html>
<head>
	<title>Academic Planar</title>
	<meta charset="UTF-8">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="CSS/nav.css">
	<link rel="stylesheet" href="CSS/courseHistory.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<?php
		ob_start();
		session_start();
		require 'vendor/autoload.php';
		include_once 'funcs/StudentFunctions.php';
		$student = getStudent($_SESSION['username']);
	?>
</head>

<body>
	<?php
		include 'nav.php';
	?>

		<div id="content">
			<div id='table_area' class='table_area'>
				<div id='histor_header' class='history_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Course History</h4>
				</div>
				<table class='history_table' id='history_table'>
					<thead>
						<tr>
							<th style='border-radius: 10px 0px 0px 0px;'>Course Number</th>
							<th>Title</th>
							<th>Credits</th>
							<th style='border-radius: 0px 10px 0px 0px'>Grade</th>
						</tr>
					</thead>
					<?php
						for($n=1;$n<=count($student['course_taken'][0]);$n++){
							for($i=0;$i<count($student['course_taken'][0]['semester_'.$n]);$i++){
								echo "<tr>";
								echo "<td id='left' class='data'>".$student['course_taken'][0]['semester_'.$n][$i]['subject'].' '.$student['course_taken'][0]['semester_'.$n][$i]['catalog'].'</td>';
								echo "<td class='data'>".$student['course_taken'][0]['semester_'.$n][$i]['title'].'</td>';
								echo "<td class='data'>".$student['course_taken'][0]['semester_'.$n][$i]['credits'].'</td>';
								echo "<td id='right' class='data'>".$student['course_taken'][0]['semester_'.$n][$i]['grade'].'</td>';
								echo '</tr>';
							}
						}
					?>
				</table>
			</div>
		</div>
</div> <!-- flexbox div ends -->

</body>
</html>
