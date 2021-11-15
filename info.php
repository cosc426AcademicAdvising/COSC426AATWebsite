<!DOCTYPE html>
<html>
<head>
	<title>Academic Planar</title>
	<meta charset="UTF-8">
	<!-- for caret -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="CSS/nav.css">
	<link rel="stylesheet" href="CSS/scheduleView.css">
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
		include_once 'funcs/StudentFunctions.php';
		$student = getStudent($_SESSION['username']);
	?>
		<div id="content">
			<div id="container">
				<div class='taking' id='taking'>
					<div class='taking_header'>
						<h3>Links and contact info</h3>
					</div>
					<div class='table_area'>
						<table class='taking_table'>
							<thead>
								<tr>
									<th style="border-radius: 10px 0px 0px 0px;">Service</th>
									<th>Location</th>
									<th style="border-radius: 0px 10px 0px 0px;">Number/email</th>
								</tr>
							</thead>
							<?php
								echo "<tr>";
								echo "<td>Academic Advisor</td>";
								echo "<td>*advisor office placeholder*</td>";
								echo "<td>".$student['advisor_mail']."</td>";
								echo "</tr>";
							?>
							<tr>
							<td>Office of the Registrar</td>
							<td>Holloway Hall 120</td>
							<td>registrar@salisbury.edu</td>
							</tr>
							<tr>
							<td>Department Contacts</td>
							<td>Select school and department for relevant contacts --></td>
							<td><a href="www.salisbury.edu/academic-offices">Academic offices link</a></td>
							</tr>
							<tr>
							<td>Center for Student Achievement</td>
							<td>Academic Commons 270</td>
							<td>410-677-4865</td>
							</tr>
							<tr>
							<td>Counseling Center</td>
							<td>Guerrieri Student Union 263</td>
							<td>410-543-6070</td>
							</tr>
							<tr>
							<td>Libraries</td>
							<td>Guerreri Academic Commons</td>
							<td>410-543-6130/libraries@salisbury.edu</td>
							</tr>
							<tr>
							<td>IT help desk</td>
							<td>Academic Commons 145</td>
							<td>410-543-6070</td>
							</tr>
						</table>		
					</div>
				</div>
			</div>
		</div>
</div> <!-- flexbox div ends -->

<script>
	$('.contact-info-btn').css({"color":"#8a0000","border-left-color":"#8a0000"});
</script>
</body>
</html>
