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
	

	$Arr_Fin_Param_Hyp = ParsFinParamHyp("coinsipo.com");

	$Arr_Fin_Param_Hyp[1] = str_replace(",",".",$Arr_Fin_Param_Hyp[1]);

	echo Build_tree_arr($Arr_Fin_Param_Hyp);

	$patern_hour = '#hour#i';
	if (preg_match($patern_hour,$Arr_Fin_Param_Hyp[2])) {
		$Arr_Fin_Param_Hyp[1] = $Arr_Fin_Param_Hyp[1]*24;
		echo "<br><br><br>##############################<br><br><br>";
		}



	echo "<br>-----------------------------------<br>";

	$CalcFinParamHyp = CalcFinParamHyp($Arr_Fin_Param_Hyp);
	echo Build_tree_arr($CalcFinParamHyp);

	echo "<br>----------------<br>";
	
	$profit_per_day = round(($Arr_Fin_Param_Hyp[1]/100*$Arr_Fin_Param_Hyp[0]),4);
	$SO = round(($Arr_Fin_Param_Hyp[0]/$profit_per_day),4);
	$profit_for_the_whole_period = round(($profit_per_day * $Arr_Fin_Param_Hyp[3]),4);
	$ROI = round((($profit_for_the_whole_period - $Arr_Fin_Param_Hyp[0]) * 0.01),4);
	$profitability = round(($profit_for_the_whole_period / $Arr_Fin_Param_Hyp[0] / 0.01),4);
	$profitability_per_cent_per_year = round(($profit_for_the_whole_period / $Arr_Fin_Param_Hyp[0] * 365 / $Arr_Fin_Param_Hyp[3] / 0.01),4);

	echo "<br> Срок окупаемости &nbsp; = &nbsp;";
	var_dump($SO);	
	echo "<br> Прибыль за весь периуд &nbsp; = &nbsp;";
	var_dump($profit_for_the_whole_period);
	echo "<br>Прибыль в день &nbsp; = &nbsp;";
	var_dump($profit_per_day);
	echo "<br> ROI &nbsp; = &nbsp;";
	var_dump($ROI);
	echo "<br> Доходность &nbsp; = &nbsp;";
	var_dump($profitability);
	echo "<br> Доходность в годовых &nbsp; = &nbsp;";
	var_dump($profitability_per_cent_per_year);


?>


</body>
</html>