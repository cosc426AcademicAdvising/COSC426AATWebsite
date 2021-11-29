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

	<link rel="stylesheet" href="public/css/login.css">
</head>

<body>
	<header>
		<h2>Salisbury University</h2>
	</header>

	<?php
		// redict user to dashboard if session still present
		if (!empty($_SESSION)) {
			header("Location: dashboard");
		}
		// require 'vendor/autoload.php';
		// include_once 'funcs/StudentFunctions.php';
		$msg = '';
		if (isset($_POST['login'])){
			$stud = getStudent($_POST['username']);
			$hash = $stud['passHash'];
			if (!empty($_POST['username']) && !empty($_POST['password'])) {
				if (password_verify($_POST['password'], $hash)) {
					$_SESSION['valid'] = true;
					$_SESSION['username'] = $stud['s_id'];
					$url='dashboard';
					echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
				}else {
					$msg='Wrong username or password!';
				}
			}
		}
	?>

	<div id="block">
	<p>Enter Username and Password</p>

	<div class = "container form-signin">
	</div>

	<div class ="container">
			<div type="inputs">
				<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">
					<input type = "uname" name = "username" placeholder = "Student ID" required autofocus><br>
					<input type = "password" name = "password" placeholder = "password" required><br>
					<button type = "submit" id="login" name = "login" style="margin-bottom: 20px;">Log In</button>
				</form>
				<hr>
				<form action="newUser" method="post">
					<label for="SignUp" style="margin-top: 5px;">New User?</label><br>
					<button type = "submit" style="margin-top: 10px;" id="SignUp" name = "SignUp">Sign Up</button>
				</form>
			</div>
		
	</div>

	</div>
	<h4 style="margin-top: 10px"> <?php echo $msg; ?> </h4>

</body>
</html>
