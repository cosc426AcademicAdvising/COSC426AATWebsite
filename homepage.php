<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="homepage.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<?php require 'vendor/autoload.php'; ?>

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
				<form action="" id="programplanningworksheet">
					<h3 style="text-align: center; margin-bottom:20px;">Program Planning Worksheet</h3>
					<label for="studentname">Name: </label>
					<input type="text" id="studentname" name="studentname" size="40">
					<label for="studentid">Id: </label>
					<input type="text" id="studentid" name="studentid" maxlength="7" minlength="7" size="8">
					<br>
					<label for="major">Major: </label>
					<select id="major" id="major">
					<?php 
						include_once 'DepartmentFunctions.php'; 
						$schools = getSchools();
						$cnt = count($schools);					
						for($i=0;$i<$cnt;$i++){
							echo '<option value='.$schools[$i].'>'.$schools[$i].'</option>';
						}
					?>
					</select>
					<label for="minor">Minor: </label>
					<select id="minor" name="minor">
					<?php 
						include_once 'DepartmentFunctions.php'; 
						$schools = getSchools();
						$cnt = count($schools);					
						for($i=0;$i<$cnt;$i++){
							echo '<option value='.$schools[$i].'>'.$schools[$i].'</option>';
						}
					?>
					</select>
					
					<br>

					<span>Registering for</span>
					<input type="radio" id="Fall" name="season" value="Fall">
					<label for="Fall">Fall </label>
					<input type="radio" id="Winter" name="season" value="Winter">
					<label for="Winter">Winter </label>
					<input type="radio" id="Spring" name="season" value="Spring">
					<label for="Spring">Spring </label>
					<input type="radio" id="Summer" name="season" value="Summer">
					<label for="Summer">Summer </label>
					
					<label for="year">Year </label>
					<input type="text" id="year" name="year" maxlength="4" minlength="4" size="6">
					<br>

					<span>Earned: </span> 
					<input type="text" id="creditearned" name="creditearned" maxlength="3" size="4" readonly>
					<span>credits</span>
					<span>Credits</span>
					<input type="text" id="creditenrolled" name="creditenrolled" size="3" value="0" readonly>
					<span>currently enrolled in</span>
					<br>

					<!-- Course table goes here -->
					<div id="schedule-course">
						<table id="schedulecoursetable">
							<tr>
								<b>
									<th>Course Number</th>
									<th>Title</th>
									<th>Credit</th>
									<th>Major, Minor, Elective</th>
									<th></th>
								</b>
							</tr>
							<tr id="schedule-course-entry">
								<th><input type='text' id="schedulecoursenumb" name="schedulecoursenumb" style="text-transform:uppercase"></th>
								<th><input type='text' id="schedulecoursetitle" name="schedulecoursetitle"></th>
								<th><input type='text' id="schedulecoursecredit" name="schedulecoursecredit"></th>
								<th><input type='text' id="schedulecoursetype" name="schedulecoursetype"></th>
								<th><button type='button' onclick="scheduleAddCourse(schedulecoursenumb.value, schedulecoursetitle.value, schedulecoursecredit.value, schedulecoursetype.value)">Add</button></th>
								<!-- scheduleAddCourse(schedule-coursenumb.value, schedule-coursetitle.value, schedule-coursecredit.value, schedule-coursetype.value)" -->
							</tr>
						</table>
					</div>
					<br>

					<label for="memo">Memo: </label><br>
					<textarea rows="8" cols="50" name="memo" form="programplanningworksheet"></textarea>
					<br>
					<input type="submit" value="Submit">

				</form>

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

		function scheduleAddCourse(subj, ttl, cr, typ) {
			// console.log(subj, ttl, cr, typ);
			if (subj != "" && ttl != "" && cr != "") {
				// but = '<button type="button" onclick="">Delete</botton>'
				text = "<tr><th>" + subj + "</th><th>" + ttl + "</th><th>" + cr + "</th><th>" + typ + "</th><th></th></tr>";
				$('#schedulecoursetable').append(text);
				$("#schedulecoursetable :input").val("");
			}
		}
	</script>
	
</body>
