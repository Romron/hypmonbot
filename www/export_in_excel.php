<?php
	require_once'funktions_hypmon.php';
	require_once 'Classes/PHPExcel.php';	

		// set_time_limit(60);
		ini_set ('max_execution_time',60);

		$link_DB = conect_DB();
		
		$result_query_SQL = querySelectFromDB($link_DB);
		OutputResultSQL_InExcel($result_query_SQL);
	
		mysqli_close($link_DB);

		echo '<script>location.replace("http://hypmonbot/www/tabl_hyp_mon_bot.php");</script>'; 
		exit();


?>


