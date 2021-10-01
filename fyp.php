<!DOCTYPE html>
<html>
<head>
	<title>Academic Planner</title>
	<meta charset="UTF-8">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="CSS/nav.css">
	<link rel="stylesheet" href="CSS/fyp.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<?php
		ob_start();
		session_start();
		require 'vendor/autoload.php';
		include_once 'funcs/StudentFunctions.php';
		include_once 'funcs/FourYearFunctions.php';
		$student = getStudent($_SESSION['username']);
		$fyp = getFourYearbyMajor($student['major'][0]['title']);
		$sem = $student['semester'];
	?>
</head>

<body>
	<?php
		include 'nav.php';
	?>

		<div id="content">
			<div class=t1>
				<table>
					<?php
						for ($n=1;$n<=4;$n++){
							echo "<td> Semester ".$n.'</td>';
							for ($i=0;$i<count($fyp["semester_".$n]);$i++){
								echo "<tr>";
								echo '<td>'.$fyp["semester_".$n][$i]['subject'].' '.$fyp['semester_'.$n][$i]['catalog'].'</td>';
								echo '<td>'.$fyp['semester_'.$n][$i]['title'].'</td>';
								echo '<td>'.$fyp['semester_'.$n][$i]['cred'].'</td>';
								echo "\n";
							}
							echo "<tr></tr>";
						}
					?>
				</table>
			</div>
			<div class=t2;>
				<table>
					<?php
						for ($n=5;$n<=8;$n++){
							echo "<td> Semester ".$n.'</td>';
							for ($i=0;$i<count($fyp["semester_".$n]);$i++){
								echo "<tr>";
								echo '<td>'.$fyp["semester_".$n][$i]['subject'].' '.$fyp['semester_'.$n][$i]['catalog'].'</td>';
								echo '<td>'.$fyp['semester_'.$n][$i]['title'].'</td>';
								echo '<td>'.$fyp['semester_'.$n][$i]['cred'].'</td>';
							}
							echo "<tr></tr>";
						}
					?>
				</table>
			</div>
		</div>
</div> <!-- flexbox div ends -->

</body>
</html>
