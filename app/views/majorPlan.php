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
	<link rel="stylesheet" href="css/plan.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<?php
		ob_start();
		session_start();
		// require 'vendor/autoload.php';
		// include_once 'funcs/StudentFunctions.php';
		// include_once 'funcs/FourYearFunctions.php';
		$student = getStudent($_SESSION['username']);
	?>
</head>

<body>
	<?php
		include 'nav.php';
	?>

		<div id="content" style="overflow: auto">
			<form id="min" method="post">
				<select name="major">
					<option value="0"><?php echo $student['major'][0]['title']; ?></option>
					<?php
						if(isset($student['major'][1])){
							echo "<option value='1'>".$student['major'][1]['title']."</option>";
						}
						if(isset($student['major'][2])){
							echo "<option value='2'>".$student['major'][2]['title']."</option>";
						}
					?>
				</select>
				<input type="submit" name="submit" value="Select">
			</form>
			<?php
				if(isset($_POST['major'])){
					$fyp = getFourYearByMajor($student['major'][$_POST['major']]['title']);
				} else {
					$fyp = getFourYearByMajor($student['major'][0]['title']);
				}
			?>
			<div id='table_area' class='table_area'>
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Year 1</h4>
				</div>
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" onclick='sortTable(0)' style='border-radius: 10px 0px 0px 0px;'>Course Number <span class="fas fa-caret-right first"></span></th>
							<th class="title" onclick='sortTable(1)'>Title <span class="fas fa-caret-right second"></span></th>
							<th class="cred" onclick='sortTable(2)'>Credits <span class="fas fa-caret-right third"></span></th>
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
								if( $i % 2 == 0) {
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
			<div id='table_area' class='table_area'>
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Year 2</h4>
				</div>
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" onclick='sortTable(0)' style='border-radius: 10px 0px 0px 0px;'>Course Number <span class="fas fa-caret-right first"></span></th>
							<th class="title" onclick='sortTable(1)'>Title <span class="fas fa-caret-right second"></span></th>
							<th class="cred" onclick='sortTable(2)'>Credits <span class="fas fa-caret-right third"></span></th>
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
			<div id='table_area' class='table_area'>
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Year 3</h4>
				</div>
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" onclick='sortTable(0)' style='border-radius: 10px 0px 0px 0px;'>Course Number <span class="fas fa-caret-right first"></span></th>
							<th class="title" onclick='sortTable(1)'>Title <span class="fas fa-caret-right second"></span></th>
							<th class="cred" onclick='sortTable(2)'>Credits <span class="fas fa-caret-right third"></span></th>
						</tr>
					</thead>
					<?php
						for ($n=5;$n<=6;$n++){
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
			<div id='table_area' class='table_area'>
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Year 4</h4>
				</div>
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" onclick='sortTable(0)' style='border-radius: 10px 0px 0px 0px;'>Course Number <span class="fas fa-caret-right first"></span></th>
							<th class="title" onclick='sortTable(1)'>Title <span class="fas fa-caret-right second"></span></th>
							<th class="cred" onclick='sortTable(2)'>Credits <span class="fas fa-caret-right third"></span></th>
						</tr>
					</thead>
					<?php
						for ($n=7;$n<=8;$n++){
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
</div> <!-- flexbox div ends -->

<!-- <script>
	$('nav ul .progress-show').toggleClass("prog");
	$('nav ul .second').toggleClass("rotate");
	$('.fyp-btn').css({"color":"#8a0000","border-left-color":"#8a0000"});
</script> -->
</body>
</html>
