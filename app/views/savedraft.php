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

	$student = getStudent($_SESSION['username']);
	?>
</head>

<body>
	<?php
	include 'nav.php';
	?>

	<div id="content">

		<?php
		$text = $_POST['draft'];

		// delete old draft
		// deleteDraft($student['s_id']);

		// echo $text;
		global $token;
		$url = 'https://cosc426restapi.herokuapp.com/api/Draft/Submit/';
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
		 	header("Location: dashboard");
		 }
		?>

	</div>
	</div> <!-- flexbox div ends -->


	<!-- <script>
		$('nav ul .schedule-show').toggleClass("sch");
		$('nav ul .first').toggleClass("rotate");
		$('.schedule-view-btn').css({
			"color": "#8a0000",
			"border-left-color": "#8a0000"
		});
	</script> -->
</body>

</html>
