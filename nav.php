	<header>
		<h2>Salisbury University</h2>
	</header>
	<?php
		if(empty($_SESSION)){
			header("Location: /login.php");
		}
	?>
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
				<li><a href="signout.php">Sign Out</a></li>
			</ul>
		</nav>

		<script>
			$( document ).ready(function(){
				$('.schedule-btn').click(function () {
					$('nav ul .schedule-show').toggleClass("sch");
					$('nav ul .first').toggleClass("rotate");
				});
				$('.progress-btn').click(function () {
					$('nav ul .progress-show').toggleClass("prog");
					$('nav ul .second').toggleClass("rotate");
				});
				$('nav ul li').click(function () {
					$(this).addClass("active").siblings().removeClass("active");
				});

			});
		</script>
			
