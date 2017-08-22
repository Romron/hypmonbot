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
	<!-- <script src="js/funktions.js"></script> -->
	<script src="js/FixHeaderCol.js"></script>

</head>
<body>

	<!-- Блок кнопок -->
		<!-- 		<div id="BlocButton">
			<button id="Fix_table_header" onclick="FixHeaderCol(gid('tabl_1'),5,3,1500,2000)">
				Закрипить шапку таблицы
			</button>			
			
			<button id="Export_in_Excel" onclick="location.href='export_in_excel.php'">
				Экспортировать в Эксель
			</button>			

			<button id="Start">
				Начать сбор данных
			</button>
		</div> -->
	<!-- /Блок кнопок -->  

	<!-- Шапка таблицы -->
		<!-- 
		<table class="main_tabl" id="tabl_1">
				<tr>
					<th rowspan="5" class="NameHyp_Col" id="Had_NameHyp_Col">
						<p class="vertical"> Монитор </p>
					</th>			
					<th rowspan="5">
						<p class="vertical"> Номер п/п </p>
					</th>
					<th rowspan="5">
						ПРОЭКТ
					</th>
					<th colspan="9">
						http://pr-cy.ru/
					</th>
					<th colspan="8">
						http://www.alexa.com/siteinfo
					</th>
					<th colspan="3">
						https://www.nic.ru/whois/
					</th>																							
				</tr>
				<tr>
					<th rowspan="3">
						ТИЦ 
					</th>
					<th colspan="4">
						Страницы
					</th>
					<th rowspan="3">
						<p class="vertical"> Просмотры, шт. </p>
					</th>
					<th rowspan="3">
						<p class="vertical"> max трафик из </p>
					</th>
					<th colspan="2">
						Baclink
					</th>			
					<th colspan="3">
						Популярность
					</th>
					<th colspan="3">
						Активность пользователей
					</th>
					<th rowspan="3">
						<p class="vertical"> Процент поискового трафика </p>
					</th>
					<th rowspan="3">
						<p class="vertical"> baclink </p>
					</th>
					<th rowspan="3">
						<p class="vertical"> Дата  регистрации домена </p>
					</th>
					<th rowspan="3">
						<p class="vertical">  Дата окончания домена </p>
					</th>
					<th rowspan="3">
						<p class="vertical"> Дата обновления домена </p>
					</th>																						
				</tr>
				<tr>
					<th colspan="2">
						Яндекс
					</th>
					<th colspan="2">
						Google
					</th>
					<th rowspan="2">
						<p class="vertical"> Страницы </p>
					</th>			
					<th rowspan="2">
						<p class="vertical"> Домены </p>
					</th>
					<th >
						Global Rank
					</th>
					<th colspan="2">
						Rank in country
					</th>
					<th rowspan="2">
						<p class="vertical"> Показатель отказов </p>
					</th>
					<th rowspan="2">
						<p class="vertical"> Страниц за везит </p>
					</th>
					<th rowspan="2">
						<p class="vertical"> Ср. продолжит визита, м-с </p>
					</th>																		
				</tr>
				<tr>
					<th>
						шт.
					</th>
					<th>
						<p class="vertical">  Динамика </p>
					</th>
					<th>
						<p class="vertical"> шт. </p>
					</th>
					<th>
						<p class="vertical"> Динамика </p>
					</th>

					<th>
						<p class="vertical"> Значение </p>
					</th>

					<th>
						<p class="vertical"> Страна </p>
					</th>
					<th>
						<p class="vertical"> Значение </p>
					</th>
																								
				</tr>
				<tr>
			
					<?php 
						// for ($i=0; $i<20; $i++){
						// echo "<td class='Namber_column'>".$i."</td>";
						// } 
					?>
								
									
				</tr>
 		-->
	<!-- /Шапка таблицы -->




	<?php  

			// $URL = "https://bitmakler.com/investmentfund";
			// $URL = "https://bitmakler.com/";
			
			// $URL = "http://allhyipmon.ru/rating";
			// $URL = "http://list4hyip.com/";


			$URL = "http://rian.com.ua";
			

			$page = GetWebPage($URL);
			echo $page;
			


			// set_time_limit(0);
			// $ArrNameHyp = GetHypNam();

			
			// $link_DB = conect_DB();		// наполнение результатами БД
			// // queryInputIntoDB($link_DB,$ArrNameHyp);
			
			
			// // наполнение результатами таблицы на html странице 
			// for ($i=0; $i < count($ArrNameHyp); $i++) {	// основной вариант
			// // for ($i=0; $i < 11; $i++) {			//	для тестов
				
			// 		if (is_array($ArrNameHyp[$i])) {
			// 				$HypMonName = $ArrNameHyp[$i][1];
			// 				$HypCount = $ArrNameHyp[$i][2];					
			// 			echo '<tr>';
			// 				echo '<td class="NameHyp_Col" rowspan='.$HypCount.'>
			// 					<p class="vertical">'.$HypMonName.'</p>
			// 					</td>';
			// 			continue;						
			// 			}
			// 			echo 
			// 				'<td>
			// 					'.$i.'
			// 				</td>';
			// 					echo '<td>
			// 							<p class="NameHyp">'.$ArrNameHyp[$i].'</p>
			// 							</td>';
			// 				$patern_URL = '#(?:https?:\/\/)?[w]{0,3}\.?(.*)/?#'; 				
			// 				if (!preg_match_all($patern_URL,$ArrNameHyp[$i],$result_str_name_site,PREG_PATTERN_ORDER)) { 
			// 				    echo "patern_URL ненайден или ошибка";
			// 				    return false;
			// 					} 
							
			// 				$ArrParamHype = ParsParamHaypWithServAnalSite($result_str_name_site[1][0]);
							
			// 				queryInputIntoDB($link_DB,$HypMonName,$ArrNameHyp[$i],$ArrParamHype);
							
			// 				for ($q=0; $q < 20; $q++) { 
			// 					echo "<td>";
			// 				if (strpos($ArrParamHype[$q],"ERR")) { 
			// 						echo '<p class="err_mess">'.$ArrParamHype[$q].'</p>';
			// 					}else{
			// 						echo '<p class="ParamHyp">'.trim(strip_tags($ArrParamHype[$q])).'</p>';
			// 						}
			// 					echo "</td>";
			// 					}
			// 			echo '</tr>';
			// 	}
	
			// 	mysqli_close($link_DB);

	


	?>
	
	






	</table>

	


</body>
</html>