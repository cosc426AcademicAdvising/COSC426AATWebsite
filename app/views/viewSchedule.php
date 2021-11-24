<!DOCTYPE html>
<html lang="en">
<head>
	<title>Academic Planar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/viewSchedule.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<?php
		ob_start();
		session_start();
		// require 'vendor/autoload.php';
	?>
</head>

<body>
	<?php
		include 'nav.php';
		// include_once 'funcs/StudentFunctions.php';
		$student = getStudent($_SESSION['username']);
	?>
		<div id="content">
			<div id="container">
				<div class='taking' id='taking'>
					<div class='taking_header'>
						<h3>Main Courses</h3>
					</div>
					<div class='table_area'>
						<table class='taking_table'>
							<thead>
								<tr>
									<th style="border-radius: 10px 0px 0px 0px;">Course Number</th>
									<th>Title</th>
									<th style="border-radius: 0px 10px 0px 0px;">Credits</th>
								</tr>
							</thead>
							<?php
								for ($n=1;$n<=2;$n++){
									if($n+1 == $n) {
										$style_subject = 'border-left: none; border-bottom: none;';
										$style_title = 'border-bottom: none;';
										$style_credit = 'border-right: none; border-bottom: none;';
									}
									else {
										$style_subject = 'border-left: none;';
										$style_title = '';
										$style_credit = 'border-right: none;';
									}
								}
								for ($i=0;$i<count($student["taking_course"]);$i++){
									if( $i % 2 == 0) {
										$style_subject = $style_subject.'background-color: #c9c9c9';
										$style_title = $style_title.'background-color: #c9c9c9';
										$style_credit = $style_credit.'background-color: #c9c9c9';
									}
									echo "<tr>";
									echo "<td style='$style_subject'>".$student["taking_course"][$i]['subject'].' '.$student["taking_course"][$i]['catalog'].'</td>';
									echo "<td style='$style_title'>".$student["taking_course"][$i]['title'].'</td>';
									echo "<td style='$style_credit'>".$student["taking_course"][$i]['cred'].'</td>';
									echo '</tr>';
								}
							?>
						</table>
					</div>
				</div>
				<div class='backup' id='backup'>
					<div class='backup_header'>
						<h3>Backup Courses</h3>
					</div>
					<div class='table_area'>
						<table class='backup_table'>
							<thead>
								<tr>
									<th style="border-radius: 10px 0px 0px 0px;">Course Number</th>
									<th>Title</th>
									<th style="border-radius: 0px 10px 0px 0px;">Credits</th>
								</tr>
							</thead>
							<?php
								for ($i=0;$i<count($student["backup_course"]);$i++){
									if( $i % 2 != 0) {
										$style_subject = $style_subject.'background-color: #c9c9c9';
										$style_title = $style_title.'background-color: #c9c9c9';
										$style_credit = $style_credit.'background-color: #c9c9c9';
									}
									echo "<tr>";
									echo "<td style='$style_subject'>".$student["backup_course"][$i]['subject'].' '.$student["backup_course"][$i]['catalog'].'</td>';
									echo "<td style='$style_title'.'padding-top: 10px;'>".$student["backup_course"][$i]['title'].'</td>';
									echo "<td style='$style_credit'>".$student["backup_course"][$i]['cred'].'</td>';
									echo '</tr>';
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
</div> <!-- flexbox div ends -->

<script>
	$('nav ul .schedule-show').toggleClass("sch");
	$('nav ul .first').toggleClass("rotate");
	$('.schedule-view-btn').css({"color":"#8a0000","border-left-color":"#8a0000"});
</script>
</body>
</html>
