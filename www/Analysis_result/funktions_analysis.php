<?php


	function querySortingFromDB($link_DB,$name_table,$main_field,$sorting_field,$sorting_direction='ASC',$WHERE='',$limit='',$table=false){	//	Данная функция извликает данные из базы, групирует и сортирует их по указаным параметрам

		//	добавить отбор заданного количества строк

	   // $patern_zero = '~\d\.[1-9]*(0*)$~';
	   $patern_zero = '~\.\d*[1-9]?(0*)(?<=$)~U';

		if ($limit) {
			$limit_str ='LIMIT '.$limit;
			}else{ $limit_str = ''; }

	    if ($WHERE == '') {
		    $query_1 = "SELECT * FROM `".$name_table."` 		
		    			GROUP BY `".$main_field."`
		    			ORDER BY `".$sorting_field."` ".$sorting_direction."
		    			".$limit_str."";	 
		    }else{   
			    $query_1 = "SELECT * FROM `".$name_table."` 		
			    			WHERE `".$sorting_field."` > ".$WHERE."
			    			GROUP BY `".$main_field."`
			    			ORDER BY `".$sorting_field."` ".$sorting_direction."
			    			".$limit_str."";	  	
			    }

	    // отправка ПЕРВОГО запроса 
		   	$result_query_SQL = mysqli_query($link_DB,$query_1);
		    if (!$result_query_SQL) {
		    	echo "<br><br><b><font color='red'>".__FUNCTION__."&nbsp; Query_1 failed : " . mysqli_error($link_DB)."</font></b>";	
		    	exit();
		    	}     

	    // оброботка ПЕРВОГО ответа сервера
			for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) {
		    	if ($i>20) { break; }	// для тестов
		   		$result_1[] = mysqli_fetch_assoc($result_query_SQL);
		    	}

		// формируем и отправляем ВТОРОЙ запрос
			for ($z=0; $z < count($result_1); $z++) { 
			  	if ($z>20) { break; }	// для тестов
			    $query_2 = "SELECT * FROM `".$name_table."` 
			    			WHERE `".$main_field."` = '".$result_1[$z][$main_field]."'
			    			";	

			    // отправка ВТОРОГО запроса 
				   	$result_query_SQL = mysqli_query($link_DB,$query_2);
				    if (!$result_query_SQL) {
				    	echo "<br><br><b><font color='red'>".__FUNCTION__."&nbsp; Query_2 failed : " . mysqli_error($link_DB)."</font></b>";	
				    	exit();
				    	}    

			    // оброботка ВТОРОГО ответа сервера
					for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) {
				   		$result_2[] = mysqli_fetch_assoc($result_query_SQL);
				    	}
				}

		// вывод результатов в виде таблицы
		if ($table) {
			echo "<table>";
				foreach ($result_2[0] as $key => $value) {
					if ($key == $sorting_field) {
						$th_str = '<th class="sorting">';
					}elseif ($key == $main_field){
						$th_str = '<th class="main_sorting">';
						}else{$th_str = '<th>';}					
					echo $th_str.$key."</th>";
					}
				for ($q=0; $q < count($result_2); $q++) { 
					echo "<tr>";
					foreach ($result_2[$q] as $key_2 => $value_2) {
						if (preg_match_all($patern_zero,$value_2,$result_zero,PREG_PATTERN_ORDER)) { // убираем незначущие нули после запятой
							$value_2 = str_replace($result_zero[1][0],"",$value_2);	
							$value_2 = $value_2.'0';
							}
						if ($key_2 == $sorting_field) {
							$td_str = '<td class="sorting">';
						}elseif ($key_2 == $main_field){
							$td_str = '<td class="main_sorting">';
							}else{$td_str = '<td>';}
						echo $td_str;
							echo $value_2;
						echo "</td>";
						$q_n++;
						}
					echo "</tr>";
					}
			echo "</table>";
	   		}else{	// в результирующем массиве убираем незначущие нули после запятой
				for ($w=0; $w < count($result_2); $w++) {
					$w_n = 0;		// счётчик элементов массива $result_2[$w] для удаления незначущих нулей в $result_2
					foreach ($result_2[$w] as $key_2 => $value_2) {
						if (preg_match_all($patern_zero,$value_2,$result_zero,PREG_PATTERN_ORDER)) {
							$value_2 = str_replace($result_zero[1][0],"",$value_2);	
							$value_2 = $value_2.'0';
							$result_2[$w][$key_2] = $value_2;

							// echo "<br>*****&nbsp;&nbsp; result_2[".$w."][".$key_2."] = ".$result_2[$w][$key_2];

							}
						$w_n++;
						}
				}
			   	return $result_2;
		   		}
		}



?>