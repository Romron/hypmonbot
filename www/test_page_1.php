<!DOCTYPE html>
<html>
<head>
	<title>TEST PAGE 1</title>
	<meta charset="utf-8">
	<meta description="Главная таблица монитора">

	<link href="css/table_css.css" rel="stylesheet">
	<?php 	include('funktions_hypmon.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>

</head>
<body>

<?php
	


	// $str = urlencode('биткоин');
	// // $url_1 = 'https://online.seranking.com/research.keyword.html?source=ru&filter=keyword&input='.$str;
	// $url_2 = 'https://serpstat.com/keywords/?query='.$str;
	// // $page_2 = GetWebPage($url);
	// $page = GetWebPage($url_2);
	// $key = urlencode("биткоин");
	$key = "биткоин";
	
	$str_2 = "https://online.seranking.com/research.keyword.html?source=ru&filter=keyword&input=";
	$url_2 = $str_2.$key;
	$patern_2 = '#>Частотность.*\n.*\n.*\n.*\n.*\n.*\n.*\n.*<a\sclass="text-black">(.*)<\/a>#'; 		//	частотность в поиске 

	$page_2 = GetWebPage($url_2);

	// echo $page_2;
	// echo "<br><br>*********************************************************************<br><br>";
	echo $url_2."<br><br>";

	if (!preg_match_all($patern_2,$page_2,$result_2,PREG_PATTERN_ORDER)) { 
	    echo "ERR &nbsp;".__FUNCTION__."patern_2 ненайден";		
		} 

	echo Build_tree_arr($result_2);







?>


</body>
</html>