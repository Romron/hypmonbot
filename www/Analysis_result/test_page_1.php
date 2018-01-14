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
		set_time_limit(0);
		$name_table = "Crypto_1";	//	Выбор таблицы в базе данных
		// $name_table = "Crypto_test";	//	Выбор таблицы в базе данных
		// $name_table = "Work_table_1";	//	Выбор таблицы в базе данных
		$link_DB = conect_DB();	
		$depth_of_search = 10;

		$main_field = 'id';
		$sorting_field = 'Capitalization';
		$sorting_direction = 'DESC';
		$limit_str = 10;

//---------------------------------------------------------------------------

// формирую запрос
    $query_1 = "SELECT * FROM `".$name_table."` 		
    			GROUP BY `".$main_field."`
    			ORDER BY `".$sorting_field."` ".$sorting_direction."
    			".$limit_str."";

// отправка запроса 
   	$result_query_SQL = mysqli_query($link_DB,$query_1);
    if (!$result_query_SQL) {
    	echo "<br><br><b><font color='red'>".__FUNCTION__."&nbsp; Query_1 failed : " . mysqli_error($link_DB)."</font></b>";	
    	exit();
    	}   

// оброботка ответа сервера
	for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) {
    	if ($i>20) { break; }	// для тестов
   		$result[] = mysqli_fetch_assoc($result_query_SQL);
    	}

// вывод результатов в виде таблицы
			echo "<table>";
				foreach ($result[0] as $key => $value) {
					if ($key == $sorting_field) {
						$th_str = '<th class="sorting">';
					}elseif ($key == $main_field){
						$th_str = '<th class="main_sorting">';
						}else{$th_str = '<th>';}					
					echo $th_str.$key."</th>";
					}
				for ($q=0; $q < count($result); $q++) { 
					echo "<tr>";
					foreach ($result[$q] as $key_2 => $value_2) {
						if (preg_match_all($patern_zero,$value_2,$result_zero,PREG_PATTERN_ORDER)) { // убираем незначущие нули после запятой
							$value_2 = str_replace($result_zero[1][0],"",$value_2);	
							$value_2 = $value_2.'0';
							}
						if ($key_2 == $sorting_field) {
							$td_str = '<td class="sorting">';
						}elseif ($key_2 == $main_field){
							$td_str = '<td class="main_sorting">';
							}else{$td_str = '<td>';}
						echo $td_str;
							echo $value_2;
						echo "</td>";
						$q_n++;
						}
					echo "</tr>";
					}
			echo "</table>";

 ?>

</body>


</html>



