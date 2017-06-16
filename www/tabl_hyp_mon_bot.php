<!DOCTYPE html>
<html>
<head>
	<title>MAIN TABLE</title>
	<meta charset="utf-8">
	<meta description="Главная таблица монитора">

	<link href="css/table_css.css" rel="stylesheet">
	<?php 	include('funktions_hypmon.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>
	<script src="js/funktions.js"></script>


</head>
<body>



	<table class="main_tabl">

	<!-- Блок кнопок -->
		<div class="BlocButton">
			<button class="UpdateListHyp">

				Обновить список хайпов
			</button>			
			<button class="UpdateParamHyp">
				Обновить параметры хайпов
			</button>
		</div>
	<!-- /Блок кнопок -->

	<!-- Шапка таблицы -->
		<thead id="Shapka_table">	
			<tr>
				<td rowspan="5">
					<p class="vertical"> Номер п/п </p>
				</td>			
				<td rowspan="5">
					<p class="vertical"> Монитор </p>
				</td>
				<td rowspan="5">
					ПРОЭКТ
				</td>
				<td colspan="9">
					http://pr-cy.ru/
				</td>
				<td colspan="8">
					http://www.alexa.com/siteinfo
				</td>
				<td colspan="3">
					https://www.nic.ru/whois/
				</td>																							
			</tr>
			<tr>
				<td rowspan="3">
					ТИЦ 
				</td>
				<td colspan="4">
					Страницы
				</td>
				<td rowspan="3">
					<p class="vertical"> Просмотры, шт. </p>
				</td>
				<td rowspan="3">
					<p class="vertical"> max трафик из </p>
				</td>
				<td colspan="2">
					Baclink
				</td>			




				<td colspan="3">
					Популярность
				</td>
				<td colspan="3">
					Активность пользователей
				</td>
				<td rowspan="3">
					<p class="vertical"> Процент поискового трафика </p>
				</td>
				<td rowspan="3">
					<p class="vertical"> baclink </p>
				</td>
				<td rowspan="3">
					<p class="vertical"> Дата  регистрации домена </p>
				</td>
				<td rowspan="3">
					<p class="vertical">  Дата окончания домена </p>
				</td>
				<td rowspan="3">
					<p class="vertical"> Дата обновления домена </p>
				</td>																						
			</tr>
			<tr>
				<td colspan="2">
					Яндекс
				</td>
				<td colspan="2">
					Google
				</td>
				<td rowspan="2">
					<p class="vertical"> Страницы </p>
				</td>			
				<td rowspan="2">
					<p class="vertical"> Домены </p>
				</td>
				<td >
					Global Rank
				</td>
				<td colspan="2">
					Rank in country
				</td>
				<td rowspan="2">
					<p class="vertical"> Показатель отказов </p>
				</td>
				<td rowspan="2">
					<p class="vertical"> Страниц за везит </p>
				</td>
				<td rowspan="2">
					<p class="vertical"> Ср. продолжит визита, м-с </p>
				</td>																		
			</tr>
			<tr>
				<td>
					шт.
				</td>
				<td>
					<p class="vertical">  Динамика </p>
				</td>
				<td>
					<p class="vertical"> шт. </p>
				</td>
				<td>
					<p class="vertical"> Динамика </p>
				</td>

				<td>
					<p class="vertical"> Значение </p>
				</td>

				<td>
					<p class="vertical"> Страна </p>
				</td>
				<td>
					<p class="vertical"> Значение </p>
				</td>
																							
			</tr>
			<tr>
		
				<?php 
					for ($i=0; $i<20; $i++){
					echo "<td class='Namber_column'>".$i."</td>";
				} ?>
							
								
			</tr>
		</thead>	
	<!-- /Шапка таблицы -->
		


	<?php  
		set_time_limit(0);
		$ArrNameHyp = GetHypNam();


		for ($i=0; $i < count($ArrNameHyp); $i++) {	// основной вариант
		// for ($i=0; $i < 5; $i++) {			//	для тестов
			

				if (is_array($ArrNameHyp[$i])) {
						$HypName = $ArrNameHyp[$i][1];
						$HypCount = $ArrNameHyp[$i][2];					
					echo '<tr>';
						echo '<td class="NameHyp_Col" rowspan='.$HypCount.'>
							<p class="vertical">'.$HypName.'</p>
							</td>';
					continue;						
					}
					echo 
						'<td>
							'.$i.'
						</td>';
							echo '<td>
									<p class="NameHyp">'.$ArrNameHyp[$i].'</p>
									</td>';

						$patern_URL = '#https?:\/\/(.*)/#'; 				
						if (!preg_match_all($patern_URL,$ArrNameHyp[$i],$result_str_name_site,PREG_PATTERN_ORDER)) { 
						    echo "patern_URL ненайден или ошибка";
						    return false;
							} 



						$ArrParamHype = ParsParamHaypWithServAnalSite($result_str_name_site[1][0]);
						for ($q=0; $q < 20; $q++) { 
							echo "<td>";
								echo '<p class="ParamHyp">'.strip_tags($ArrParamHype[$q]).'</p>';

							echo "</td>";
							}
					echo '</tr>';
			}
	?>


	</table>


</body>
</html>