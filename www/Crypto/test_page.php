<!DOCTYPE html>
<html>
<head>
	<title>TEST PAGE</title>
	<meta charset="utf-8">
	<meta description="Страница для тестов">

	<link href="css/table_css.css" rel="stylesheet">
	<?php 	include('funktions_hypmon.php');	?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/jquery-3.1.1.js"></script>

</head>
<body>

<?php
	// // ====================== MySQL запросы ======================


		$name_table = "Crypto_1";	//	Выбор таблицы в базе данных
		// $name_table = "Crypto_test";	//	Выбор таблицы в базе данных
		// $name_table = "Work_table_1";	//	Выбор таблицы в базе данных
		// $name_table = "Work_table_3";	//	Выбор таблицы в базе данных
		$link_DB = conect_DB();	

		

		$result = querySortingFromDB($link_DB,$name_table,'Name','Capitalization','DESC','',1);

	    // echo "<br><b> result: </b>&nbsp;&nbsp;&nbsp;&nbsp;<br>";
	    // echo Build_tree_arr($result);












	// 	// текст запроса

	//     // $query = "SELECT 1+1 AS Result";
	//     // $query = "SELECT * FROM `".$name_table."`";
	//     // $query = "SELECT id, Date FROM `".$name_table."`";
	//     // $query = "SELECT id AS N, Date AS QQ FROM `".$name_table."`";
	//     // $query = "SELECT id, Date, Name, Frequency_1 FROM `".$name_table."` 
	//     			// ORDER BY Name DESC
	//     			// LIMIT 10,100";	    

	//     // $query = "SELECT id, Date, Name, Frequency_1 FROM `".$name_table."` 
	//     // 			WHERE Frequency_1 > 0
	//     // 			ORDER BY Name 
	//     // 			";	    

	//     // $query = "SELECT DISTINCT Name FROM `".$name_table."` 
	//     // 			ORDER BY Name 
	//     // 			";
	    
	//     // $query = "SELECT * FROM `".$name_table."` 
	//     // 			GROUP BY project
	//     // 			ORDER BY cy DESC
	//     // 			";	  	    

	//     $query = "SELECT * FROM `".$name_table."` 
	//     			WHERE project = 'indeliblegain.com'
	//     			";	  





	//     // вывод запроса
	// 	    echo "<br><b> query: </b>&nbsp;&nbsp;&nbsp;&nbsp;";
	// 	    print_r($query);
	//     	echo "<br>========================================";

	//     // отправка запроса 
	// 	   	$result_query_SQL = mysqli_query($link_DB,$query);
	// 	    if (!$result_query_SQL) {
	// 	    	echo "<br><br><b><font color='red'>".__FUNCTION__."Query failed : " . mysqli_error($link_DB)."</font></b>";	
	// 	    	exit();
	// 	    	}    

	//     // оброботка ответа сервера
	// 		for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) {
	// 	    	if ($i>5000) { break; }
	// 	   		$result[] = mysqli_fetch_assoc($result_query_SQL);
	// 	    	}
		
	// 	// // вывод результатов в виде таблицы
	// 	// 	echo "<table>";
	// 	// 		foreach ($result[0] as $key => $value) {
	// 	// 			echo "<th>".$key."</th>";
	// 	// 			}

	// 	// 		for ($q=0; $q < count($result); $q++) { 
	// 	// 			echo "<tr>";
	// 	// 			foreach ($result[$q] as $value) {

	// 	// 				echo "<td>";
	// 	// 					echo $value;
	// 	// 				echo "</td>";
	// 	// 			}
	// 	// 			echo "</tr>";
	// 	// 			}

	// 	// 	echo "</table>";

	//     // вывод результатов ввиде массива
	// 	    // echo "<br><b> result_query_SQL: </b>&nbsp;&nbsp;&nbsp;&nbsp;";
	// 	    // print_r($result_query_SQL);


		    // echo "<br><b> result: </b>&nbsp;&nbsp;&nbsp;&nbsp;<br>";
		    // echo Build_tree_arr($result);




?>


</body>
</html>