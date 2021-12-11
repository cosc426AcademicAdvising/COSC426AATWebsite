<!DOCTYPE html>
<html lang="en">

<head>
	<title>Dashboard</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="public/css/nav.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<link rel="stylesheet" href="public/css/dashboard.css">
	<link rel="stylesheet" href="public/css/flashmessage.css">

	<?php
	ob_start();
	session_start();
	$student = getStudent($_SESSION['username']);
	$sem = $student['course_taken'][0];
	$cnt = count($sem);
	$total_credits = 0;
	for ($i = 1; $i < $cnt + 1; $i++) {
		$field = "semester_" . $i;
		if($i == 9)
			$field = "semester_winter";
		if($i == 10)
			$field = "semester_summer";
		$courses = $sem[$field];
		$cnt_course = count($courses);
		for ($j = 0; $j < $cnt_course; $j++) {
			$total_credits = $total_credits + intval($courses[$j]['credits']);
		}
	}
	$year = "";
	$semester = "";
	if ($total_credits < 30) {
		$year = "Freshman";
		if ($total_credits < 15)
			$semester = "1";
		else
			$semester = "2";
	} else if ($total_credits < 60) {
		$year = "Sophmore";
		if ($total_credits < 45)
			$semester = "3";
		else
			$semester = "4";
	} else if ($total_credits < 90) {
		$year = "Junior";
		if ($total_credits < 75)
			$semester = "5";
		else
			$semester = "6";
	} else {
		$year = "Senior";
		if ($total_credits < 105)
			$semester = "7";
		else
			$semester = "8";
	}
	$plan = getFourYearbyMajor($student['major'][0]['title']);
	$semester_plan = "semester_" . $student['semester'];
	$progress = $total_credits;
	$progress_percent = intval(100 * ($progress / 120));
	$progress_percent_str = strval($progress_percent) . "%";
	$progress_width = 'width: ' . $progress_percent . '%;';
	$majors = array();
	for ($i = 0; $i < count($student['major']); $i++) {
		$majors[$i] = $student['major'][$i]['title'];
	}

	// for recommandations
	combinedFourYear($majors);
	echo '<script> var student_id = ' . json_encode($student['s_id'])  . '; </script>';
	echo '<script> var student_course_hist = ' . json_encode($student['course_taken'])  . '; </script>';
	echo '<script> var current_semester_number = ' . json_encode(intval($student['semester']))  . '; </script>';
	?>
	<style>
		.progress {
			<?php echo $progress_width; ?>
		}
	</style>
</head>

