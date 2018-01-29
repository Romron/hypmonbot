<!DOCTYPE html>
<html>
<head>
	<title>TEST_PAGE_1</title>
	<meta charset="utf-8">
	<meta description="Главная страница">

	<link href="css/analysis_css_test_1.css" rel="stylesheet">
	<?php 	require_once('funktions_hypmon.php');	?>
	<?php 	require_once('funktions_analysis.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>

</head>
<body>

<?php 
	$link_DB = conect_DB();
	$name_table = "Crypto_1";

	$result_1 = querySortingFromDB_1($link_DB,$name_table,'Name','Capitalization','DESC',2);
	mysqli_close($link_DB);
	$link_DB = conect_DB();
	$result_2 = querySortingFromDB_1($link_DB,$name_table,'Name','Capitalization','DESC',2);
	mysqli_close($link_DB);
		echo "<br> 1. ----------------------------------------------------------------------<br>";
		echo Build_tree_arr($result_1);		
		echo "<br> 2. ----------------------------------------------------------------------<br>";
		echo Build_tree_arr($result_2);
 ?>

</body>


</html>



