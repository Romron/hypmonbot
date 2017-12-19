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
	$path_name_folder = 'TEMP';
	$path_name_file = 'temp.txt';
	$amount_page = 4;
	$amount_starts = 3;


	if (!file_exists($path_name_folder)) {	
		if (!mkdir($path_name_folder)) {	// если ошибка
			echo "ERROR: &nbsp; Class FileSistem method CreateFolder: папка &nbsp;".$path_name_folder."&nbsp; не создана";
			}
		}
		$handle = fopen($path_name_folder.'/'.$path_name_file, "a");
		if (!$handle) {	// если ошибка
			echo "ERROR: &nbsp; Class FileSistem method CreateFile: ошибка при открытии файла &nbsp;".$path_name_file.'<br>';
			}
	
	$str = file($path_name_folder.'/'.$path_name_file);
	
	if ($amount_starts < $str[1]) {
		$handle = fopen($path_name_folder.'/'.$path_name_file, "w");
		if (!$handle) {	// если ошибка
			echo "ERROR: &nbsp; Class FileSistem method CreateFile: ошибка при открытии файла &nbsp;".$path_name_file.'<br>';
			}			
		fwrite($handle,"");
		echo "<br> Файл запущен &nbsp;".$str[1]."&nbsp; раз";
		exit();
		}

	if ($str[0] == '') {
		$n = 0;
		}else{
			$n = trim($str[0]);	
			}
	echo "<br>. amount_starts = ".$str[1];
	echo "<br>. n = ".$n;
	$w = $n;
	$page_2 = GetWebPage('http://allhyipmon.ru/rating?page='.$w);
	if (is_array($page_2)) { $page_2 = implode(" ", $page_2);}
	$patern_2 = '#<div>\d{1,5}\. <b><a href="/monitor/.*>(.*)</a></b>.*мониторингов</div>#U'; // рабочий вариант
	$result_2 = array();
	do{
		echo "<br>... &nbsp;".$w;
		if (!preg_match_all($patern_2,$page_2,$result_2a,PREG_PATTERN_ORDER)) { 
		    echo "func GetHypNam:  patern_2 ненайден или ошибка";
		    return false;
			} 

		for ($q=0; $q < count($result_2a[1]); $q++) { 			//  с массива всех значений извлекаем только нужные
			$result_2b[$q] = $result_2a[1][$q];
			}
		$result_2 = array_merge($result_2,$result_2b);
		$w++;
		$url = 'http://allhyipmon.ru/rating?page='.$w;
		// // sleep(rand(1,5));
		sleep(mt_rand(1,5));
		$page_2 = GetWebPage($url);
	}while ($w <= $n+$amount_page);		//	для тестов
		
		$result_2c = array('1'=>'http://allhyipmon.ru/rating','2' => count($result_2));
		array_unshift($result_2, $result_2c);


		
	$handle = fopen($path_name_folder.'/'.$path_name_file, "w");
	if (!$handle) {	// если ошибка
		echo "ERROR: &nbsp; Class FileSistem method CreateFile: ошибка при открытии файла &nbsp;".$path_name_file.'<br>';
		}		
	$n = $w;
	$str[1]++;

	$str_2 = $n."\r\n".$str[1];
	fwrite($handle,$str_2);

	echo "<br>*****************<br>".Build_tree_arr($result_2);
?>


</body>
</html>