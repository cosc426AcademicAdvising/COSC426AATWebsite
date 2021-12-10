<!DOCTYPE html>
<html lang="en">

<head>
	<title>Scheduling</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="public/css/nav.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<link rel="stylesheet" href="public/css/scheduleNew.css">
	<link rel="stylesheet" href="public/css/flashmessage.css">

	<?php
	ob_start();
	session_start();

	// available courses
	echo '<script> var available_courses = ' . json_encode(getCoursebyRegex("", "", "", ""))  . '; </script>';

	//student information
	$student = getStudent($_SESSION['username']);
	$progress = $student['credits'];

	$majors = array();
	for ($i = 0; $i < count($student['major']); $i++) {
		$majors[$i] = $student['major'][$i]['title'];
	}
	$minors = array();
	if (count($student['minor']) > 0) {
		for ($i = 0; $i < count($student['minor']); $i++) {
			$minors[$i] = $student['minor'][$i]['title'];
		}
	}

	// draft
	$is_draft_present = isDraftPresent($student['s_id']);
	echo '<script> var is_draft_present = ' . json_encode($is_draft_present)  . '; </script>';
	// if draft make js variable for it
	if ($is_draft_present == 1) {
		$draft = getDraft($student['s_id']);
		echo '<script> var student_draft = ' . json_encode($draft)  . '; </script>';
	}
	// for recommandations
	combinedFourYear($majors);
	echo '<script> var student_id = ' . json_encode($student['s_id'])  . '; </script>';
	echo '<script> var student_course_hist = ' . json_encode($student['course_taken'])  . '; </script>';
	echo '<script> var current_semester_number = ' . json_encode(intval($student['semester']))  . '; </script>';
	?>
</head>

