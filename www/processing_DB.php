<?php 
	require_once'funktions_hypmon.php';

		// set_time_limit(60);
		ini_set ('max_execution_time',240);
		$link_DB = conect_DB();
		
		// $text_query = ;
		$result_query_SQL = querySelectFromDB('Work_table_1',$link_DB/*,"*",$text_query*/);
	
		for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) { 	//	Из полученного обьекта базы данных формируем АССОЦИАТИВНЫЙ массив 
			$arr_row[] = mysqli_fetch_assoc($result_query_SQL); 
				if ($arr_row[$i]['project'] == "") { unset($arr_row[$i]); continue; }
				$patern_URL = '#(?:https?:\/\/)?[w]{0,3}\.?(.*)/?#'; 				
				if (!preg_match_all($patern_URL,$arr_row[$i]['project'],$result_str_name_site,PREG_PATTERN_ORDER)) { 
				    echo "<br>".__FUNCTION__."patern_URL ненайден или ошибка";
					} 
					$arr_row[$i]['project'] = $result_str_name_site[1][0];
				// echo "<br>".$i."&nbsp; [project] &nbsp;= &nbsp;".$arr_row[$i]['project'];
				
		    $query_input = "INSERT INTO Work_table_2 (`monitor`, 
										`date`,
										`project`,
										`cy`,
										`page_yndex_pc`,
										`page_yndex_dynamics`, 
										`page_google_pc`, 			    									
										`page_google_dynamics`, 
										`Views`, 
										`max_traffic`, 
										`Baclink_page`, 
										`Baclink_domain`, 
										`Global_Rank`, 
										`Rank_in_country`, 
										`Rank_in_country_value`, 
										`Acidification_index`, 
										`Pages_per_visit`, 
										`The_average_will_continue_to_visit`, 
										`Search_traffic_percentage`, 
										`baclink_alexa`, 
										`Domain_registration_date`, 
										`Domain_end_date`, 
										`Domain_renewal_date`			    									 
								 )VALUES(
								 		'".$arr_row[$i]['monitor']."',
								 		'".$arr_row[$i]['date']."',
										'".$arr_row[$i]['project']."',
										'".$arr_row[$i]['cy']."',
										'".$arr_row[$i]['page_yndex_pc']."',
										'".$arr_row[$i]['page_yndex_dynamics']."',
										'".$arr_row[$i]['page_google_pc']."',
										'".$arr_row[$i]['page_google_dynamics']."',
										'".$arr_row[$i]['Views']."',
										'".$arr_row[$i]['max_traffic']."',
										'".$arr_row[$i]['Baclink_page']."',
										'".$arr_row[$i]['Baclink_domain']."',
										'".$arr_row[$i]['Global_Rank']."',		
										'".$arr_row[$i]['Rank_in_country']."',
										'".$arr_row[$i]['Rank_in_country_value']."',
										'".$arr_row[$i]['Acidification_index']."',
										'".$arr_row[$i]['Pages_per_visit']."',
										'".$arr_row[$i]['The_average_will_continue_to_visit']."',
										'".$arr_row[$i]['Search_traffic_percentage']."',
										'".$arr_row[$i]['baclink_alexa']."',
										'".$arr_row[$i]['Domain_registration_date']."',
										'".$arr_row[$i]['Domain_end_date']."',
										'".$arr_row[$i]['Domain_renewal_date']."'
										)";
			// echo $query_input."<br><br>";
			mysqli_query($link_DB,$query_input) or die("Query failed : " . mysqli_error($link_DB));	/* Выполняем SQL-запрос */	
				// if ($i>10) { break;  }
		}

		// echo "<br>************************<br>";
		// echo Build_tree_arr($arr_row);
		// echo "<br>************************<br>";

		mysqli_close($link_DB);

		echo '<script>location.replace("http://hypmonbot/www/tabl_hyp_mon_bot.php");</script>'; 
		exit();




?>