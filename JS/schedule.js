// schedule new functions
function scheduleAddCourse(subj, ttl, cr, prog) {
	// console.log(subj, ttl, cr, typ);
	if (subj != "" && ttl != "" && cr != "") {
		rmbutton = '<button type="button" onclick="removeCourse()">Remove</botton>'
		text = "<tr><td>" + subj.toUpperCase() + "</td><td>" + ttl.toUpperCase() + "</td><td>" + cr + "</td><td> " + prog.toUpperCase() + " </td><td>" + rmbutton + "</td></tr>";
		$('#schedulecoursetable').append(text);
		$("#schedulecoursetable :input").val("");

		$("#schedulecoursenumb").focus();
	}
}

function removeCourse() {
	var td = event.target.parentNode;
	var tr = td.parentNode; // the row to be removed
	tr.parentNode.removeChild(tr);
}
