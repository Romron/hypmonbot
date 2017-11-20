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

	
	$ArrNameHyp = GetHypNam();
	


	$str_URL = 'http://allhyipmon.ru/';
	$patern_1 ='#(?:https?:\/\/)?[w]{0,3}\.?(.*)/?#';

	for ($i=1; $i < $ArrNameHyp[0][2]; $i++) {	// $ArrNameHyp[$i][2];	количество хайпов взятых с данного монитора
			if (!preg_match_all($patern_1,$ArrNameHyp[$i],$result_URL,PREG_PATTERN_ORDER)) { 
			    echo "func TEST:  $result_URL ненайден или ошибка";
			    return false;
				} 			
			$str_URL = 'http://allhyipmon.ru/monitor/'.$result_URL[1][0];		// формирую URL страницы подробностей для данного хайпа
			echo $str_URL."<br>";
			$page = GetWebPage('http://list4hyip.com/');		// получаю страницы подробностей для данного хайпа

			$str_URL = '';

		}


				




?>


</body>
</html>