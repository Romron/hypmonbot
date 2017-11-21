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
	$patern_URL ='#(?:https?:\/\/)?[w]{0,3}\.?(.*)/?#';
	$arr_fin_param_hyp = array();

	for ($i=1; $i < $ArrNameHyp[0][2]; $i++) {	// $ArrNameHyp[$i][2];	количество хайпов взятых с данного монитора
			if (!preg_match_all($patern_URL,$ArrNameHyp[$i],$result_URL,PREG_PATTERN_ORDER)) { 
			    echo "func TEST:  $patern_URL ненайден или ошибка";
			    return false;
				} 			
			$str_URL = 'http://allhyipmon.ru/monitor/'.$result_URL[1][0];		// формирую URL страницы подробностей для данного хайпа
			$page_details = GetWebPage($str_URL);		// получаю страницы подробностей для данного хайпа
			// echo $page_details;
			// echo "<br><br><br><br><br><br><br>*************************************<br>";
			echo $str_URL."<br>";
			// с полученной страницы парсим параметры
			
			$patern_1 = '#<tr class="polz".*Минимальный вклад.*;">\$? ?([\d\.]+)<\/b>#';
				if (!preg_match_all($patern_1,$page_details,$result_1,PREG_PATTERN_ORDER)) { 
				    echo "func TEST:  patern_1 ненайден или ошибка";
					} 				
			echo Build_tree_arr($result_1);
			
			$patern_2 = '#<td>Планы:<\/td><td><b style="color:\#155a9e;">(.*)<\/b>#';
				if (!preg_match_all($patern_2,$page_details,$result_2,PREG_PATTERN_ORDER)) { 
				    echo "func TEST:  patern_2 ненайден или ошибка";
					// exit();
					} 				
			echo Build_tree_arr($result_2);
			
			echo "<br>******<br>";
			
			array_push($arr_fin_param_hyp, $result_1[1][0],$result_2[1][0]);
			$str_URL = '';
			// break;
		}

	echo Build_tree_arr($arr_fin_param_hyp);

				




?>


</body>
</html>