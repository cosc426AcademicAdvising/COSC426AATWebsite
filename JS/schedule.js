// schedule new functions
function scheduleAddCourse(course, prog) {

	// console.log(course.split(" - "));
	if (course != "") {
		var val = course.split(seperator);
		rmbutton = '<span class="close" onclick="removeCourse()">&times;</span>';
		text = "<tr><td>" + val[0].toUpperCase() + "</td><td>" + val[1].toUpperCase() + "</td><td>" + val[2] + "</td><td> " + prog.toUpperCase() + " </td><td>" + rmbutton + "</td></tr>";
		$('#schedulecoursetable').append(text);

		$('#creditenrolled').val( parseInt($('#creditenrolled').val()) + parseInt(val[2]) );
		
		$("#coursesearchsection :input").val("");
		$("#coursesearch").focus();
	}
}

function removeCourse() {
	var td = event.target.parentNode;
	var tr = td.parentNode; // the row to be removed

	// access credit column, split at the dot, then remove non-numeric char
	var rmcred = tr.children[2].outerHTML.split('.')[0].replace(/\D/g, '');

	console.log(rmcred, typeof rmcred);
	$('#creditenrolled').val( $('#creditenrolled').val() - parseInt(rmcred) );

	tr.parentNode.removeChild(tr);
}

function saveDraft() {
	var courseTable = [];
	var backupCourseTable = [];

	var tabledata = $("#schedulecoursetable tbody").children().slice(1);	//slice(1) to remove table header row
	if( tabledata.length > 0 ) {
		for( let i=0; i<tabledata.length;i++ ) {
			courseTable.push(tabledata[i].innerText.split("\t").slice(0, 4));
			// slice (0,4) to exclude remove button in each row
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
