<!DOCTYPE html>
<html lang="en">
<?php
	ob_start();
	session_start();
?>
<head>
	<title>Academic Planar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="public/css/newUser.css">

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <?php
    // include_once 'funcs/DepartmentFunctions.php';

	echo '<script> var available_minors = ' . json_encode(getMinors())  . '; </script>';
    echo '<script> var available_majors = ' . json_encode(getMajors())  . '; </script>';

    ?>

</head>
<body>
    <datalist id="available_minors"></datalist>
    <datalist id="available_majors"></datalist>

    <script>

		available_majors.sort(function(a, b) {
			if (a["Acad Plan"] > b["Acad Plan"]) {
				return 1;
			} else 
				return -1;
			
		});
        
        available_minors.sort(function(a, b) {
			if (a["Acad Plan"] > b["Acad Plan"]) {
				return 1;
			} else 
				return -1;
			
		});

		var text = "";
		available_majors.forEach(val => text += '<option value="' + val["Acad Plan"]  + '">');
		$('#available_majors').html(text);

        var text = "";
		available_minors.forEach(val => text += '<option value="' + val["Acad Plan"]  + '">');
		$('#available_minors').html(text);
	</script>

    <header>
		<h2>Salisbury University</h2>
	</header>
    <form action="firsttime" method="post">
    <div class="container">
        <div class="title">
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
        </div>
        <div class="input_field" style="grid-row-start: 2; grid-row-end: 3">
            <input type="text" placeholder="Enter First and Last Name" name="name" id="name" required>
        </div>
        <div class="input_field" style="grid-row-start: 3; grid-row-end: 4">
            <input type="text" placeholder="Enter Student ID" name="s_id" id="s_id" required>
        </div>
        <br>
        <div class="input_field" style="grid-row-start: 4; grid-row-end: 5"> 
            <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
        </div>
        <br>
        <div class="input_field" style="grid-row-start: 5; grid-row-end: 6">
            <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
        </div>
        <div class="enc_major">
            <div class="major">
                <label for="major">Search for a Major <br>
                    <font size="1">enter an abbreviation</font>
                </label><br>
                <input list="available_majors" id="majorsearch" class="majorsearch" name="majorsearch">
                <button type="button" class="add_major" onclick='addMajor()'>Add</button>
            </div>
            <div class="m_vals">
                <table id="major_tbl">
                    <thead>
                        <tr>
                            <th>Majors</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="enc_minor">
            <div class="minor">
                <label for="minor">Search for a Minor <br>
                    <font size="1">enter an abbreviation</font>
                </label><br>
                <input list="available_minors" id="minorsearch" class="minorsearch" name="minorsearch">
                <button type="button" class="add_minor" onclick='addMinor()'>Add</button>
            </div>
            <div class="m_vals">
                <table id="minor_tbl">
                    <thead>
                        <tr>
                            <th>Minors</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="submit_btn">
            <button type="submit" class="registerbtn">Register</button>
        </div>
    </div>
    </form>
    <form>
    <div class="signin">
        <p>Already have an account? <a href="./">Sign in</a>.</p>
    </div>
    </form>

    <script src="public/js/firstTimeFuncs.js"></script>

</body>
</html>