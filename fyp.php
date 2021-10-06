<!DOCTYPE html>
<html>
<head>
	<title>Academic Planar</title>
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

		<div id="content" style="overflow: auto">
			<div id="container" class="container">
				<div class='year1' id='year1'>
					<div class='fyp_header'>
						<h3>Year 1</h3>
					</div>
					<div class='table_area'>
						<table class='schedule_table'>
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
									
									for ($i=0;$i<count($fyp["semester_".$n]);$i++){
										if( $i % 2 != 0) {
											$style_subject = $style_subject.'background-color: #c9c9c9';
											$style_title = $style_title.'background-color: #c9c9c9';
											$style_credit = $style_credit.'background-color: #c9c9c9';
										}
										echo "<tr>";
										echo "<td style='$style_subject'>".$fyp["semester_".$n][$i]['subject'].' '.$fyp['semester_'.$n][$i]['catalog'].'</td>';
										echo "<td style='$style_title'>".$fyp['semester_'.$n][$i]['title'].'</td>';
										echo "<td style='$style_credit'>".$fyp['semester_'.$n][$i]['cred'].'</td>';
										echo '</tr>';
									}
								}
							?>
						</table>
					</div>
				</div>
				<div class='year2' id='year2'>
					<div class='fyp_header'>
						<h3>Year 2</h3>
					</div>
					<div class='table_area'>
						<table class='schedule_table'>
							<thead>
								<tr>
									<th style="border-radius: 10px 0px 0px 0px;">Course Number</th>
									<th>Title</th>
									<th style="border-radius: 0px 10px 0px 0px;">Credits</th>
								</tr>
							</thead>
							<?php
								for ($n=3;$n<=4;$n++){
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
									
									for ($i=0;$i<count($fyp["semester_".$n]);$i++){
										if( $i % 2 != 0) {
											$style_subject = $style_subject.'background-color: #c9c9c9';
											$style_title = $style_title.'background-color: #c9c9c9';
											$style_credit = $style_credit.'background-color: #c9c9c9';
										}
										echo "<tr>";
										echo "<td style='$style_subject'>".$fyp["semester_".$n][$i]['subject'].' '.$fyp['semester_'.$n][$i]['catalog'].'</td>';
										echo "<td style='$style_title'>".$fyp['semester_'.$n][$i]['title'].'</td>';
										echo "<td style='$style_credit'>".$fyp['semester_'.$n][$i]['cred'].'</td>';
										echo '</tr>';
									}
								}
							?>
						</table>
					</div>
				</div>
				<div class='year3' id='year3'>
					<div class='fyp_header'>
						<h3>Year 3</h3>
					</div>
					<div class='table_area'>
						<table class='schedule_table'>
							<thead>
								<tr>
									<th style="border-radius: 10px 0px 0px 0px;">Course Number</th>
									<th>Title</th>
									<th style="border-radius: 0px 10px 0px 0px;">Credits</th>
								</tr>
							</thead>
							<?php
								for ($n=3;$n<=4;$n++){
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
									
									for ($i=0;$i<count($fyp["semester_".$n]);$i++){
										if( $i % 2 != 0) {
											$style_subject = $style_subject.'background-color: #c9c9c9';
											$style_title = $style_title.'background-color: #c9c9c9';
											$style_credit = $style_credit.'background-color: #c9c9c9';
										}
										echo "<tr>";
										echo "<td style='$style_subject'>".$fyp["semester_".$n][$i]['subject'].' '.$fyp['semester_'.$n][$i]['catalog'].'</td>';
										echo "<td style='$style_title'>".$fyp['semester_'.$n][$i]['title'].'</td>';
										echo "<td style='$style_credit'>".$fyp['semester_'.$n][$i]['cred'].'</td>';
										echo '</tr>';
									}
								}
							?>
						</table>
					</div>
				</div>
				<div class='year4' id='year4'>
					<div class='fyp_header'>
						<h3>Year 4</h3>
					</div>
					<div class='table_area'>
						<table class='schedule_table'>
							<thead>
								<tr>
									<th style="border-radius: 10px 0px 0px 0px;">Course Number</th>
									<th>Title</th>
									<th style="border-radius: 0px 10px 0px 0px;">Credits</th>
								</tr>
							</thead>
							<?php
								for ($n=3;$n<=4;$n++){
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
									
									for ($i=0;$i<count($fyp["semester_".$n]);$i++){
										if( $i % 2 != 0) {
											$style_subject = $style_subject.'background-color: #c9c9c9';
											$style_title = $style_title.'background-color: #c9c9c9';
											$style_credit = $style_credit.'background-color: #c9c9c9';
										}
										echo "<tr>";
										echo "<td style='$style_subject'>".$fyp["semester_".$n][$i]['subject'].' '.$fyp['semester_'.$n][$i]['catalog'].'</td>';
										echo "<td style='$style_title'>".$fyp['semester_'.$n][$i]['title'].'</td>';
										echo "<td style='$style_credit'>".$fyp['semester_'.$n][$i]['cred'].'</td>';
										echo '</tr>';
									}
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
</div> <!-- flexbox div ends -->

<script>
	$('nav ul .progress-show').toggleClass("prog");
	$('nav ul .second').toggleClass("rotate");
	$('.fyp-btn').css({"color":"#8a0000","border-left-color":"#8a0000"});
</script>
</body>
</html>
