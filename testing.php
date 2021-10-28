<?php
ob_start();
session_start();
require 'vendor/autoload.php';

include_once 'funcs/FourYearFunctions.php';
include_once 'funcs/StudentFunctions.php';

$student = getStudent($_SESSION['username']);
$majors = array();
for($i=0;$i<count($student['major']);$i++) {
	$majors[$i] = $student['major'][$i]['title'];
}

combinedFourYear($majors);
echo '<script> var std = ' . json_encode( $student )  . '; </script>';
echo '<script> var std_hist = ' . json_encode( $student['course_taken'] )  . '; </script>';

?>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

<script>
	console.log( std );
	// console.log(fyp);
	var fy_courses = [];
	for (let i=1; i < 9; i++) {
		var key = 'semester_' + i;

		// major 1
		if(fyp != null) {
			for (child of fyp[0][key]) {
				fy_courses.push(child);
			}
		}

		// major 2
		if (fyp.length == 2 && fyp[1] != null) {
			for (child of fyp[1][key]) {
				fy_courses.push(child);
			}
		}

		// major 3
		if (fyp.length == 3) {
			if(fyp[1] != null) {
				for (child of fyp[1][key]) {
					fy_courses.push(child);
				}
			}
			if(fyp[2] != null) {
				for (child of fyp[2][key]) {
					fy_courses.push(child);
				}
			}
		}
	}

	var courses_taken = [];
	for(key in std_hist[0]) {
		for(child of std_hist[0][key] ) {
			courses_taken.push(child);
		}
	}

	// format courses_taken to match fy_courses
	courses_taken.forEach( obj => obj['title'] = obj['title'].toUpperCase());
	courses_taken.forEach( obj => delete obj.grade );
	courses_taken.forEach( obj => delete Object.assign(obj, {['cred']: obj['credits'] })['credits']);	// might delete

	// remove underterminable courses and with X in catalog e.g HIST 10X
	fy_courses = fy_courses.filter(function(obj){
		return obj['catalog'] != '' && obj['catalog'] != 'XXX' && obj['catalog'][2] != 'X';
	});

	// convert to string for comparison
	var string_fy = [];
	for(obj of fy_courses) {
		string_fy.push(JSON.stringify(obj));
	}
	var string_taken = [];
	for(obj of courses_taken) {
		string_taken.push(JSON.stringify(obj));
	}

	// remove dups
	string_fy = string_fy.filter(function(item, pos, self) {
		return self.indexOf(item) == pos;
	});

	// fint difference fy - taken
	var string_rec = [];
	string_rec = string_fy.filter(function(x){
			if(!string_taken.includes(x)){
				return x;
			}
	});

	// console.log('combined courses of majors', fy_courses);
	console.log('student courses taken', courses_taken);

	var rec = [];
	for(obj of string_rec) {
		rec.push(JSON.parse(obj));
	}

	// TODO feature for course HIST 10X
	console.log('recommandations', rec);

</script>
