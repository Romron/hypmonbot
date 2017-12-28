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
					<td rowspan="2"> № п/п </td>
					<td rowspan="2"> Дата </td>
					<td rowspan="2"> Название </td>
					<td rowspan="2"> Капитализация </td>
					<td rowspan="2"> Курс </td>
					<td rowspan="2"> Частотность </td>
					<td colspan="3"> seobook.com </td>
				</tr>
				<tr>
					<td> US Monthly </td>
					<td> Daily </td>
					<td> Google </td>
				</tr>
			</thead>
			<tbody>
	<!-- /Шапка таблицы -->

	

<?php  

	// потенциальные источники частотностей: ***************************************
		// $str_quantity_start_3 = "https://serpstat.com/keywords/?query=";
		// $str_quantity_start_3_1 = "&ff=1&search_type=subdomains&se=g_ua";
		// $str_quantity_start_4 = "http://www.bukvarix.com/keywords/?q=";	// Пока бесплатно !!!

//----------------------------------------------------------------------------------------
	// global $handle_log;
	$path_name_file='quantity_start.txt';
	$path_name_folder='LOG';
	$amount_starts = 13;


	if (!file_exists($path_name_folder)) {	// создаём папку для лог файлов если её не было 
		if (!mkdir($path_name_folder)) {	// если ошибка
			echo "ERROR: &nbsp; Class FileSistem method CreateFolder: папка &nbsp;".$path_name_folder."&nbsp; не создана";
			}
		}
	$handle = fopen($path_name_folder.'/'.$path_name_file, "a");	// создаём, а если уже есть то открываем, файл для хранения количества стартов 
		if (!$handle) {	// если ошибка
		echo "ERROR: &nbsp; Class FileSistem method CreateFile: ошибка при открытии файла &nbsp;".$path_name_file.'<br>';
		}
	$handle_log = fopen($path_name_folder.'/log.txt', "a");	// создаём, а если уже есть то открываем, файл

	$str_quantity_start = file($path_name_folder.'/'.$path_name_file);		// читаем файл с количеством стартов 
	$str_quantity_start[1]++;

	// echo "<br>";
	// echo Build_tree_arr($str_quantity_start);

	if ($amount_starts < $str_quantity_start[1]) {		// если количество стартов больше заданого то записываем информацию в файл и выходим 
		$handle = fopen($path_name_folder.'/'.$path_name_file, "w");
		if (!$handle) {	// если ошибка
			echo "ERROR: &nbsp; ".__FUNCTION__.": ошибка при открытии файла &nbsp;".$path_name_file.'<br>';
			}
				
		$str_in_log_file = date("H:i:s",time())." ".__FUNCTION__.":\r\n".
			"\tgiven_quantity_starts = ".$amount_starts."\r\n".
			"\tdone_quantity_of_starts = ".$str_quantity_start[1]."\r\n".
			"\tquantity_of_pages_passed_0 = ".($str_quantity_start[0]-1)."\r\n".
			"\t\tРабота скрипта завершина\r\n";

		fwrite($handle_log,$str_in_log_file);
		echo "<br> Файл был запущен &nbsp;".$str_quantity_start[1]."&nbsp; раз <br><br>";
		exit();
		}

	if ($str_quantity_start[0] == '') {
		$quantity_of_pages_passed_0 = 1;
		}else{
			$quantity_of_pages_passed_0 = trim($str_quantity_start[0]);	// $n - количество пройденных страниц на сайте источнике.
			}
	
	echo "<br>. amount_starts = ".$str_quantity_start[1];
	echo "<br>. quantity_of_pages_passed = ".$quantity_of_pages_passed_0."<br><br>";

