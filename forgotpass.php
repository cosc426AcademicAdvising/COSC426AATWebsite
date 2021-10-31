<!DOCTYPE html>
<html>
<?php
	ob_start();
	session_start();
  include_once "funcs/StudentFunctions.php"
?>
<head>
	<title>Academic Planar</title>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="CSS\login.css">
</head>

<body>
	<header>
		<h2>Salisbury University</h2>
	</header>

	<?php
		require 'vendor/autoload.php';
		include_once 'funcs/StudentFunctions.php';
		$msg = '';
		if (isset($_POST['login'])){
			$stud = getStudent($_POST['username']);
      if (strcmp($_POST['password'], $_POST['cpassword'])){
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $id = $stud['s_id'];
        newPass($id, $hash);
      }
		}
	?>

	<div id="block">
		<p>Enter Username and new password</p>

		<div class = "container form-signin">
		</div>

		<div class ="container">
			<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">
				<div type="inputs">
					<input type = "uname" name = "username" placeholder = "Student ID" required autofocus><br>
					<input type = "password" name = "password" placeholder = "password" required><br>
          <input type = "password" name = "cpassword" placeholder = "confirm password" required><br>
					<button type = "submit" id="login" name = "login">Log in</button>
				</div>
			</form>
		</div>

	</div>
	<h4 style="margin-top: 10px"> <?php echo $msg; ?> </h4>

</body>
</html>
