<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="homepage.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
	<header>
		<h2>Salisbury University</h2>
	</header>

	<div class="flexbox">
		<nav class="sidebar">
			<ul>
				<li><a href="#" class="dashboard-btn">Dashboard</a></li>
				<li>
					<a href="#" class="schedule-btn">Schedule <span class="fas fa-caret-down first"></span></a>
					<ul class="schedule-show">
						<li><a href="#" class="schedule-new-btn">New</a></li>
						<li><a href="#" class="schedule-view-btn">View</a></li>
					</ul>
				</li>
				<li>
					<a href="#" class="progress-btn">Progress Report <span class="fas fa-caret-down second"></span> </a>
					<ul class="progress-show">
						<li><a href="#" class="fyp-btn">Four Year Plan</a></li>
						<li><a href="#" class="course-hist-btn">Course History</a></li>
					</ul>
				</li>
				<li><a href="#" class="contact-info-btn">Contact info</a></li>
				<li><a href="#">Sign Out</a></li>
			</ul>
		</nav>

		<div id="content">
			<div class="dashboard">
				<p>to be dashboard</p>
			</div>
			<div class="schedule-new">
				<p>new schedule</p>
			</div>
			<div class="schedule-view">
				<p>view schedule</p>
			</div>
			<div class="fyp">
				<p>four year plan</p>
			</div>
			<div class="course-hist">
				<p>course history</p>
			</div>
			<div class="contact-info">
				<p>advisor info</p>
			</div>
		</div>

	</div>

	<script>
		$(document).ready(function () {
			$('#content > *').not(':first').hide();
		});

		// nav bar sub menu
		$('.schedule-btn').click(function(){
			$('nav ul .schedule-show').toggleClass("sch");
			$('nav ul .first').toggleClass("rotate");
		});
		$('.progress-btn').click(function(){
			$('nav ul .progress-show').toggleClass("prog");
			$('nav ul .second').toggleClass("rotate");
		});
		$('nav ul li').click(function(){
			$(this).addClass("active").siblings().removeClass("active");
		});

		// nav bar button function
		$('.dashboard-btn').click(function () {
			$('#content > *').hide();
			$('#content .dashboard').show();
		});
		$('.schedule-new-btn').click(function () {
			$('#content > *').hide();
			$('#content .schedule-new').show();
		});
		$('.schedule-view-btn').click(function () {
			$('#content > *').hide();
			$('#content .schedule-view').show();
		});
		$('.fyp-btn').click(function () {
			$('#content > *').hide();
			$('#content .fyp').show();
		});
		$('.course-hist-btn').click(function () {
			$('#content > *').hide();
			$('#content .course-hist').show();
		});
		$('.contact-info-btn').click(function () {
			$('#content > *').hide();
			$('#content .contact-info').show();
		});
	</script>
	
</body>
