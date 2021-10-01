<!DOCTYPE html>
<html>
	<head>
		<title>Academic Planner</title>
		<meta charset="UTF-8">
		<!-- for caret -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
		<link rel="stylesheet" href="CSS/nav.css">
		<script src="https://code.jquery.com/jquery-3.4.1.js">


		</script>

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
		$progress = $student['credits'];
		$progress_percent = intval(100 * ($progress / 120));
		$progress_percent_str = strval($progress_percent)."%";
		$progress_width = 'width: '.$progress_percent.'%;';
	?>
	<style>
			.progress {
				<?php echo $progress_width; ?>;
			}
	</style>
</head>

			$student = getStudent($_SESSION['username']);
			$plan = getFourYearbyMajor($student['major'][0]['title']);
			$semester_plan = "semester_".$student['semester'];
			$progress = $student['credits'];
			$progress_percent = intval(100 * ($progress / 120));
			$progress_percent_str = strval($progress_percent)."%";
			$progress_width = 'width: '.$progress_percent.'%;';
		?>
		<style>
				.progress {
					<?php echo $progress_width; ?>;
				}
		</style>
	</head>

	<body onload="setSize();">
		<?php
			include 'nav.php';
		?>
			<div class="container">

				<div class="schedule" id="schedule">
					<h3> Upcoming Schedule </h3>
					<div class="table_area">
						<table class="schedule_table">
							<thead>
								<tr>
									<th style="border-radius: 10px 0px 0px 0px;">Course Number</th>
									<th>Title</th>
									<th style="border-radius: 0px 10px 0px 0px;">Credit</th>
								</tr>
							</thead>
							<?php
								for($i=0;$i<count($student['taking_course']);$i++){
									echo "<tr>";
										echo "<td>".$student['taking_course'][$i]['subject']." ".$student['taking_course'][$i]['catalog']."</td>";
										echo "<td>".$student['taking_course'][$i]['title']."</td>";
										echo "<td>".$student['taking_course'][$i]['cred']."</td>";
									echo "</tr>";
								}
							?>
						</table>
					</div>
				</div>
				<div class="plan" id="plan">
					<h3> Major Plan Schedule</h3>
					<div class="table_area">
						<table class="schedule_table">
							<thead>
								<tr>
									<th style="border-radius: 10px 0px 0px 0px;">Course Number</th>
									<th>Title</th>
									<th style="border-radius: 0px 10px 0px 0px;">Credit</th>
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
				</div>
				<div class="personal_info" id="personal_info">
					<h3> Personal Information </h3>
					<div class="info_area">
						<div class="dash_info">
							<?php
								echo "<h4> Name: ".$student['name']."</h4>";
								echo "<h4> Student ID: ".$student['s_id']."</h4>";
								$cnt = count($student['major']);
								if($cnt == 1)
									$major_print = "<h4> Major(s): ".$student['major'][0]['title']."</h4>";
								else if($cnt == 2)
									$major_print = "<h4> Major(s): ".$student['major'][0]['title'].", ".$student['major'][1]['title']."</h4>";
								else if($cnt == 3)
									$major_print = "<h4> Major(s): ".$student['major'][0]['title'].", ".$student['major'][1]['title'].", ".$student['major'][2]['title']."</h4>";
								echo $major_print;
								$cnt = count($student['minor']);
								if($cnt == 1)
									$major_print = "<h4> Minor(s): ".$student['minor'][0]['title']."</h4>";
								else if($cnt == 2)
									$major_print = "<h4> Minor(s): ".$student['minor'][0]['title'].", ".$student['minor'][1]['title']."</h4>";
								else if($cnt == 3)
									$major_print = "<h4> Minor(s): ".$student['minor'][0]['title'].", ".$student['minor'][1]['title'].", ".$student['minor'][2]['title']."</h4>";
								echo $major_print;
							?>
							<h4> Change Password Button</h4>
						</div>
					</div>
				</div>
				<div class="credit_info" id="credit_info">
					<h3> Credit Info </h3>
					<div class="info_area">
						<div class="dash_info">
							<?php
								echo "<h4> Current Year: ".$student['year']."</h4>";
								echo "<h4> Current Semester: ".$student['semester']."</h4>";

								$credits = 0;
								for($i=0;$i<count($student['taking_course']);$i++)
									$credits = $credits+$student['taking_course'][$i]['cred'];

								echo "<h4> Credits Registered For: ".$credits."</h4>";
								echo "<h4> Total Credits: ".$student['credits']."</h4>";
							?>
						</div>
					</div>
				</div>
				<div class="advisor_info" id="advisor_info">
					<h3> Enrollment Info </h3>
					<div class="info_area">
						<div class="dash_info">
							<?php
								echo "<h4> Advisor Email: ".$student['advisor_mail']."</h4>";
								echo "<h4> Enrollment Date: ".$student['enrll']."</h4>";
								echo "<h4> Registering For: ".$student['registering_for']."</h4>";
							?>
						</div>
					</div>
				</div>
					<div class="progress_bar" id="progress_bar">
						<h4 style="color: white;">Credits Progress</h4>
						<div class="progress">
							<?php
								echo $progress_percent_str;
							?>
						</div>
					</div>
				</div>
			</div>
	</div>
	<script>
		function setSize() {
				var w = window.innerWidth;
				var h = window.innerHeight;
				document.getElementById("schedule").style.minWidth=w/2.15-100+"px";
				document.getElementById("schedule").style.maxHeight=h/1.5-75+"px";

				document.getElementById("plan").style.minWidth=w/2.15-100+"px";
				document.getElementById("plan").style.maxHeight=h/1.5-75+"px";

				document.getElementById("personal_info").style.minWidth=w/3.25-75+"px";
				document.getElementById("personal_info").style.maxHeight=h/2.75-75+"px";

				document.getElementById("advisor_info").style.minWidth=w/3.25-75+"px";
				document.getElementById("advisor_info").style.maxHeight=h/2.75-75+"px";

				document.getElementById("credit_info").style.minWidth=w/3.25-75+"px";
				document.getElementById("credit_info").style.maxHeight=h/2.75-75+"px";

				document.getElementById("progress_bar").style.minWidth=w*.85-100+"px";
				document.getElementById("progress_bar").style.maxHeight=h/5-75+"px";
			}
	</script>
	</body>

</html>
