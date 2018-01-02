<!DOCTYPE html>
<html>
<head>
	<title>TEST PAGE 1****</title>
	<meta charset="utf-8">
	<meta description="Главная таблица монитора">

	<!-- <link href="css/table_css.css" rel="stylesheet"> -->

	<!-- <link rel="canonical" href="https://ru.semrush.com/info/Bitcoin+%28keyword%29"> -->

	<?php 	include('funktions_hypmon.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>

</head>
<body>

<?php
	

	$key = "bitcoin";
	// $key = "Marscoin";
	// $key = "ethereum";
	// $key = "lit ecoin";
	// $key = "vot+ecoin";
	// $key = "ronp+ aulcoin";
	// $key = "usde";
	// $key = "steem";

	$key = str_replace($arr_3,"-",$key);
	

	$str_3 = "https://coinmarketcap.com/currencies/";
	$url_3_2 = $str_3.$key."/historical-data/?start=20130428&end=".date(Ymd);
	$page_3_2 = GetWebPage($url_3_2);
	$page_3_2 = str_replace("\n","",$page_3_2);

	echo $page_3_2;
	echo "<br>*********************************************************************<br>";
	echo "key &nbsp;= &nbsp;".$key."<br>";
	echo "url_3_2 &nbsp;= &nbsp;".$url_3_2."<br>";

	// $patern_3_2 = '#<tr class="text-right">\s*<td\sclass="text-left">(\w{3}\s\d{2},\s20\d{2})<\/td>\s*<td>([\d\.]*)<\/td>\s*(?:<td>[\d\.,-]*<\/td>\s*){5}<\/tr>\s*<\/tbody>#';  // дата выхода на рынок	
	$patern_3_2 = '#<tbody>\s*<tr class="text-right">\s*<td\sclass="text-left">(?:\w{3}\s\d{2},\s20\d{2})<\/td>\s*(?:<td>[\d\.]*<\/td>\s*){3}<td>([\d\.]*)<\/td>\s*#';  // дата выхода на рынок	
	if (!preg_match_all($patern_3_2,$page_3_2,$result_3_2,PREG_PATTERN_ORDER)) { 
	    // echo "<br>func: &nbsp;".__FUNCTION__."&nbsp; patern_3 ненайден или ошибка<br>";
		}	


	// array_push($result_2,$result_2[1][0]);

	echo "<br><br><br>=========================================================================<br><br><br>";

	print_r($result_3_2);
	// Build_tree_arr($result_2);

	echo "<br><br>***&nbsp; result_3_2[1][0] = &nbsp;".$result_3_2[1][0];
	echo "<br><br>***&nbsp; result_3_2[2][0] = &nbsp;".$result_3_2[2][0];








?>


</body>
</html>