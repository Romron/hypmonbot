<!DOCTYPE html>
<html>
<head>
	<title>TEST PAGE</title>
	<meta charset="utf-8">
	<meta description="Главная таблица монитора">

	<link href="css/table_css.css" rel="stylesheet">
	<?php 	include('funktions_hypmon.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>

</head>
<body>

<?php

	

	$FinParamHyp = ParsFinParamHyp("cryptoosa.com");
	echo Build_tree_arr($FinParamHyp);
	

	$CalcFinParamHyp = CalcFinParamHyp($FinParamHyp);
	echo Build_tree_arr($CalcFinParamHyp);



?>


</body>
</html>