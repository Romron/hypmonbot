<!DOCTYPE html>
<html>
<head>
	<title>TEST PAGE</title>
	<meta charset="utf-8">
	<meta description="Главная страница">

	<link href="css/analysis_css_1.css" rel="stylesheet">
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
		$result = querySortingFromDB($link_DB,$name_table,'Name','Date','DESC','',0);
		$heders_col = array('id','Дата','Нозвание','Капитализация','Курс','Частотность','Частотность',
			'Частотность <br> за месяц','Частотность <br> за день','Частотность <br> гугл','Кол-во бирж','Дата выхода <br> на торги','Цена на <br> момент выхода','Цена сегодня','Разница цен');
	?>	
<body>

	<div class="wrapper_top">

		<div class="heder"> HEDER </div>
		<div id="content_block_switch"> BLOCK_SWITCH </div>

		<div id="table_1">
			

			<?php 
				foreach ($heders_col as $value) {
					$th_n++;
					// if ($key == $sorting_field) {
					// 	$th_str = '<th id="'.$th_n.'" class="sorting">';
					// }elseif ($key == $main_field){
					// 	$th_str = '<th id="'.$th_n.'" class="main_sorting">';
					// 	}else{$th_str = '<th>';}					
					// echo $th_str.$key."</th>";
					// if ($th_n>3) { break; }
					echo '<div id="th_'.$th_n.'" class="td_class">'.$value.'</div>';
					}
			?>
			
		</div> <!-- table_1 -->	

	</div> <!-- wrapper_top -->

	<div class="wrapper_bottom">
		<div id="tbody_for_table_2">
			<div id="table_2">
				<?php echo "<table>"; ?>
					<?php 
						// echo "<tr><td>TBODY</td></tr>";
						for ($q=0; $q < count($result); $q++) { 
							echo "<tr>";
							foreach ($result[$q] as $key_2 => $value_2) {
								// if ($key_2 == $sorting_field) {
								// 	$td_str = '<td class="sorting">';
								// }elseif ($key_2 == $main_field){
								// 	$td_str = '<td class="main_sorting">';
								// 	}else{$td_str = '<td>';}
								// echo $td_str;
								echo "<td>";	
									echo $value_2;
								echo "</td>";
								}
							echo "</tr>";
							}
					?>
				<?php echo "</table>";  ?>
			</div> <!-- table_2 -->
		</div>	


			<div class="footer">FOOTER</div>
	</div>

	


</body>
</html>





