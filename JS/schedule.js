// schedule new functions
function scheduleAddCourse(course, prog) {
	if (course != "") {
		if (forBcourse.value == "No") { // for non-backup courses
			var val = course.split(seperator);
			rmbutton = '<span class="close" onclick="removeCourse()">&times;</span>';
			text = "<tr><td>" + val[0].toUpperCase() + "</td><td>" + val[1].toUpperCase() + "</td><td>" + val[2] + "</td><td> " + prog.toUpperCase() + " </td><td>" + rmbutton + "</td></tr>";
			$('#schedule-coursetable').append(text);

			$('#creditenrolled').val(parseInt($('#creditenrolled').val()) + parseInt(val[2]));
		}
		else {
			var val = course.split(seperator);
			rmbutton = '<span class="close" onclick="removeCourse()">&times;</span>';
			text = "<tr><td>" + val[0].toUpperCase() + "</td><td>" + val[1].toUpperCase() + "</td><td>" + val[2] + "</td><td> " + prog.toUpperCase() + " </td><td>" + rmbutton + "</td></tr>";
			$('#schedule-backupcoursetable').append(text);
		}

		$("#coursesearchsection :input").val("");
		$("#coursesearch").focus();
		$('#forBcourse').prop('selectedIndex', 0);
	}
	else {
		//error message
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
}

function saveDraft() {
	var courseTable = [];
	var backupCourseTable = [];

	var tabledata = $("#schedule-coursetable tbody").children().slice(1);	//slice(1) to remove table header row
	if( tabledata.length > 0 ) {
		for( let i=0; i<tabledata.length;i++ ) {
			courseTable.push(tabledata[i].innerText.split("\t").slice(0, 4));
			// slice (0,4) to exclude remove button in each row
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
	}
	console.log(draftObj);
}
