<!DOCTYPE html>
<html>
<head>
	<title>Academic Planner</title>
	<meta charset="UTF-8">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="CSS/nav.css">
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
			<table>
				<?php
					for($n=1;$n<=count($student['course_taken'][0]);$n++){
						echo "<td> Semester ".$n.'</td>';
						for($i=0;$i<count($student['course_taken'][0]['semester_'.$n]);$i++){
							echo "<tr>";
							echo '<td>'.$student['course_taken'][0]['semester_'.$n][$i]['subject'].' '.$student['course_taken'][0]['semester_'.$n][$i]['catalog'].'</td>';
							echo '<td>'.$student['course_taken'][0]['semester_'.$n][$i]['title'].'</td>';
							echo '<td>'.$student['course_taken'][0]['semester_'.$n][$i]['credits'].'</td>';
							echo '<td>'.$student['course_taken'][0]['semester_'.$n][$i]['grade'].'</td>';
							echo '</tr>';
						}
					}
				?>
			</table>
		</div>
</div> <!-- flexbox div ends -->

</body>
</html>
