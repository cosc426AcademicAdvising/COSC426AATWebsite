<html>
	<head>
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	</head>
	<?php
		include_once 'funcs/CourseFunctions.php';
		// $course = getCoursebyRegex("", "", "", "");
		echo '<script> var courselist = ' . json_encode( getCoursebyRegex("", "", "", ""))  . '; </script>'

	?>
	<body>
		<datalist id="data"></datalist>
		<input list="data" name="course" id="course">

		<script>
			console.log(courselist);
			var text = "";
			courselist.forEach( val => text += '<option value="'+ val["Subject"] + val["Catalog"]+ " " + val["Long Title"] + " " + val["Allowd Unt"] + '">');
			$('#data').html( text )
		</script>
	</body>
		<!-- {Allowd Unt: '3.00', Long Title: 'FEDERAL INCOME TAX ACCOUNTING: PERSONAL', Subject: 'ACCT', Catalog: ' 341'} -->
</html>
