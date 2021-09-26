<!DOCTYPE html>
<html>
<head>
	<title>Academic Planar</title>
	<meta charset="UTF-8">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="CSS/nav.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<link rel="stylesheet" href="CSS/dashboard.css">

	<?php
		ob_start();
		session_start();
		require 'vendor/autoload.php';

		include_once 'funcs/StudentFunctions.php';
		include_once 'funcs/FourYearFunctions.php';
		$student = getStudent($_SESSION['username']);
		$plan = getFourYearbyMajor($student['major'][0]['title']);
		$semester_plan = "semester_".$student['semester'];
	?>
</head>

<body>
	<?php
		include 'nav.php';
	?>

		<div id="content">
			<div class="container">
			
				<div class="schedule">
				<h3> Upcoming Schedule </h3>
				<table class="schedule_table">
					<thead>
						<tr>
							<th>Course Number</th>
							<th>Title</th>
							<th>Credit</th>
							<th>Program</a></th>
						</tr>
					</thead>
					<?php
						for($i=0;$i<count($student['taking_course']);$i++){
							echo "<tr>";
								echo "<td>".$student['taking_course'][$i]['subject']." ".$student['taking_course'][$i]['catalog']."</td>";
								echo "<td>".$student['taking_course'][$i]['title']."</td>";
								echo "<td>".$student['taking_course'][$i]['cred']."</td>";
								echo "<td>".$student['taking_course'][$i]['genED']."</td>";
							echo "</tr>";
						}
					?>
				</table>
				</div>
				<div class="plan">
				<h3> Major Plan Schedule</h3>
				<table class="schedule_table">
					<thead>
						<tr>
							<th>Course Number</th>
							<th>Title</th>
							<th>Credit</th>
						</tr>
					</thead>
					<?php
						for($i=0;$i<count($plan[$semester_plan]);$i++){
							echo "<tr>";
								echo "<td>".$plan[$semester_plan][$i]['subject']." ".$plan[$semester_plan][$i]['catalog']."</td>";
								echo "<td>".$plan[$semester_plan][$i]['title']."</td>";
								echo "<td>".$plan[$semester_plan][$i]['cred']."</td>";
							echo "</tr>";
						}
					?>
				</table>
				</div>
				<div class="personal_info">
					<h3>Personal Info</h3>
					<div class="personal_info_fill">
						<?php echo "<h4> Student ID: ".$student['s_id']."</h4>"; ?>
						<?php echo "<h4> Current Year: ".$student['year']."</h4>"; ?>
						<?php echo "<h4> Current Semester: ".$student['semester']."</h4>"; ?>
						<?php echo "<h4> Advisor Email: ".$student['advisor_mail']."</h4>"; ?>
						<h4> Change Password Button</h4>
					</div>

				</div>
				<div class="progress_bar">
					<header>Progress Bar</header>
				</div>
			</div>
		</div>
	</body>
	</html>
