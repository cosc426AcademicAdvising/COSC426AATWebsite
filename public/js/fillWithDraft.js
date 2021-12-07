function fill_with_draft() {
	// add main courses
	for(i in student_draft['taking_course']){
		var course = student_draft['taking_course'][i]['subject'] + " " + student_draft['taking_course'][i]['catalog'] + seperator + student_draft['taking_course'][i]['title'] + seperator + student_draft['taking_course'][i]['cred'];
		scheduleAddCourse(course, String(student_draft['taking_course'][i]['genED']), false);
	}

	// add backup
	if (student_draft['backup_course'].length != 0){
		for (i in student_draft['backup_course'] ){
			var course = student_draft['backup_course'][i]['subject'] + " " + student_draft['backup_course'][i]['catalog'] + seperator + student_draft['backup_course'][i]['title'] + seperator + student_draft['backup_course'][i]['cred'];
			// because we do pass a variable to determine is course is backup
			// we have to set is a backup-course to Yes
			// scheduleAddCourse() will reset it to original value after addition
			$('#forBackup').prop('selectedIndex', 1);
			scheduleAddCourse(course, String(student_draft['backup_course'][i]['genED']), false);
		}
	}

}
