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
	<script src="js/FixHeaderCol.js"></script>

</head>
<body>

	<script type="text/javascript">
		
	</script>


	<!-- Блок кнопок -->
		<div id="BlocButton">
			<button id="UpdateListHyp" onclick="FixHeaderCol(gid('tabl_1'),4,3,1500,2000)">
				Обновить список хайпов
			</button>			
			<button class="UpdateParamHyp">
				Обновить параметры хайпов
			</button>
		</div>
	<!-- /Блок кнопок -->


	<!-- Шапка таблицы -->
		<table class="main_tabl" id="tabl_1">
			<tr class="HedTab">
				<th rowspan="4">
					<p class="vertical"> Номер п/п </p>
				</th>			
				<th rowspan="4">
					<p class="vertical"> Монитор </p>
				</th>
				<th rowspan="4">
					ПРОЭКТ
				</th>
				<th colspan="11">
					http://pr-cy.ru/
				</th>
				<th colspan="12">
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
				<th rowspan="3">
					<p class="vertical"> Возраст </p>
				</th>
				<th rowspan="3">
					<p class="vertical"> Продлён </p>
				</th>
				<th colspan="5">
					Популярность
				</th>
				<th colspan="2">
					География трафика 
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
				<th colspan="2">
					Global Rank
				</th>
				<th colspan="3">
					Rank in country
				</th>
				<th rowspan="2">
					<p class="vertical"> Максимум из </p>
				</th>
				<th rowspan="2">
					%
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
					<p class="vertical"> Динамика </p>
				</th>
				<th>
					<p class="vertical"> Страна </p>
				</th>
				<th>
					<p class="vertical"> Значение </p>
				</th>
				<th>
					<p class="vertical"> Динамика </p>
				</th>																						
			</tr>

	<!-- /Шапка таблицы -->

	<?php  
		for ($i=0; $i < 20; $i++) {			//	для тестов
			echo '<tr>';
				echo '<td>
					<p>'.$i.'</p>
					</td>';
			echo 
				'<td>
					
				</td>';
					echo '<td>
							<p class="NameHyp"></p>
							</td>';
				for ($q=0; $q < 26; $q++) { 
					echo '<td>';
						echo '<p></p>';

					echo "</td>";
					}
			echo '</tr>';
			}

		

	?>
		</table>
			<!-- </div> -->
	<!-- </div> -->

	


</body>
</html>