<?php 
	require_once'funktions_hypmon.php';

		// set_time_limit(60);
		ini_set ('max_execution_time',60);
		$link_DB = conect_DB();
		
		$text_query = ;
		$result_query_SQL = querySelectFromDB('Work_table_1',$link_DB,"*",$text_query);
	
		for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) { 	//	Из полученного обьекта базы данных формируем АССОЦИАТИВНЫЙ массив 
			$arr_row[] = mysqli_fetch_assoc($result_query_SQL); 
				// if ($i>100) { break;  }
			}

	    $query_input = "INSERT INTO ".$name_table."(`monitor`)VALUES('".$HypMonName."')";
	    mysqli_query($link_DB,$query_input) or die("Query failed : " . mysqli_error($link_DB));	/* Выполняем SQL-запрос */	




		mysqli_close($link_DB);

		echo '<script>location.replace("http://hypmonbot/www/tabl_hyp_mon_bot.php");</script>'; 
		exit();




?>