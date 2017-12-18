<!DOCTYPE html>
<html>
<head>
	<title>TEST PAGE</title>
	<meta charset="utf-8">
	<meta description="Страница для тестов">

	<link href="css/table_css.css" rel="stylesheet">
	<?php 	include('funktions_hypmon.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>

</head>
<body>

<?php

	$str = urlencode('"Rotate13" "Base64" "Strip" inurl:index.php?q=');
	// for ($n=0; $n < 1; $n++) { 

	// $url = 'http://www.google.ru/search?q='.urlencode($str).'&num=100&start='.$n.'00&filter=0';
	// $page = GetWebPage($url);
	// $url = $value.base64_encode('http://www.google.ru/search?q='.urlencode($str).'&num=100&start='.$n.'00&filter=0');
	$url = 'http://proxy.bernex.net/index.php?q='.base64_encode('http://www.google.ru/search?q='.$str.'&num=100&start=000&filter=0');
	$page = file_get_contents($url);


// 'http://www.google.ru/search?q="Rotate13" "Base64" "Strip" inurl:index.php?q=&num=100&start=000&filter=0';
	
	echo $page;

	// $patern_proxi_URL = '#<div class="g"><h3 class="r"><a href="\/url\?q=(?:https?:\/\/)?[w]{0,3}\.?(.*)\%#'; 		
	// 	if (!preg_match_all($patern_proxi_URL,$page,$result_proxi_URL,PREG_PATTERN_ORDER)) { 
	// 		echo "func TEST:  patern_proxi_URL ненайден или ошибка";	} 
	// sleep(mt_rand(1,5));
	// for ($q=0; $q < count($result_proxi_URL[1]); $q++) { 
	// 		$result_prox[1][$q] = $result_prox[1][$q].":".$result_prox[2][$q];
	// 		array_push($arr_all_prox, $result_prox[1][$q]);
	// 	}	
	// }

	// 			echo Build_tree_arr($arr_all_prox);
	// 			echo "<br><br><br><br><br>***********************************************<br><br><br><br>";

?>


</body>
</html>