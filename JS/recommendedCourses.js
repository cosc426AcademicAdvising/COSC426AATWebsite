// fyp defined in funcs/FourYearFunctions.php -> combinedFourYear()
// extract semester keys from each major(s)

// current_semester_number defined in scheduleNew.php in php tag
// we want to recommend classes from semester 0 to semester ahead of current
var semester_count = (current_semester_number + 1 <= 8) ? current_semester_number + 1 : current_semester_number;

var fy_courses = [];
for (let i = 1; i <= semester_count; i++) {
	var key = 'semester_' + i;
	// major 1
	if (fyp[0] != null) {
		for (obj of fyp[0][key]) {
			fy_courses.push(obj);
		}
	}
	// major 2
	if (fyp.length == 2 && fyp[1] != null) {
		for (obj of fyp[1][key]) {
			fy_courses.push(obj);
		}
	}
	// major 3
	if (fyp.length == 3) {
		if (fyp[1] != null) {
			for (obj of fyp[1][key]) {
				fy_courses.push(obj);
			}
		}
		if (fyp[2] != null) {
			for (obj of fyp[2][key]) {
				fy_courses.push(obj);
			}
		}
	}
}

// std_hist defined in scheduleNew.php in php tag
// extract student courses taken list
var courses_taken = [];
for (key in std_hist[0]) {
	for (obj of std_hist[0][key]) {
		courses_taken.push(obj);
	}
}

// format courses_taken to match fy_courses
courses_taken.forEach(obj => obj['title'] = obj['title'].toUpperCase());
courses_taken.forEach(obj => delete obj.grade);
courses_taken.forEach(obj => delete Object.assign(obj, { ['cred']: obj['credits'] })['credits']);	// might delete

// remove underterminable courses and courses w/ X in catalog e.g HIST 10X
fy_courses = fy_courses.filter(function (obj) {
	return Object.keys(obj).length == 4 && obj['catalog'] != '' && obj['catalog'] != 'XXX' && obj['catalog'][2] != 'X';
});

// convert to string for easier comparison
var string_fy = [];
for (obj of fy_courses) {
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
var rec = [];
for (obj of string_rec) {
	rec.push(JSON.parse(obj));
}

// remove extra char for courses like HIST 103b
rec.forEach(obj => obj['catalog'] = obj['catalog'].slice(0, 3));

switch( true ) {
	case (rec.length >= 4):
		for (let i = 0; i < 4; i++) {
			var course = rec[i]["subject"] + " " + $.trim(rec[i]["catalog"]) + seperator + rec[i]["title"] + seperator + rec[i]["cred"];
			scheduleAddCourse(course, "MAJOR", true);
		}
		break;
	case (rec.length >= 3):
		for (let i = 0; i < 3; i++) {
			var course = rec[i]["subject"] + " " + $.trim(rec[i]["catalog"]) + seperator + rec[i]["title"] + seperator + rec[i]["cred"];
			scheduleAddCourse(course, "MAJOR", true);
		}
		break;
	case (rec.length >= 2):
		for (let i = 0; i < 2; i++) {
			var course = rec[i]["subject"] + " " + $.trim(rec[i]["catalog"]) + seperator + rec[i]["title"] + seperator + rec[i]["cred"];
			scheduleAddCourse(course, "MAJOR", true);
		}
		break;
	case (rec.length == 1):
		var course = rec[0]["subject"] + " " + $.trim(rec[0]["catalog"]) + seperator + rec[0]["title"] + seperator + rec[0]["cred"];
		scheduleAddCourse(course, "MAJOR", true);
		break;
	case (rec.length == 0):
		break;
}

// TODO feature for courses like HIST 10X
