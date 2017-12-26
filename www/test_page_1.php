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
	
	// // function GetWebPage_1 (){

		$curl = curl_init();
	    curl_setopt($curl, CURLOPT_COOKIESESSION, true); 
        curl_setopt($curl, CURLOPT_COOKIEJAR, __DIR__.'/cookies/cookies.txt');	    
	    curl_setopt($curl, CURLOPT_COOKIEFILE, __DIR__.'/cookies/cookies.txt'); 
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	    curl_setopt($curl, CURLOPT_HEADER, true); 
	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.0; ru; rv:1.9.1.3) Gecko/20090824 Firefox/3.5.3'); 
	    curl_setopt($curl, CURLOPT_URL, 'http://www.seobook.com/user'); 
	    $html = curl_exec($curl);


	    echo $html;

	    // preg_match('#<input type="hidden" name="form_build_id" value="(.*)"#Uis',$html, $Result_form_build_id);
	    if (!preg_match_all('#<input type="hidden" name="form_build_id" value="(.*)"#Uis',$html,$Result_form_build_id,PREG_PATTERN_ORDER)){
	    	echo "<br>ERROR<br>";
	    	}

	    $form_build_id = $Result_form_build_id[1][0];
	    

	    echo "<br><br>**********************************<br>";
	    echo $form_build_id;
	    echo "<br><br>**********************************<br>";


	    $post = "name=romron@ukr.net&pass=cFJsmHfJ59&form_build_id=".$form_build_id."&form_id=user_login&op=Log in";

	    curl_setopt($curl, CURLOPT_URL, 'http://www.seobook.com/user/romron');
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
	    
	    $html = curl_exec($curl);
	    echo $html;

	    echo "<br><br><br>=================================================================================================================<br><br><br>";

	    curl_setopt($curl, CURLOPT_URL, 'http://tools.seobook.com/keyword-tools/seobook');
	    $html = curl_exec($curl);
	    echo $html;
		// }









	// $key = "Bitcoin";
	// // $key = urlencode("биткоин");
	
	// $str_2 = "http://tools.seobook.com/keyword-tools/seobook/?keyword=";
	// // $str_2 = "http://google.com";

	// $url_2 = $str_2.$key;


	// $page_2 = GetWebPage($url_2);

	// echo $page_2;
	// echo "<br><br>*********************************************************************<br><br>";
	// echo $url_2."<br><br>";














?>


</body>
</html>