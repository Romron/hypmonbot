<?php 
	require_once('funktions_hypmon.php');
	require_once('funktions_analysis.php');
	session_start();


	if (isset($_POST['submit_test_1'])) {
		// header("location:test_page.php");
	
		
		// $name_table = "Crypto_1";	//	Выбор таблицы в базе данных
		$name_table = "Crypto_test";	//	Выбор таблицы в базе данных
		// $name_table = "Work_table_1";	//	Выбор таблицы в базе данных
		$link_DB = conect_DB();	
		$_SESSION['result'] = querySortingFromDB($link_DB,$name_table,'id','Capitalization','DESC','',0);


		header("location:test_page.php");
		// echo Build_tree_arr($result);
		}




 ?>





