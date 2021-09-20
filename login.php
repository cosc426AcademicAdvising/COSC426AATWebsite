<html>
	<head>
		<link rel="stylesheet" href="login.css">
	</head>
	<body>
      <h2>Enter Username and Password</h2> 
      <div class = "container form-signin">
         
         <?php
			require 'vendor/autoload.php';
			include_once 'StudentFunctions.php';
            $msg = '';
			$stud = getStudent('1234123');
			$hash = $stud['passHash'];
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['username'] == '1234123' && 
                  password_verify($_POST['password'], $hash)) {
                  
                  $url='homepage.php';
		  echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
               }else {
                  $msg='Wrong username or password';
               }
            }
         ?>
      </div>
      
      <div class = "container">
      
         <form 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4>
		<?php echo $msg; ?>
	    </h4>
			<div type="inputs">
				<input type = "uname" name = "username" placeholder = "Student ID" required autofocus><br>
				<input type = "password" name = "password" placeholder = "password = passtest" required><br>
				<button type = "submit" name = "login">Log in</button>
			</div>
         </form>
      </div> 
      
   </body>
</html>