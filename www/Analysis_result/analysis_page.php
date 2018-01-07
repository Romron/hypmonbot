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
	<?php
		// $name_table = "Crypto_1";	//	Выбор таблицы в базе данных
		$name_table = "Crypto_test";	//	Выбор таблицы в базе данных
		// $name_table = "Work_table_1";	//	Выбор таблицы в базе данных
		$link_DB = conect_DB();	
		$result = querySortingFromDB($link_DB,$name_table,'Name','Exchange','DESC','',0);
		$char_arr = array('+','%','_');		// массив символов для удаления

	?>
<body>

	<div id="wrapper_top">

		<div id="heder"> HEDER </div>
		<div id="content_block_switch"> BLOCK_SWITCH</div>
		<div id="table_hed">
			<?php 
				foreach ($result[0] as $key => $value) {
					$n_col_th++;
					$key = str_replace($char_arr," ",$key);
					echo '<div class="col_'.$n_col_th.' th_div">';	
						echo $key;
					echo "</div>";
					}
			?>
		</div>
	</div>

	<div id="wrapper_bottom">
		<div id="table_body">
			<?php 
				for ($q=0; $q < count($result); $q++) { 
					echo '<div class="tr_div">';
					foreach ($result[$q] as $key_2 => $value_2) {
						$n_col_td++;
						$value_2 = str_replace($char_arr," ",$value_2);
						echo '<div class="col_'.$n_col_td.' td_div">';	
							echo $value_2;
						echo "</div>";
						}
					$n_col_td=0;
					echo "</div>";
					}
			?>
			
		</div>
	</div>

	


</body>
</html>





