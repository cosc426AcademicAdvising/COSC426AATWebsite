// schedule new functions
function scheduleAddCourse(course, prog) {
	if (course != "") {
		var val = course.split(seperator);
		rmbutton = '<span class="close" onclick="removeCourse()">&times;</span>';

		if (forBcourse.value == "No") { // for non-backup courses
			text = "<tr><td>" + val[0].toUpperCase() + "</td><td>" + val[1].toUpperCase() + "</td><td>" + parseFloat(val[2]).toFixed(0) + "</td><td> " + prog.toUpperCase() + " </td><td>" + rmbutton + "</td></tr>";
			$('#schedule-coursetable').append(text);

			// add credits
			$('#creditenrolled').val(parseInt($('#creditenrolled').val()) + parseInt(val[2]));
		}
		else {
			//	display table if adding first time
			if ($('#schedule-backupcoursetable tbody').children().length == 1) {
				$('#schedule-backupcoursetable').toggle();
			}
			text = "<tr><td>" + val[0].toUpperCase() + "</td><td>" + val[1].toUpperCase() + "</td><td>" + val[2] + "</td><td> " + prog.toUpperCase() + " </td><td>" + rmbutton + "</td></tr>";
			$('#schedule-backupcoursetable').append(text);
		}

		$("#coursesearchsection :input").val("");
		$("#coursesearch").focus();
		$('#forBcourse').prop('selectedIndex', 0);
	}
	else {
		//error messages
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
	console.log(draftObj);
}
