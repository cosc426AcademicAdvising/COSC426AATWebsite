// schedule new functions
function scheduleAddCourse(course, course_for, isRec) {
	if (course != "") {
		var course_attr = course.split(seperator);
		rmbutton = '<span class="close" onclick="removeCourse()">&times;</span>';
		// credit = parseFloat(course_attr[2]).toFixed(0);
		var credit = parseInt(course_attr[2])

		// setup html
		var text = "";
		if(isRec == true) {
			text = "<tr title='recommended course'><td>" + course_attr[0].toUpperCase() + "</td><td>" + course_attr[1].toUpperCase() + "</td><td>" + credit + "</td><td> " + course_for.toUpperCase() + " </td><td>" + rmbutton + "</td></tr>";
		} else {
			course_for_array = []
			for (box of $(".checkboxaddcourse")){
				if (box.checked)
					course_for_array.push(box.value);
			}
			text = "<tr><td>" + course_attr[0].toUpperCase() + "</td><td>" + course_attr[1].toUpperCase() + "</td><td>" + credit + "</td><td> " + course_for_array.join(", ") + " </td><td>" + rmbutton + "</td></tr>";
		}

		// get current courses present in tables
		var current_courses = [];
		var tabledata = $("#schedule-coursetable tbody").children().slice(1);
		var backup_tabledata = $("#schedule-backupcoursetable tbody").children().slice(1);
		for (let i = 0; i < tabledata.length; i++) {
			current_courses.push(tabledata[i].innerText.split("\t").slice(0, 4)[0]);
		}
		for (let i = 0; i < backup_tabledata.length; i++) {
			current_courses.push(backup_tabledata[i].innerText.split("\t").slice(0, 4)[0]);
		}

		// if course number is not in one of the tables, proceed
		if (current_courses.indexOf(course_attr[0]) == -1 ) {
			// for non-backup courses
			if (forBackup.value == "No") {
				// check that enrolled credits is not greater than 19
				if(parseInt($('#creditenrolled').val()) + credit >= 20) {
					alert("Enrolled credit limit exceeded! Course will be added to backup");
					//	display backup table if adding first time
					if ($('#schedule-backupcoursetable tbody').children().length == 1) {
						$('#schedule-backupcoursetable').toggle();
					}
					$('#schedule-backupcoursetable').append(text);

					$('#coursesearchsection :input[type="checkbox"]').prop('checked', false);
					$("#coursesearchsection :input[id='coursesearch']").val("");
					$("#coursesearch").focus();
					$('#forBackup').prop('selectedIndex', 0);
					return
				}
				$('#schedule-coursetable').append(text);
				// update enrolled credits
				$('#creditenrolled').val(parseInt($('#creditenrolled').val()) + credit);

			} else{
				//	display backup table if adding first time
				if ($('#schedule-backupcoursetable tbody').children().length == 1) {
					$('#schedule-backupcoursetable').toggle();
				}
				$('#schedule-backupcoursetable').append(text);
			}
		} else {
			alert("Cannot add the same course twice!");
		}

		$('#coursesearchsection :input[type="checkbox"]').prop('checked', false);
		$("#coursesearchsection :input[id='coursesearch']").val("");
		$("#coursesearch").focus();
		$('#forBackup').prop('selectedIndex', 0);
	}
	else {
		//error message empty input
		alert("empty field!");
	}
}

function removeCourse() {
	var td = event.target.parentNode;
	var tr = td.parentNode; // the row to be removed
	var t = tr.parentNode.parentNode;	// table

	if (t.id == 'schedule-coursetable') {
		// access credit column, split at the dot, then remove non-numeric char
		var rmcred = tr.children[2].outerHTML.split('.')[0].replace(/\D/g, '');

		console.log(rmcred, typeof rmcred);
		$('#creditenrolled').val($('#creditenrolled').val() - parseInt(rmcred));
	}

	tr.parentNode.removeChild(tr);

	// hide backup-course table since there is no data
	if (t.id == 'schedule-backupcoursetable' && $('#schedule-backupcoursetable tbody').children().length == 1) {
		$('#schedule-backupcoursetable').toggle();
	}
}

function saveDraft() {
	var courseTable = [];
	var backupCourseTable = [];

	var tabledata = $("#schedule-coursetable tbody").children().slice(1);	//slice(1) to remove table header row
	if( tabledata.length > 0 ) {
		for( let i=0; i<tabledata.length;i++ ) {
			courseTable.push(tabledata[i].innerText.split("\t").slice(0, 4));
			// slice (0,4) to exclude the remove button in each row
		}
	}

	var tabledata = $("#schedule-backupcoursetable tbody").children().slice(1);
	if (tabledata.length > 0) {
		for (let i = 0; i < tabledata.length; i++) {
			backupCourseTable.push(tabledata[i].innerText.split("\t").slice(0, 4));
		}
	}

	var draftObj = {
		name:studentname.value,
		s_id:studentid.value,
		registering_for: $('input[name="season"]:checked').val(),
		year:year.value,
		taking_course:courseTable,
		backup_course:backupCourseTable,
		memo:memo.value,
	}

	// create temporary form to send draft object
	$form = $('<form action="savedraft" method="POST"></form>')
	$form.append("<input type='submit' id='clickme' name='draft' value='" + JSON.stringify(draftObj) +"'>")
	$('body').append($form);
	$('#clickme').click();
}
