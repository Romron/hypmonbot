<?php
	require_once'funktions_hypmon.php';
	require_once 'Classes/PHPExcel.php';

	set_time_limit(120);
	$link_DB = conect_DB();

	$arr_name_sheets = array(
		"aaa",
		"bbb",
		"ccc",
		"дддд",
		"ъъъъ"
		);



		$result_query_SQL_1 = querySelectFromDB($link_DB,'id');
		$arr_data_query_SQL['id'][] = $result_query_SQL_1;

		$result_query_SQL_2 = querySelectFromDB($link_DB,'Date');
		$arr_data_query_SQL['Date'][] = $result_query_SQL_2;

		$result_query_SQL_3 = querySelectFromDB($link_DB,'project');
		$arr_data_query_SQL['project'][] = $result_query_SQL_3;

		$memory = memory_get_usage();		
		echo "<br> ".__FILE__.":&nbsp;&nbsp;Объём памяти = &nbsp;&nbsp;".$memory;

		
		echo "<br> result_query_SQL_1=&nbsp;&nbsp;";
			print_r(mysqli_fetch_assoc($result_query_SQL_1));
		echo "<br> result_query_SQL_2=&nbsp;&nbsp;";
		// 	print_r(mysqli_fetch_assoc($result_query_SQL_2));
		// echo "<br> result_query_SQL_3=&nbsp;&nbsp;";
		// 	print_r(mysqli_fetch_assoc($result_query_SQL_3));

		echo "<br> Исходный массив обьектов базы данных:<br>";
			print_r($arr_data_query_SQL);
		echo "<br>";

		
		OutputResultSQL_InExcel($arr_data_query_SQL,"Data_proc.xlsx",$arr_name_sheets);
	
		mysqli_close($link_DB);



		exit();


?>


