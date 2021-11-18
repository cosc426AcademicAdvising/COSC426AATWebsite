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
		$progress = $student['credits'];
		$progress_percent = intval(100 * ($progress / 120));
		$progress_percent_str = strval($progress_percent)."%";
		$progress_width = 'width: '.$progress_percent.'%;';
		$majors = array();
		for($i=0;$i<count($student['major']);$i++) {
			$majors[$i] = $student['major'][$i]['title'];
			
		}
	?>
	<style>
			.progress {
				<?php echo $progress_width; ?>;
			}
	</style>
</head>

<body>
	<?php
		include 'nav.php';
	?>

		<div id="content" style="overflow: auto">
			<div class="container" id="container">
				
				<div class="schedule" id="schedule">
					
					<div class="dash_header">
						<h3> Upcoming Schedule </h3>
					</div>
					
					<div class="table_area">
						<table class="schedule_table">
							<thead>
								<tr>
									<th style="border-radius: 0px 0px 0px 0px; border-bottom: solid; border-right: solid;">Course Number</th>
									<th style="border-bottom: solid; border-right: solid;">Title</th>
									<th style="border-radius: 0px 0px 0px 0px; border-bottom: solid;">Credit</th>
								</tr>
							</thead>
							<?php
								for($i=0;$i<count($student['taking_course']);$i++){
									echo "<tr>";
										if($i+1 == count($student['taking_course'])) {
											$style_subject = 'border-left: none; border-bottom: none;';
											$style_title = 'border-bottom: none;';
											$style_credit = 'border-right: none; border-bottom: none;';
										}
										else {
											$style_subject = 'border-left: none;';
											$style_title = '';
											$style_credit = 'border-right: none;';
										}
										if( $i % 2 != 0) {
											$style_subject = $style_subject.'background-color: #c9c9c9';
											$style_title = $style_title.'background-color: #c9c9c9';
											$style_credit = $style_credit.'background-color: #c9c9c9';
										}
										echo "<td style='$style_subject'>".$student['taking_course'][$i]['subject']." ".$student['taking_course'][$i]['catalog']."</td>";
										echo "<td style='$style_title'>".$student['taking_course'][$i]['title']."</td>";
										echo "<td style='$style_credit'>".$student['taking_course'][$i]['cred']."</td>";
									echo "</tr>";
								}
							?>
						</table>
					</div>
				</div>
				<div class="plan" id="plan">
					<div class="dash_header">
						<h3> Recommended Courses</h3>
					
					
					</div>
					
					<div class="table_area">
						<table class="schedule_table">
							
							<?php
								include_once 'funcs/FourYearFunctions.php';
								if(isset($_POST['major']))
									$plan = getFourYearbyMajor($_POST['major']);
								if($plan != "")
									displayFourYearSemester($plan, $semester_plan);
								else
									echo "<h3>No Four Year Plan Found For".$_POST['major']."</h3>";
							?>
						</table>
						
					</div>
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
										<?php echo "<h4>".$student['name']."</h4>"; ?>
									</div>
								</div>

								<div class='row_even' >
									<div class='row_even_field' id='row_even_field'>
										<h4> Student ID</h4>
									</div>
									<div class='row_even_value' id='row_even_value'>
										<?php echo "<h4>".$student['s_id']."</h4>"; ?>
									</div>
								</div>
								<?php
									$cnt = count($student['major']);
									if($cnt == 1) {
										$major_field_print = "<h4> Major(s)</h4>";
										$major_value_print = "<h4>".$student['major'][0]['title']."</h4>";
									}
									else if($cnt == 2) {
										$major_field_print = "<h4> Major(s)</h4>";
										$major_value_print = "<h4>".$student['major'][0]['title'].", ".$student['major'][1]['title']."</h4>";
									}
									else if($cnt == 3) {
										$major_field_print = "<h4> Major(s)</h4>";
										$major_value_print = "<h4>".$student['major'][0]['title'].", ".$student['major'][1]['title'].", ".$student['major'][2]['title']."</h4>";
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
									if($cnt == 1) {
										$minor_field_print = "<h4> Minor(s)</h4>";
										$minor_value_print = "<h4>".$student['minor'][0]['title']."</h4>";
									}
									else if($cnt == 2) {
										$minor_field_print = "<h4> Minor(s)</h4>";
										$minor_value_print = "<h4>".$student['minor'][0]['title'].", ".$student['minor'][1]['title']."</h4>";
									}
									else if($cnt == 3) {
										$minor_field_print = "<h4> Minor(s)</h4>";
										$minor_value_print = "<h4>".$student['minor'][0]['title'].", ".$student['minor'][1]['title'].", ".$student['minor'][2]['title']."</h4>";
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
										<?php echo "<h4>".$student['year']."</h4>"; ?>
									</div>
								</div>

								<div class='row_even'>
									<div class='row_even_field' id='row_even_field'>
										<h4> Current Semester</h4>
									</div>
									<div class='row_even_value' id='row_even_value'>
										<?php echo "<h4>".$student['semester']."</h4>"; ?>
									</div>
								</div>
								<?php
									$credits = 0;
									for($i=0;$i<count($student['taking_course']);$i++)
										$credits = $credits+$student['taking_course'][$i]['cred'];
								?>
								<div class='row_odd'>
									<div class='row_odd_field' id='row_odd_field'>
										<h4> Credits Registered For</h4>
									</div>
									<div class='row_odd_value' id='row_odd_value'>
										<?php echo "<h4>".$credits."</h4>"; ?>
									</div>
								</div>
								
								<div class='row_even' style='border-radius: 0px 0px 10px 10px;'>
									<div class='row_even_field' id='row_even_field' style='border-bottom: none'>
										<h4> Total Credits</h4>
									</div>
									<div class='row_even_value' id='row_even_value' style='border-bottom: none'>
										<?php echo "<h4>".$student['credits']."</h4>"; ?>
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
										<?php echo "<h4>".$student['advisor_mail']."</h4>"; ?>
									</div>
								</div>
									
								<div class='row_even'>
									<div class='row_even_field' id='row_even_field'>
										<h4> Enrollment Date</h4>
									</div>
									<div class='row_even_value' id='row_even_value'>
										<?php echo "<h4>".$student['enrll']."</h4>"; ?>
									</div>
								</div>
									
								<div class='row_odd' style='border-radius: 0px 0px 10px 10px;'>
									<div class='row_odd_field' id='row_odd_field' style='border-bottom: none'>
										<h4> Registering For</h4>
									</div>
									<div class='row_odd_value' id='row_odd_value' style='border-bottom: none'>
										<?php echo "<h4>".$student['registering_for']."</h4>"; ?>
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