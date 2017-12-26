<!DOCTYPE html>
<html>
<head>
	<title>TEST PAGE 1</title>
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
	
	// // // function GetWebPage_1 (){

	// 	$curl = curl_init();
	//     curl_setopt($curl, CURLOPT_COOKIESESSION, true); 
 //        curl_setopt($curl, CURLOPT_COOKIEJAR, __DIR__.'/cookies/cookies.txt');	    
	//     curl_setopt($curl, CURLOPT_COOKIEFILE, __DIR__.'/cookies/cookies.txt'); 
	//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	//     curl_setopt($curl, CURLOPT_HEADER, true); 
	//     curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
	//     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	//     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	//     curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.0; ru; rv:1.9.1.3) Gecko/20090824 Firefox/3.5.3'); 
	//     curl_setopt($curl, CURLOPT_URL, 'http://www.seobook.com/user'); 
	//     $html = curl_exec($curl);


	//     echo $html;

	//     // preg_match('#<input type="hidden" name="form_build_id" value="(.*)"#Uis',$html, $Result_form_build_id);
	//     if (!preg_match_all('#<input type="hidden" name="form_build_id" value="(.*)"#Uis',$html,$Result_form_build_id,PREG_PATTERN_ORDER)){
	//     	echo "<br>ERROR<br>";
	//     	}

	//     $form_build_id = $Result_form_build_id[1][0];
	    

	//     echo "<br><br>**********************************<br>";
	//     echo $form_build_id;
	//     echo "<br><br>**********************************<br>";


	//     $post = "name=romron@ukr.net&pass=cFJsmHfJ59&form_build_id=".$form_build_id."&form_id=user_login&op=Log in";

	//     curl_setopt($curl, CURLOPT_URL, 'http://www.seobook.com/user/romron');
	//     curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
	    
	//     $html = curl_exec($curl);
	//     echo $html;

	//     echo "<br><br><br>=================================================================================================================<br><br><br>";

	//     curl_setopt($curl, CURLOPT_URL, 'http://tools.seobook.com/keyword-tools/seobook');
	//     $html = curl_exec($curl);
	//     echo $html;
	// 	// }



	$headers = array(		// только для обращения по адресу: http://tools.seobook.com/keyword-tools/seobook/?keyword=
		'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
		'Accept-Encoding:gzip, deflate',
		'Accept-Language:ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
		'Cache-Control:max-age=0',
		'Connection:keep-alive',
		'Cookie:MintAcceptsCookies=1; MintUnique=1; MintUniqueDay=1514260800; MintUniqueWeek=1514088000; MintUniqueMonth=1512100800; MintUniqueLocation=1; _ga=GA1.2.1582748074.1514273105; _gid=GA1.2.378127518.1514273105; MintCrush=2005843086; SESSe0033d505970ff0ab6bd1d798ecad786=89N4k3jHPfZbiWQXT0-NfuCg9eozsiS49B44XUtuamA; MintUniqueHour=1514296800',
		'Host:tools.seobook.com',
		'Upgrade-Insecure-Requests:1',
		'User-Agent:Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'
		);

	$result_2 = array();

	// $key = "bitcoin";
	// $key = "bitcoin+cash";
	$key = "litecoin";
	// $key = "steem";

	// $key = urlencode("биткоин");
	
	$str_2 = "http://tools.seobook.com/keyword-tools/seobook/?keyword=";
	$url_2 = $str_2.$key;
	$page_2 = GetWebPage($url_2,$headers);

	echo $page_2;
	echo "<br><br>*********************************************************************<br><br>";
	echo $url_2."<br><br>";


	$patern_2_1 = '#>'.$key.'<\/a><\/td>\n.*<td>(.*)<\/td>#';
	if (!preg_match_all($patern_2_1,$page_2,$result_2_1,PREG_PATTERN_ORDER)) { 
	    echo "func: &nbsp;".__FUNCTION__."&nbsp; patern_2_1 ненайден или ошибка";
		}	

	$patern_2_2 = '~<td><a href="https:\/\/www\.google\.com\/#q='.$key.'".*>(.*)<\/a><\/td>~';
	if (!preg_match_all($patern_2_2,$page_2,$result_2_2,PREG_PATTERN_ORDER)) { 
	    echo "func: &nbsp;".__FUNCTION__."&nbsp; patern_2_2 ненайден или ошибка";
		}	

	$patern_2_3 = '~<td><a href="https:\/\/www\.google\.us\/#q='.$key.'" rel="nofollow" target="_blank">(.*)<\/a>~';
	if (!preg_match_all($patern_2_3,$page_2,$result_2_3,PREG_PATTERN_ORDER)) { 
	    echo "func: &nbsp;".__FUNCTION__."&nbsp; patern_2_3 ненайден или ошибка";
		} 

	array_push($result_2,$result_2_1[1][0],$result_2_2[1][0],$result_2_3[1][0]);

	echo "<br>=========================================================================<br>".Build_tree_arr($result_2);








?>


</body>
</html>