<body>

	<datalist id="available_courses"></datalist>
	<datalist id="recommended_courses"></datalist>

	<script>
		available_courses = available_courses.filter(function(val) {
			return val["Allowd Unt"] != "999.00";
		});

		// sort by course number
		available_courses.sort(function(a, b) {
			if (a["Subject"] > b["Subject"]) {
				return 1;
			} else if (a["Subject"] < b["Subject"]) {
				return -1;
			} else { // same
				if (a["Catalog"] > b["Catalog"]) {
					return 1;
				} else {
					return -1;
				}
			}
		});

		var text = "";
		var seperator = Array(4).fill(' ').join(''); //4 blank space
		available_courses.forEach(val => text += '<option value="' + val["Subject"] + " " + $.trim(val["Catalog"]) + seperator + val["Long Title"] + seperator + val["Allowd Unt"] + '">');
		$('#available_courses').html(text);
	</script>

	<?php
	include 'nav.php';
	?>

	<div id="content" style="overflow: scroll;">
		<div class="container">
			<!-- for messages to user -->
			<section id="message-container"></section>
			<script src="public/js/flashmessage.js"></script>

			<div class="schedule-new">
				<form action="javascript:submitPlan()" id="programplanningworksheet">
					<div class="std_form">

						<p class="denote" style="font-weight:normal;font-size:12px;text-align:right"><span class="required"> *</span> denotes a required field</p>
						<div class="std_title">
							<h2 style="text-align:center; margin: auto;">Program Planning Worksheet</h2>
						</div>
						<div class="std_id">
							<h4 style="margin: auto auto 18px auto; text-align: center;">Personal Info</h4>

							<label for="studentname">Name</label>
							<input type="text" id="studentname" name="studentname" size="40" style="margin-right: 35px;" value="<?php echo $student['name']; ?>" readonly>
							<label for="studentid">ID</label>
							<input type="text" id="studentid" name="studentid" maxlength="7" minlength="7" size="8" value="<?php echo $student['s_id']; ?>" readonly>
						</div>

						<div class="std_maj">
							<h4 style="margin: auto auto 18px auto; text-align: center;">Degree Info</h4>

							<p style="margin-top:15px;">
								Major(s):
								<span id="major">
									<?php
									echo "" . implode(", ", $majors);
									?>
								</span>
							</p>
							<p style="margin-top:15px;">
								Minor(s):
								<span id="minor">
									<?php
									if (count($student['minor']) > 0) {
										echo "" . implode(", ", $minors);
									}
									?>
								</span>
							</p>
						</div>

						<div class="std_register">
							<h4 style="margin: auto auto 18px auto; text-align: center;">Enrollment Info<span class="required">*</span></h4>
							<label style="margin-right: 25px;">Registering for<span class="required">*</span></label>
							<input type="radio" name="season" value="Fall" style="margin-left: 10px;" required>
							<label for="Fall">Fall </label>
							<input type="radio" name="season" value="Winter" style="margin-left: 10px;" required>
							<label for="Winter">Winter </label>
							<input type="radio" name="season" value="Spring" style="margin-left: 10px;" required>
							<label for="Spring">Spring </label>
							<input type="radio" name="season" value="Summer" style="margin-left: 10px;" required>
							<label for="Summer">Summer </label>

							<label for="year" style="margin-left:40px;">Year <span class="required">*</span></label>
							<select id="year" name="year">
								<?php
								$year = date("Y");
								$year_count = 5;	//number of years forward
								for ($i = 0; $i < $year_count; $i++) {
									echo '<option>' . ($year + $i) . '</option>';
								}
								?>
							</select>
							<br>
							<br>
							<span>Earned: </span>
							<input type="text" id="creditearned" name="creditearned" maxlength="3" size="4" value="<?php echo $student['credits']; ?>" readonly>
							<span>credits.</span>
							<span style="margin-left:80px">Credits</span>
							<input type="text" id="creditenrolled" name="creditenrolled" size="3" value="0" readonly>
							<span>currently enrolled in.</span>
						</div>
						<div class="std_courseSearch">
							<div class="std_search">
								<h4 style="margin: auto auto 18px auto; text-align: center;">Course Search<span class="required">*</span></h4>
								<div class="search_field" id="coursesearchsection">
									<div style="display:flex; margin-bottom: 10px;">
										<input list="available_courses" id="coursesearch" name="coursesearch" placeholder="enter a subject, course number, title or credits" style="width:40vw; margin: auto">
									</div>

									<div class="checkboxes" id="checkboxes" style="display:inline-block; margin-left:20px">
										<!-- <label for="coursetype">Fulffilment <br> <font size="1">for Major, Minor, Elective</font></label><br> -->
										<!-- <input type='text' id="coursetype" name="coursetype"> -->
										<label style="margin-right: 25px;">Fulfillment<span class="required">*</span></label>
										<input type="checkbox" value="MAJOR" id="majorcourse" class="checkboxaddcourse">
										<label for="majorcourse" style="margin-right: 25px;">Major</label>
										<input type="checkbox" value="MINOR" id="minorcourse" class="checkboxaddcourse" style="margin-left: 2px;">
										<label for="minorcourse" style="margin-right: 25px;">Minor</label>
										<input type="checkbox" value="ELECTIVE" id="electcourse" class="checkboxaddcourse" style="margin-left: 2px;">
										<label for="electcourse">Elective</label>

										<label for="forBackup" style="margin-left: 75px;">Backup Course?<span class="required">*</span></label>
										<select id="forBackup" name="forBackup">
											<option>No</option>
											<option>Yes</option>
										</select>
										<br>
										<br>
										<button type='button' onclick="scheduleAddCourse(coursesearch.value, '', false)">Add To Table</button>
									</div>

								</div>
							</div>
						</div>
						<div class="std_tbl">
							<!-- Course table goes here -->
							<div id="schedule-course" class="crs_tbl">
								<div class="tbl_title">
									<h3> Preffered Courses </h3>
								</div>
								<div class="tbl_area">
									<table id="schedule-coursetable">
										<tr>
											<b>
												<th style="width:10%px;">Course</th>
												<th style="width:50%;">Title</th>
												<th style="width:5%;">Credits</th>
												<th style="width:20%;">Fulffilment</a></th>
												<th style="border-right: none;"></th>
											</b>
										</tr>
									</table>
								</div>
							</div>

							<div style="text-align:center;margin-top:20px;">
							</div>
							<div id="schedule-backupcourse" class="crs_tbl">
								<div class="tbl_title">
									<h3> Backup Courses </h3>
								</div>
								<div class="tbl_area">
									<table id="schedule-backupcoursetable">
										<tr style="display:none">
											<th style="width:10%px;visibility:hidden;">Course</th>
											<th style="width:50%;visibility:hidden;">Title</th>
											<th style="width:5%;visibility:hidden;">Credits</th>
											<th style="width:20%;visibility:hidden;">Fulffilment</a></th>
											<th style="border-right: none;visibility:hidden;"></th>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<br>
						<div class="std_memo">
							<h4 style="margin: auto auto 18px auto; text-align: center;">Memo</h4>
							<textarea rows="3" cols="50" id="memo" name="memo" placeholder="Questions, Comments, or Concerns for your Advisor" form="programplanningworksheet" style="padding: 8px; overflow: auto;"></textarea>
						</div>
						<br>
						<!-- remove  type=button when save button is complete -->
						<div class="std_btn">
							<button type="button" onclick="saveDraft()" style="padding: 0 20px 0 20px; font-size: 25px; width: 300px; margin-bottom: 15px;">Save Draft</button>
							<br>
							<input type="submit" value="Send To Advisor" style="padding: 0 20px 0 20px; font-size: 25px; width: 300px;">
						</div>
					</div>
			</div>

			</form>
		</div>
	</div>
	</div>
	</div> <!-- flexbox div ends -->

	<!-- table and buttons functionalities -->
	<script src="public/js/scheduleNewFuncs.js"></script>

	<!-- courses recommandations -->
	<script src="public/js/recommendCourses.js"></script>

	<!-- fill tables with draft obj data if student had saved-->
	<script src="public/js/fillWithDraft.js"></script>

	<script>
		$('nav ul .schedule-show').toggleClass("sch");
		$('nav ul .first').toggleClass("rotate");
		$('.schedule-new-btn').css({
			"color": "#8a0000",
			"border-left-color": "#8a0000"
		});

		if ($('#schedule-backupcoursetable tbody').children().length == 1) {
			$('#schedule-backupcoursetable').toggle();
		}

		// if draft was not saved recommend courses
		if (is_draft_present != 1) {
			recommend_courses(true);
		} else {
			fill_with_draft();
			message('success', '<b>Alert:</b><br/> Previous draft loaded!');
		}
	</script>



</body>

</html>
