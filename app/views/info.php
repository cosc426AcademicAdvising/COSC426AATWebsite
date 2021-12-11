<!DOCTYPE html>
<html lang="en">

<head>
	<title>Contact Info</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="public/css/nav.css">
	<link rel="stylesheet" href="public/css/info.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<link rel="icon" type="image/ico" href="public/img/favicon.ico">

	<?php
	ob_start();
	session_start();
	?>
</head>

<body>
	<?php
	include 'nav.php';
	$student = getStudent($_SESSION['username']);
	?>
	<div id="content">
		<div class="container">
			<div class='taking' id='taking'>
				<div class='taking_header'>
					<h3>Student Resources</h3>
				</div>
				<div class='table_area'>
					<table class='taking_table'>
						<thead>
							<tr>
								<th style="border-right: solid;">Service</th>
								<th>Location</th>
								<th style="border-left: solid;">Contact</th>
							</tr>
						</thead>
						<tr>
							<td id='serv'>General advising</td>
							<td id='loc'>Blackwell Hall</td>
							<td id='con'>410-546-4366</td>
						</tr>
						<tr>
							<td id='serv' style="background-color: #c9c9c9;">Office of the Registrar</td>
							<td id='loc' style="background-color: #c9c9c9;">Holloway Hall 120</td>
							<td id='con' style="background-color: #c9c9c9;">registrar@salisbury.edu</td>
						</tr>
						<tr>
							<td id='serv'>Department Contacts</td>
							<td id='loc'>Select School and Department for Relevant Contacts</td>
							<td id='con'><a href="www.salisbury.edu/academic-offices">Academic offices link</a></td>
						</tr>
						<tr>
							<td id='serv' style="background-color: #c9c9c9;">Center for Student Achievement</td>
							<td id='loc' style="background-color: #c9c9c9;">Academic Commons 270</td>
							<td id='con' style="background-color: #c9c9c9;">410-677-4865</td>
						</tr>
						<tr>
							<td id='serv'>Counseling Center</td>
							<td id='loc'>Guerrieri Student Union 263</td>
							<td id='con'>410-543-6070</td>
						</tr>
						<tr>
							<td id='serv' style="background-color: #c9c9c9;">Libraries</td>
							<td id='loc' style="background-color: #c9c9c9;">Guerreri Academic Commons</td>
							<td id='con' style="background-color: #c9c9c9;">410-543-6130/libraries@salisbury.edu</td>
						</tr>
						<tr>
							<td id='serv' style="border-bottom: none;">IT help desk</td>
							<td id='loc' style="border-bottom: none;">Academic Commons 145</td>
							<td id='con' style="border-bottom: none;">410-543-6070</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	</div> <!-- flexbox div ends -->

	<script>
		$('.contact-info-btn').css({
			"color": "#8a0000",
			"border-left-color": "#8a0000"
		});
	</script>
</body>

</html>
