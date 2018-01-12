<?php if (isset($_POST["clear_test_1"])) {
	header("location:test_page.php");
} ?>

<!DOCTYPE html>
<html>
<head>
	<title>TEST_PAGE</title>
	<meta charset="utf-8">
	<meta description="Главная страница">

	<link href="css/analysis_css_test_1.css" rel="stylesheet">
	<?php 	require_once('funktions_hypmon.php');	?>
	<?php 	require_once('funktions_analysis.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>

</head>
	<?php
		$char_arr = array('+','%','_');		// массив символов для удаления
		$name_table = "Crypto_1";	//	Выбор таблицы в базе данных
		// $name_table = "Crypto_test";	//	Выбор таблицы в базе данных
		// $name_table = "Work_table_1";	//	Выбор таблицы в базе данных
		$link_DB = conect_DB();	
		$result = querySortingFromDB($link_DB,$name_table,'id','Capitalization','DESC','',0);
		$arr_keys = array_keys($result[0]);
	?>

<body>


	<div id="wrapper_top">

		<div id="heder">
		<div id="inform_left"> <?php echo Build_tree_arr($_POST); ?> </div>
		<div id="inform_centr"> HEDER </div>
		<div id="inform_right"><span><b>Текущая таблица базы данных:</b> <?php echo $name_table; ?></span></div>

		</div>

		<!-- <form name="test_1" action="test_page.php" method="post"> -->
		<form name="test_1" action="" method="post">

		<div id="table_hed">
			<?php 
				foreach ($result[0] as $key => $value) {
					$n_col_th++;
					// Выбраные колонки выделяем отдельным цветом
						if ($key == $arr_keys[($_POST['sort']-1)]) {
							$div_str = 'sort';
						}elseif ($key == $arr_keys[($_POST['group']-1)]){
							$div_str = 'group';
							}else{$div_str = '';}
					$key = str_replace($char_arr," ",$key);	// только для вывода на экран
					// echo '<div class="col_'.$n_col_th.' th_div '.$div_str.'">';	
					echo '<div class="col_ th_div '.$div_str.'" id="th_div_'.$n_col_th.'">';	//+++++++++++++++++++++++++++++++
				echo $key;
				echo '<div class="div_switch_th"> 
						<input type="radio" class="radio_gs" name="group" id="group_'.$n_col_th.'" value="'.$n_col_th.'"/>
							<label for="group_'.$n_col_th.'" class="label_group"></label>
					 	<input type="radio" class="radio_gs" name="sort" id="sort_'.$n_col_th.'" value="'.$n_col_th.'"/> 
							<label for="sort_'.$n_col_th.'" class="label_sort"></label>						
						<input type="radio" class="radio_gs" name="oder_sort" id="oder_sort_'.$n_col_th.'" value="'.$n_col_th.'"/>
							<label for="oder_sort_'.$n_col_th.'" class="label_oder_sort"></label> 
					  </div>';
						
					echo "</div>";
					}
			?>
		</div>
		<div id="block_switch"> <!-- BLOCK_SWITCH -->
			<?php 
				for ($b_s=1; $b_s < (count($result[0])+1); $b_s++) { 
					// Выбраные колонки выделяем отдельным цветом
						if ($b_s == ($_POST['sort'])) {
							$div_str = 'sort';
						}elseif ($b_s == ($_POST['group'])){
							$div_str = 'group';
							}else{$div_str = '';}
					echo '<div class="col_ th_div '.$div_str.' " id="b_s_div_'.$b_s.'">';	
						echo $b_s;
					echo "</div>";
				}
			?>
			<div id="div_submit_test_1">
				<input type="submit" name="submit_test_1" value="submit" />
				<input type="submit" name="clear_test_1" value="clear" />


			</div>
		</div>
		</form>
	</div>



	<div id="wrapper_bottom">
		
		<script type="text/javascript">  // плавающий wrapper_bottom 
			var wrapper_top_style = getComputedStyle(document.getElementById("wrapper_top"));	// получаю элемент в целом как объект и сразу же все расчитанные для него css свойства 
			var wrapper_bottom = document.getElementById("wrapper_bottom");	// получаю элемент в целом как объект
			wrapper_bottom.style.top = wrapper_top_style.height;	// устанавливаю новое значение свойства
			</script>

		<div id="table_body">
			<?php 
				if (isset($_POST["submit_test_1"])) {
					
					
					if (isset($_POST['oder_sort'])) {
						$oder_sort = 'DESC';
					}else{ $oder_sort = 'ASC'; }

					$result = querySortingFromDB($link_DB,$name_table,$arr_keys[$_POST['group']],$arr_keys[$_POST['sort']],$oder_sort,'',0);
					
					for ($q=0; $q < count($result); $q++) { 
						echo '<div class="tr_div">';
						foreach ($result[$q] as $key_2 => $value_2) {
							$n_col_td++;
							$value_2 = str_replace($char_arr," ",$value_2);

						// Выбраные колонки выделяем отдельным цветом
						if ($key_2 == $arr_keys[($_POST['sort']-1)]) {
							$div_str = 'sort';
						}elseif ($key_2 == $arr_keys[($_POST['group']-1)]){
							$div_str = 'group';
							}else{$div_str = '';}

							echo '<div class="col_'.$n_col_td.' td_div '.$div_str.'" id="td_div_'.$q.'">';	
								echo $value_2;
							echo "</div>";
							}
						$n_col_td=0;
						echo "</div>";
						}

				}		
			?>
			
		</div>
	</div>


		<script type="text/javascript">  // плавающий ширина колонок 		+++++++++++++++++++++++++++++++++++++++++
			
			for (var i = 1; i < 15; i++) {
				
				var th_div = document.getElementById('th_div_'+i);
				var b_s_div = document.getElementById("b_s_div_"+i);
				var td_div = document.getElementById("td_div_"+i);

				var th_w = th_div.clientWidth;
				
				b_s_div.style.width = th_w+'px';
				td_div.style.width = th_w+'px';

				var b_s_w = b_s_div.clientWidth;
				var td_div_w = td_div.clientWidth;

				console.log(i+'. ширина '+th_div+' = '+th_w);
				console.log(i+'. ширина '+b_s_div+' = '+b_s_w);
				console.log(i+'. ширина '+td_div+' = '+td_div_w);

				

				}

			</script>




</body>


</html>





