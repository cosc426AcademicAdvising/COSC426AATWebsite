// schedule new functions
function scheduleAddCourse(course, prog, isRec) {
	if (course != "") {
		var val = course.split(seperator);
		rmbutton = '<span class="close" onclick="removeCourse()">&times;</span>';
		credit = parseFloat(val[2]).toFixed(0);
		if(isRec == true) {
			text = "<tr title='recommened course'><td>" + val[0].toUpperCase() + "</td><td>" + val[1].toUpperCase() + "</td><td>" + credit + "</td><td> " + prog.toUpperCase() + " </td><td>" + rmbutton + "</td></tr>";
		} else {
			ctype = []
			for (box of $(".checkboxaddcourse")){
				if (box.checked)
					ctype.push(box.value);
			}
			text = "<tr><td>" + val[0].toUpperCase() + "</td><td>" + val[1].toUpperCase() + "</td><td>" + credit + "</td><td> " + ctype.join(", ") + " </td><td>" + rmbutton + "</td></tr>";
		}

		var current = [];
		var tabledata = $("#schedule-coursetable tbody").children().slice(1);
		var btabledata = $("#schedule-backupcoursetable tbody").children().slice(1);
		for (let i = 0; i < tabledata.length; i++) {
			current.push(tabledata[i].innerText.split("\t").slice(0, 4)[0]);
		}
		for (let i = 0; i < btabledata.length; i++) {
			current.push(btabledata[i].innerText.split("\t").slice(0, 4)[0]);
		}
		// 																	TODO implement max credit limit to 19
		if (current.indexOf(val[0]) == -1 ) {
			if (forBcourse.value == "No") { // for non-backup courses
				$('#schedule-coursetable').append(text);
				// add credits
				$('#creditenrolled').val(parseInt($('#creditenrolled').val()) + parseInt(val[2]));

			} else{
				//	display table if adding first time
				if ($('#schedule-backupcoursetable tbody').children().length == 1) {
					$('#schedule-backupcoursetable').toggle();
				}
				$('#schedule-backupcoursetable').append(text);
			}
		} else {
			// error message dup course
			alert("Cannot add the same course twice!");
		}

		$('#coursesearchsection :input[type="checkbox"]').prop('checked', false);
		$("#coursesearchsection :input[id='coursesearch']").val("");
		$("#coursesearch").focus();
		$('#forBcourse').prop('selectedIndex', 0);
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
	// console.log("Saved draft", draftObj)

	$form = $('<form action="savedraft.php" method="POST"></form>')
	$form.append("<input type='submit' id='clickme' name='draft' value='" + JSON.stringify(draftObj) +"'>")
	$('body').append($form);
	$('#clickme').click();

	// window.location.replace("https://cosc426website.herokuapp.com/savedraft.php");
	//'https://cosc426website.herokuapp.com/savedraft.php'

	// const url='https://cosc426restapi.herokuapp.com/api/Update/SubmitForm/';

	// fetch(url, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: draftObj})
	// 	.then(results => results.json())
	// 	.then(console.log)


	// var xhr = new XMLHttpRequest();
	// xhr.open("POST", url);

	// xhr.setRequestHeader("Access-Control-Allow-Origin", '*');
	// xhr.setRequestHeader("Accept", "application/json");
	// xhr.setRequestHeader("Content-Type", "application/json");
	
	
	// xhr.onreadystatechange = function () {
	//    if (xhr.readyState == 4 && http.status == 200) {
	// 	  console.log(xhr.status);
	// 	  console.log(xhr.responseText);
	//    }};
	
	// xhr.send(draftObj);
}
