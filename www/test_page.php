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
	set_time_limit(0);			// позволяет скрипту быть запущенным постоянно

	// Список URLов со списками прокси

	// $URL_prox = "www.gatherproxy.com/ru/proxylist/anonymity/?t=Elite#1";

	$arr_all_prox = [];
	// while ($count_page_prox<= 50) {
	while ($count_page_prox<= 20) {


		$URL_prox = "www.gatherproxy.com/ru/proxylist/anonymity/?t=Elite#2";
		$page_prox = GetWebPage($URL_prox);
		// echo $page_prox;

		// Парсинг прокси в массив

		$patern_prox = '~"PROXY_IP":"([\d]{1,3}\.[\d]{1,3}\.[\d]{1,3}\.[\d]{1,3}).*"PROXY_PORT":"(.*)"~U';
		if (!preg_match_all($patern_prox,$page_prox,$result_prox,PREG_PATTERN_ORDER)) { 
		    echo "func GetHypNam:  patern_prox ненайден или ошибка";
			} 
		for ($i=0; $i < count($result_prox[2]); $i++) { 
			$result_prox[2][$i] = hexdec($result_prox[2][$i]);
			}
		
		for ($q=0; $q < count($result_prox[1]); $q++) { 
				$result_prox[1][$q] = $result_prox[1][$q].":".$result_prox[2][$q];
				array_push($arr_all_prox, $result_prox[1][$q]);
			}	
		
		$count_page_prox++;
		sleep(mt_rand(1,5));
		}	
	

	echo Build_tree_arr($arr_all_prox);
	echo "<br><br><br><br><br>***********************************************<br><br><br><br>";



	
	// Проверка и оценка работоспособности полученных прокси. 


		// $url = "www.google.com";
		// $url = "https://www.google.com.ua/?gfe_rd=cr&dcr=0&ei=oSsxWsOTMOfk8Ae7-rVI&gws_rd=ssl";
		$url = "https://ru.wikipedia.org";


		// $url = "http://allhyipmon.ru";

		$conect_out = 120;
		$tim_out = 120;
		
		// $proxy = "96.85.198.105:53281";
		// $proxy = "217.64.244.194:8080";

	foreach ($arr_all_prox as $value) {
		$z++;
		$headers = array(
			'GET ' . $url . ' HTTP/1.0',
			'Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash,
		                  application/vnd.ms-excel, application/msword, */*',
			'Accept-Language: ru,zh-cn;q=0.7,zh;q=0.3',
			'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)'
			// 'Proxy-Connection: Keep-Alive'
			);

        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
	        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
	        curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки

			curl_setopt($ch, CURLOPT_COOKIESESSION, true);  
	        curl_setopt($ch, CURLOPT_COOKIEJAR,    __DIR__."/cookies/cookies.txt");
	        curl_setopt($ch, CURLOPT_COOKIEFILE,   __DIR__."/cookies/cookies.txt");  
	      
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	        
	        curl_setopt($ch, CURLOPT_HEADER, true);		
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  
	        curl_setopt($ch, CURLOPT_REFERER, $url);       

	        // if ($value) {	// если прокси
	            curl_setopt($ch, CURLOPT_PROXY, $value);
	            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
	            curl_setopt($ch,CURLOPT_TIMEOUT, 5);
	            curl_setopt($ch, CURLOPT_FAILONERROR, true);
	            // curl_setopt($ch, CURLOPT_NOBODY, true);		//	выводит только заголовки полученных страниц
	            // }    

        $content = curl_exec($ch);
        $err     = curl_errno($ch);
        $errmsg  = curl_error($ch);
        $header  = curl_getinfo($ch);

        curl_close($ch);

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        $header['$ch'] = $ch;
        $result = $header;

   //      if ($result['errno'] != 0) {  // если ошибка
   //      	echo "<br>Код ошибки: &nbsp".$result['errmsg']; 
   //      	// return $result;
   //      	}     
        
   //      if ($result['http_code'] != 200){
			// echo "<br>Запрос по адресу: &nbsp-&nbsp".$url;
			// echo "<br>&nbsp&nbsp&nbsp&nbsp Код ответа сервера: &nbsp".$result['http_code']."<br>";       // если ошибка....
			// // return $result;
			// }

        echo "<br>".$z;
        if ($result['errno'] == 0) {
			echo "&nbsp;&nbsp;".$value."&nbsp;&nbsp; proxy is ready";
			}else{echo "&nbsp;&nbsp;Код ошибки: &nbsp".$result['errmsg'];}

        // $page = $result['content'];        // если не ошибка
   		// echo $page;

		sleep(mt_rand(1,5));
   	}






?>


</body>
</html>