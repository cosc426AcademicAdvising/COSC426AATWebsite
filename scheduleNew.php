<!DOCTYPE html>
<html>
<head>
	<title>Academic Planar</title>
	<meta charset="UTF-8">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="CSS/nav.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<link rel="stylesheet" href="CSS/scheduleNew.css">

	<?php
		ob_start();
		session_start();
		require 'vendor/autoload.php';

		include_once 'funcs/CourseFunctions.php';
		include_once 'funcs/StudentFunctions.php';
		include_once 'funcs/FourYearFunctions.php';
		
		// available courses
		echo '<script> var available_courses = ' . json_encode( getCoursebyRegex("", "", "", ""))  . '; </script>';
		
		//student information
		$student = getStudent($_SESSION['username']);
		$progress = $student['credits'];

		$majors = array();
		for($i=0;$i<count($student['major']);$i++) {
			$majors[$i] = $student['major'][$i]['title'];
		}
		$minors = array();
		if(count($student['minor']) > 0) {
			for($i=0;$i<count($student['minor']);$i++) {
				$minors[$i] = $student['minor'][$i]['title'];
			}
		}

		// for recommandations
		combinedFourYear($majors);
		echo '<script> var std_hist = ' . json_encode( $student['course_taken'] )  . '; </script>';
	?>
</head>

<body>
	<datalist id="available_courses"></datalist>
	<datalist id="recommended_courses"></datalist>

	<script>
		available_courses = available_courses.filter(function(val){
			return val["Allowd Unt"] != "999.00";
		});

		// sort by course number
		available_courses.sort(function(a,b) {
			if ( a["Subject"] > b["Subject"] ){ return 1;} 
			else if( a["Subject"] < b["Subject"] ) { return -1;} 
			else { // same
				if (a["Catalog"] > b["Catalog"]) { return 1; }
				else { return -1; }
			}
		});
		
		var text = "";
		var seperator =  Array(4).fill(' ').join(''); //4 blank space
		available_courses.forEach( val => text += '<option value="'+ val["Subject"] + " " +$.trim(val["Catalog"])+ seperator + val["Long Title"] + seperator + val["Allowd Unt"] + '">');
		$('#available_courses').html( text );
	</script>
	<?php
		include 'nav.php';
	?>

		<div id="content" style="overflow: scroll;">
			
			<div class="schedule-new">
				<form action="" id="programplanningworksheet">
					<p style="font-weight:normal;font-size:12px;text-align:right"><span class="required"> *</span> denotes a required field</p>
					<h3 style="text-align:center; margin-bottom:20px;">Program Planning Worksheet</h3>
					<label for="studentname">Name<span class="required">*</span></label>
					<input type="text" id="studentname" name="studentname" size="40" value="<?php echo $student['name'];?>" readonly>
					<label for="studentid">Id<span class="required">*</span></label>
					<input type="text" id="studentid" name="studentid" maxlength="7" minlength="7" size="8" value="<?php echo $student['s_id'];?>" readonly>
					<br>
					
					<div id="affliation">
						<p style="margin-top:15px;">
							Major(s):
							<span id="major">
								<?php 
								foreach ($majors as $val) {echo $val . ', ';} 
								?>
							</span>
						</p> 
						<p style="margin-top:15px;">
							Minor(s):
							<span id="minor">
								<?php
								if(count($student['minor']) > 0) {
									foreach ($minors as $val) {echo $val . ', ';} 
								}
								?>
							</span> 
						</p>
					</div>

					<br>

					<span>Registering for<span class="required">*</span></span>
					<input type="radio" name="season" value="Fall" required>
					<label for="Fall">Fall </label>
					<input type="radio" name="season" value="Winter" required>
					<label for="Winter">Winter </label>
					<input type="radio" name="season" value="Spring" required>
					<label for="Spring">Spring </label>
					<input type="radio" name="season" value="Summer" required>
					<label for="Summer">Summer </label>
					
					<label for="year" style="margin-left:100px;">Year <span class="required">*</span></label>
					<select id="year" name="year">
						<?php
						$year = date("Y");
						$year_count = 5;	//number of years forward
						for( $i=0; $i<$year_count; $i++){
							echo '<option>'. ($year + $i) . '</option>';
						}
						?>
					</select>
					<br>

					<span>Earned: </span> 
					<input type="text" id="creditearned" name="creditearned" maxlength="3" size="4" value="<?php echo $student['credits'];?>" readonly>
					<span>credits.</span>
					<span style="margin-left:100px">Credits</span>
					<input type="text" id="creditenrolled" name="creditenrolled" size="3" value="0" readonly>
					<span>currently enrolled in.</span>
					<br>

					<div id="coursesearchsection" style="display:inline-block; margin-top:20px; width:100%;">
						<div style="display:inline-block;">
							<label for="course">Search for a course <br> <font size="1">enter a subject, course number, title or credits</font></label><br>
							<input list="available_courses" id="coursesearch" name="coursesearch" style="width:40vw;">
						</div>
						<div style="display:inline-block;">
							<label for="coursetype">Fulffilment <br> <font size="1">for Major, Minor, Elect, Gen-Ed, ...</font></label><br>
							<input type='text' id="coursetype" name="coursetype">
						</div>
						<div style="display:inline-block;text-align:center;">
							<label for="forBcourse">Is a back-up<br>course?</label><br>
							<select id="forBcourse" name="forBcourse">
								<option>No</option>
								<option>Yes</option>
							</select>
						</div>
						<button type='button' onclick="scheduleAddCourse(coursesearch.value, coursetype.value)">Add</button>
					</div>

					<!-- Course table goes here -->
					<div id="schedule-course">
						<table id="schedule-coursetable">
							<tr>
								<b>
									<th style="width:10%px;">Course Number<span class="required">*</span></th>
									<th style="width:50%;">Title</th>
									<th style="width:5%;">Credits</th>
									<th style="width:20%;">Fulffilment</a></th>
									<th></th>
								</b>
							</tr>
						</table>
					</div>
					
					<div style="text-align:center;margin-top:20px;">
					<label for="schedule-backupcoursetable"><u>Back-up Courses</u></label>
					</div>
					<div id="schedule-backupcourse">
						<table id="schedule-backupcoursetable">
							<tr hidden>
								<b>
									<th style="width:10%px;">Course Number</th>
									<th style="width:50%;">Title</th>
									<th style="width:5%;">Credits</th>
									<th style="width:20%;">Fulffilment</a></th>
									<th></th>
								</b>
							</tr>
						</table>
					</div>

					<br>

					<label for="memo">Memo: </label><br>
					<textarea rows="4" cols="50" id="memo" name="memo" form="programplanningworksheet"></textarea>
					<br>
					<!-- remove  type=button when save button is complete -->
					<button type="button" onclick="saveDraft()">Save</button>
					<input type="submit" value="Submit">

				</form>
			</div>

		</div>
</div> <!-- flexbox div ends -->
<script>
	$('nav ul .schedule-show').toggleClass("sch");
	$('nav ul .first').toggleClass("rotate");
	$('.schedule-new-btn').css({"color":"#8a0000","border-left-color":"#8a0000"});
	
	if ( $('#schedule-backupcoursetable tbody').children().length == 1) {
		$('#schedule-backupcoursetable').toggle();
	}
</script>

<!-- table and buttons functionalities -->
<script src="JS/scheduleNewFuncs.js"></script>

<!-- courses recommandations -->
<script src="JS/recommendedCourses.js"></script>

</body>
</html>
