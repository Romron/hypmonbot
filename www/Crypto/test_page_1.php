<!DOCTYPE html>
<html>
<head>
	<title>TEST PAGE 1****</title>
	<meta charset="utf-8">
	<meta description="Главная таблица монитора">

	<!-- <link href="css/table_css.css" rel="stylesheet"> -->

	<!-- <link rel="canonical" href="https://ru.semrush.com/info/Bitcoin+%28keyword%29"> -->

	<?php 	include('funktions_hypmon.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>

</head>
<body>

<?php
	// первый запрос: сортировка по СY по убыванию, и групировка по project, что бы исключить повторы, результаты в $result_arr.
	// второй запрос: WHERE = '.$result_arr[0][project].' т.е. выбираем все строки в которых поле project равно наидольшему CY и т.д.

	$name_table = "Work_table_1";	//	Выбор таблицы в базе данных
	$link_DB = conect_DB();	
	$sorting_field = 'page_yndex_pc';


    $query_1 = "SELECT * FROM `".$name_table."` 		
    			GROUP BY ".$sorting_field."
    			ORDER BY baclink_alexa DESC
    			";	  	    

    // отправка ПЕРВОГО запроса 
	   	$result_query_SQL = mysqli_query($link_DB,$query_1);
	    if (!$result_query_SQL) {
	    	echo "<br><br><b><font color='red'>".__FUNCTION__."Query failed : " . mysqli_error($link_DB)."</font></b>";	
	    	exit();
	    	}     

    // оброботка ПЕРВОГО ответа сервера
		for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) {
	    	if ($i>500) { break; }
	   		$result_1[] = mysqli_fetch_assoc($result_query_SQL);
	    	}


	for ($z=0; $z < count($result_1); $z++) { 

	    $query_2 = "SELECT * FROM `".$name_table."` 
	    			WHERE `".$sorting_field."` = '".$result_1[$z][$sorting_field]."'
	    			";


	    // $query_2 = "SELECT * FROM `".$name_table."` 
	    // 			WHERE project = '".$result_1[$z][project]."'
	    // 			";	
	    


	    // отправка ВТОРОГО запроса 
		   	$result_query_SQL = mysqli_query($link_DB,$query_2);
		    if (!$result_query_SQL) {
		    	echo "<br><br><b><font color='red'>".__FUNCTION__."Query failed : " . mysqli_error($link_DB)."</font></b>";	
		    	exit();
		    	}    

	    // оброботка ВТОРОГО ответа сервера
			for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) {
		    	// if ($i>5000) { break; }
		   		$result_2[] = mysqli_fetch_assoc($result_query_SQL);
		    	}
		}

	// вывод результатов в виде таблицы
		echo "<table>";
			foreach ($result_2[0] as $key => $value) {
				echo "<th>".$key."</th>";
				}

			for ($q=0; $q < count($result_2); $q++) { 
				echo "<tr>";
				foreach ($result_2[$q] as $value) {
					echo "<td>";
						echo $value;
					echo "</td>";
					}
				echo "</tr>";
				}
		echo "</table>";



?>


</body>
</html>