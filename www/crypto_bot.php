<!DOCTYPE html>
<html>
<head>
	<title>CRYPTO TABLE</title>
	<meta charset="utf-8">
	<meta description="Главная таблица CRYPTO">

	<link href="css/table_css.css" rel="stylesheet">
	<?php 	include('funktions_hypmon.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>
	<!-- <script src="js/funktions.js"></script> -->
	<script src="js/FixHeaderCol.js"></script>

	<script type="text/javascript">
	  function digitalWatch() {
	    var date = new Date();
	    var hours = date.getHours();
	    var minutes = date.getMinutes();
	    var seconds = date.getSeconds();
	    if (hours < 10) hours = "0" + hours;
	    if (minutes < 10) minutes = "0" + minutes;
	    if (seconds < 10) seconds = "0" + seconds;
	    document.getElementById("digital_watch").innerHTML = hours + ":" + minutes + ":" + seconds;
	    setTimeout("digitalWatch()", 1000);
	  }

	</script>
</head>
<body>

	<!-- Блок кнопок -->
		<!-- хочу на javascript -->
	<!-- /Блок кнопок -->  

	<!-- Шапка таблицы --> 
		<!-- хочу на javascript -->
	<!-- /Шапка таблицы -->

	

	<?php  
	$str = "https://prostocoin.com/marketcap&page=";
	$patern_1 = '#<tr>\n*.*\n.*<td.*>(.*)<\/a>.*\n.*<td>\$(.*)<\/td>.*\n.*<td>\$(.*)<\/td>#'; 		//	название валюты 
	
	for ($i=1; $i < 2 ; $i++) { 
		$url = $str.$i;
		$page = GetWebPage($url);

		if (!preg_match_all($patern_1,$page,$result_1,PREG_PATTERN_ORDER)) { 
		    echo "ERR &nbsp;".__FUNCTION__."patern_1 ненайден";		
			} 

		}



		echo Build_tree_arr($result_1);
		// print_r($result_1);

	?>
	
	
	<!-- то же в пайтоне -->





	</table>

	


</body>
</html>