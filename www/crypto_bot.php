<!DOCTYPE html>
<html>
<head>
	<title>CRYPTO TABLE</title>
	<meta charset="utf-8">
	<meta description="Главная таблица CRYPTO">

	<link href="css/table_css.css" rel="stylesheet">
	<?php 	include('funktions_hypmon.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>
	<!-- <script src="js/funktions.js"></script> -->
	<script src="js/FixHeaderCol.js"></script>

	<script type="text/javascript">
	  function digitalWatch() {
	    var date = new Date();
	    var hours = date.getHours();
	    var minutes = date.getMinutes();
	    var seconds = date.getSeconds();
	    if (hours < 10) hours = "0" + hours;
	    if (minutes < 10) minutes = "0" + minutes;
	    if (seconds < 10) seconds = "0" + seconds;
	    document.getElementById("digital_watch").innerHTML = hours + ":" + minutes + ":" + seconds;
	    setTimeout("digitalWatch()", 1000);
	  }

	</script>
</head>
<body>

	<!-- Блок кнопок -->
		<!-- хочу на javascript -->
	<!-- /Блок кнопок -->  

	<!-- Шапка таблицы --> 
		<!-- хочу на javascript -->

		<table>
			<thead> 
				<tr>
					<td> № п/п </td>
					<td> Дата </td>
					<td> Название </td>
					<td> Капитализация </td>
					<td> Курс </td>
					<td> Частотность </td>
					<td> ... </td>
				</tr>
			</thead>
			<tbody>
	<!-- /Шапка таблицы -->

	

<?php  

	ignore_user_abort(true);	// Игнорирует отключение пользователя 
	set_time_limit(0);			// позволяет скрипту быть запущенным постоянно

	// ini_set ('max_execution_time',1800);	//	время выполнения скрипта не более 30 мин
	$arr_ini = ini_get_all();
	// ini_set('display_errors', TRUE);
	// ini_set('display_startup_errors', TRUE);
	echo "Начало работы скрипта &nbsp - &nbsp".date("d.m.y H:i:s",time());
		echo "<br>******";
	echo "<br> Установлено максимальное время выполнения скрипта &nbsp-&nbsp".ini_get('max_execution_time')."&nbsp сек.";
	echo "<br> Объём оперативной память выделенный скрипту &nbsp-&nbsp &nbsp".$arr_ini[memory_limit][global_value];
	echo "<br> Объём оперативной память занимаемый скриптом &nbsp-&nbsp".round((memory_get_usage()/1000000),2)."M";
		echo "<br>******";






	$name_table = "Crypto_1";
	$link_DB = conect_DB();
	$result = array();
	$number_in_order = 0;

	$str_0 = "https://prostocoin.com/marketcap&page=";
	$str_1 = "https://online.seranking.com/research.keyword.html?source=us&filter=keyword&input=";
	
	// $str_2 = "https://serpstat.com/keywords/?query=";
	// $str_2_1 = "&ff=1&search_type=subdomains&se=g_ua";
	
	
	$patern_0 = '#<tr>\n*.*\n.*<td.*>(.*)<\/a>.*\n.*<td>\$(.*)<\/td>.*\n.*<td>\$(.*)<\/td>#'; 		//	название валюты 
	$patern_1 = '#>Частотность.*\n.*\n.*\n.*\n.*\n.*\n.*\n.*<a\sclass="text-black">(.*)<\/a>#'; 		//	частотность в поиске 
	// $patern_2 = '#<div class="dtc">\n.*>(.*)<\/div>#'; 		//	частотность в поиске 
	// $patern_2_1 = '#class="card_stat">\n.*\n.*<div.*>(.*)<\/div>#'; 		//	количество страниц
	
	for ($i=1; $i < 13 ; $i++) { 	// рабочий вариант
	// for ($i=1; $i < 2 ; $i++) {	// для тестов
		$url_0 = $str_0.$i;
		$page_0 = GetWebPage($url_0);

		if (!preg_match_all($patern_0,$page_0,$result_0,PREG_PATTERN_ORDER)) { 
		    echo "ERR &nbsp;".__FUNCTION__."patern_0 ненайден";		
			} 		

		for ($q=0; $q < count($result_0[1]); $q++) { 			//	кол-во ячеек в строке
			$number_in_order++;
			$result_0[1][$q] = urlencode(strtolower($result_0[1][$q]));
			$url_1 = $str_1.$result_0[1][$q];
			$url_2 = $str_2.$result_0[1][$q].$str_2_1;
			
			$page_1 = GetWebPage($url_1);
			
			if (!preg_match_all($patern_1,$page_1,$result_1,PREG_PATTERN_ORDER)) { 
			    // echo "ERR &nbsp;".__FUNCTION__."&nbsp; patern_1 ненайден <br>";		
			    // echo "url_1 &nbsp;=&nbsp;".$url_1."<br>";		
				} 

			// if (!preg_match_all($patern_2,$page_2,$result_2,PREG_PATTERN_ORDER)) { 
			//     // echo "ERR &nbsp;".__FUNCTION__."&nbsp; patern_2 ненайден <br>";		
			//     // echo "url_2 &nbsp;=&nbsp;".$url_2."<br>";		
			// 	} 

			// if (!preg_match_all($patern_2_1,$page_2_1,$result_2_1,PREG_PATTERN_ORDER)) { 
			//     // echo "ERR &nbsp;".__FUNCTION__."&nbsp; patern_2_1 ненайден <br>";		
			//     // echo "url_2_1 &nbsp;=&nbsp;".$url_2_1."<br>";		
			// 	} 

			echo "<tr>";
				echo "<td>";
					echo $number_in_order;
				echo "</td>";
				echo "<td>";
					$date = date("d.m.y H:i:s");
					echo $date;
				echo "</td>";
				echo '<td align="right">';
					echo $result_0[1][$q];
				echo "</td>";				
				echo "<td>";
					echo $result_0[2][$q];
				echo "</td>";				
				echo "<td>";
					echo $result_0[3][$q];
				echo "</td>";				
				echo "<td>";
					echo $result_1[1][0];
				echo "</td>";
			echo "</tr>";
			
			// sleep(mt_rand(1,3));
			array_push($result,$date);
			array_push($result,$result_0[1][$q]);
			array_push($result,$result_0[2][$q]);
			array_push($result,$result_0[3][$q]);
			array_push($result,$result_1[1][0]);
			array_push($result,"");
			}
		qIIntoDB_CR($name_table,$link_DB,$result);
		sleep(mt_rand(1,3));
		}



		// echo Build_tree_arr($result);
		// echo "<br><br><br>**********************************************************<br><br><br>";
		// print_r($result_1);

		mysqli_close($link_DB);
		
		echo "<br>======";
		echo "<br> Конец работы скрипта &nbsp - &nbsp".date("d.m.y H:i:s",time())."<br><br>";			




	?>
	
		</tbody>
	</table>


	<!-- то же в пайтоне -->





	</table>

	


</body>
</html>