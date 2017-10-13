<?php 
	require_once'funktions_hypmon.php';

	// echo (phpinfo());

	$ArrNameHyp = GetHypNam();


	print_r($ArrNameHyp);
	echo "<br>-----------------------------------------------------<br><br>";
	echo Build_tree_arr($ArrNameHyp);









?>