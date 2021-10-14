// schedule new functions
function scheduleAddCourse(course, prog) {

	// console.log(course.split(" - "));
	if (course != "") {
		var val = course.split(seperator)
		// rmbutton = '<button type="button" onclick="removeCourse()">Remove</botton>';
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
