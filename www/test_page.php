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



	// $patern_3_0 = '#<div class="main-col" style="position: relative;">(?:<b class="min">\D*(\d{1,4}\.?\d*)[\s\D]*.*<\/b>)(?:<b class="min">\D*(\d{1,4}\.?\d*)[\s\D]*.*<\/b>)<div class="col3">#sU'; 	// получаем блок проэкта
	// $patern_3_0 = '#<div class="main-col" style="position: relative;">.*(<a.*target="_blank">.*<img src=.*(?!list4hyip.com)(https?://(?!mozshot.nemui.org).*)/).*<div class="col3">#sU'; 	// получаем название проэкта
	// $patern_3_0 = '#(?:<b class="min">\$?(\d{1,4}\.?\d{1,4})[\s\D\<]+)#sU'; 	// минимальный вклад
	

	$patern_3_0 = '~(<div class="main-col".*(class="plan-d">Plan: <b style="color:#FF0000;">[\w:\s]*(\d+\.?\d{0,2})[%\-\s,]).*(<a.*target="_blank">.*<img src=.*(?!list4hyip.com)(https?:\/\/(?!mozshot.nemui.org).*)\/).*(<b class="min">\$?(\d{1,4}\.?\d{1,4})[\s\D\<]+).*<div class="col3">)~sU'; 	// получаем блок проэкта
	if (!preg_match_all($patern_3_0,$page_list4hyip,$result_3_0,PREG_PATTERN_ORDER)) { 
	    echo "func GetHypNam:  patern_3_0 ненайден или ошибка";
	    // return false;
		} 

		// echo "<br>-------------------------------------------------------------------------------------------------<br>";
		// 	print_r($result_3_0);
		// echo "<br>-------------------------------------------------------------------------------------------------<br>";

		echo "<br>".Build_tree_arr($result_3_0);

	// $patern_3_1 = '#<a.*target="_blank">.*<img src=.*(?!list4hyip.com)(https?://(?!mozshot.nemui.org).*)/#sU'; 	// для тестов
	// if (!preg_match_all($patern_3_1,$result_3,$result_3_1,PREG_PATTERN_ORDER)) { 
	//     echo "func GetHypNam:  patern_3_1 ненайден или ошибка";
	//     // return false;
	// 	} 

	// $patern_3_2 = '#<b class="min">\D*(\d{1,4}\.?\d*)[\s\D]*.*<\/b>#';		
	// 	if (!preg_match_all($patern_3_2,$page_list4hyip,$result_3_2,PREG_PATTERN_ORDER)) { 
	// 	    echo "func TEST:  patern_3_2 ненайден или ошибка<br>";
	// 		// exit();
	// 		} 		
		// echo "<br>".Build_tree_arr($result_3_0);


	// array_push($result_3,$patern_3_0,$patern_3_1,$patern_3_2);
	// echo "<br>".Build_tree_arr($result_3);

?>


</body>
</html>