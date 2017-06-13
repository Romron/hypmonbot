<?php 
	include('funktions_hypmon.php');

	if($_POST['param']){
		$param = json_decode($_POST['param']);
		$res_func = Test_ajax($param->t_aj);
		echo json_encode($res_func);

		exit();
	}

	if($_POST['GetListHyp']){
		$param = json_decode($_POST['GetListHyp']);
		// $res_func = Table();
		// $res_func = Table_in_str();
		$res_func = Test_ajax("ghjhjghhgh");
		echo json_encode($res_func);

		exit();
	}



?>