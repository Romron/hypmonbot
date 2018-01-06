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
	?>	
<body>

	<div class="wrapper_top">

		<div class="heder"> HEDER </div>
		<div id="content_block_switch"> BLOCK_SWITCH </div>

			<div id="table_1">
				<?php echo "<table>"; ?>
				<?php 

					foreach ($result[0] as $key => $value) {
						if ($key == $sorting_field) {
							$th_str = '<th class="sorting">';
						}elseif ($key == $main_field){
							$th_str = '<th class="main_sorting">';
							}else{$th_str = '<th>';}					
						echo $th_str.$key."</th>";
						}
				?>
				<?php echo "</table>";  ?>
			</div> <!-- table_1 -->	

	</div>

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





