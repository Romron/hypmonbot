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

	if (!file_exists($path_name_folder)) {	
		if (!mkdir($path_name_folder)) {	// если ошибка
			echo "ERROR: &nbsp; Class FileSistem method CreateFolder: папка &nbsp;".$path_name_folder."&nbsp; не создана";
			}
		}
		$handle = fopen($path_name_folder.'/'.$path_name_file, "a");
		if (!$handle) {	// если ошибка
			echo "ERROR: &nbsp; Class FileSistem method CreateFile: ошибка при открытии файла &nbsp;".$path_name_file.'<br>';
			}
	
	$str = file_get_contents($path_name_folder.'/'.$path_name_file);
	if ($str == '') {
		$n = 0;
		}else{
			$n = $str;	
			}
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
		// }while ($n <= 5);		//	рабочий вариант строки
		}while ($w <= $n+$amount_page);		//	для тестов
    		
		$handle = fopen($path_name_folder.'/'.$path_name_file, "w");
		if (!$handle) {	// если ошибка
			echo "ERROR: &nbsp; Class FileSistem method CreateFile: ошибка при открытии файла &nbsp;".$path_name_file.'<br>';
			}		
		$n = $w;
		fwrite($handle,$n);

    	echo "<br>*****************<br>".Build_tree_arr($result_2);
?>


</body>
</html>