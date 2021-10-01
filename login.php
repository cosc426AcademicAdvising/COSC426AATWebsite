<!DOCTYPE html>
<html>
<?php
	ob_start();
	session_start();
?>	
<head>
	<title>Academic Planner</title>
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
			$hash = $stud['passHash'];
			if (!empty($_POST['username']) && !empty($_POST['password'])) {
				if (password_verify($_POST['password'], $hash)) {
					$_SESSION['valid'] = true;
					$_SESSION['username'] = $stud['s_id'];
					$url='dashboard.php';
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
			<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">
				<div type="inputs">
					<input type = "uname" name = "username" placeholder = "Student ID" required autofocus><br>
					<input type = "password" name = "password" placeholder = "password" required><br>
					<button type = "submit" id="login" name = "login">Log in</button>
				</div>
			</form>
		</div>

	</div>
	<h4 style="margin-top: 10px"> <?php echo $msg; ?> </h4> 
	
</body>
</html>
