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

	// echo 2*2;
	// echo "<br>";
	// echo 6/2;

	// echo "<br>-----------------------------------<br>";
	

	$FinParamHyp = ParsFinParamHyp("coinsipo.com");
	echo Build_tree_arr($FinParamHyp);

		foreach ($FinParamHyp as $key => $value) {
			// settype($value, float);
			echo "<br>*";
			var_dump($value);
		}


	echo "<br>-----------------------------------<br>";

	$CalcFinParamHyp = CalcFinParamHyp($FinParamHyp);
	echo Build_tree_arr($CalcFinParamHyp);

	echo "<br>----------------<br>";
	$PP = round(($FinParamHyp[1]/100*$FinParamHyp[0]),4);
	var_dump($PP);
	echo "<br>";
	$SO = $FinParamHyp[0]/$PP;
	var_dump($SO);

?>


</body>
</html>