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

	$page_3 = GetWebPage('http://list4hyip.com/');
		if (is_array($page_3)) { $page_3 = implode(" ", $page_3);}	
	

	$result_3a[1] = array();

		$patern_3 = '#href="\/go\/lid\/\d+" target=_blank>\s*<img src="(?:https?:\/\/)?[w]{0,3}\.?([\da-z\.\/\?:-]+)#s'; 
		$patern_3_1 = '#mozshot.nemui#';
		$patern_3_2 = '#([\da-z\.-]+)#';
		$patern_3_3 = '#\d+x\d+\?(?:https?:\/\/)?[w]{0,3}\.?([\da-z\.-]+)#';
		
		if (!preg_match_all($patern_3,$page_3,$result_3_0,PREG_PATTERN_ORDER)) { 
		    echo "func GetHypNam:  patern_3 ненайден или ошибка";
		    return false;
			} 

		foreach ($result_3_0[1] as $key => $value) {
			
			echo "value = ".$value."<br>";
			if (!preg_match_all($patern_3_1,$value,$result_3_1,PREG_PATTERN_ORDER)) { 
				if (!preg_match_all($patern_3_2,$value,$result_3_2,PREG_PATTERN_ORDER)) { echo "func GetHypNam:  patern_3_2 ненайден или ошибка";	}
			}else{
				if (!preg_match_all($patern_3_3,$value,$result_3_2,PREG_PATTERN_ORDER)) { echo "func GetHypNam:  patern_3_3 ненайден или ошибка";	}
				}

			$result_3a[1][] = $result_3_2[1][0];

		}
		echo Build_tree_arr($result_3a);



		// $page_3 = GetWebPage('http://list4hyip.com/');
		// 		if (is_array($page_3)) { $page_3 = implode(" ", $page_3);}	
		// 		$patern_3 = '#<a.*target="_blank">.*<img src=.*(?!list4hyip.com)(https?://(?!mozshot.nemui.org).*/)#sU'; 
		// 		if (!preg_match_all($patern_3,$page_3,$result_3a,PREG_PATTERN_ORDER)) { 
		// 		    echo "func GetHypNam:  patern_3 ненайден или ошибка";
		// 		    return false;
		// 			} 
		// 		for ($q=0; $q < count($result_3a[1]); $q++) { 			//  с массива всех значений извлекаем только нужные
		// 			if ($result_3a[1][$q] == "http://list4hyip.com/") {	//	удаляем не нужное
		// 				continue;
		// 				}
		// 			$result_3[$q] = $result_3a[1][$q];
		// 			}

		// 			$result_3c = array('1'=>'http://list4hyip.com/','2' => count($result_3));
		// 			array_unshift($result_3, $result_3c);

		// echo Build_tree_arr($result_3);
?>


</body>
</html>