<!DOCTYPE html>
<html>
<head>
	<title>PROXY_TEST</title>
	<meta charset="utf-8">
	<meta description="Страница для теста чекера прокси">

	<link href="css/table_css.css" rel="stylesheet">
	<?php 	include('funktions_hypmon.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>
	<!-- <script src="js/funktions.js"></script> -->
</head>
<body>


<?php

	set_time_limit(1800);
	$arr_proxy = array();
	$result_proxy = array();
	$url_check = 'www.google.com.ua';

	$page_with_amount_list_proxy = GetWebPage('https://premproxy.com/socks-list/');
		// echo $page_with_amount_list_proxy['content'];
	
	$patern_amount_list_proxy = '#<div id="navbar">.*<li><a href="\d{1,2}.htm">(\d{1,2})</a></li>.*</div>#s'; 		//	
	if (!preg_match_all($patern_amount_list_proxy,$page_with_amount_list_proxy['content'],$amount_list_proxy,PREG_PATTERN_ORDER)) { 
	    $result_proxy = '<p class="err_mess">patern_amount_list_proxy_ERR</p>';	
		} 
	
	
	for ($i=1; $i < $amount_list_proxy[1][0]; $i++) { 
	// for ($i=1; $i < 5; $i++) { 		//	для тестов

		$page_with_proxy = GetWebPage('https://premproxy.com/socks-list/ip-port/'.$i.'.htm');
			// echo $page_with_proxy;

		$patern_proxy = '#^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}:\d{2,5}#m'; 		//	SOCKS
		if (!preg_match_all($patern_proxy,$page_with_proxy['content'],$result_proxy,PREG_PATTERN_ORDER)) { 
		    $result_proxy = '<p class="err_mess">ptrn_proxy_ERR</p>';	
			} 
			

		//	ProxyChecker(){
			// проверка работоспособности
			
			// for ($q=0; $q < count($result_proxy[0]); $q++) { 
			for ($q=0; $q < 10; $q++) { 
 			echo "<br>".$i.".".$q.".";
			
 				echo "<br>".$result_proxy[0][$q]."<br>";

 				$heder = GetWebPage( $url_check,$result_proxy[0][$q]);

 				print_r($heder['$http']);
 				echo "<br><br><br><br><br>";
 				echo $heder['content'];
 				sleep(1);
 			}



		// }

		$arr_proxy = array_merge($arr_proxy,$result_proxy[0]);
		// sleep(mt_rand(1,2));	//	без этой строчки не работает
		}

		// здесь $arr_proxy можно писать в файл
	
		// print_r($arr_proxy);







?>

</body>
</html>