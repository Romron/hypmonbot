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
	
	for ($i=1; $i < $amount_list_proxy[1][0]; $i++) { 

		$page_with_proxy = GetWebPage('https://premproxy.com/socks-list/ip-port/'.$i.'.htm');
			// echo $page_with_proxy;

		$patern_proxy = '#^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}:\d{2,5}#m'; 		//	SOCKS
		if (!preg_match_all($patern_proxy,$page_with_proxy,$result_proxy,PREG_PATTERN_ORDER)) { 
		    $result_proxy = '<p class="err_mess">ptrn_proxy_ERR</p>';	
			} 
		
		$arr_proxy = array_merge($arr_proxy,$result_proxy[0]);	

		//	ProxyChecker(){
			// проверка работоспособности
			

				// $headers = array(
				// 	'GET ' . $url . ' HTTP/1.0',
				// 	'Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash,
				//                   application/vnd.ms-excel, application/msword, */*',
				// 	'Accept-Language: ru,zh-cn;q=0.7,zh;q=0.3',
				// 	'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)'
				// 	// 'Proxy-Connection: Keep-Alive'
				// 	);

		  //       $ch = curl_init();
		  //       curl_setopt($ch, CURLOPT_URL, $url);
		        
		  //       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
		  //       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
		  //       curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки

				// curl_setopt($ch, CURLOPT_COOKIESESSION, true);  
		  //       curl_setopt($ch, CURLOPT_COOKIEJAR,    __DIR__."/cookies/cookies.txt");
		  //       curl_setopt($ch, CURLOPT_COOKIEFILE,   __DIR__."/cookies/cookies.txt");  
		      
		  //       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		  //       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		        
		  //       curl_setopt($ch, CURLOPT_HEADER, true);		
				// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  
		  //       curl_setopt($ch, CURLOPT_REFERER, $url);       

		  //       $content = curl_exec($ch);
		  //       $err     = curl_errno($ch);
		  //       $errmsg  = curl_error($ch);
		  //       $header  = curl_getinfo($ch);

		  //       curl_close($ch);

		  //       $header['errno']   = $err;
		  //       $header['errmsg']  = $errmsg;
		  //       $header['content'] = $content;
		  //       $header['$ch'] = $ch;
		  //       $result = $header;

		  //       if ($result['errno'] != 0) {  // если ошибка
		  //        	echo "<br>Код ошибки: &nbsp".$result['errmsg']; 
		  //          return $result;
		  //         }     
		  //       if ($result['http_code'] != 200){
		  //          	echo "<br>Запрос по адресу: &nbsp-&nbsp".$url;
		  //          	echo "<br>&nbsp&nbsp&nbsp&nbsp Код ответа сервера: &nbsp".$result['http_code']."<br>";       // если ошибка....
		  //         	return $result;
		  //         }
		  //       // если не ошибка





			// проверка анонимности
			// проверка внешнего IP на уникальность
			// проверка DNS 




		// }


		sleep(mt_rand(1,2));	//	без этой строчки не работает
		}

		// здесь $arr_proxy можно писать в файл
	
		print_r($arr_proxy);







?>

</body>
</html>