//--------------------------------------------------------------------

	ignore_user_abort(true);	// Игнорирует отключение пользователя 
	set_time_limit(0);			// позволяет скрипту быть запущенным постоянно

	$time_0 = time();
	$arr_ini = ini_get_all();		// для определения объёма памяти выделенного скрипту, а также всех прочих настроек
	echo "Начало работы скрипта &nbsp - &nbsp".date("d.m.y H:i:s",$time_0);
		echo "<br>******";
		echo "<br> Установлено максимальное время выполнения скрипта &nbsp-&nbsp".ini_get('max_execution_time')."&nbsp сек.";
		echo "<br> Объём оперативной память выделенный скрипту &nbsp-&nbsp &nbsp".$arr_ini[memory_limit][global_value];
		echo "<br> Объём оперативной память занимаемый скриптом &nbsp-&nbsp".round((memory_get_usage()/1000000),2)."M";
		echo "<br>******";

	$name_table = "Crypto_test";
	$link_DB = conect_DB();
	$result = array();
	$number_in_order = 0;		// порядковый номер строки на веб странице. Для БД не нужен

	$str_0 = "https://prostocoin.com/marketcap&page=";		// перечень крипто валют - всего 1200 строк по состоянию на 27.12.2017
	$str_1 = "https://online.seranking.com/research.keyword.html?source=us&filter=keyword&input=";
	$str_2 = "http://tools.seobook.com/keyword-tools/seobook/?keyword=";	// вроде бесплатный сервис !!!
	$headers_2 = array(		// только для обращения по адресу: http://tools.seobook.com/keyword-tools/seobook/?keyword=
		'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
		'Accept-Encoding:gzip, deflate',
		'Accept-Language:ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
		'Cache-Control:max-age=0',
		'Connection:keep-alive',
		'Cookie:MintAcceptsCookies=1; MintUnique=1; MintUniqueDay=1514260800; MintUniqueWeek=1514088000; MintUniqueMonth=1512100800; MintUniqueLocation=1; _ga=GA1.2.1582748074.1514273105; _gid=GA1.2.378127518.1514273105; MintCrush=2005843086; SESSe0033d505970ff0ab6bd1d798ecad786=89N4k3jHPfZbiWQXT0-NfuCg9eozsiS49B44XUtuamA; MintUniqueHour=1514296800',
		'Host:tools.seobook.com',
		'Upgrade-Insecure-Requests:1',
		'User-Agent:Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'
		);
	
	$patern_0 = '#<tr>\n*.*\n.*<td.*>(.*)<\/a>.*\n.*<td>\$(.*)<\/td>.*\n.*<td>\$(.*)<\/td>#'; 		//	название валюты 
	$patern_1 = '#>Частотность.*\n.*\n.*\n.*\n.*\n.*\n.*\n.*<a\sclass="text-black">(.*)<\/a>#'; 		//	частотность в поиске 
	
	for ($i = $quantity_of_pages_passed_0; $i < 1+$quantity_of_pages_passed_0; $i++) { 	// рабочий вариант.  сдесь задаёться количество страниц за один запуск
		// for ($i=1; $i < 2 ; $i++) {	// для тестов
		if ($i>13) { break; }	// ограничение количества страниц

		$url_0 = $str_0.$i;
		$page_0 = GetWebPage($url_0);
		if (!preg_match_all($patern_0,$page_0,$result_0,PREG_PATTERN_ORDER)) { 
		    echo "ERR &nbsp;".__FUNCTION__."patern_0 ненайден";		
			} 		
		for ($q=0; $q < count($result_0[1]); $q++) { 	//	перебор массива с названиями криптовалют
			
			// if ($q > 5) { break; }		// для тестов
			
			$number_in_order++;		// номер строки для веб страницы
			
			$result_0[1][$q] = urlencode(strtolower($result_0[1][$q]));
			$url_1 = $str_1.$result_0[1][$q];
			$url_2 = $str_2.$result_0[1][$q];
			$page_1 = GetWebPage($url_1);
			if (!preg_match_all($patern_1,$page_1,$result_1,PREG_PATTERN_ORDER)) { 
			    // echo "ERR &nbsp;".__FUNCTION__."&nbsp; patern_1 ненайден <br>";		
			    // echo "url_1 &nbsp;=&nbsp;".$url_1."<br>";		
				} 

			$key_2 = strtolower($result_0[1][$q]);
			$url_2 = $str_2.$key_2;
			$page_2 = GetWebPage($url_2,$headers_2);
			$patern_2_1 = '#>'.$key_2.'<\/a><\/td>\n.*<td>(.*)<\/td>#';
			if (!preg_match_all($patern_2_1,$page_2,$result_2_1,PREG_PATTERN_ORDER)) { 
			    // echo "func: &nbsp;".__FUNCTION__."&nbsp; patern_2_1 ненайден или ошибка";
				}	
			$patern_2_2 = '~<td><a href="https:\/\/www\.google\.com\/#q='.$key_2.'".*>(.*)<\/a><\/td>~';
			if (!preg_match_all($patern_2_2,$page_2,$result_2_2,PREG_PATTERN_ORDER)) { 
			    // echo "func: &nbsp;".__FUNCTION__."&nbsp; patern_2_2 ненайден или ошибка";
				}	
			$patern_2_3 = '~<td><a href="https:\/\/www\.google\.us\/#q='.$key_2.'" rel="nofollow" target="_blank">(.*)<\/a>~';
			if (!preg_match_all($patern_2_3,$page_2,$result_2_3,PREG_PATTERN_ORDER)) { 
			    // echo "func: &nbsp;".__FUNCTION__."&nbsp; patern_2_3 ненайден или ошибка";
				} 


			// Формируем тело веб таблицы
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
					echo "<td>";
						echo $result_2_1[1][0];
					echo "</td>";
					echo "<td>";
						echo $result_2_2[1][0];
					echo "</td>";
					echo "<td>";
						echo $result_2_3[1][0];
					echo "</td>";
				echo "</tr>";
			


			array_push($result,$date,$result_0[1][$q],$result_0[2][$q],$result_0[3][$q],$result_1[1][0],$result_2_1[1][0],$result_2_2[1][0],$result_2_3[1][0]);

			}
		qIIntoDB_CR($name_table,$link_DB,$result);		// запись результатов в БД
		sleep(mt_rand(1,3));
		$quantity_of_pages_passed_1 = $i+1;
		}

		// echo "<br><br>=========================================================================<br><br><br>";
		// echo Build_tree_arr($result);
		// echo "<br><br><br>**********************************************************<br><br><br>";
		// print_r($result_1);

		
		$handle = fopen($path_name_folder.'/'.$path_name_file, "w");
		if (!$handle) {	// если ошибка
			echo "ERROR: &nbsp; Class FileSistem method CreateFile: ошибка при открытии файла &nbsp;".$path_name_file.'<br>';
			}		


		$str_2 = $quantity_of_pages_passed_1."\r\n".$str_quantity_start[1];
		fwrite($handle,$str_2);

		mysqli_close($link_DB);
		
		$time_1 = time();
		$time = $time_1 - $time_0;
		echo "<br>======";
		echo "<br> Конец работы скрипта &nbsp - &nbsp".date("d.m.y H:i:s",$time_1);			
		echo "<br> Время работы скрипта &nbsp - &nbsp".date("i:s",$time)."<br><br>";			




	?>
	
		</tbody>
	</table>


	<!-- то же в пайтоне -->





	</table>

	


</body>
</html>