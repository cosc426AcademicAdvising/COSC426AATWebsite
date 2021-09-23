$( document ).ready(function(){

	$('.schedule-btn').click(function () {
		$('nav ul .schedule-show').toggleClass("sch");
		$('nav ul .first').toggleClass("rotate");
	});
	$('.progress-btn').click(function () {
		$('nav ul .progress-show').toggleClass("prog");
		$('nav ul .second').toggleClass("rotate");
	});
	$('nav ul li').click(function () {
		$(this).addClass("active").siblings().removeClass("active");
	});

});

// schedule new functions
function scheduleAddCourse(subj, ttl, cr, prog) {
	// console.log(subj, ttl, cr, typ);
	if (subj != "" && ttl != "" && cr != "") {
		rmbutton = '<button type="button" onclick="removeCourse()">Remove</botton>'
		text = "<tr><td>" + subj.toUpperCase() + "</td><td>" + ttl.toUpperCase() + "</td><td>" + cr + "</td><td> " + prog.toUpperCase() + " </td><td>" + rmbutton +"</td></tr>";
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
