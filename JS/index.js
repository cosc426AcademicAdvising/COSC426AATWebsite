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
function scheduleAddCourse(subj, ttl, cr, typ) {
	// console.log(subj, ttl, cr, typ);
	if (subj != "" && ttl != "" && cr != "") {
		// but = '<button type="button" onclick="">Delete</botton>'
		text = "<tr><th>" + subj + "</th><th>" + ttl + "</th><th>" + cr + "</th><th>" + typ 
			+ "</th><th><button type='button' onclick=''>Remove</button></th></tr>";
		$('#schedulecoursetable').append(text);
		$("#schedulecoursetable :input").val("");
	}
}
