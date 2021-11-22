// combined_four_year_plans defined in funcs/FourYearFunctions.php -> combinedFourYear()
// extract semester keys from each major(s)

// current_semester_number defined in scheduleNew.php in php tag
// we want to recommend classes from semester 0 to semester ahead of current
var semester_count = (current_semester_number + 1 <= 8) ? current_semester_number + 1 : current_semester_number;

var four_year_courses = [];
for (let i = 1; i <= semester_count; i++) {
	var key = 'semester_' + i;
	// major 1
	if (combined_four_year_plans[0] != null) {
		for (obj of combined_four_year_plans[0][key]) {
			four_year_courses.push(obj);
		}
	}
	// major 2
	if (combined_four_year_plans.length == 2 && combined_four_year_plans[1] != null) {
		for (obj of combined_four_year_plans[1][key]) {
			four_year_courses.push(obj);
		}
	}
	// major 3
	if (combined_four_year_plans.length == 3) {
		if (combined_four_year_plans[1] != null) {
			for (obj of combined_four_year_plans[1][key]) {
				four_year_courses.push(obj);
			}
		}
		if (combined_four_year_plans[2] != null) {
			for (obj of combined_four_year_plans[2][key]) {
				four_year_courses.push(obj);
			}
		}
	}
}

// student_course_hist defined in scheduleNew.php in php tag
// extract student courses taken list
var courses_taken = [];
for (key in student_course_hist[0]) {
	for (obj of student_course_hist[0][key]) {
		courses_taken.push(obj);
	}
}

// format courses_taken to match four_year_courses
courses_taken.forEach(obj => obj['title'] = obj['title'].toUpperCase());
courses_taken.forEach(obj => delete obj.grade);
courses_taken.forEach(obj => delete Object.assign(obj, { ['cred']: obj['credits'] })['credits']);	// might delete

// remove underterminable courses and courses w/ X in catalog e.g HIST 10X
four_year_courses = four_year_courses.filter(function (obj) {
	return Object.keys(obj).length == 4 && obj['catalog'] != '' && obj['catalog'] != 'XXX' && obj['catalog'][2] != 'X';
});

// convert to string for easier comparison
var string_fy = [];
for (obj of four_year_courses) {
	string_fy.push(JSON.stringify(obj));
}
var string_taken = [];
for (obj of courses_taken) {
	string_taken.push(JSON.stringify(obj));
}

// remove dups
string_fy = string_fy.filter(function (item, pos, self) {
	return self.indexOf(item) == pos;
});

// find difference: fy - taken
var string_rec = [];
string_rec = string_fy.filter(function (x) {
	if (!string_taken.includes(x)) {
		return x;
	}
});

// convert back to object
var recommended_courses = [];
for (obj of string_rec) {
	recommended_courses.push(JSON.parse(obj));
}

// remove extra char for courses like HIST 103b
recommended_courses.forEach(obj => obj['catalog'] = obj['catalog'].slice(0, 3));

switch( true ) {
	case (recommended_courses.length >= 4):
		for (let i = 0; i < 4; i++) {
			var course = recommended_courses[i]["subject"] + " " + $.trim(recommended_courses[i]["catalog"]) + seperator + recommended_courses[i]["title"] + seperator + recommended_courses[i]["cred"];
			scheduleAddCourse(course, "MAJOR", true);
		}
		break;
	case (recommended_courses.length >= 3):
		for (let i = 0; i < 3; i++) {
			var course = recommended_courses[i]["subject"] + " " + $.trim(recommended_courses[i]["catalog"]) + seperator + recommended_courses[i]["title"] + seperator + recommended_courses[i]["cred"];
			scheduleAddCourse(course, "MAJOR", true);
		}
		break;
	case (recommended_courses.length >= 2):
		for (let i = 0; i < 2; i++) {
			var course = recommended_courses[i]["subject"] + " " + $.trim(recommended_courses[i]["catalog"]) + seperator + recommended_courses[i]["title"] + seperator + recommended_courses[i]["cred"];
			scheduleAddCourse(course, "MAJOR", true);
		}
		break;
	case (recommended_courses.length == 1):
		var course = recommended_courses[0]["subject"] + " " + $.trim(recommended_courses[0]["catalog"]) + seperator + recommended_courses[0]["title"] + seperator + recommended_courses[0]["cred"];
		scheduleAddCourse(course, "MAJOR", true);
		break;
	case (recommended_courses.length == 0):
		break;
}

// TODO feature for courses like HIST 10X
