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
	<script src="JS/schedule.js"></script>

	<?php
		ob_start();
		session_start();
		require 'vendor/autoload.php';

		include_once 'funcs/CourseFunctions.php';
		
		echo '<script> var courselist = ' . json_encode( getCoursebyRegex("", "", "", ""))  . '; </script>'
	?>
</head>

<body>
	<datalist id="courselist"></datalist>
	<script>
		courselist = courselist.filter(function(val){
			return val["Allowd Unt"] != "999.00";
		});

		// sort by course number
		courselist.sort(function(a,b) {
			if( a["Subject"] > b["Subject"] ){
				return 1;
			} else if( a["Subject"] < b["Subject"] ){
				return -1;
			} else { // same
				if(a["Catalog"] > b["Catalog"]){
					return 1;
				}else{
					return -1;
				}
			}
		});
		
		var text = "";
		var seperator = "    "
		courselist.forEach( val => 
			text += '<option value="'+ val["Subject"] + " " +$.trim(val["Catalog"])+ seperator + val["Long Title"] + seperator + val["Allowd Unt"] + '">');
		$('#courselist').html( text )
	</script>
	<?php
		include 'nav.php';
	?>

		<div id="content" style="overflow: scroll;">
			
			<div class="schedule-new">
				<form action="" id="programplanningworksheet">
					<h3 style="text-align: center; margin-bottom:20px;">Program Planning Worksheet</h3>
					<label for="studentname">Name: </label>
					<input type="text" id="studentname" name="studentname" size="40">
					<label for="studentid">Id: </label>
					<input type="text" id="studentid" name="studentid" maxlength="7" minlength="7" size="8">
					<br>
					
					<div for="affliation">
						<p>Major(s): <span id="major"></span> Minor(s):  <span id="minor"></span> </p>
					</div>

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

					<div id="coursesearchsection" style="display:inline-block; margin-top:20px; width:100%;">
						<div style="display:inline-block;">
							<label for="course">Search for a course <br> <font size="1">enter subject, course number, title or credits</font></label><br>
							<input list="courselist" id="coursesearch" name="coursesearch" size="80" required>
						</div>
						<div style="display:inline-block;">
							<label for="coursetype">Fulffilment <br> <font size="1">for Major, Minor, Elective, Gen-Ed, ...</font></label><br>
							<input type='text' id="coursetype" name="coursetype">
						</div>
						<button type='button' onclick="scheduleAddCourse(coursesearch.value, coursetype.value)">Add</button>
					</div>

					<!-- Course table goes here -->
					<div id="schedule-course">
						<table id="schedulecoursetable">
							<tr>
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
					<textarea rows="4" cols="50" name="memo" form="programplanningworksheet"></textarea>
					<br>

					<input type="submit" value="Submit">

				</form>
			</div>

		</div>
</div> <!-- flexbox div ends -->
<script>
	$('nav ul .schedule-show').toggleClass("sch");
	$('nav ul .first').toggleClass("rotate");
	$('.schedule-new-btn').css({"color":"#8a0000","border-left-color":"#8a0000"});
</script>

</body>
</html>
