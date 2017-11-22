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
	$arr_result = array();
	$arr_fin_param_hyp = array();

	for ($i=1; $i < $ArrNameHyp[0][2]; $i++) {	// $ArrNameHyp[$i][2];	количество хайпов взятых с данного монитора
			if (!preg_match_all($patern_URL,$ArrNameHyp[$i],$result_URL,PREG_PATTERN_ORDER)) { 
			    echo "func TEST:  $patern_URL ненайден или ошибка";
			    return false;
				} 			
			$str_URL = 'http://allhyipmon.ru/monitor/'.$result_URL[1][0];		// формирую URL страницы подробностей для данного хайпа
			$page_details = GetWebPage($str_URL);		// получаю страницы подробностей для данного хайпа
			
			$patern_1 = '#<tr class="polz".*Минимальный вклад.*;">\$? ?([\d\.]+)<\/b>#';	//	минимальный вклад
				if (!preg_match_all($patern_1,$page_details,$result_1,PREG_PATTERN_ORDER)) { 
				    // echo "func TEST:  patern_1 ненайден или ошибка";
					} 	
				$result_1[1] = str_replace('.',',',$result_1[1]);								
		
			$patern_2 = '#<td>Планы:<\/td><td><b style="color:\#155a9e;">(.*)<\/b>#';		
				if (!preg_match_all($patern_2,$page_details,$result_2,PREG_PATTERN_ORDER)) { 
				    // echo "func TEST:  patern_2 ненайден или ошибка";
					// exit();
					} 				
			
				$patern_2_1 = '#^-? ?(\d+\.?,?\d{0,3})%?#m';								//	процентная ставка
					if (!preg_match_all($patern_2_1,$result_2[1][0],$result_2_1,PREG_PATTERN_ORDER)) { 
					    // echo "func TEST:  patern_2_1 ненайден или ошибка<br>";
						// exit();
						} 	
					$result_2_1[1] = str_replace('.',',',$result_2_1[1]);									
			
				$patern_2_2 = '#^.*([dD]aily|день|[Hh]ourly|[dD]ays?|monthly)#m';			//	периуд мин процентной ставки
					if (!preg_match_all($patern_2_2,$result_2[1][0],$result_2_2,PREG_PATTERN_ORDER)) { 
					    // echo "func TEST:  patern_2_2 ненайден или ошибка<br>";
						// exit();
						} 	
		
				$patern_2_3 = '#^.*(?:(?:в день)|на|[Ff]or|to) +(\d{0,}(бессрочно)?)#m';	//	Мин. срок вклада
					if (!preg_match_all($patern_2_3,$result_2[1][0],$result_2_3,PREG_PATTERN_ORDER)) { 
					    // echo "func TEST:  patern_2_2_2 ненайден или ошибка<br>";
						// exit();
						} 	
		
				$patern_2_4 = '#^.*\d+ +(день|дней|дня|days?|hours?|года?|months?)#mi';		//	час,  день, неделя...
					if (!preg_match_all($patern_2_4,$result_2[1][0],$result_2_4,PREG_PATTERN_ORDER)) { 
					    // echo "func TEST:  patern_2_2_4 ненайден или ошибка<br>";
						// exit();
						} 	
		
				echo Build_tree_arr($result_2);
				echo "<br>**************<br>";



			array_push($arr_result,$result_1[1][0],$result_2_1[1][0],$result_2_2[1][0],$result_2_3[1][0],$result_2_4[1][0]);
			array_push($arr_fin_param_hyp,$arr_result);
			$str_URL = '';
			array_splice($arr_result,0);
		}



	echo "<br>-------------------------------<br><br>";
	echo Build_tree_arr($arr_fin_param_hyp);
				




?>


</body>
</html>