function addMajor() {
    rmbutton = '<span class="close" onclick="removeBtn()">&times;</span>';
    var maj = $("#majorsearch").val();
    var cnt = $("#major_tbl tr").length;
    var duplicate = false;
    
    if(cnt > 2)
        for (let i = 2; i < cnt; i++) {
            var field = "maj_tbl_val" + i;
            console.log(field + "HAHAHA");
            table = document.getElementById(field).value;
            if(table === maj)
                duplicate = true;
        }
    if(cnt <= 4){
        if(!duplicate){
            var field = "maj_tbl_val" + cnt;
            $("#major_tbl").append("<tr><td><input class='majmin_tbl' id='" + field + "' type='text' name='major[]' value='" + maj + "'readonly/></td><td>" + rmbutton + "</td></tr>");
            $("#majorsearch").val('');
        }
        else {
            alert("Cannot add same major twice.");
        }
    }
    else {
        alert("Cannot have more than 3 majors.");
    }
  }

  function addMinor() {
    rmbutton = '<span class="close" onclick="removeBtn()">&times;</span>';
    var min = $("#minorsearch").val();
    var cnt = $("#minor_tbl tr").length;
    var duplicate = false;
    
    if(cnt > 2)
        for (let i = 2; i < cnt; i++) {
            var field = "min_tbl_val" + i;
            table = document.getElementById(field).value;
            if(table === min)
                duplicate = true;
        }
    if(cnt <= 4){
        if(!duplicate){
            var field = "min_tbl_val" + cnt;
            $("#minor_tbl").append("<tr><td><input class='majmin_tbl' id='" + field + "' type='text' name='minor[]' value='" + min + "'readonly/></td><td>" + rmbutton + "</td></tr>");
            $("#minorsearch").val('');
        }
        else {
            alert("Cannot add same minor twice.");
        }
    }
    else {
        alert("Cannot have more than 3 minors.");
    }
  }

  function removeBtn() {
	var td = event.target.parentNode;
	var tr = td.parentNode; // the row to be removed
	var t = tr.parentNode.parentNode;	// table

	tr.parentNode.removeChild(tr);
}