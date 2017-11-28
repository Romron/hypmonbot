<!DOCTYPE html>
<html>
<head>
	<title>TEST PAGE</title>
	<meta charset="utf-8">
	<meta description="Главная таблица монитора">

	<link href="css/table_css.css" rel="stylesheet">
	<?php 	include('funktions_hypmon.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>

</head>
<body>

<?php

	$page_list4hyip = GetWebPage('http://list4hyip.com');		// получаю страницу с перечнем хайпов

		// $patern_3 = '#(div class="main-col")#';		//	час,  день, неделя...
		$patern_3 = '#<b class="min">\D*(.*)\s?[\D]*<\/b>#';		//	час,  день, неделя...
			if (!preg_match_all($patern_3,$page_list4hyip,$result_3,PREG_PATTERN_ORDER)) { 
			    echo "func TEST:  patern_3 ненайден или ошибка<br>";
				// exit();
				} 		
	echo "<br>".Build_tree_arr($result_3);

?>


</body>
</html>