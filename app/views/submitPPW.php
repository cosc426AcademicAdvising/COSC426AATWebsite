<!DOCTYPE html>
<html lang="en">

<head>
	<title>Academic Planar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="public/css/nav.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<?php
	ob_start();
	session_start();
	// require 'vendor/autoload.php';
	$student = getStudent($_SESSION['username']);
	?>
</head>

<body>
	<?php
	include 'nav.php';
	?>

	<div id="content">

		<?php
		$text = $_POST['PPW'];

		global $token;
		$url = 'https://cosc426restapi.herokuapp.com/api/Update/SubmitForm/';
		$data = array('form' => $text);
		// use key 'http' even if you send the request to https://...
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/json",
				'method'  => 'POST',
				'content' => json_encode($data)
			)
		);

		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		if ($result === FALSE) { 
			/* Handle error */
		} elseif ($result == 1) {
			// delete draft
			$url = 'https://cosc426restapi.herokuapp.com/api/Draft/Delete/' . strval($student['s_id']);
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/json",
					'method'  => 'GET'
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			
			// email notif	- need to setup SMTP with heroku email
			// $to = "florentdondjeu@yahoo.com";	// advising email
			// $subject = "Notification: Program Planning Submittion";
			
			// $message = "The following student: " . $student['name'] . ". SID: " . $student['s_id'];
			// $message .=	"\nhas completed their program planning worksheet, which is now availble for viewing in the python application!";
			// $message = wordwrap($message, 70);

			// $server_mail = "florentdondjeu@gmail.com";
			// $headers = array(
			// 	'From' => $server_mail,
			// 	'Reply-To' => $server_mail
			// );

			// $success = mail($to, $subject, $message, $headers);
			// if (!$success) {
			// 	// echo $errorMessage = error_get_last()['message'];
			// 	echo "<script>console.log('Error: Submit PPW - email not sent!')</script>";
			// } else {
			// 	echo "email sent!";
			// 	echo "<script>console.log('Success: Submit PPW - email sent.')</script>";
			// }
			header("Location: dashboard?success=2");
		}
		?>

	</div>
	</div> <!-- flexbox div ends -->

</body>

</html>
