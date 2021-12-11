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
	<link rel="icon" type="image/ico" href="public/img/favicon.ico">

	<link rel="stylesheet" href="public/css/signup.css">
</head>
<?php
// require 'vendor/autoload.php';
// include_once 'funcs/StudentFunctions.php';
$msg = '';
if (isset($_POST['login'])) {
	if (!empty($_POST['username']) && !empty($_POST['password'])) {
		if ($_POST['password'] == $_POST['confirm password']) {
			$name = $_POST['name'];
			$s_id = $_POST['login'];
			$hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$enrdate = $_POST['enrolldate'];
			$res = createStudent($s_id, $hash, $name);
		} else {
			$msg = 'passwords do not match';
		}
	} else {
		$msg = 'incomplete info';
	}
}
?>

<body>
	<header>
		<h2>Salisbury University</h2>
	</header>

	<div id="block">
		<p>Enter User Info</p>

		<div class="container">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<div type="inputs">
					<input type="name" name="name" placeholder="Name" required autofocus><br>
					<input type="uname" name="username" placeholder="Student ID" required><br>
					<input type="password" name="password" placeholder="password" required><br>
					<input type="confirmpassword" name="confirmpassword" placeholder="confirm password" required><br>
					<input type="enrolldate" name="enrolldate" placeholder="Enrollment Date mm/dd/yyyy" required><br>
					<button type="submit" id="login" name="login">Sign up</button>
				</div>
			</form>
		</div>
	</div>

</body>

</html>
