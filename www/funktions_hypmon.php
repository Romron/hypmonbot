<?php 
	function GetWebPage( $url, $conect_out = 120, $tim_out = 120){    
        $uagent = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36" ; // "Opera/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388 Version/12.14"; 

        $ch = curl_init( $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
        curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки
        curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $conect_out); // таймаут соединения
        curl_setopt($ch, CURLOPT_TIMEOUT, $tim_out);        // таймаут ответа
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);       // останавливаться после 10-ого редиректа
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_COOKIEJAR,    "cookies/cookies.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE,   "cookies/cookies.txt");         
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        $content = curl_exec($ch);
        $err     = curl_errno($ch);
        $errmsg  = curl_error($ch);
        $header  = curl_getinfo($ch);

        curl_close($ch);

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        $header['$ch'] = $ch;
        $result = $header;

        if (($result['errno'] != 0 )||($result['http_code'] != 200))  // если ошибка
          {
           echo "<br>"."Код ошибки:&nbsp".$result['errmsg']."<br>";       // если ошибка....
           return $result;
          }
        else  // если не ошибка
          {
            $page = $result['content'];
            return $page;
            //echo $page;
          }
      }

	function GetHypNam(){	
		// $page_1 = file_get_contents("https://bitmakler.com/investmentfund");
		$page_1 = GetWebPage("https://bitmakler.com/investmentfund");
			if (is_array($page)) { $page = implode(" ", $page);}				
				$patern_1 = '#<b onclick="openpage\(\'(https?://(?:www\.)?.*\.*/)#U'; 
				if (!preg_match_all($patern_1,$page_1,$result_1a,PREG_PATTERN_ORDER)) { 
				    echo "func GetHypNam:  patern_1 ненайден или ошибка";
				    return false;
					} 		
	 
				for ($q=0; $q < count($result_1a[1]); $q++) { 			//  с массива всех значений извлекаем только нужные
					$result_1[$q] = $result_1a[1][$q];
					}

					$result_1c = array('1'=>'https://bitmakler.com/investmentfund','2' => count($result_1));
					array_unshift($result_1, $result_1c);

		$page_2 = GetWebPage('http://allhyipmon.ru/rating');
			if (is_array($page)) { $page = implode(" ", $page);}
			$patern_2 = '#<div>\d{1,2}\. <b><a href="/monitor/.*>(.*)</a></b>.*мониторингов</div>#U'; 
			$n=0;
			$result_2 = array();
			do{

				if (!preg_match_all($patern_2,$page_2,$result_2a,PREG_PATTERN_ORDER)) { 
				    echo "func GetHypNam:  patern_2 ненайден или ошибка";
				    return false;
					} 

				for ($q=0; $q < count($result_2a[1]); $q++) { 			//  с массива всех значений извлекаем только нужные
					$result_2b[$q] = $result_2a[1][$q];
					}
				$result_2 = array_merge($result_2,$result_2b);

				$n++;
				$url = 'http://allhyipmon.ru/rating?page='.$n.'<br>';
				 // echo $url;

				sleep(rand(5,20));
				$page_2 = GetWebPage($url);

			}while ($n <= 2);

				$result_2c = array('1'=>'http://allhyipmon.ru/rating','2' => count($result_2));
				array_unshift($result_2, $result_2c);

		$page_3 = GetWebPage('http://list4hyip.com/');
				if (is_array($page)) { $page = implode(" ", $page);}	
				$patern_3 = '#<a.*target="_blank">.*<img src=.*(?!list4hyip.com)(https?://(?!mozshot.nemui.org).*/)#sU'; 
				if (!preg_match_all($patern_3,$page_3,$result_3a,PREG_PATTERN_ORDER)) { 
				    echo "func GetHypNam:  patern_3 ненайден или ошибка";
				    return false;
					} 
				for ($q=0; $q < count($result_3a[1]); $q++) { 			//  с массива всех значений извлекаем только нужные
					if ($result_3a[1][$q] == "http://list4hyip.com/") {	//	удаляем не нужное
						continue;
						}
					$result_3[$q] = $result_3a[1][$q];
					}

					$result_3c = array('1'=>'http://list4hyip.com/','2' => count($result_3));
					array_unshift($result_3, $result_3c);

	    $result = array_merge($result_1,/*$result_2,*/$result_3);
        return $result;
        // return $result_1;
		}

	function Table(){     	//	создаём таблицу спомощью php
		// $ArrNameHyp = GetHypNam();
		$ArrNameHyp = GetHypNam_TEST();

		for ($i=0; $i < count($ArrNameHyp); $i++) {	
			
				echo '<tr>';
				if (is_array($ArrNameHyp[$i])) {
						$HypName = $ArrNameHyp[$i][1];
						$HypCount = $ArrNameHyp[$i][2];					

						echo '<td class="NameHyp_Col" rowspan='.$HypCount.'>
							<p class="vertical">'.$HypName.'</p>
							</td>';
					continue;						
					}
					echo 
						'<td>
							'.$i.'
						</td>';
							echo '<td>
									<p class="NameHyp">'.$ArrNameHyp[$i].'</p>
									</td>';
						for ($q=0; $q < 27; $q++) { 
							echo "<td></td>";
							}
					echo '</tr>';
			}		
		}

	function Table_in_str(){ 		//	создаёт таблицу и преобразует её в строку для последующей передачи с помощью ajax в скрипт js 
		// $ArrNameHyp = GetHypNam();
		$ArrNameHyp = GetHypNam_TEST();

		for ($i=0; $i < count($ArrNameHyp); $i++) {	
			
				$str_1 = '<tr>';
				
				if (is_array($ArrNameHyp[$i])) {
						$HypName = $ArrNameHyp[$i][1];
						$HypCount = $ArrNameHyp[$i][2];					
					

					$str_2 = '<td class="NameHyp_Col" rowspan='.$HypCount.'>
							<p class="vertical">'.$HypName.'</p>
							</td>';
					continue;						
					}
					$str_3 =  
						'<td>
							'.$i.'
						</td>';
							$str_4 =  '<td>
									<p class="NameHyp">'.$ArrNameHyp[$i].'</p>
									</td>';
						for ($q=0; $q < 27; $q++) { 
							$str_5 = $str_5."<td></td>";
							}
					$str_6 = '</tr>';

				$str = $str.$str_1.$str_2.$str_3.$str_4.$str_5.$str_6;
				$str_5 = "";
			}	
			return $str;
		}

	function ParsParamHaypWithServAnalSite($URL_hyp){     
		// предполагаеться вызов в теле ф-ции GetHypNam поочерёдно для каждого массива хайпов отдельно.
		// т.е один хайп проганяется поочерёдно по всем сераисам анализа сайтов
		// заполняеться вся строка и только после этого переходм к другому хайпу 

		$page = GetWebPage('https://a.pr-cy.ru/'.$URL_hyp);		
			if (is_array($page)) { $page = implode(" ", $page);}		
		
			 // echo $page;
			 // exit;

			$patern_0 = '#<a href="https://yaca.yandex.ru/yca/cy/ch/.*" target="_blank">(.*)</a>#'; 		//	ТИЦ 
				if (!preg_match_all($patern_0,$page,$result_0,PREG_PATTERN_ORDER)) { 
				    // $result_0 = array('0' => '',array('0' => '<p class="err_mess">ptrn_0_ERR</p>'));		
				    $result_0 = array('0' => '',array('0' => 0));		
				    // return false;
					} 

			$patern_1 = '#href="http:\/\/yandex.ru\/yandsearch\?text=host%3A'.$URL_hyp.'.*target="_blank">(.*)</a>#sU'; 			// шт.  Яндекс
				if (!preg_match_all($patern_1,$page,$result_1,PREG_PATTERN_ORDER)) { 
				    // $result_1 = array('0' => '',array('0' => '<p class="err_mess">ptrn_1_ERR</p>'));
				    $result_1 = array('0' => '',array('0' => 0));
				    // return false;
					} 

			$patern_2 = '#href="http:\/\/yandex.ru\/yandsearch\?text=host%3A'.$URL_hyp.'.*target="_blank">.*</a>\W*&nbsp;<span class="\w*">(.*)</span>#sU'; 		// динамика
				if (!preg_match_all($patern_2,$page,$result_2,PREG_PATTERN_ORDER)) { 
					$result_2 = array('0' => '',array('0' => '0'));
				    // return false;
					} 

			$patern_3 = '#<a href="https:\/\/www\.google\.com\/search\?\e*q=site:.*" target="_blank">\e*(.*)</a>#sU'; 				// шт.		Гугл
				if (!preg_match_all($patern_3,$page,$result_3,PREG_PATTERN_ORDER)) { 
				    // $result_3 = array('0' => '',array('0' => '<p class="err_mess">ptrn_3_ERR</p>'));
				    $result_3 = array('0' => '',array('0' => 0));
				    // return false;
					} 		

			$patern_4 = '#href="https:\/\/www\.google\.com\/search\?\e*q=site:'.$URL_hyp.'" target="_blank">\e*.*\e*&nbsp;<span.*>(.*)<\/span>#sU'; 	// динамика
				if (!preg_match_all($patern_4,$page,$result_4,PREG_PATTERN_ORDER)) { 
				    $result_4 = array('0' => '',array('0' => '0'));
				    // return false;
					} 		
		
			$patern_5 = '#<td>Просмотры</td>(?:\W*<td.*</td>){2}(?:\W*<td.*>(.*)</td>)#sU'; 		//  Просмотры
				if (!preg_match_all($patern_5,$page,$result_5,PREG_PATTERN_ORDER)) { 
				    $result_5 = array('0' => '',array('0' => '<p class="err_mess">ptrn_5_ERR</p>'));
				    // return false;
					} 		

			$patern_6 = '#<p>.*Место в стране <img.*>(.*\w*):.*</p>#sU'; 					//	 	 	Максимум трафика из
				if (!preg_match_all($patern_6,$page,$result_6,PREG_PATTERN_ORDER)) { 
				    $result_6 = array('0' => '',array('0' => '<p class="err_mess">ptrn_6_ERR</p>'));
				    // return false;
					} 		

			$patern_7 = '#<div.*<div class="info-test">Ссылается страниц</div>\v*\t*</div>\v*\t*<div class="col-sm-8 content-test">\v*\t*(.*)\v*\t*<img#sU'; //  Baclink - страницы
				if (!preg_match_all($patern_7,$page,$result_7,PREG_PATTERN_ORDER)) { 
				    $result_7 = array('0' => '',array('0' => '<p class="err_mess">ptrn_7_ERR</p>'));
				    // return false;
					}elseif (is_string($result_7[1][0])) {   
							$result_7[1][0] = 0;
							}

			$patern_8 = '#<div class="info-test">Ссылаются доменов</div>\v*\t*</div>\v*\t*<div class="col-sm-8 content-test">v*\t*(.*)\v*\t*<img#sU'; 	//  Baclink - домены
				if (!preg_match_all($patern_8,$page,$result_8,PREG_PATTERN_ORDER)) { 
				    $result_8 = array('0' => '',array('0' => '<p class="err_mess">ptrn_8_ERR</p>'));
				    // return false;
					}elseif (is_string($result_8[1][0])) {
						$result_8[1][0] = 0;
						}		

		$page = GetWebPage('http://www.alexa.com/siteinfo/'.$URL_hyp);	

			if (is_array($page)) { $page = implode(" ", $page);}		
			
			// echo $page;

			$patern_9 = '#alt=\W*Global rank icon\W*<strong.*-->(.*)<\/strong>#sU'; 		// Популярность - Global - Значение
				if (!preg_match_all($patern_9,$page,$result_9,PREG_PATTERN_ORDER)) { 
				    $result_9 = array('0' => '',array('0' => '<p class="err_mess">ptrn_9_ERR</p>'));
				    // return false;
					} 	

			$patern_10 = '#Rank in\W*<a.*>(.*)</a>#sU'; 									// Популярность - Rank in country - Страна
				if (!preg_match_all($patern_10,$page,$result_10,PREG_PATTERN_ORDER)) { 
				    $result_10 = array('0' => '',array('0' => '<p class="err_mess">ptrn_10_ERR</p>'));
				    // return false;
					} 	

			$patern_11 = '#class="countryRank".*pcache.alexa.com\/images\/flags.*>(.*)</strong>#sU'; 		
				if (!preg_match_all($patern_11,$page,$result_11,PREG_PATTERN_ORDER)) { 
				    $result_11 = array('0' => '',array('0' => '<p class="err_mess">ptrn_11_ERR</p>'));
				    // return false;
					} 

			$patern_12 = '#Bounce Rate.*vmiddle">(.*)</strong>#sU'; 						//	Активность пользователей - Показатель отказов
				if (!preg_match_all($patern_12,$page,$result_12,PREG_PATTERN_ORDER)) { 
				    $result_12 = array('0' => '',array('0' => '<p class="err_mess">ptrn_12_ERR</p>'));
				    // return false;
					} 	

			$patern_13 = '#h4 class="metrics-title">Daily Pageviews per Visitor.*align-vmiddle">(.*)<#sU'; 
				if (!preg_match_all($patern_13,$page,$result_13,PREG_PATTERN_ORDER)) { 			// Активность пользователей - Страниц за везит
				    $result_13 = array('0' => '',array('0' => '<p class="err_mess">ptrn_13_ERR</p>'));
				    // return false;
					} 	

			$patern_14 = '#h4 class="metrics-title">Daily Time on Site.*align-vmiddle">(.*)<#sU'; 
				if (!preg_match_all($patern_14,$page,$result_14,PREG_PATTERN_ORDER)) { 			// Активность пользователей - Ср. продолжит визита, м-с
				    $result_14 = array('0' => '',array('0' => '<p class="err_mess">ptrn_14_ERR</p>'));
					}

			$patern_15 = '#Search Visits.*vmiddle">(.*)</strong>#sU'; 
				if (!preg_match_all($patern_15,$page,$result_15,PREG_PATTERN_ORDER)) { 			// Процент поискового трафика
				    $result_15 = array('0' => '',array('0' => '<p class="err_mess">ptrn_15_ERR</p>'));
				    // return false;
					} 	

			$patern_16 = '#Total Sites Linking In.*box1-r">(.*)</s#sU'; 
				if (!preg_match_all($patern_16,$page,$result_16,PREG_PATTERN_ORDER)) { 			// Процент поискового трафика
				    $result_16 = array('0' => '',array('0' => '<p class="err_mess">ptrn_16_ERR</p>'));
				    // return false;
					} 	

		$page = GetWebPage('https://www.nic.ru/whois/?query='.$URL_hyp);	

			if (is_array($page)) { $page = implode(" ", $page);}

			// echo $page;
		
			$patern_17 = '#Domain Registration Date.* (\w{3}) (\d{1,2}) (\d{2}:\d{2}:\d{2}) (GMT) (\d{4})#'; 
				if (!preg_match_all($patern_17,$page,$result_17,PREG_PATTERN_ORDER)) { 			// Процент поискового трафика
					$patern_17_1 = '#Creation Date:.*(\d{4}-\d{2}-\d{2})T\d{2}:\d{2}:\d{2}Z#'; 
					if (!preg_match_all($patern_17_1,$page,$result_17_1,PREG_PATTERN_ORDER)) {				    
					    $result_17_1 = array('0' => '',array('0' => '<p class="err_mess">ptrn_17_1_ERR</p>'));
				    	// return false;
				    	}
				    $result_17 = array('0' => '',$result_17_1[1]);
					}elseif (!is_string($result_17)){ 			
									$arr = array_merge($result_17[2],$result_17[1],$result_17[5]);
									$str = implode("-",$arr);
									$result_17 = array('0' => '',array('0' => $str));
									}

			$patern_18 = '#Domain Expiration Date.* (\w{3}) (\d{1,2}) (\d{2}:\d{2}:\d{2}) (GMT) (\d{4})#'; 
				if (!preg_match_all($patern_18,$page,$result_18,PREG_PATTERN_ORDER)) { 			// Процент поискового трафика
				    
					$patern_18_1 = '#Creation Date:.*(\d{4}-\d{2}-\d{2})T\d{2}:\d{2}:\d{2}Z#'; 
					if (!preg_match_all($patern_18_1,$page,$result_18_1,PREG_PATTERN_ORDER)) {	
					    $result_18 = array('0' => '',array('0' => '<p class="err_mess">ptrn_18_1_ERR</p>'));
					    // return false;
					    }
					    $result_18 = array('0' => '',$result_18_1[1]);
				    
					}elseif (!is_string($result_18)){ 			
									$arr = array_merge($result_18[2],$result_18[1],$result_18[5]);
									$str = implode("-",$arr);
									$result_18 = array('0' => '',array('0' => $str));
								}

			$patern_19 = '#Domain Last Updated Date.* (\w{3}) (\d{1,2}) (\d{2}:\d{2}:\d{2}) (GMT) (\d{4})#'; 
				if (!preg_match_all($patern_19,$page,$result_19,PREG_PATTERN_ORDER)) { 			// Процент поискового трафика
				    $result_19 = array('0' => '',array('0' => '<p class="err_mess">ptrn_19_ERR</p>'));
				    // return false;
					}elseif (!is_string($result_19)){ 			
									$arr = array_merge($result_19[2],$result_19[1],$result_19[5]);
									$str = implode("-",$arr);
									$result_19 = array('0' => '',array('0' => $str));
								}


		$arr_param_hyp = array_merge($result_0[1],$result_1[1],$result_2[1],$result_3[1],$result_4[1],$result_5[1],$result_6[1],$result_7[1],$result_8[1],$result_9[1],$result_10[1],$result_11[1],$result_12[1],$result_13[1],$result_14[1],$result_15[1],$result_16[1],$result_17[1],$result_18[1],$result_19[1]);

		return $arr_param_hyp;

		}

	function conect_DB(){	
		
		// http://www.phpmyadmin.co 
		// Your account number is: 232379
		// Your new database is now ready to use.
		// To connect to your database use these details
		// Server: sql11.freemysqlhosting.net
		// Name: sql11189828
		// Username: sql11189828
		// Password: 4UVIZKBKhY
		// Port number: 3306

		/* Соединяемся, выбираем базу данных */
	    $link_DB = mysqli_connect('sql11.freemysqlhosting.net','sql11189828','4UVIZKBKhY','sql11189828');
	    if (mysqli_connect_errno()) {
	    	echo "Ошибка при подключении к базе данных (".mysqli_connect_errno()."): ".mysqli_connect_error();
	    	}
	    return $link_DB;	
		}

	function querySelectFromDB($link_DB){	//	Данная функция будет только(!!) извликать данные из базу
	    /* Выполняем SQL-запрос */
	    $query = "SELECT * FROM test_2";
	    $result = mysqli_query($link_DB,$query) or die("Query failed : " . mysql_error());	    
	   	
	   	return $result;
		}

	function queryInputIntoDB($link_DB,$ArrNameHyp) {	//	Данная функция будет только(!!) добавлять данные в базу
	    
		// for ($i=0; $i < count($ArrNameHyp); $i++) {	// основной вариант
		for ($i=0; $i < 10; $i++) {			//	для тестов
			
				if (is_array($ArrNameHyp[$i])) {
					$HypMonName = $ArrNameHyp[$i][1];
					continue;						
					}
				$patern_URL = '#(?:https?:\/\/)?[w]{0,3}\.?(.*)/?#'; 				
				if (!preg_match_all($patern_URL,$ArrNameHyp[$i],$result_str_name_site,PREG_PATTERN_ORDER)) { 
				    echo "patern_URL ненайден или ошибка";
				    return false;
					} 

				$date_today = time();	//	получаем текушее кол-во секунд в эпохе Юникс
				$query_input_date = "INSERT INTO test_2(`date`) VALUES ('".$date_today."')";

				$ArrParamHype = ParsParamHaypWithServAnalSite($result_str_name_site[1][0]);
				for ($q=0; $q < 20; $q++) { 
						$ArrParamHype[$q] = strip_tags($ArrParamHype[$q]);
						}
			    $query_input = "INSERT INTO test_2(`monitor`, 
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
			    									`Rank_in_country_country`, 
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
			    							 		'".$HypMonName."',
			    							 		'".$date_today."',
			    									'".$ArrNameHyp[$i]."',
			    									'".$ArrParamHype[0]."',
			    									'".$ArrParamHype[1]."',
			    									'".$ArrParamHype[2]."',
			    									'".$ArrParamHype[3]."',
			    									'".$ArrParamHype[4]."',
			    									'".$ArrParamHype[5]."',
			    									'".$ArrParamHype[6]."',
			    									'".$ArrParamHype[7]."',
			    									'".$ArrParamHype[8]."',
			    									'".$ArrParamHype[9]."',
			    									'".$ArrParamHype[10]."',
			    									'".$ArrParamHype[11]."',
			    									'".$ArrParamHype[12]."',
			    									'".$ArrParamHype[13]."',
			    									'".$ArrParamHype[14]."',
			    									'".$ArrParamHype[15]."',
			    									'".$ArrParamHype[16]."',
			    									'".$ArrParamHype[17]."',
			    									'".$ArrParamHype[18]."',
			    									'".$ArrParamHype[19]."'
			    									)";
			    /* Выполняем SQL-запрос */
			    mysqli_query($link_DB,$query_input) or die("Query failed : " . mysqli_error($link_DB));
			}
		}



	function OutputResultSQL($result){
		print "<table>\n";
	    while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
	        print "\t<tr>\n";
	        foreach ($line as $col_value) {
	            print "\t\t<td>$col_value</td>\n";
	        }
	        print "\t</tr>\n";
		    }
	    print "</table>\n";

	    /* Освобождаем память от результата */
	    mysqli_free_result($result);
		}	

	function OutputResultSQL_InExcel($result_query_SQL){
		
		for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) { 
			$arr_row[] = mysqli_fetch_assoc($result_query_SQL); 
			
			}
		
			// print_r($arr_row);

			$objPHPExecel = new PHPExcel();
			$objPHPExecel->setActiveSheetIndex(0);
			$active_sheet = $objPHPExecel->getActiveSheet();

			header("Content-Type:application/vnd.ms-excel");
			header("Content-Disposition:attachment:filename='simple.xls'");

			$objWriter = PHPExcel_IOFactory::createteWriter($objPHPExecel, 'Excel2007');
			$objWriter->save('php://output');

		}			



	function ExcelTabl(){
		// на входе получаем данные в формате json ??
		}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------




function GetHypNam_TEST(){

		// $result = array(array('0' => '00000'),'1','2','3','4',array('5' => '55555'),'6','7','8','9','10','11',array('12' => '121212112'),'13','14','15','16','17','18','19','20');
		
		$result = array('1','2','3','4','6','7','8','9','10','11','13','14','15','16','17','18','19','20');

		print_r($result);

		return $result;
	}

function Test_ajax($test_data)
	{
		
		$str = "<br>************ с файла js на сервер пришло".$test_data." ****************<br>";
		return $str;

	}	


//	Добавить кнопку "обновить список хайпов" и понему запускать эту ф-цию
//	добавить кнопку "обновить параметры хайпов" и выполнять обновление БЕЗ(!!!!) перезагрузки всей страницы,
//  а также возможность обновить только выбраные строчки отдельно








 ?>