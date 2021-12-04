<!DOCTYPE html>
<html lang="en">
<head>
	<title>Academic Planar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="public/css/nav.css">
	<link rel="stylesheet" href="public/css/fyp.css">
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
		<div class="container" id="container">
			<form id="min" method="post" style="grid-column-start: 1; grid-column-end: 3;">
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
			
			<div class="enc">
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Year 1 Semester 1</h4>
				</div>
				<div class="tbl">
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" style="border-right: solid; border-bottom: solid;">Course Number </th>
							<th class="title" style="border-bottom: solid;">Title</th>
							<th class="cred" style="border-left: solid; border-bottom: solid;">Credits </span></th>
						</tr>
					</thead>
					<?php
							for ($i=0;$i<count($fyp["semester_1"]);$i++){
								$style_sub = "";
								$style_tit = "";
								$style_cred = "";
								if( $i % 2 == 0) {
									$style_sub = 'border-left: none; background-color: #c9c9c9;';
									$style_tit = 'background-color: #c9c9c9;';
									$style_cred = 'border-right: none; background-color: #c9c9c9;';
								}
								if($i+1 == count($fyp["semester_1"])){
									$style_sub = $style_sub.'border-bottom: none;';
									$style_tit = $style_tit.'border-bottom: none;';
									$style_cred = $style_cred.'border-bottom: none;';
								}
								$style_subject = 'border-left: none;'.$style_sub;
								$style_title = ''.$style_tit;
								$style_credit = 'border-right: none;'.$style_cred;
								echo "<tr>";
								echo "<td style='$style_subject'>".$fyp["semester_1"][$i]['subject'].' '.$fyp['semester_1'][$i]['catalog'].'</td>';
								echo "<td style='$style_title'>".$fyp['semester_1'][$i]['title'].'</td>';
								echo "<td style='$style_credit'>".$fyp['semester_1'][$i]['cred'].'</td>';
								echo '</tr>';
							}
						
					?>
				</table>
				</div>
			</div>
				<div class="enc">
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Year 1 Semester 2</h4>
				</div>
				<div class="tbl">
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" style="border-right: solid; border-bottom: solid;">Course Number </th>
							<th class="title" style="border-bottom: solid;">Title</th>
							<th class="cred" style="border-left: solid; border-bottom: solid;">Credits </span></th>
						</tr>
					</thead>
					<?php
							$style_subject = 'border-left: none;';
							$style_title = '';
							$style_credit = 'border-right: none';
							for ($i=0;$i<count($fyp["semester_2"]);$i++){
								$style_sub = "";
								$style_tit = "";
								$style_cred = "";
								if( $i % 2 == 0) {
									$style_sub = 'border-left: none; background-color: #c9c9c9;';
									$style_tit = 'background-color: #c9c9c9;';
									$style_cred = 'border-right: none; background-color: #c9c9c9;';
								}
								if($i+1 == count($fyp["semester_2"])){
									$style_sub = $style_sub.'border-bottom: none;';
									$style_tit = $style_tit.'border-bottom: none;';
									$style_cred = $style_cred.'border-bottom: none;';
								}
								$style_subject = 'border-left: none;'.$style_sub;
								$style_title = ''.$style_tit;
								$style_credit = 'border-right: none;'.$style_cred;
								echo "<tr>";
								echo "<td style='$style_subject'>".$fyp["semester_2"][$i]['subject'].' '.$fyp['semester_2'][$i]['catalog'].'</td>';
								echo "<td style='$style_title'>".$fyp['semester_2'][$i]['title'].'</td>';
								echo "<td style='$style_credit'>".$fyp['semester_2'][$i]['cred'].'</td>';
								echo '</tr>';
							}
					?>
				</table>
				</div>
			</div>
				<div class="enc">
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Year 2 Semester 1</h4>
				</div>
				<div class="tbl">
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" style="border-right: solid; border-bottom: solid;">Course Number </th>
							<th class="title" style="border-bottom: solid;">Title</th>
							<th class="cred" style="border-left: solid; border-bottom: solid;">Credits </span></th>
						</tr>
					</thead>
					<?php
							$style_subject = 'border-left: none;';
							$style_title = '';
							$style_credit = 'border-right: none;';
							for ($i=0;$i<count($fyp["semester_3"]);$i++){
								$style_sub = "";
								$style_tit = "";
								$style_cred = "";
								if( $i % 2 == 0) {
									$style_sub = 'border-left: none; background-color: #c9c9c9;';
									$style_tit = 'background-color: #c9c9c9;';
									$style_cred = 'border-right: none; background-color: #c9c9c9;';
								}
								if($i+1 == count($fyp["semester_3"])){
									$style_sub = $style_sub.'border-bottom: none;';
									$style_tit = $style_tit.'border-bottom: none;';
									$style_cred = $style_cred.'border-bottom: none;';
								}
								$style_subject = 'border-left: none;'.$style_sub;
								$style_title = ''.$style_tit;
								$style_credit = 'border-right: none;'.$style_cred;
								echo "<tr>";
								echo "<td style='$style_subject'>".$fyp["semester_3"][$i]['subject'].' '.$fyp['semester_3'][$i]['catalog'].'</td>';
								echo "<td style='$style_title'>".$fyp['semester_3'][$i]['title'].'</td>';
								echo "<td style='$style_credit'>".$fyp['semester_3'][$i]['cred'].'</td>';
								echo '</tr>';
							}
						
					?>
				</table>
				</div>
			</div>
				<div class="enc">
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Year 2 Semester 2</h4>
				</div>
				<div class="tbl">
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" style="border-right: solid; border-bottom: solid;">Course Number </th>
							<th class="title" style="border-bottom: solid;">Title</th>
							<th class="cred" style="border-left: solid; border-bottom: solid;">Credits </span></th>
						</tr>
					</thead>
					<?php
							$style_subject = 'border-left: none;';
							$style_title = '';
							$style_credit = 'border-right: none;';
							for ($i=0;$i<count($fyp["semester_4"]);$i++){
								$style_sub = "";
								$style_tit = "";
								$style_cred = "";
								if( $i % 2 == 0) {
									$style_sub = 'border-left: none; background-color: #c9c9c9;';
									$style_tit = 'background-color: #c9c9c9;';
									$style_cred = 'border-right: none; background-color: #c9c9c9;';
								}
								if($i+1 == count($fyp["semester_4"])){
									$style_sub = $style_sub.'border-bottom: none;';
									$style_tit = $style_tit.'border-bottom: none;';
									$style_cred = $style_cred.'border-bottom: none;';
								}
								$style_subject = 'border-left: none;'.$style_sub;
								$style_title = ''.$style_tit;
								$style_credit = 'border-right: none;'.$style_cred;
								echo "<tr>";
								echo "<td style='$style_subject'>".$fyp["semester_4"][$i]['subject'].' '.$fyp['semester_4'][$i]['catalog'].'</td>';
								echo "<td style='$style_title'>".$fyp['semester_4'][$i]['title'].'</td>';
								echo "<td style='$style_credit'>".$fyp['semester_4'][$i]['cred'].'</td>';
								echo '</tr>';
							}
						
					?>
				</table>
				</div>
			</div>
				<div class="enc">
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Year 3 Semester 1</h4>
				</div>
				<div class="tbl">
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" style="border-right: solid; border-bottom: solid;">Course Number </th>
							<th class="title" style="border-bottom: solid;">Title</th>
							<th class="cred" style="border-left: solid; border-bottom: solid;">Credits </span></th>
						</tr>
					</thead>
					<?php
							$style_subject = 'border-left: none;';
							$style_title = '';
							$style_credit = 'border-right: none;';
							for ($i=0;$i<count($fyp["semester_5"]);$i++){
								$style_sub = "";
								$style_tit = "";
								$style_cred = "";
								if( $i % 2 == 0) {
									$style_sub = 'border-left: none; background-color: #c9c9c9;';
									$style_tit = 'background-color: #c9c9c9;';
									$style_cred = 'border-right: none; background-color: #c9c9c9;';
								}
								if($i+1 == count($fyp["semester_5"])){
									$style_sub = $style_sub.'border-bottom: none;';
									$style_tit = $style_tit.'border-bottom: none;';
									$style_cred = $style_cred.'border-bottom: none;';
								}
								$style_subject = 'border-left: none;'.$style_sub;
								$style_title = ''.$style_tit;
								$style_credit = 'border-right: none;'.$style_cred;
								echo "<tr>";
								echo "<td style='$style_subject'>".$fyp["semester_5"][$i]['subject'].' '.$fyp['semester_5'][$i]['catalog'].'</td>';
								echo "<td style='$style_title'>".$fyp['semester_5'][$i]['title'].'</td>';
								echo "<td style='$style_credit'>".$fyp['semester_5'][$i]['cred'].'</td>';
								echo '</tr>';
							}
						
					?>
				</table>
				</div>
			</div>
				<div class="enc">
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Year 3 Semester 2</h4>
				</div>
				<div class="tbl">
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" style="border-right: solid; border-bottom: solid;">Course Number </th>
							<th class="title" style="border-bottom: solid;">Title</th>
							<th class="cred" style="border-left: solid; border-bottom: solid;">Credits </span></th>
						</tr>
					</thead>
					<?php
							$style_subject = 'border-left: none;';
							$style_title = '';
							$style_credit = 'border-right: none;';
							for ($i=0;$i<count($fyp["semester_6"]);$i++){
								$style_sub = "";
								$style_tit = "";
								$style_cred = "";
								if( $i % 2 == 0) {
									$style_sub = 'border-left: none; background-color: #c9c9c9;';
									$style_tit = 'background-color: #c9c9c9;';
									$style_cred = 'border-right: none; background-color: #c9c9c9;';
								}
								if($i+1 == count($fyp["semester_6"])){
									$style_sub = $style_sub.'border-bottom: none;';
									$style_tit = $style_tit.'border-bottom: none;';
									$style_cred = $style_cred.'border-bottom: none;';
								}
								$style_subject = 'border-left: none;'.$style_sub;
								$style_title = ''.$style_tit;
								$style_credit = 'border-right: none;'.$style_cred;
								echo "<tr>";
								echo "<td style='$style_subject'>".$fyp["semester_6"][$i]['subject'].' '.$fyp['semester_6'][$i]['catalog'].'</td>';
								echo "<td style='$style_title'>".$fyp['semester_6'][$i]['title'].'</td>';
								echo "<td style='$style_credit'>".$fyp['semester_6'][$i]['cred'].'</td>';
								echo '</tr>';
							}
						
					?>
				</table>
				</div>
			</div>
				<div class="enc">
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Year 4 Semester 1</h4>
				</div>
				<div class="tbl">
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" style="border-right: solid; border-bottom: solid;">Course Number </th>
							<th class="title" style="border-bottom: solid;">Title</th>
							<th class="cred" style="border-left: solid; border-bottom: solid;">Credits </span></th>
						</tr>
					</thead>
					<?php
							$style_subject = 'border-left: none;';
							$style_title = '';
							$style_credit = 'border-right: none;';
							for ($i=0;$i<count($fyp["semester_7"]);$i++){
								$style_sub = "";
								$style_tit = "";
								$style_cred = "";
								if( $i % 2 == 0) {
									$style_sub = 'border-left: none; background-color: #c9c9c9;';
									$style_tit = 'background-color: #c9c9c9;';
									$style_cred = 'border-right: none; background-color: #c9c9c9;';
								}
								if($i+1 == count($fyp["semester_7"])){
									$style_sub = $style_sub.'border-bottom: none;';
									$style_tit = $style_tit.'border-bottom: none;';
									$style_cred = $style_cred.'border-bottom: none;';
								}
								$style_subject = 'border-left: none;'.$style_sub;
								$style_title = ''.$style_tit;
								$style_credit = 'border-right: none;'.$style_cred;
								echo "<tr>";
								echo "<td style='$style_subject'>".$fyp["semester_7"][$i]['subject'].' '.$fyp['semester_7'][$i]['catalog'].'</td>';
								echo "<td style='$style_title'>".$fyp['semester_7'][$i]['title'].'</td>';
								echo "<td style='$style_credit'>".$fyp['semester_7'][$i]['cred'].'</td>';
								echo '</tr>';
							}
						
					?>
				</table>
				</div>
			</div>
				<div class="enc">
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Year 4 Semester 2</h4>
				</div>
				<div class="tbl">
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" style="border-right: solid; border-bottom: solid;">Course Number </th>
							<th class="title" style="border-bottom: solid;">Title</th>
							<th class="cred" style="border-left: solid; border-bottom: solid;">Credits </span></th>
						</tr>
					</thead>
					<?php
							$style_subject = 'border-left: none;';
							$style_title = '';
							$style_credit = 'border-right: none;';
							for ($i=0;$i<count($fyp["semester_8"]);$i++){
								$style_sub = "";
								$style_tit = "";
								$style_cred = "";
								if( $i % 2 == 0) {
									$style_sub = 'border-left: none; background-color: #c9c9c9;';
									$style_tit = 'background-color: #c9c9c9;';
									$style_cred = 'border-right: none; background-color: #c9c9c9;';
								}
								if($i+1 == count($fyp["semester_8"])){
									$style_sub = $style_sub.'border-bottom: none;';
									$style_tit = $style_tit.'border-bottom: none;';
									$style_cred = $style_cred.'border-bottom: none;';
								}
								$style_subject = 'border-left: none;'.$style_sub;
								$style_title = ''.$style_tit;
								$style_credit = 'border-right: none;'.$style_cred;
								echo "<tr>";
								echo "<td style='$style_subject'>".$fyp["semester_8"][$i]['subject'].' '.$fyp['semester_8'][$i]['catalog'].'</td>';
								echo "<td style='$style_title'>".$fyp['semester_8'][$i]['title'].'</td>';
								echo "<td style='$style_credit'>".$fyp['semester_8'][$i]['cred'].'</td>';
								echo '</tr>';
							}
						
					?>
				</table>
				</div>
			</div>
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
