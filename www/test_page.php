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


	// Список URLов со списками прокси



	// Парсинг прокси в массив



	
	// Проверка и оценка работоспособности полученных прокси. 


	// function GetWebPage( $url, $conect_out = 120, $tim_out = 120){    
       
       // echo "Вход в функцию: ".__FUNCTION__."<br><br><br>";		

		// $url = "www.google.com";
		// $url = "https://www.google.com.ua/?gfe_rd=cr&dcr=0&ei=oSsxWsOTMOfk8Ae7-rVI&gws_rd=ssl";
		// $url = "https://ru.wikipedia.org";
		$url = "http://allhyipmon.ru";

		$conect_out = 120;
		$tim_out = 120;
		
		$proxy = "209.126.102.151:8799";

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

	        if ($proxy) {	// если прокси
	            curl_setopt($ch, CURLOPT_PROXY, $proxy);
	            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
	            curl_setopt($ch,CURLOPT_TIMEOUT, 5);
	            curl_setopt($ch, CURLOPT_FAILONERROR, true);
	            // curl_setopt($ch, CURLOPT_NOBODY, true);		//	выводит только заголовки полученных страниц
	            }    

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

        if ($result['errno'] != 0) {  // если ошибка
        	echo "<br>Код ошибки: &nbsp".$result['errmsg']; 
        	return $result;
        	}     
        
        if ($result['http_code'] != 200){
			echo "<br>Запрос по адресу: &nbsp-&nbsp".$url;
			echo "<br>&nbsp&nbsp&nbsp&nbsp Код ответа сервера: &nbsp".$result['http_code']."<br>";       // если ошибка....
			return $result;
			}

        $page = $result['content'];        // если не ошибка
   		echo $page;

   //      return $page;
      // }






?>


</body>
</html>