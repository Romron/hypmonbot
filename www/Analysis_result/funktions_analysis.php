<?php


	function querySortingFromDB($link_DB,$name_table,$group_field,$sorting_field,$sorting_direction='ASC',$WHERE='',$limit='',$table=false){	//	Данная функция извликает данные из базы, групирует и сортирует их по указаным параметрам

		//	добавить отбор заданного количества строк

		// суть работы ф-ции в том что первым запросом производиться (только!!) сортировка без повторения, а потом в цыкле формируем блоки строк по ранее отобраному полю т.е. групировка: взять первую строку получить из неё сортируемое поле и сформировать запрос на выборку с базы данных всех строк с этим полем и так далие. 
		// 
		//  т.е. эта функция работает не правильно!!!! 



	   // $patern_zero = '~\d\.[1-9]*(0*)$~';
	   $patern_zero = '~\.\d*[1-9]?(0*)(?<=$)~U';

		if ($limit) {
			$limit_str ='LIMIT '.$limit;
			}else{ $limit_str = ''; }

	    if ($WHERE == '') {
		    $query_1 = "SELECT * FROM `".$name_table."` 		
		    			GROUP BY `".$group_field."`
		    			ORDER BY `".$sorting_field."` ".$sorting_direction."
		    			".$limit_str."";	 
		    }else{   
			    $query_1 = "SELECT * FROM `".$name_table."` 		
			    			WHERE `".$sorting_field."` > ".$WHERE."
			    			GROUP BY `".$group_field."`
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
			    			WHERE `".$group_field."` = '".$result_1[$z][$group_field]."'
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
					}elseif ($key == $group_field){
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
						}elseif ($key_2 == $group_field){
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

	function querySortingFromDB_1($link_DB,$name_table,$group_field,$sorting_field,$sorting_direction='ASC',$limit=''){
		
		$query = "CALL GrupAndSort('".$limit."','".$sorting_direction."','".$sorting_field."','".$group_field."','".$name_table."')";
		
		// if ($limit > 2) {
			echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

			echo "++<br>".$name_table."<br>".$group_field."<br>".$sorting_field."<br>".$sorting_direction."<br>".$limit."<br>++<br>";
			echo "--<br>".$query;
			// }			


			if (mysqli_multi_query($link_DB, $query)) {
				do {
			        if ($result_query_SQL = mysqli_store_result($link_DB)) {
			            while ($result[] = mysqli_fetch_assoc($result_query_SQL)) {
			                // Здесь разделитель групп ответов сервера
			            	}
			            mysqli_free_result($result_query_SQL);
			        	}					
					} while (mysqli_next_result($link_DB));
				}
		
		if ($limit > 2) {
			echo "<br>//<br>".Build_tree_arr($result);
			}
		

		return $result;
		}

?>