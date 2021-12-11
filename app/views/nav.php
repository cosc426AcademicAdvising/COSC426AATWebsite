	<header>
		<img style="height: 75px; padding: 10px; margin: auto; display: block;" src="public/img/web_header.png" />
	</header>
	<?php
	if (empty($_SESSION)) {
		// redirect to login page
		header("Location: ./");
	}
	?>
	<!-- side navigation bar definition -->
	<div class="flexbox">
		<nav class="sidebar">
			<ul>
				<li>
					<a href="dashboard" class="dashboard-btn">
						<ion-icon name="speedometer-outline"></ion-icon>&nbsp;Dashboard
					</a>
				</li>
				<li>
					<a href="#" class="schedule-btn">
						<ion-icon name="calendar-outline"></ion-icon>&nbsp;Schedule
						<span class="fas fa-caret-down first"></span>
					</a>
					<ul class="schedule-show">
						<li><a href="programplanningworksheet" class="schedule-new-btn">New</a></li>
						<li><a href="viewschedule" class="schedule-view-btn">View</a></li>
					</ul>
				</li>
				<li>
					<a href="#" class="progress-btn">
						<ion-icon name="trending-up-outline"></ion-icon>&nbsp;Progress Report
						<span class="fas fa-caret-down second"></span>
					</a>
					<ul class="progress-show">
						<li><a href="majorplan" class="fyp-btn">Major Plan</a></li>
						<li><a href="minorplan" class="minor-btn">Minor Plan</a></li>
						<li><a href="coursehistory" class="course-hist-btn">Course History</a></li>
					</ul>
				</li>
				<li><a href="contact" class="contact-info-btn">
						<ion-icon name="call-outline"></ion-icon>&nbsp;Contact info
					</a></li>
				<li><a href="signout">
						<ion-icon name="log-out-outline"></ion-icon>&nbsp;Sign Out
					</a></li>
			</ul>
		</nav>

		<script>
			$(document).ready(function() {

				$('.schedule-btn').click(function() {
					$('nav ul .schedule-show').toggleClass("sch");
					$('nav ul .first').toggleClass("rotate");
				});
				$('.progress-btn').click(function() {
					$('nav ul .progress-show').toggleClass("prog");
					$('nav ul .second').toggleClass("rotate");
				});
				$('nav ul li').click(function() {
					$(this).addClass("active").siblings().removeClass("active");
				});

			});
		</script>

		<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
