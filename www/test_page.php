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
	$link_DB = conect_DB();
	$result_query_SQL = querySelectFromDB('Work_table_1',$link_DB,"*",$text_query);

	for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) { 	//	Из полученного обьекта базы данных формируем АССОЦИАТИВНЫЙ массив 
		$arr_row[] = mysqli_fetch_assoc($result_query_SQL); 
		// if ($i>100) { break; }		// для тестов
		}

	foreach ($arr_row as $item) {


		echo "Min_deposit &nbsp; =>&nbsp;&nbsp;";
		var_dump($item['Min_deposit']);
			echo "<br>";
		echo "echoInterest_rate_in_value &nbsp; =>&nbsp;&nbsp;";
		var_dump($item['Interest_rate_in_value']);
			echo "<br>";
		echo "Period_of_payment_of_interest &nbsp; =>&nbsp;&nbsp;";
		var_dump($item['Period_of_payment_of_interest']);
			echo "<br>";
		echo "Min_term_of_deposit_value &nbsp; =>&nbsp;&nbsp;";
		var_dump($item['Min_term_of_deposit_value']);
			echo "<br>";
		echo "Min_term_of_deposit_units &nbsp; =>&nbsp;&nbsp;";
		var_dump($item['Min_term_of_deposit_units']);
			echo "<br>";

		echo "<br>==========<br>";


		if ($item['Min_deposit'] == '0' or $item['Min_deposit'] == '' or
			$item['Interest_rate_in_value'] == '0' or $item['Interest_rate_in_value'] == '' or
			$item['Min_term_of_deposit_value'] == '0' or $item['Min_term_of_deposit_value'] == '') {
				echo "000000000000<br>";
				echo "=====================================<br>";
				continue;	
				}

		$payback_period = 100 / ($item['Interest_rate_in_value'] / $item['Min_term_of_deposit_value']);
		$profit_for_the_whole_period = $item['Min_deposit'] * $item['Interest_rate_in_value'] / 100 - $item['Min_deposit'];
		$profit_per_day = $profit_for_the_whole_period / $item['Min_term_of_deposit_value'];
		$ROI = ($item['Min_deposit'] * $item['Interest_rate_in_value'] / 100 - $item['Min_deposit']) / $item['Min_deposit'] * 100;
		$profitability = $profit_for_the_whole_period / $item['Min_deposit'] * 100;
		$profitability_per_cent_per_year = $profit_for_the_whole_period / $item['Min_deposit'] * 365 / $item['Min_term_of_deposit_value'] * 100;

		echo "НЕ НУЛЬ =><br>";
		echo "payback_period &nbsp; = &nbsp;".$payback_period."<br>";
		echo "profit_for_the_whole_period &nbsp; = &nbsp;".$profit_for_the_whole_period."<br>";
		echo "profit_per_day &nbsp; = &nbsp;".$profit_per_day."<br>";
		echo "ROI &nbsp; = &nbsp;".$ROI."<br>";
		echo "profitability &nbsp; = &nbsp;".$profitability."<br>";
		echo "profitability_per_cent_per_year &nbsp; = &nbsp;".$profitability_per_cent_per_year."<br>";

		}



?>


</body>
</html>