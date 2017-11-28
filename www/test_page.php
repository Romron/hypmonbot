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

	$page_list4hyip = GetWebPage('http://list4hyip.com');		// получаю страницу с перечнем хайпов



	$patern_3_0 = '#<div class="main-col" style="position: relative;">(.*)<div class="col3">#sU'; 	// получаем блок проэкта
	if (!preg_match_all($patern_3_0,$page_list4hyip,$result_3_0,PREG_PATTERN_ORDER)) { 
	    echo "func GetHypNam:  patern_3_0 ненайден или ошибка";
	    // return false;
		} 

		echo "<br>-------------------------------------------------------------------------------------------------<br>";
			print_r($result_3_0);
		echo "<br>-------------------------------------------------------------------------------------------------<br>";

	// $patern_3_1 = '#<a.*target="_blank">.*<img src=.*(?!list4hyip.com)(https?://(?!mozshot.nemui.org).*)/#sU'; 	// для тестов
	// if (!preg_match_all($patern_3_1,$result_3,$result_3_1,PREG_PATTERN_ORDER)) { 
	//     echo "func GetHypNam:  patern_3_1 ненайден или ошибка";
	//     // return false;
	// 	} 

	// $patern_3_2 = '##';		
	// 	if (!preg_match_all($patern_3_2,$result_3,$result_3_2,PREG_PATTERN_ORDER)) { 
	// 	    echo "func TEST:  patern_3_2 ненайден или ошибка<br>";
	// 		// exit();
	// 		} 		

	// array_push($result_3,$patern_3_0,$patern_3_1,$patern_3_2);
	// echo "<br>".Build_tree_arr($result_3);

?>


</body>
</html>