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
</head>
<body>
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
            <input type="text" placeholder="Enter Student ID" name="s_id" id="s_id" required>
        </div>
        <br>
        <div class="input_field" style="grid-row-start: 3; grid-row-end: 4"> 
            <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
        </div>
        <br>
        <div class="input_field" style="grid-row-start: 4; grid-row-end: 5">
            <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
        </div>


        <button type="submit" class="registerbtn" style="grid-row-start: 5; grid-row-end: 6; margin: auto;">Register</button>
    </div>
    </form>
    <form>
    <div class="signin">
        <p>Already have an account? <a href="./">Sign in</a>.</p>
    </div>
    </form>
</body>
</html>