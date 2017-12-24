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
	$key = "Bitcoin";
	// $key = urlencode("биткоин");
	
	$str_2 = "https://serpstat.com/keywords/?query=";
	$str_2_1 = "&ff=1&search_type=subdomains&se=g_ua";	

	$url_2 = $str_2.$key.$str_2_1;

	// $patern_2 = '#<div class="dtc">\n.*>(.*)<\/div>#'; 		//	частотность в поиске 
	   // $patern_2 = '#<div class="dtc">\n.*>(.*)<\/div>\n.*\n.*\n.*Частотность.*<div class="tooltip#'; 		//	частотность в поиске 
	   $patern_2 = '#<div class="dtc">\n.*>(.*)<\/div>\n.*\n.*\n.*Частотность.*<div class="tooltip#'; 		//	частотность в поиске 
	// $patern_2_1 = '#class="card_stat">\n.*\n.*<div.*>(.*)<\/div>#'; 		//	количество страниц
	$patern_2_1 = '#class="card_stat">#'; 		//	количество страниц

	$page_2 = GetWebPage($url_2);

	echo $page_2;
	echo "<br><br>*********************************************************************<br><br>";
	echo $url_2."<br><br>";

	if (!preg_match_all($patern_2,$page_2,$result_2,PREG_PATTERN_ORDER)) { 
	    echo "ERR &nbsp;".__FUNCTION__."&nbsp; patern_2 ненайден <br>";		
	    // echo "url_2 &nbsp;=&nbsp;".$url_2."<br>";		
		} 

	if (!preg_match_all($patern_2_1,$page_2_1,$result_2_1,PREG_PATTERN_ORDER)) { 
	    echo "ERR &nbsp;".__FUNCTION__."&nbsp; patern_2_1 ненайден <br>";		
	    // echo "url_2_1 &nbsp;=&nbsp;".$url_2_1."<br>";		
		} 

	echo Build_tree_arr($result_2);
	echo "<br>****************************************************<br>";
	echo Build_tree_arr($result_2_1);







?>


</body>
</html>