<body>
	<?php
	include 'nav.php';
	?>

	<div id="content" style="overflow: auto">
		<div class="container" id="container">

			<!-- for messages to user -->
			<section id="message-container"></section>
			<script src="public/js/flashmessage.js"></script>

			<?php
			if (isset($_GET['success'])){
				if($_GET['success'] == '1'){
					echo "<script>message('success', '<b>Alert:</b><br/> Your draft has been saved!');</script>";
				}
				elseif($_GET['success'] == '2'){
					echo "<script>message('success', '<b>Alert:</b><br/> Your new schedule has been submitted!');</script>";
				}
			}
			?>

			<div class="schedule" id="schedule">

				<div class="dash_header">
					<h3> Upcoming Schedule </h3>
				</div>

				<div class="table_area">

					<?php
					$total = count($student['taking_course']);
					if ($total > 0) {
						echo '<table class="schedule_table">';
						displayScheduleCurrent($student);
						echo '</table>';
					} else {
						echo "<div class='alt'>";
						echo "<h2> No Schedule Found </h2>";
						echo "<h2> On the left sidebar </h2>";
						echo "<h2> Please go to Schedule -> New </h2>";
						echo "<h2> to create your schedule </h2>";
						echo "</div>";
					}
					?>

				</div>
			</div>
			<div class="plan" id="plan">
				<div class="dash_header">
					<h3> Recommended Courses</h3>
				</div>

				<div class="table_area">
					<table class="schedule_table" id="recommended-course-table">
						<thead>
							<tr>
								<th style="border-right: solid; border-bottom: solid;">Course Number</th>
								<th style="border-bottom: solid;">Title</th>
								<th style="border-left: solid; border-bottom: solid;">Credits</th>
							</tr>
						</thead>
					</table>

				</div>
				<!-- courses recommandations -->
				<script src="public/js/recommendCourses.js"></script>
				<script src="public/js/scheduleNewFuncs.js"></script>
				<script>
					var recommandations = recommend_courses(false);
					add_recommended(recommandations);
				</script>

			</div>
			<div class="personal_info" id="personal_info">
				<div class="dash_header_info">
					<h3> Personal Information </h3>
				</div>
				<div class="info_area">
					<div class="dash_info">

						<div class='row_odd'>
							<div class='row_odd_field' id='row_odd_field'>
								<h4> Name </h4>
							</div>
							<div class='row_odd_value' id='row_odd_value'>
								<?php echo "<h4>" . $student['name'] . "</h4>"; ?>
							</div>
						</div>

						<div class='row_even'>
							<div class='row_even_field' id='row_even_field'>
								<h4> Student ID</h4>
							</div>
							<div class='row_even_value' id='row_even_value'>
								<?php echo "<h4>" . $student['s_id'] . "</h4>"; ?>
							</div>
						</div>
						<?php
						$cnt = count($student['major']);
						if ($cnt == 1) {
							$major_field_print = "<h4> Major(s)</h4>";
							$major_value_print = "<h4>" . $student['major'][0]['title'] . "</h4>";
						} else if ($cnt == 2) {
							$major_field_print = "<h4> Major(s)</h4>";
							$major_value_print = "<h4>" . $student['major'][0]['title'] . ", " . $student['major'][1]['title'] . "</h4>";
						} else if ($cnt == 3) {
							$major_field_print = "<h4> Major(s)</h4>";
							$major_value_print = "<h4>" . $student['major'][0]['title'] . ", " . $student['major'][1]['title'] . ", " . $student['major'][2]['title'] . "</h4>";
						}
						?>
						<div class='row_odd'>
							<div class='row_odd_field' id='row_odd_field'>
								<?php echo $major_field_print; ?>
							</div>
							<div class='row_odd_value' id='row_odd_value'>
								<?php echo $major_value_print; ?>
							</div>
						</div>
						<?php
						$cnt = count($student['minor']);
						if ($cnt == 1) {
							$minor_field_print = "<h4> Minor(s)</h4>";
							$minor_value_print = "<h4>" . $student['minor'][0]['title'] . "</h4>";
						} else if ($cnt == 2) {
							$minor_field_print = "<h4> Minor(s)</h4>";
							$minor_value_print = "<h4>" . $student['minor'][0]['title'] . ", " . $student['minor'][1]['title'] . "</h4>";
						} else if ($cnt == 3) {
							$minor_field_print = "<h4> Minor(s)</h4>";
							$minor_value_print = "<h4>" . $student['minor'][0]['title'] . ", " . $student['minor'][1]['title'] . ", " . $student['minor'][2]['title'] . "</h4>";
						}
						?>
						<div class='row_even' style='border-radius: 0px 0px 10px 10px;'>
							<div class='row_even_field' id='row_even_field' style='border-bottom: none;'>
								<?php echo $minor_field_print; ?>
							</div>
							<div class='row_even_value' id='row_even_value' style='border-bottom: none;'>
								<?php echo $minor_value_print; ?>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="credit_info" id="credit_info">
				<div class="dash_header_info">
					<h3> Credit Info </h3>
				</div>
				<div class="info_area">
					<div class="dash_info">

						<div class='row_odd'>
							<div class='row_odd_field' id='row_odd_field'>
								<h4> Current Year</h4>
							</div>
							<div class='row_odd_value' id='row_odd_value'>
								<?php echo "<h4>" . $year . "</h4>"; ?>
							</div>
						</div>

						<div class='row_even'>
							<div class='row_even_field' id='row_even_field'>
								<h4> Current Semester</h4>
							</div>
							<div class='row_even_value' id='row_even_value'>
								<?php echo "<h4>" . $semester . "</h4>"; ?>
							</div>
						</div>
						<?php
						$credits = 0;
						for ($i = 0; $i < count($student['taking_course']); $i++)
							$credits = $credits + $student['taking_course'][$i]['cred'];
						?>
						<div class='row_odd'>
							<div class='row_odd_field' id='row_odd_field'>
								<h4> Credits Registered For</h4>
							</div>
							<div class='row_odd_value' id='row_odd_value'>
								<?php echo "<h4>" . $credits . "</h4>"; ?>
							</div>
						</div>

						<div class='row_even' style='border-radius: 0px 0px 10px 10px;'>
							<div class='row_even_field' id='row_even_field' style='border-bottom: none'>
								<h4> Total Credits</h4>
							</div>
							<div class='row_even_value' id='row_even_value' style='border-bottom: none'>
								<?php echo "<h4>" . $total_credits . "</h4>"; ?>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="advisor_info" id="advisor_info">
				<div class="dash_header_info">
					<h3>Enrollment Info </h3>
				</div>
				<div class="info_area">
					<div class="dash_info">
						<div class='row_odd'>
							<div class='row_odd_field' id='row_odd_field'>
								<h4> Advisor Email</h4>
							</div>
							<div class='row_odd_value' id='row_odd_value'>
								<?php echo "<h4>advisor@email.com</h4>"; ?>
							</div>
						</div>

						<div class='row_even'>
							<div class='row_even_field' id='row_even_field'>
								<h4> Enrollment Date</h4>
							</div>
							<div class='row_even_value' id='row_even_value'>
								<?php echo "<h4>Must Submit Program Planning First</h4>"; ?>
							</div>
						</div>

						<div class='row_odd' style='border-radius: 0px 0px 10px 10px;'>
							<div class='row_odd_field' id='row_odd_field' style='border-bottom: none'>
								<h4> Registering For</h4>
							</div>
							<div class='row_odd_value' id='row_odd_value' style='border-bottom: none'>
								<?php echo "<h4>".$student['enrll']."</h4>"; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="progress_bar" id="progress_bar">
				<div class="dash_header_progress">
					<h3 style="color: white; text-align: center;">Credits Progress</h3>
				</div>
				<div class="progress_background">
					<div class="progress">
						<div class="progress_text">
							<?php
							echo $progress_percent_str;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

</body>

</html>
<?php
?>
