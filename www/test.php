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

	// $date_today = date('m-d-y', time('h:i:s'));
	// $date_today = date('U');
	$date_today = date('Y-d-m');

	echo $date_today;

	$query_input = "INSERT INTO test_2(`date`) VALUES ('".$date_today."')";
	mysqli_query($link_DB,$query_input) or die("Query failed : " . mysqli_error($link_DB));


	echo "<br>";
	echo "<br>";
	echo "<br>";

	$result = querySelectIntoDB($link_DB);
	OutputResultSQL($result);


	/* Закрываем соединение с базой данных*/
	mysqli_close($link_DB);



?>


</body>
</html>