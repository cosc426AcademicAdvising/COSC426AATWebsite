<!DOCTYPE html>
<html>
<head>
	<title>Academic Planar</title>
	<meta charset="UTF-8">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="CSS/nav.css">
	<link rel="stylesheet" href="CSS/minplan.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<?php
		ob_start();
		session_start();
		require 'vendor/autoload.php';
		include_once 'funcs/StudentFunctions.php';
		include_once 'funcs/MinorFunctions.php';
		$student = getStudent($_SESSION['username']);
	?>
	
</head>

<body>
	<?php
		include 'nav.php';
	?>
		
		<div id="content">
			<form id="min" method="post">
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
			<div id='table_area' class='table_area'>
				<div id='course_header' class='course_header'>
					<h4 style='color: white; text-align: center; padding: 10px;'><?php echo $minPlan['req1'] ?></h4>
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
						for($n=0;$n<count($minPlan['crs1']);$n++){
							echo "<tr>";
							echo "<td id='left' class='data'>".$minPlan['crs1'][$n]['subject']." ".$minPlan['crs1'][$n]['catalog']."</td>";
							echo "<td class='data'>".$minPlan['crs1'][$n]['title']."</td>";
							echo "<td id='right' class='data'>".$minPlan['crs1'][$n]['credits']."</td>";
							echo '</tr>';
						}
					?>
				</table>
			</div>
			<?php
			if(isset($minPlan['crs2'])){
				echo "<div id='table_area' class='table_area'>";
					echo "<div id='course_header' class='course_header'>";
						if(isset($minPlan['req2'])){
							echo "<h4 style='color: white; text-align: center; padding: 10px;'>".$minPlan['req2']."</h4>";
						}
					echo "</div>";
					echo "<table class='course_table' id='course_table'>";
						echo "<thead>";
							echo "<tr>";
								echo "<th class='num' onclick='sortTable(0)' style='border-radius: 10px 0px 0px 0px;'>Course Number <span class='fas fa-caret-right first'></span></th>";
								echo "<th class='title' onclick='sortTable(1)'>Title <span class='fas fa-caret-right second'></span></th>";
								echo "<th class='cred' onclick='sortTable(2)'>Credits <span class='fas fa-caret-right third'></span></th>";
							echo "</tr>";
						echo "</thead>";
						for($n=0;$n<count($minPlan['crs2']);$n++){
							echo "<tr>";
							echo "<td id='left' class='data'>".$minPlan['crs2'][$n]['subject']." ".$minPlan['crs2'][$n]['catalog']."</td>";
							echo "<td class='data'>".$minPlan['crs2'][$n]['title']."</td>";
							echo "<td id='right' class='data'>".$minPlan['crs2'][$n]['credits']."</td>";
							echo '</tr>';
						}
					echo "</table>";
				echo "</div>";
			}
			if(isset($minPlan['crs3'])){
				echo "<div id='table_area' class='table_area'>";
					echo "<div id='course_header' class='course_header'>";
						if(isset($minPlan['req3'])){
							echo "<h4 style='color: white; text-align: center; padding: 10px;'>".$minPlan['req3']."</h4>";
						}
					echo "</div>";
					echo "<table class='course_table' id='course_table'>";
						echo "<thead>";
							echo "<tr>";
								echo "<th class='num' onclick='sortTable(0)' style='border-radius: 10px 0px 0px 0px;'>Course Number <span class='fas fa-caret-right first'></span></th>";
								echo "<th class='title' onclick='sortTable(1)'>Title <span class='fas fa-caret-right second'></span></th>";
								echo "<th class='cred' onclick='sortTable(2)'>Credits <span class='fas fa-caret-right third'></span></th>";
							echo "</tr>";
						echo "</thead>";
						for($n=0;$n<count($minPlan['crs3']);$n++){
							echo "<tr>";
							echo "<td id='left' class='data'>".$minPlan['crs3'][$n]['subject']." ".$minPlan['crs3'][$n]['catalog']."</td>";
							echo "<td class='data'>".$minPlan['crs3'][$n]['title']."</td>";
							echo "<td id='right' class='data'>".$minPlan['crs3'][$n]['credits']."</td>";
							echo '</tr>';
						}
					echo "</table>";
				echo "</div>";
			}
			if(isset($minPlan['crs4'])){
				echo "<div id='table_area' class='table_area'>";
					echo "<div id='course_header' class='course_header'>";
						if(isset($minPlan['req4'])){
							echo "<h4 style='color: white; text-align: center; padding: 10px;'>".$minPlan['req4']."</h4>";
						}
					echo "</div>";
					echo "<table class='course_table' id='course_table'>";
						echo "<thead>";
							echo "<tr>";
								echo "<th class='num' onclick='sortTable(0)' style='border-radius: 10px 0px 0px 0px;'>Course Number <span class='fas fa-caret-right first'></span></th>";
								echo "<th class='title' onclick='sortTable(1)'>Title <span class='fas fa-caret-right second'></span></th>";
								echo "<th class='cred' onclick='sortTable(2)'>Credits <span class='fas fa-caret-right third'></span></th>";
							echo "</tr>";
						echo "</thead>";
						for($n=0;$n<count($minPlan['crs4']);$n++){
							echo "<tr>";
							echo "<td id='left' class='data'>".$minPlan['crs4'][$n]['subject']." ".$minPlan['crs4'][$n]['catalog']."</td>";
							echo "<td class='data'>".$minPlan['crs4'][$n]['title']."</td>";
							echo "<td id='right' class='data'>".$minPlan['crs4'][$n]['credits']."</td>";
							echo '</tr>';
						}
					echo "</table>";
				echo "</div>";
			}
			?>
		</div>
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

<script>
	$('nav ul .progress-show').toggleClass("prog");
	$('nav ul .second').toggleClass("rotate");
	$('.course-hist-btn').css({"color":"#8a0000","border-left-color":"#8a0000"});
</script>

</body>
</html>
