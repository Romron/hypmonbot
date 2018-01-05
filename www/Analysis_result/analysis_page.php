<!DOCTYPE html>
<html>
<head>
	<title>ANALYSIS_PAGE</title>
	<meta charset="utf-8">
	<meta description="Главная страница">

	<link href="css/analysis_css.css" rel="stylesheet">
	<?php 	require_once('funktions_hypmon.php');	?>
	<?php 	require_once('funktions_analysis.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>

</head>
<body>

	<div class="wrapper">

		<div class="heder">
			HEDER
		</div>

		<div class="content">
			<?php

				// echo "CONTENT";

				// $name_table = "Crypto_1";	//	Выбор таблицы в базе данных
				$name_table = "Crypto_test";	//	Выбор таблицы в базе данных
				// $name_table = "Work_table_1";	//	Выбор таблицы в базе данных
				$link_DB = conect_DB();	


				$result = querySortingFromDB($link_DB,$name_table,'Name','Date','DESC','',1);

				   // echo "<br><b> result: </b>&nbsp;&nbsp;&nbsp;&nbsp;<br>";
				   // echo Build_tree_arr($result);

			?>
		</div>

		<div class="footer">
			FOOTER
		</div>

	</div>


</body>
</html>





