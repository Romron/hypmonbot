<!DOCTYPE html>
<html>
<head>
	<title>TEST PAGE</title>
	<meta charset="utf-8">
	<meta description="Страница для тестов">

	<link href="css/table_css.css" rel="stylesheet">
	<?php 	include('funktions_hypmon.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>

</head>
<body>

<?php

	$name_table = "Crypto_test";
	$link_DB = conect_DB();

	querySortingFromDB($link_DB,$name_table,'Name','Frequency_Daily','DESC','0',1)



?>


</body>
</html>