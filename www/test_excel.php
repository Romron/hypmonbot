<?php
	require_once'funktions_hypmon.php';
	require_once 'Classes/PHPExcel.php';	

    # Если кнопка нажата
    // if( isset( $_POST['Export_in_Excel'] ) ){


		$link_DB = conect_DB();
		$result_query_SQL = querySelectFromDB($link_DB);
		OutputResultSQL_InExcel($result_query_SQL);

		
		mysqli_close($link_DB);
		// }
?>


