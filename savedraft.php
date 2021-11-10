<!DOCTYPE html>
<html>
<head>
	<title>Academic Planar</title>
	<meta charset="UTF-8">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="CSS/nav.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

	<?php
		ob_start();
		session_start();
		require 'vendor/autoload.php';
	?>
</head>

<body>
	<?php
		include 'nav.php';
	?>

		<div id="content">
			
		</div>
</div> <!-- flexbox div ends -->

<script>
	if (xhr.readyState == 4) {
		if (xhr.status == 200) {
			console.log("Post request received", xhr.responseText);
		}
	}
</script>

<script>
	$('nav ul .schedule-show').toggleClass("sch");
	$('nav ul .first').toggleClass("rotate");
	$('.schedule-view-btn').css({"color":"#8a0000","border-left-color":"#8a0000"});
</script>
</body>
</html>
