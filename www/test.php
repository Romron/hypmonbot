<!DOCTYPE html>
<html>
<head>
	<title>Test page</title>
	<meta charset="utf-8">
	<meta description="Главная таблица монитора">

	<link href="css/table_css.css" rel="stylesheet">
	<?php 	include('funktions_hypmon.php');	?>

</head>
<body>

<?php

	$link_DB = conect_DB();

	// set_time_limit(0);
	// $ArrNameHyp = GetHypNam();
	
	// queryInputIntoDB($link_DB,$ArrNameHyp);

	$date_today = time();	//	получаем текушее кол-во секунд в эпохе Юникс

	echo "<br>".$date_today."&nbsp;&nbsp;Отправленно в БД";

	$query_input = "INSERT INTO test_2(`date`) VALUES ('".$date_today."')";
		mysqli_query($link_DB,$query_input) or die("Query failed : " . mysqli_error($link_DB));
	$query_D = "SELECT (`date`) FROM test_2";
		$result_D = mysqli_query($link_DB,$query_D) or die("Query failed : " . mysql_error());

	echo "<br>".date('d.m.y H:i:s', time($result_D))."&nbsp;&nbsp;Получено из базы";		//	преобразовываем кол-во секунд в эпохе Юникс в норм формат

	/* Закрываем соединение с базой данных*/
	mysqli_close($link_DB);



?>


</body>
</html>