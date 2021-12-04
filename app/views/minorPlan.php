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
	<link rel="stylesheet" href="public/css/plan.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<?php
		ob_start();
		session_start();
		// require 'vendor/autoload.php';
		// include_once 'funcs/StudentFunctions.php';
		// include_once 'funcs/MinorFunctions.php';
		$student = getStudent($_SESSION['username']);
	?>

</head>

<body>
	<?php
		include 'nav.php';
	?>

		<div id="content">
			<div class="container">
			<form id="min" method="post" style="grid-row-start: 1; grid-row-end: 2;">
				<select name="minor">
					<option value="0"><?php echo $student['minor'][0]['title']; ?></option>
					<?php
						if(isset($student['minor'][1])){
							echo "<option value='1'>".$student['minor'][1]['title']."</option>";
						}
						if(isset($student['minor'][2])){
							echo "<option value='2'>".$student['minor'][2]['title']."</option>";
						}
					?>
				</select>
				<input type="submit" name="submit" value="Select">
			</form>
			<?php
				if(isset($_POST['minor'])){
					$minPlan = getMinorPlan($student['minor'][$_POST['minor']]['title']);
				} else {
					$minPlan = getMinorPlan($student['minor'][0]['title']);
				}
			?>
			<div id='table_area' class='table_area' style="grid-row-start: 2; grid-row-end: 3;">
				<div id='course_header' class='course_header' >
					<h4 style='color: white; text-align: center; padding: 10px;'>Minor Requirements</h4>
				</div>
				<table class='course_table' id="course_table">
					<?php
						// $result = str_replace("\n", '', $minPlan['minor_req']);
						$result = str_replace(")", '', $minPlan['minor_req']);
						$result = str_replace("(", '', $result);
						// $result = str_replace(":", "\n", $result);
						$result = str_replace(".", "\n", $result);
						echo "<td style='border:none; padding-top: 25px; padding-bottom: 25px; '>".nl2br($result)."</td>";
					?>
				</table>
			</div>
			<div id='table_area' class='table_area'style="grid-row-start: 3; grid-row-end: 4;">
				<div id='course_header' class='course_header'>
					<?php
						$result = str_replace(".", "\n", $minPlan['req1']);
					?>
					<h4 style='color: white; text-align: center; padding: 10px;'><?php echo nl2br($result) ?></h4>
				</div>
				<table class='course_table' id="course_table">
					<thead>
						<tr>
							<th class="num" id="l">Course Number</th>
							<th class="title">Title</span></th>
							<th class="cred" id="r">Credits</span></th>
						</tr>
					</thead>
					<?php
						for($n=0;$n<count($minPlan['crs1']);$n++){
							$style_sub = "";
							$style_tit = "";
							$style_cred = "";
							if( $n % 2 != 0) {
								$style_sub = 'border-left: none; background-color: #c9c9c9;';
								$style_tit = 'background-color: #c9c9c9;';
								$style_cred = 'border-right: none; background-color: #c9c9c9;';
							}
							echo "<tr>";
							echo "<td style='$style_sub' id='left' class='data'>".$minPlan['crs1'][$n]['subject']." ".$minPlan['crs1'][$n]['catalog']."</td>";
							echo "<td style='$style_tit' class='data'>".$minPlan['crs1'][$n]['title']."</td>";
							echo "<td style='$style_cred' id='right' class='data'>".$minPlan['crs1'][$n]['credits']."</td>";
							echo '</tr>';
						}
					?>
				</table>
			</div>
			<?php
			if(isset($minPlan['crs2'])){
				echo "<div id='table_area' class='table_area' style='grid-row-start: 4; grid-row-end: 5;'>";
					echo "<div id='course_header' class='course_header'>";
						if(isset($minPlan['req2'])){
							$result = str_replace(".", "\n", $minPlan['req2']);
							echo "<h4 style='color: white; text-align: center; padding: 10px;'>".nl2br($result)."</h4>";
						}
						else{
							echo "<h4 style='color: white; text-align: center; padding: 10px;'>Check Top of Page Minor Requirements</h4>";
						}
					echo "</div>";
					echo "<table class='course_table' id='course_table'>";
						echo "<thead>";
							echo "<tr>";
								echo "<th class='num' id='l'>Course Number</th>";
								echo "<th class='title'>Title</th>";
								echo "<th class='cred' id='r'>Credits</th>";
							echo "</tr>";
						echo "</thead>";
						for($n=0;$n<count($minPlan['crs2']);$n++){
							$style_sub = "";
							$style_tit = "";
							$style_cred = "";
							if( $n % 2 != 0) {
								$style_sub = 'border-left: none; background-color: #c9c9c9;';
								$style_tit = 'background-color: #c9c9c9;';
								$style_cred = 'border-right: none; background-color: #c9c9c9;';
							}
							echo "<tr>";
							echo "<td style='$style_sub' id='left' class='data'>".$minPlan['crs2'][$n]['subject']." ".$minPlan['crs2'][$n]['catalog']."</td>";
							echo "<td style='$style_tit' class='data'>".$minPlan['crs2'][$n]['title']."</td>";
							echo "<td style='$style_cred' id='right' class='data'>".$minPlan['crs2'][$n]['credits']."</td>";
							echo '</tr>';
						}
					echo "</table>";
				echo "</div>";
			}
			if(isset($minPlan['crs3'])){
				echo "<div id='table_area' class='table_area' style='grid-row-start: 5; grid-row-end: 6;'>";
					echo "<div id='course_header' class='course_header'>";
						if(isset($minPlan['req3'])){
							echo "<h4 style='color: white; text-align: center; padding: 10px;'>".nl2br($minPlan['req3'])."</h4>";
						}
						else{
							echo "<h4 style='color: white; text-align: center; padding: 10px;'>Check Top of Page Minor Requirements</h4>";
						}
					echo "</div>";
					echo "<table class='course_table' id='course_table'>";
						echo "<thead>";
							echo "<tr>";
								echo "<th class='num' id='l'>Course Number</th>";
								echo "<th class='title'>Title</th>";
								echo "<th class='cred' id='r'>Credits</th>";
							echo "</tr>";
						echo "</thead>";
						for($n=0;$n<count($minPlan['crs3']);$n++){
							$style_sub = "";
							$style_tit = "";
							$style_cred = "";
							if( $n % 2 != 0) {
								$style_sub = 'border-left: none; background-color: #c9c9c9;';
								$style_tit = 'background-color: #c9c9c9;';
								$style_cred = 'border-right: none; background-color: #c9c9c9;';
							}
							echo "<tr>";
							echo "<td style='$style_sub' id='left' class='data'>".$minPlan['crs3'][$n]['subject']." ".$minPlan['crs3'][$n]['catalog']."</td>";
							echo "<td style='$style_tit' class='data'>".$minPlan['crs3'][$n]['title']."</td>";
							echo "<td style='$style_cred' id='right' class='data'>".$minPlan['crs3'][$n]['credits']."</td>";
							echo '</tr>';
						}
					echo "</table>";
				echo "</div>";
			}
			if(isset($minPlan['crs4'])){
				echo "<div id='table_area' class='table_area' style='grid-row-start: 6; grid-row-end: 7;'>";
					echo "<div id='course_header' class='course_header'>";
						if(isset($minPlan['req4'])){
							echo "<h4 style='color: white; text-align: center; padding: 10px;'>".nl2br($minPlan['req4'])."</h4>";
						}
						else{
							echo "<h4 style='color: white; text-align: center; padding: 10px;'>Check Top of Page Minor Requirements</h4>";
						}
					echo "</div>";
					echo "<table class='course_table' id='course_table'>";
						echo "<thead>";
							echo "<tr>";
								echo "<th class='num' id='l'>Course Number</th>";
								echo "<th class='title'>Title</th>";
								echo "<th class='cred' id='r'>Credits</th>";
							echo "</tr>";
						echo "</thead>";
						for($n=0;$n<count($minPlan['crs4']);$n++){
							$style_sub = "";
							$style_tit = "";
							$style_cred = "";
							if( $n % 2 != 0) {
								$style_sub = 'border-left: none; background-color: #c9c9c9;';
								$style_tit = 'background-color: #c9c9c9;';
								$style_cred = 'border-right: none; background-color: #c9c9c9;';
							}
							echo "<tr>";
							echo "<td style='$style_sub' id='left' class='data'>".$minPlan['crs4'][$n]['subject']." ".$minPlan['crs4'][$n]['catalog']."</td>";
							echo "<td style='$style_tit' class='data'>".$minPlan['crs4'][$n]['title']."</td>";
							echo "<td style='$style_cred' id='right' class='data'>".$minPlan['crs4'][$n]['credits']."</td>";
							echo '</tr>';
						}
					echo "</table>";
				echo "</div>";
			}
			?>
		</div>
		<div>
<script>
	function sortTable(n) {
	  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	  table = document.getElementById("course_table");
	  switching = true;

	  dir = "asc";

	  while (switching) {
		switching = false;
		rows = table.rows;
		for (i = 1; i < (rows.length - 1); i++) {

		  shouldSwitch = false;

		  x = rows[i].getElementsByTagName("TD")[n];
		  y = rows[i + 1].getElementsByTagName("TD")[n];

		  if (dir == "asc") {

			if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			  shouldSwitch = true;
			  break;
			}
		  } else if (dir == "desc") {
			if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			  shouldSwitch = true;
			  break;
			}
		  }
		}
		if (shouldSwitch) {
		  rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		  switching = true;
		  switchcount++;
		} else {
		  if (switchcount == 0 && dir == "asc") {
			dir = "desc";
			switching = true;
		  }
		}
	  }
	}
	</script>
</div> <!-- flexbox div ends -->

<!-- <script>
	$('nav ul .progress-show').toggleClass("prog");
	$('nav ul .second').toggleClass("rotate");
	$('.minor-btn').css({"color":"#8a0000","border-left-color":"#8a0000"});
</script> -->

</body>
</html>
