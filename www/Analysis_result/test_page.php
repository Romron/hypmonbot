

<!DOCTYPE html>
<html>
<head>
	<title>TEST_PAGE</title>
	<meta charset="utf-8">
	<meta description="Главная страница">

	<link href="css/analysis_css_test.css" rel="stylesheet">
	<?php 	require_once('funktions_hypmon.php');	?>
	<?php 	require_once('funktions_analysis.php');	?>
	<?php 	require_once('test_page_1.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>

</head>
	<?php
		session_start();
		// global $result;
		// // $name_table = "Crypto_1";	//	Выбор таблицы в базе данных
		// $name_table = "Crypto_test";	//	Выбор таблицы в базе данных
		// // $name_table = "Work_table_1";	//	Выбор таблицы в базе данных
		// $link_DB = conect_DB();	
		// $result = querySortingFromDB($link_DB,$name_table,'id','Capitalization','DESC','',0);
		$char_arr = array('+','%','_');		// массив символов для удаления
		$result = $_SESSION['result'];
	?>
<body>

	<div id="wrapper_top">

		<div id="heder"> HEDER
				<?php 
					// if (count($_POST) > 0) {
					// 	echo Build_tree_arr($_POST);
					// 	}else{
					// 	}
				?>

		</div>
		<!-- <form name="test_1" action="test_page.php" method="post"> -->
		<form name="test_1" action="test_page_1.php" method="post">
		<div id="table_hed">
			<?php

				foreach ($result[0] as $key => $value) {
					$n_col_th++;
					$key = str_replace($char_arr," ",$key);
					echo '<div class="col_'.$n_col_th.' th_div">';	
						// Скрытые под текс чекбоксы
						echo '<input id="id_'.$n_col_th.'" type="checkbox" name="'.$n_col_th.'" value="true"  />';
						echo '<label for="id_'.$n_col_th.'">'.$key.'</label>';
					echo "</div>";
					}
			?>

		</div>
		<div id="block_switch"> <!-- BLOCK_SWITCH -->
			<?php 
				for ($b_s=1; $b_s < (count($result[0])+1); $b_s++) { 
					echo '<div class="col_'.$b_s.' th_div">';	
						echo $b_s;
					echo "</div>";
				}


			?>
			<input type="submit" name="submit_test_1" value="Submit" />
		</div>
		</form>
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





