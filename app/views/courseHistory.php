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
	<link rel="stylesheet" href="public/css/courseHistory.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<?php
		ob_start();
		session_start();
		// require 'vendor/autoload.php';
		// include_once 'funcs/StudentFunctions.php';
		$student = getStudent($_SESSION['username']);
	?>

</head>

<body>
	<?php
		include 'nav.php';
	?>

		<div id="content">
		<div class="container">
			<div id='table_area' class='table_area'>
				<div id='history_header' class='history_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'>Course History</h4>
				</div>
				<table class='history_table' id="history_table">
					<thead>
						<tr>
							<th style="border-right: solid;" onclick='sortTable(0)'>Course Number</th>
							<th onclick='sortTable(1)'>Title</th>
							<th style="border-left: solid" onclick='sortTable(2)'>Credits</th>
						</tr>
					</thead>
					<?php
						$cnter = 0;
						for($n=1;$n<=count($student['course_taken'][0]);$n++){
							for($i=0;$i<count($student['course_taken'][0]['semester_'.$n]);$i++){
								$style_sub = "";
								$style_tit = "";
								$style_cred = "";
								// if( $cnter % 2 != 0) {
								// 	$style_sub = 'border-left: none; background-color: #c9c9c9;';
								// 	$style_tit = 'background-color: #c9c9c9;';
								// 	$style_cred = 'border-right: none; background-color: #c9c9c9;';
								// }
								echo "<tr>";
								echo "<td id='left' class='data' style='$style_sub'>".$student['course_taken'][0]['semester_'.$n][$i]['subject'].' '.$student['course_taken'][0]['semester_'.$n][$i]['catalog'].'</td>';
								echo "<td class='data' style='$style_sub'>".$student['course_taken'][0]['semester_'.$n][$i]['title'].'</td>';
								echo "<td id='right' class='data' style='$style_sub'>".$student['course_taken'][0]['semester_'.$n][$i]['credits'].'</td>';
								echo '</tr>';
								$cnter = $cnter + 1;
							}
						}
					?>
				</table>
			</div>
		</div>
		</div>
<script>
	function sortTable(n) {
	  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	  table = document.getElementById("history_table");
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
		  switchcount ++;
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
	$('.course-hist-btn').css({"color":"#8a0000","border-left-color":"#8a0000"});
</script> -->

</body>
</html>
