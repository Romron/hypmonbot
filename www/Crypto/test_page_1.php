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
	


	$result_2 = array();
	$arr_3 = array(' ','+');		// для замены этих символов в ключах


	$key = "bitcoin";
	// $key = "lit ecoin";
	// $key = "vot+ecoin";
	// $key = "ronp+ aulcoin";
	// $key = "usde";
	// $key = "steem";

	// $key = urlencode("биткоин");
	$key = str_replace($arr_3,"-",$current_key);
	



	$str_2 = "https://coinmarketcap.com/currencies/";
	$url_2 = $str_2.$key;
	$page_2 = GetWebPage($url_2);
	// $page_2 = html_entity_decode($page_2);
	$page_2 = str_replace("\n","",$page_2);
	


	echo $page_2;
	echo "<br><br>*********************************************************************<br><br>";
	echo $url_2."<br><br>";


	$patern_2 = '#<tr(?:\sclass="[\w-]+")?>.*<td>(\d{1,4})<\/td>.*<\/tr>\s*<\/tbody>#';
	if (!preg_match_all($patern_2,$page_2,$result_2,PREG_PATTERN_ORDER)) { 
	    echo "func: &nbsp;".__FUNCTION__."&nbsp; patern_2 ненайден или ошибка";
		}	


	// array_push($result_2,$result_2[1][0]);

	echo "<br><br><br>=========================================================================<br><br><br>";

	print_r($result_2);
	// Build_tree_arr($result_2);

	echo "<br><br>***&nbsp; result_2[1][0] = &nbsp;".$result_2[1][0];








?>


</body>
</html>