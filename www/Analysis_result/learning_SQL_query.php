<!DOCTYPE html>
<html>
<head>
	<title>Learning_SQL_query</title>
	<meta charset="utf-8">
	<meta description="Главная страница">

	<!-- <link href="css/learning_SQL_css_.css" rel="stylesheet"> -->
	<?php 	require_once('funktions_hypmon.php');	?>
	<?php 	require_once('funktions_analysis.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>
	<style> 
		table, td{
			border: 1px solid black;
			border-collapse: collapse;
			 text-align: center;
			 font-size: 13px;
		}

		th{
			border: 2px solid black;
		}
	</style>

</head>
<body>

<?php 
		set_time_limit(0);

	$time_0 = time();
	$arr_ini = ini_get_all();		// для определения объёма памяти выделенного скрипту, а также всех прочих настроек
	echo "Начало работы скрипта &nbsp - &nbsp".date("d.m.y H:i:s",$time_0);
		echo "<br>******";
		echo "<br> Установлено максимальное время выполнения скрипта &nbsp-&nbsp".ini_get('max_execution_time')."&nbsp сек.";
		echo "<br> Объём оперативной память выделенный скрипту &nbsp-&nbsp &nbsp".$arr_ini[memory_limit][global_value];
		echo "<br> Объём оперативной память занимаемый скриптом &nbsp-&nbsp".round((memory_get_usage()/1000000),2)."M";
		echo "<br>******";

	$name_table = "Crypto_1";	//	Выбор таблицы в базе данных
	// $name_table = "Crypto_test";	//	Выбор таблицы в базе данных
	// $name_table = "Work_table_1";	//	Выбор таблицы в базе данных
	$link_DB = conect_DB();	
	$depth_of_search = 10;
	$patern_zero = '~\.\d*[1-9]?(0*)(?<=$)~U';	// убираем лишние нули

	$main_field = 'id';
	$sorting_field = 'Capitalization';
	$sorting_direction = 'DESC';
	$limit_str = 'LIMIT 10';

//---------------------------------------------------------------------------

// формирую запрос
    // $query_1 = "SELECT * FROM `".$name_table."` 		
    // 			GROUP BY `".$main_field."`
    // 			ORDER BY `".$sorting_field."` ".$sorting_direction."
    // 			".$limit_str."";    

    // $query_1 = "SELECT * FROM `".$name_table."` 		
    // 			GROUP BY Name, Frequency_1
    // 			ORDER BY Frequency_1 DESC
    // 			LIMIT 2000
    // 			";


    // $query_1 = "CREATE TABLE `temp_test` LIKE `Crypto_test`";
    // $query_1 = "INSERT INTO `temp_test` SELECT * FROM `Crypto_test` GROUP BY `Name` ORDER BY `Name` DESC LIMIT 10;";
    $query_1 = "CALL GrupAndSort('10','DESC','Capitalization','Name','Crypto_1')";




//---------------------------------------------------------------------------
echo "<br>".$query_1;
echo "<br>=========================================<br>";


/*
// отправка запроса 
   	$result_query_SQL = mysqli_multi_query($link_DB,$query_1);
    if (!$result_query_SQL) {
    	echo "<br><br><b><font color='red'>".__FUNCTION__."&nbsp; Query_1 failed : " . mysqli_error($link_DB)."</font></b>";	
    	exit();
    	}   

// оброботка ответа сервера
	for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) {
    	// if ($i>200) { break; }	// для тестов
   		$result[] = mysqli_fetch_assoc($result_query_SQL);
    	}

*/

/* запускаем мультизапрос */
if (mysqli_multi_query($link_DB, $query_1)) {
    do {
        /* получаем первый результирующий набор */
        if ($result = mysqli_store_result($link_DB)) {
            while ($row = mysqli_fetch_row($result)) {
                printf("%s\n", $row[0]);
            }
            mysqli_free_result($result);
        }
        /* печатаем разделитель */
        if (mysqli_more_results($link)) {
            printf("-----------------\n");
        }
    } while (mysqli_next_result($link));
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

	$time_1 = time();
	$time = $time_1 - $time_0;
	echo "<br>=========================================";
	echo "<br> Конец работы скрипта &nbsp - &nbsp".date("d.m.y H:i:s",$time_1);			
	echo "<br> Время работы скрипта &nbsp - &nbsp".date("i:s",$time)."<br><br>";	
 ?>

</body>


</html>



