// isForNewSchedule parameter to determine if courses will be addead 
// to table in program planning worksheet page. can true or false
function recommend_courses(isForNewSchedule)
{
	// combined_four_year_plans defined in resources/FourYearFunctions.php -> combinedFourYear()

	// take courses obj and put them in a list of obj
	var four_year_courses = [];
	for (let i = 1; i <= 8; i++) {
		// extract semester keys from each major(s)
		var key = 'semester_' + i;
		// major 1
		if (combined_four_year_plans[0] != null) {
			for (obj of combined_four_year_plans[0][key]) {
				four_year_courses.push(obj);
			}
		}
		
		// major 1 is always added so if major count == 2 add 2nd major
		// if major count == 3 add 2nd and 3rd major

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

	// console.log(four_year_courses);
	// console.log(courses_taken);

	// find difference four_year_courses - courses_taken
	var recommended_courses = four_year_courses.filter(function (obj) {
		return !courses_taken.some(function (obj2) {
			return obj.subject == obj2.subject && obj.catalog == obj2.catalog;
		});
	});

	// remove extra char for courses like HIST 103b
	recommended_courses.forEach(obj => obj['catalog'] = obj['catalog'].slice(0, 3));

	// TODO feature for courses like HIST 10X

	// add to html datalist
	var text = "";
	var seperator = Array(4).fill(' ').join(''); //4 blank space
	recommended_courses.forEach(obj => text += `<option value="${obj.subject} ${obj.catalog} ${seperator} ${obj.title} ${seperator} ${obj.cred}">`)
	$('#recommended_courses').html(text);

	if (isForNewSchedule == true) {
			switch( true ) {
				case (recommended_courses.length >= 3):
					for (let i = 0; i < 3; i++) {
						var course = recommended_courses[i]["subject"] + " " + $.trim(recommended_courses[i]["catalog"]) + seperator + recommended_courses[i]["title"] + seperator + recommended_courses[i]["cred"];
						scheduleAddCourse(course, "MAJOR", true);
					}
					message('info', '<b>Alert:</b><br/> See recommendations below!');
					break;
				case (recommended_courses.length >= 2):
					for (let i = 0; i < 2; i++) {
						var course = recommended_courses[i]["subject"] + " " + $.trim(recommended_courses[i]["catalog"]) + seperator + recommended_courses[i]["title"] + seperator + recommended_courses[i]["cred"];
						scheduleAddCourse(course, "MAJOR", true);
					}
					message('info', '<b>Alert:</b><br/> See recommendations below!');
					break;
				case (recommended_courses.length == 1):
					var course = recommended_courses[0]["subject"] + " " + $.trim(recommended_courses[0]["catalog"]) + seperator + recommended_courses[0]["title"] + seperator + recommended_courses[0]["cred"];
					scheduleAddCourse(course, "MAJOR", true);
					message('info', '<b>Alert:</b><br/> See recommendation below!');
					break;
				case (recommended_courses.length == 0):
					break;
			}
	} else {
		return recommended_courses
	}

}
