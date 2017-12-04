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
	
	// $file_before = new FileAndFolder;
	// $str = $file_before->ReadFile();

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
		
		echo "<br>. n = 0";
		$n = 0;
		}else{
			$n = $str;	
			echo "<br>. n = ".$n;
			}
	// unset($file_before);

	$w = $n;
	$page_2 = GetWebPage('http://allhyipmon.ru/rating');
		if (is_array($page_2)) { $page_2 = implode(" ", $page_2);}
		$patern_2 = '#<div>\d{1,2}\. <b><a href="/monitor/.*>(.*)</a></b>.*мониторингов</div>#U'; // рабочий вариант
		
		$result_2 = array();
		do{
   				// echo $n."&nbsp;&nbsp; итерация цыкла DO-WHILE в функции: ".__FUNCTION__."<br><br><br>";		
			if (!preg_match_all($patern_2,$page_2,$result_2a,PREG_PATTERN_ORDER)) { 
			    echo "func GetHypNam:  patern_2 ненайден или ошибка";
			    return false;
				} 

			for ($q=0; $q < count($result_2a[1]); $q++) { 			//  с массива всех значений извлекаем только нужные
				$result_2b[$q] = $result_2a[1][$q];
				}
			$result_2 = array_merge($result_2,$result_2b);

			$url = 'http://allhyipmon.ru/rating?page='.$w;
			$w++;
    		echo "<br>*****************<br>".Build_tree_arr($result_2);
	 		 // echo $url;

			// sleep(rand(1,5));
			sleep(mt_rand(1,5));
			$page_2 = GetWebPage($url);

		// }while ($n <= 5);		//	рабочий вариант строки
		}while ($w <= $n+1);		//	для тестов
		

		$handle = fopen($path_name_folder.'/'.$path_name_file, "w");
		if (!$handle) {	// если ошибка
			echo "ERROR: &nbsp; Class FileSistem method CreateFile: ошибка при открытии файла &nbsp;".$path_name_file.'<br>';
			}		
		fwrite($handle,($w+1));

		// $file_after = new FileAndFolder;
		// $file_after->flag_open_file = "w";
		// $file_after->WriteFile($n);
		// unset($file_after);





	


	// $file = new FileAndFolder();
	// $file->path_name_file = 'temp_1.txt';
	// $file->CreateFolder();
	// $file->CreateFile();
	// $file->str = '777777777';
	// $file->WriteFile();
	// $str = $file->ReadFile();
	// echo "<br>".$str."<br>";



?>


</body>
</html>