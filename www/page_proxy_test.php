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

	set_time_limit(120);
	$arr_proxy = array();
	$result_proxy = array();

	$page_with_amount_list_proxy = GetWebPage('https://premproxy.com/socks-list/');
		// echo $page_with_amount_list_proxy;
	
	$patern_amount_list_proxy = '#<div id="navbar">.*<li><a href="\d{1,2}.htm">(\d{1,2})</a></li>.*</div>#s'; 		//	
	if (!preg_match_all($patern_amount_list_proxy,$page_with_amount_list_proxy,$amount_list_proxy,PREG_PATTERN_ORDER)) { 
	    $result_proxy = '<p class="err_mess">patern_amount_list_proxy_ERR</p>';	
		} 
	
	for ($i=1; $i < 20; $i++) { 

		$page_with_proxy = GetWebPage('https://premproxy.com/socks-list/ip-port/'.$i.'.htm');
			// echo $page_with_proxy;

		$patern_proxy = '#^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}:\d{2,5}#m'; 		//	SOCKS
		if (!preg_match_all($patern_proxy,$page_with_proxy,$result_proxy,PREG_PATTERN_ORDER)) { 
		    $result_proxy = '<p class="err_mess">ptrn_proxy_ERR</p>';	
			} 
		
		sleep(mt_rand(1,2));
		$arr_proxy = array_unshift($arr_proxy,$result_proxy);
		}
	



	var_dump($amount_list_proxy);
	
		echo "<br>";
		echo "<br>";
		echo "<br>";

	// var_dump($result_proxy);
	print_r($arr_proxy);



?>

</body>
</html>