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

	set_time_limit(0);
	$ArrNameHyp = GetHypNam();
	
	queryInputIntoDB($link_DB,$ArrNameHyp);
	$result = querySelectFromDB($link_DB);
	OutputResultSQL($result);




	/* Закрываем соединение с базой данных*/
	mysqli_close($link_DB);



?>


</body>
</html>