function addMajor() {
    rmbutton = '<span class="close" onclick="removeBtn()">&times;</span>';
    var maj = $("#majorsearch").val();
    var cnt = $("#major_tbl tr").length;
    if(cnt <= 4){
        $("#major_tbl").append("<tr><td><input type='text' name='major[]' value='" + maj + "'readonly/></td><td>" + rmbutton + "</td></tr>");
        $("#majorsearch").val('');
    }
    else {
        alert("Cannot have more than 3 majors.");
    }
  }

  function addMinor() {
    rmbutton = '<span class="close" onclick="removeBtn()">&times;</span>';
    var min = $("#minorsearch").val();
    var cnt = $("#minor_tbl tr").length;
    if(cnt <= 4){
        $("#minor_tbl").append("<tr><td><input type='text' name='minor[]' value='" + min + "'readonly/></td><td>" + rmbutton + "</td></tr>");
        $("#minorsearch").val('');
    }
    else {
        alert("Cannot have more than 3 majors.");
    }
  }

  function removeBtn() {
	var td = event.target.parentNode;
	var tr = td.parentNode; // the row to be removed
	var t = tr.parentNode.parentNode;	// table

	tr.parentNode.removeChild(tr);
}