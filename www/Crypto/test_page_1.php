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
		$url_3_1 = "https://coinmarketcap.com/currencies/bitcoin/#markets";

		$page_3_1 = GetWebPage($url_3_1);
		

		$page_3_1 = str_replace("\n","",$page_3_1);
		echo $page_3_1;

		/*$patern_3_1 = '#<tr(?:\sclass="[\w-\d_]+")?>.*<td>(\d{1,4})<\/td>.*<\/tr>\s*<\/tbody>#';*/

		/*$patern_3_1 = '#<tr(?:\sclass="[\w-\d_\s]+")?(?:\srole="[\w-\d_\s]+")?>\s*<td(?:\sclass="[\w-\d_\s]+")?>(\d{1,4})<\/td>.*<\/tr>\s*<\/tbody>#';  // количество бирж торгующих данной валютой	
		*/
		 /*$patern_3_1 = '#<tr(?:\sclass="[\w-\d_\s]+")?(?:\srole="[\w-\d_\s]+")?>\s*<td(?:\sclass="[\w-\d_\s]+")?>(\d{1,4})<\/td>.*<\/td>\s<\/tr><\/tbody#';*/
		 $patern_3_1 = '#<tr(?:\sclass="[\w-\d_\s]+")?(?:\srole="[\w-\d_\s]+")?>\s*<td(?:\sclass="[\w-\d_\s]+")?>(\d{1,4})<\/td>.*<\/tr>\s*<\/tbody#U';
		

		if (!preg_match_all($patern_3_1,$page_3_1,$result_3_1,PREG_PATTERN_ORDER)) { 
		    echo "<br>func: &nbsp;".__FUNCTION__."&nbsp; patern_3_1 ненайден или ошибка<br>";
			}	
		

		echo Build_tree_arr($result_3_1);



	?>


</body>
</html>