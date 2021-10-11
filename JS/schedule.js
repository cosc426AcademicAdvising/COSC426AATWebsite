// schedule new functions
function scheduleAddCourse(course, prog) {

	// console.log(course.split(" - "));
	if (course != "") {
		var val = course.split(seperator)
		// rmbutton = '<button type="button" onclick="removeCourse()">Remove</botton>';
		rmbutton = '<span class="close" onclick="removeCourse()">&times;</span>';
		text = "<tr><td>" + val[0].toUpperCase() + "</td><td>" + val[1].toUpperCase() + "</td><td>" + val[2] + "</td><td> " + prog.toUpperCase() + " </td><td>" + rmbutton + "</td></tr>";
		$('#schedulecoursetable').append(text);
		
		$("#coursesearchsection :input").val("");
		$("#coursesearch").focus();
	}
}

function removeCourse() {
	var td = event.target.parentNode;
	var tr = td.parentNode; // the row to be removed
	tr.parentNode.removeChild(tr);
}
