<html>
	<?php
		ob_start();
		session_start();
		include 'index.php';
		require 'vendor/autoload.php';
	?>	
	</head>
		<link rel="stylesheet" href="CSS/dashboard.css">
		<?php
			include_once 'funcs/StudentFunctions.php';
			include_once 'funcs/FourYearFunctions.php';
			$student = getStudent($_SESSION['username']);
			$plan = getFourYearbyMajor($student['major'][0]['title']);
			$semester_plan = "semester_".$student['semester'];
		?>
	</head>

	<body>
		<div class="container">
		
			<div class="schedule">
			<h3> Upcoming Schedule </h3>
			<table class="schedule_table">
				<thead>
					<tr>
						<th>Course Number</th>
						<th>Title</th>
						<th>Credit</th>
						<th>Program</a></th>
					</tr>
				</thead>
				<?php
					for($i=0;$i<count($student['taking_course']);$i++){
						echo "<tr>";
							echo "<td>".$student['taking_course'][$i]['subject']." ".$student['taking_course'][$i]['catalog']."</td>";
							echo "<td>".$student['taking_course'][$i]['title']."</td>";
							echo "<td>".$student['taking_course'][$i]['cred']."</td>";
							echo "<td>".$student['taking_course'][$i]['genED']."</td>";
						echo "</tr>";
					}
				?>
			</table>
			</div>
			<div class="plan">
			<h3> Major Plan Schedule</h3>
			<table class="schedule_table">
				<thead>
					<tr>
						<th>Course Number</th>
						<th>Title</th>
						<th>Credit</th>
					</tr>
				</thead>
				<?php
					for($i=0;$i<count($plan[$semester_plan]);$i++){
						echo "<tr>";
							echo "<td>".$plan[$semester_plan][$i]['subject']." ".$plan[$semester_plan][$i]['catalog']."</td>";
							echo "<td>".$plan[$semester_plan][$i]['title']."</td>";
							echo "<td>".$plan[$semester_plan][$i]['cred']."</td>";
						echo "</tr>";
					}
				?>
			</table>
			</div>
			<div class="personal_info">
				<h3>Personal Info</h3>
				<div class="personal_info_fill">
					<?php echo "<h4> Student ID: ".$student['s_id']."</h4>"; ?>
					<?php echo "<h4> Current Year: ".$student['year']."</h4>"; ?>
					<?php echo "<h4> Current Semester: ".$student['semester']."</h4>"; ?>
					<?php echo "<h4> Advisor Email: ".$student['advisor_mail']."</h4>"; ?>
					<h4> Change Password Button</h4>
				</div>

			</div>
			<div class="progress_bar">
				<header>Progress Bar</header>
			</div>
		</div>
	</body>
</html>
