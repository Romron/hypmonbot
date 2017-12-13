<?php
	require_once'funktions_hypmon.php';
	require_once'Classes/PHPExcel.php';	

		// set_time_limit(60);
		ini_set('memory_limit', '512M');
		ini_set ('max_execution_time',3600);
		$text_query = "ORDER BY `project`";		//	сортрует строки поалфавиту в порядке убывания т.е. групировкастрок по проэктам
		$link_DB = conect_DB();
		
		$result_query_SQL = querySelectFromDB('Work_table_1',$link_DB,"*",$text_query);	//	Выбор таблицы в базе данных	  ----  для тестов
		// $result_query_SQL = querySelectFromDB('Work_table_2',$link_DB,"*",$text_query);	//	Выбор таблицы в базе данных	  ----  рабочий вариант ручное наполнение
		// $result_query_SQL = querySelectFromDB('Work_table_3',$link_DB,"*",$text_query);		//	Выбор таблицы в базе данных	  ----  автоматическое наполнение CRON
		OutputResultSQL_InExcel($result_query_SQL);
	
		mysqli_close($link_DB);

		echo '<script>location.replace("http://hypmonbot/www/tabl_hyp_mon_bot.php");</script>'; 
		exit();


?>


