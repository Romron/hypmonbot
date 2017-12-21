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
	
//	функция формирования урла через анонимайзеры

	// $arr_url_anonim = array('http://fantaluciano.altervista.org/poste/index.php?q='/*,
	// 						// 'http://matarife.com/index.php?q=',
	// 						// 'http://filterevade.com/index.php?q=',
	// 						// 'http://proxy.bernex.net/index.php?q='*/	
	// 						);
		
	// 	foreach ($arr_url_anonim as $value) {

	// 		$url = $value.base64_encode('http://allhyipmon.ru/rating');
	// 		// echo "<br>******<br>".$url."<br>********<br>";
	// 		// $page_2 = GetWebPage($url);
	// 		// $page_2 = GetWebPage('http://fantaluciano.altervista.org');
	// 		// $page_2 = file_get_contents($url);
	// 		echo $page_2;
	// 		// echo "<br><br>======================================================================<br><br><br><br>";
	// 		}

			// "https://bitcoinnews.blog/cryptocurrencies";
			// "https://prostocoin.com/marketcap&page=1";	//!!!!!
			// $url = "http://filterevade.com/index.php?q=".base64_encode('http://allhyipmon.ru/rating');
			$str = urlencode('биткоин');
			// $url_1 = 'https://online.seranking.com/research.keyword.html?source=ru&filter=keyword&input='.$str;
			$url_2 = 'https://serpstat.com/keywords/?query='.$str;
			// $page_2 = GetWebPage($url);
			$page = GetWebPage($url_2);
			echo $page;














	// $str_before = 'http://allhyipmon.ru';
	// $str_after_1  = base64_encode($str_before );
	// $str_after_2  = urlencode($str_before );
	// $str_after_3  = rawurlencode($str_before );

	// echo "<br>".$str_after_1;
	// echo "<br>".$str_after_2;
	// echo "<br>".$str_after_3;

	// echo "<br>**********&nbsp;&nbsp; декодирование  &nbsp;&nbsp;**********************<br>";

	// $str_before_1 = "aHR0cDovL2ZpbHRlcmV2YWRlLmNvbS9pbmRleC5waHA%2FcT1hSFIwY0RvdkwyWnBiSFJsY21WMllXUmxMbU52YlM5cGJtUmxlQzV3YUhBJTJGY1QxaFNGSXdZMFJ2ZGt3emFEQlpNMDUyWkZkM2RXSnRWakJNZHlVelJDVXpSQSUzRCUzRA%3D%3D";
	// $str_before_2 = "aHR0cDovL2FsbGh5aXBtb24ucnU%3D&hl=cc";		// http://fantaluciano.altervista.org/poste/index.php?q=
	// $str_before_3 = "aHR0cDovL2FsbGh5aXBtb24ucnU%3D&hl=3ed";	// http://matarife.com/index.php?q=
	// $str_before_4 = "aHR0cDovL2FsbGh5aXBtb24ucnU%3D&hl=3ed";	// http://filterevade.com/index.php?q=
	// $str_before_5 = "aHR0cDovL2FsbGh5aXBtb24ucnU%3D&hl=3ed";	// http://proxy.bernex.net/index.php?q=

	// $str_after_1  = base64_decode($str_before_1);
	// $str_after_2  = base64_decode($str_before_2);
	// $str_after_3  = base64_decode($str_before_3);
	// $str_after_4  = base64_decode($str_before_4);
	// $str_after_4  = base64_decode($str_before_4);
	// $str_after_5  = base64_decode($str_before_5);
	
	// echo "<br>".$str_after_1;
	// echo "<br>".$str_after_2;
	// echo "<br>".$str_after_3;
	// echo "<br>".$str_after_4;
	// echo "<br>".$str_after_5;


?>


</body>
</html>