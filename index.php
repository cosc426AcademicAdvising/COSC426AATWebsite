<!DOCTYPE html>
<head>
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	
	<link rel="stylesheet" href="CSS/index.css">
	<link rel="stylesheet" href="CSS/scheduleNew.css">

	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script src="JS/index.js"></script>

</head>

<body>
	<header>
		<h2>Salisbury University</h2>
	</header>

	<div class="flexbox">
		<nav class="sidebar">
			<ul>
				<li><a href="dashboard.php" class="dashboard-btn">Dashboard</a></li>
				<li>
					<a href="#" class="schedule-btn">Schedule <span class="fas fa-caret-down first"></span></a>
					<ul class="schedule-show">
						<li><a href="scheduleNew.php" class="schedule-new-btn">New</a></li>
						<li><a href="scheduleView.php" class="schedule-view-btn">View</a></li>
					</ul>
				</li>
				<li>
					<a href="#" class="progress-btn">Progress Report <span class="fas fa-caret-down second"></span> </a>
					<ul class="progress-show">
						<li><a href="fyp.php" class="fyp-btn">Four Year Plan</a></li>
						<li><a href="courseHistory.php" class="course-hist-btn">Course History</a></li>
					</ul>
				</li>
				<li><a href="info.php" class="contact-info-btn">Contact info</a></li>
				<li><a href="">Sign Out</a></li>
			</ul>
		</nav>

		<div id="content">
			