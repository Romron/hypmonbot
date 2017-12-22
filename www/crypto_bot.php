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
	// $date = date("d.m.y H:i:s");

	set_time_limit(7200);

	$str_0 = "https://prostocoin.com/marketcap&page=";
	$str_1 = "https://online.seranking.com/research.keyword.html?source=us&filter=keyword&input=";
	$str_2 = "https://spywords.ru/sword.php?region=&sword=";
	$str_3 = "https://advodka.com/keyword/";
	$str_4 = "https://ru.semrush.com/";
	
	$patern_1 = '#<tr>\n*.*\n.*<td.*>(.*)<\/a>.*\n.*<td>\$(.*)<\/td>.*\n.*<td>\$(.*)<\/td>#'; 		//	название валюты 
	$patern_2 = '#>Частотность.*\n.*\n.*\n.*\n.*\n.*\n.*\n.*<a\sclass="text-black">(.*)<\/a>#'; 		//	частотность в поиске 
	
	for ($i=1; $i < 13 ; $i++) { 
		$url_1 = $str_1.$i;
		$page_1 = GetWebPage($url_1);

		if (!preg_match_all($patern_1,$page_1,$result_1,PREG_PATTERN_ORDER)) { 
		    echo "ERR &nbsp;".__FUNCTION__."patern_1 ненайден";		
			} 		

		for ($q=0; $q < count($result_1[1]); $q++) { 			//	кол-во ячеек в строке
			
			$str_2_1 = urlencode(strtolower($result_1[1][$q]));
			$url_2 = $str_2.$str_2_1;
			
			$page_2 = GetWebPage($url_2);
			
			if (!preg_match_all($patern_2,$page_2,$result_2,PREG_PATTERN_ORDER)) { 
			    // echo "ERR &nbsp;".__FUNCTION__."&nbsp; patern_2 ненайден <br>";		
			    // echo "url_2 &nbsp;=&nbsp;".$url_2."<br>";		
				} 

			echo "<tr>";
				echo "<td>";
					echo date("d.m.y H:i:s");
				echo "</td>";
				echo '<td align="right">';
					echo $result_1[1][$q];
				echo "</td>";				
				echo "<td>";
					echo $result_1[2][$q];
				echo "</td>";				
				echo "<td>";
					echo $result_1[3][$q];
				echo "</td>";				
				echo "<td>";
					echo $result_2[1][0];
				echo "</td>";
			echo "</tr>";
			
			sleep(mt_rand(1,3));
			}
		sleep(mt_rand(1,3));
		}



		// echo Build_tree_arr($result_1);
		// print_r($result_1);

	?>
	
		</tbody>
	</table>


	<!-- то же в пайтоне -->





	</table>

	


</body>
</html>