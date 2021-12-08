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
	<link rel="stylesheet" href="public/css/scheduleView.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<?php
		ob_start();
		session_start();
	?>
</head>

<body>
	<?php
		include 'nav.php';
		$student = getStudent($_SESSION['username']);
	?>
		<div id="content">
			<div class="container">
				<div class='taking' id='taking'>
					<div class='taking_header'>
						<h3>Main Courses</h3>
					</div>
					<div class='table_area'>
						<table class='taking_table'>
							<thead>
								<tr>
									<th>Course Number</th>
									<th>Title</th>
									<th>Credits</th>
								</tr>
							</thead>
							<?php
								for ($i=0;$i<count($student["taking_course"]);$i++){
									$style_sub = "";
									$style_tit = "";
									$style_cred = "";
									if( $i % 2 != 0) {
										$style_sub = 'border-left: none; background-color: #c9c9c9;';
										$style_tit = 'background-color: #c9c9c9;';
										$style_cred = 'border-right: none; background-color: #c9c9c9;';
									}
									echo "<tr>";
									echo "<td id='left' style='$style_sub'>".$student["taking_course"][$i]['subject'].' '.$student["taking_course"][$i]['catalog'].'</td>';
									echo "<td style='$style_tit'>".$student["taking_course"][$i]['title'].'</td>';
									echo "<td id='right' style='$style_cred'>".$student["taking_course"][$i]['cred'].'</td>';
									echo '</tr>';
								}
							?>
						</table>
					</div>
				</div>
				<div class='backup' id='backup'>
					<div class='taking_header'>
						<h3>Backup Courses</h3>
					</div>
					<div class='table_area'>
						<table class='taking_table'>
							<thead>
								<tr>
									<th>Course Number</th>
									<th>Title</th>
									<th>Credits</th>
								</tr>
							</thead>
							<?php
								for ($i=0;$i<count($student["backup_course"]);$i++){
									$style_sub = "";
									$style_tit = "";
									$style_cred = "";
									if( $i % 2 != 0) {
										$style_sub = 'border-left: none; background-color: #c9c9c9;';
										$style_tit = 'background-color: #c9c9c9;';
										$style_cred = 'border-right: none; background-color: #c9c9c9;';
									}
									echo "<tr>";
									echo "<td id='left' style='$style_sub'>".$student["backup_course"][$i]['subject'].' '.$student["backup_course"][$i]['catalog'].'</td>';
									echo "<td style='$style_tit'.'padding-top: 10px;'>".$student["backup_course"][$i]['title'].'</td>';
									echo "<td id='right' style='$style_cred'>".$student["backup_course"][$i]['cred'].'</td>';
									echo '</tr>';
								}
							?>
						</table>
					</div>
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
