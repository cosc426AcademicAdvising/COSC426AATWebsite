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
		<div id='table_area' class='table_area'>
			<div id='history_header' class='history_header'>
				<h4 style='color: white; text-align: center; padding: 10px;'>Course History</h4>
			</div>
			<table class='history_table' id="history_table">
				<thead>
					<tr>
						<th onclick='sortTable(0)' style='border-radius: 10px 0px 0px 0px;'>Course Number</th>
						<th onclick='sortTable(1)'>Title</th>
						<th onclick='sortTable(2)'>Credits</th>
					</tr>
				</thead>
				<?php
				for ($n = 1; $n <= count($student['course_taken'][0]); $n++) {
					for ($i = 0; $i < count($student['course_taken'][0]['semester_' . $n]); $i++) {
						echo "<tr>";
						echo "<td id='left' class='data'>" . $student['course_taken'][0]['semester_' . $n][$i]['subject'] . ' ' . $student['course_taken'][0]['semester_' . $n][$i]['catalog'] . '</td>';
						echo "<td class='data'>" . $student['course_taken'][0]['semester_' . $n][$i]['title'] . '</td>';
						echo "<td class='data'>" . $student['course_taken'][0]['semester_' . $n][$i]['credits'] . '</td>';
						echo '</tr>';
					}
				}
				?>
			</table>
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

	<script>
	$('nav ul .progress-show').toggleClass("prog");
	$('nav ul .second').toggleClass("rotate");
	$('.course-hist-btn').css({"color":"#8a0000","border-left-color":"#8a0000"});
</script>

</body>

</html>
