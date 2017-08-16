<!DOCTYPE html>
<html>
<head>
	<title>Test_excel page</title>
	<meta charset="utf-8">
	<meta description="Главная таблица монитора">

	<link href="css/table_css.css" rel="stylesheet">
	<?php 	include('funktions_hypmon.php');	?>

</head>
<body>

<?php
	require_once 'Classes/PHPExcel.php';

	$link_DB = conect_DB();
	$result_query_SQL = querySelectFromDB($link_DB);
	OutputResultSQL_InExcel($result_query_SQL);

	


	mysqli_close($link_DB);
?>


</body>
</html>