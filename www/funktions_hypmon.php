<?php 
	function GetWebPage( $url, $conect_out = 120, $tim_out = 120){    
        $uagent = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36" ; // "Opera/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388 Version/12.14"; 

       
		$headers = array(
			'GET ' . $url . ' HTTP/1.0',
			'Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash,
		                  application/vnd.ms-excel, application/msword, */*',
			'Accept-Language: ru,zh-cn;q=0.7,zh;q=0.3',
			'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
			// 'Proxy-Connection: Keep-Alive'
		);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);  
        curl_setopt($ch, CURLOPT_COOKIE,    "ukraine22=599ad1007dd9002c1347d80f");	//	Имя файла, в котором будут сохранены все внутренние cookies текущей передачи после закрытия дескриптора.
        curl_setopt($ch, CURLOPT_COOKIEJAR,    "cookies/cookies.txt");	//	Имя файла, в котором будут сохранены все внутренние cookies текущей передачи после закрытия дескриптора.
        curl_setopt($ch, CURLOPT_COOKIEFILE,   "cookies/cookies.txt");  //	Имя файла, содержащего cookies       
        curl_setopt($ch, CURLOPT_REFERER, "https://www.google.com.ua/search");       
        curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки


        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
        // curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $conect_out); // таймаут соединения
        // curl_setopt($ch, CURLOPT_TIMEOUT, $tim_out);        // таймаут ответа
        // curl_setopt($ch, CURLOPT_MAXREDIRS, 10);       // останавливаться после 10-ого редиректа
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        // curl_setopt($ch, CURLOPT_HTTPGET, true);
       

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
            // echo $page;
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

			}while ($n <= 5);

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

	    $result = array_merge($result_1,$result_2,$result_3);
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

			$patern_9 = '#alt=\W*Global rank icon\W*<strong.*-->(.*)<\/strong>#sU'; 		// Популярность - Global - Знач
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

	function querySelectFromDB($link_DB){	//	Данная функция извликает данные из базы
	    /* Выполняем SQL-запрос */
	    $query = "SELECT * FROM test_2";
	    $result = mysqli_query($link_DB,$query) or die("Query failed : " . mysql_error());	    
	   	
	   	return $result;
		}

	function queryInputIntoDB($link_DB,$HypMonName,$NameHyp,$ArrParamHype) {	//	Данная функция добавляет данные в базу
		
		$date_today = time();	//	получаем текушее кол-во секунд в эпохе Юникс

		for ($q=0; $q < 20; $q++) { 
			$ArrParamHype[$q] = trim(strip_tags($ArrParamHype[$q]));		// убираем все лишние символы
			$ArrParamHype[$q] = htmlentities($ArrParamHype[$q]);
			$ArrParamHype[$q] = str_replace ("&nbsp;",'',$ArrParamHype[$q]);
			if (preg_match_all('#(\d+):(\d+)#',$ArrParamHype[$q],$result_2,PREG_PATTERN_ORDER)) { //время в формате "m:s" переводим в "m.s" для корректного отображения в базе данных 
				$ArrParamHype[$q] = $result_2[1][0].".".$result_2[2][0];
				} 				
			if (preg_match_all('#(\d+),(\d+)(?:,(\d+))*#',$ArrParamHype[$q],$result_3,PREG_PATTERN_ORDER)) {  // милины в формате "2,362,696" переводим в нормальный вид
				$ArrParamHype[$q] = $result_3[1][0].$result_3[2][0].$result_3[3][0];
				} 						

						$patern = '#(\d)+:(\d)+#';
					if (preg_match_all($patern,$ArrParamHype[$q],$result,PREG_PATTERN_ORDER)) { 
					    $ArrParamHype[$q] = $result[1][0].'.'.$result[2][0];
						} 						
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
			    									'".$NameHyp."',
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


	function OutputResultSQL_InExcel($result_query_SQL){

		for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) { 	//	Из полученного обьекта базы данных формируем АССОЦИАТИВНЫЙ массив 
			$arr_row[] = mysqli_fetch_assoc($result_query_SQL); 
			}

			// print_r($arr_row);


		//	блок создания и получения активного экселевского листа
			$objPHPExecel = new PHPExcel();		 
			$objPHPExecel->setActiveSheetIndex(0);
			$objPHPExecel->createSheet();
			$active_sheet = $objPHPExecel->getActiveSheet();

			$active_sheet->getPageSetup()		//	блок формирования параметров страницы активного листа
						->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);				
			$active_sheet->getPageSetup()
						->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			$active_sheet->getPageMargins()->setTop(0.1);
			$active_sheet->getPageMargins()->setBottom(0.1);
			$active_sheet->getPageMargins()->setRight(0.1);
			$active_sheet->getPageMargins()->setLeft(0.1);
			$active_sheet->setTitle("SEO параметры");

		//	устанавливаем ширину колонок для всей таблицы, автоматическая ширина для интервалов типа А:Х не действует!!?? 	
			$active_sheet->getColumnDimension('A')->setWidth(20);
			$active_sheet->getColumnDimension('B')->setAutoSize(true);		
			$active_sheet->getColumnDimension('C')->setWidth(13);		
			$active_sheet->getColumnDimension('D')->setWidth(30);
			$active_sheet->getColumnDimension('E')->setAutoSize(true);		
			$active_sheet->getColumnDimension('F')->setAutoSize(true);		
			$active_sheet->getColumnDimension('G')->setAutoSize(true);		
			$active_sheet->getColumnDimension('H')->setAutoSize(true);		
			$active_sheet->getColumnDimension('I')->setAutoSize(true);		
			$active_sheet->getColumnDimension('J')->setAutoSize(true);		
			$active_sheet->getColumnDimension('K')->setWidth(10);		
			$active_sheet->getColumnDimension('L')->setAutoSize(true);		
			$active_sheet->getColumnDimension('M')->setAutoSize(true);		
			$active_sheet->getColumnDimension('N')->setAutoSize(true);		
			$active_sheet->getColumnDimension('O')->setWidth(13);		
			$active_sheet->getColumnDimension('P')->setAutoSize(true);		
			$active_sheet->getColumnDimension('Q')->setWidth(10);		
			$active_sheet->getColumnDimension('R')->setWidth(10);		
			$active_sheet->getColumnDimension('S')->setWidth(10);		
			$active_sheet->getColumnDimension('T')->setAutoSize(true);		
			$active_sheet->getColumnDimension('U')->setAutoSize(true);		
			$active_sheet->getColumnDimension('V')->setAutoSize(true);		
			$active_sheet->getColumnDimension('W')->setAutoSize(true);		
			$active_sheet->getColumnDimension('X')->setAutoSize(true);		

		// шапка таблицы начало 
			$active_sheet->mergeCells('A1:A5');
			$active_sheet->mergeCells('B1:B5');
			$active_sheet->mergeCells('C1:C5');
			$active_sheet->mergeCells('D1:D5');
			$active_sheet->mergeCells('E1:M1');
			$active_sheet->mergeCells('E2:E4');
			$active_sheet->mergeCells('F2:I2');
			$active_sheet->mergeCells('F3:G3');
			$active_sheet->mergeCells('H3:I3');
			$active_sheet->mergeCells('J2:J4');
			$active_sheet->mergeCells('K2:K4');
			$active_sheet->mergeCells('L2:M2');
			$active_sheet->mergeCells('L3:L4');
			$active_sheet->mergeCells('M3:M4');
			$active_sheet->mergeCells('N1:U1');
			$active_sheet->mergeCells('N2:P2');
			$active_sheet->mergeCells('O3:P3');
			$active_sheet->mergeCells('Q2:S2');
			$active_sheet->mergeCells('Q3:Q4');
			$active_sheet->mergeCells('R3:R4');
			$active_sheet->mergeCells('S3:S4');
			$active_sheet->mergeCells('T2:T4');
			$active_sheet->mergeCells('U2:U4');
			$active_sheet->mergeCells('V1:X1');
			$active_sheet->mergeCells('V2:V4');
			$active_sheet->mergeCells('W2:W4');
			$active_sheet->mergeCells('X2:X4');
				// установить Знач ячейки
			$active_sheet->setCellValue('A1','Монитор');
			$active_sheet->setCellValue('B1','п/п');
			$active_sheet->setCellValue('C1','Дата');
			$active_sheet->setCellValue('D1','Проэкт');
			$active_sheet->setCellValue('E1','http://pr-cy.ru/');
			$active_sheet->setCellValue('E2','ТИЦ');
			$active_sheet->setCellValue('E5',0);
			$active_sheet->setCellValue('F2','Страницы');
			$active_sheet->setCellValue('F3','Яндекс');
			$active_sheet->setCellValue('H3','Google');
			$active_sheet->setCellValue('F4','шт.');
			$active_sheet->setCellValue('F5',1);			
			$active_sheet->setCellValue('G4','Д-ка');
			$active_sheet->setCellValue('G5',2);
			$active_sheet->setCellValue('H4','шт.');
			$active_sheet->setCellValue('H5',3);			
			$active_sheet->setCellValue('I4','Д-ка');
			$active_sheet->setCellValue('I5',4);
			$active_sheet->setCellValue('J2','Просмотры');
			$active_sheet->setCellValue('J5',5);
			$active_sheet->setCellValue('K2','max трафик из');
			$active_sheet->setCellValue('K5',6);
			$active_sheet->setCellValue('L2','Baclink');
			$active_sheet->setCellValue('L3','Стр.');
			$active_sheet->setCellValue('M3','Д-ны');
			$active_sheet->setCellValue('L5',7);
			$active_sheet->setCellValue('M5',8);
			$active_sheet->setCellValue('N1','http://www.alexa.com/siteinfo');
			$active_sheet->setCellValue('N2','Популярность');
			$active_sheet->setCellValue('N3','Gl.Rank');
			$active_sheet->setCellValue('N4','Знач');
			$active_sheet->setCellValue('N5',9);
			$active_sheet->setCellValue('O3','Rank in country');
			$active_sheet->setCellValue('O4','Страна');
			$active_sheet->setCellValue('O5',10);
			$active_sheet->setCellValue('P4','Знач');
			$active_sheet->setCellValue('P5',11);
			$active_sheet->setCellValue('Q2','Активность пользователей');
			$active_sheet->setCellValue('Q3','Показатель отказов');
			$active_sheet->setCellValue('R3','Страниц за визит');
			$active_sheet->setCellValue('S3','Ср. продолжит визита');
			$active_sheet->setCellValue('Q5',12);
			$active_sheet->setCellValue('R5',13);
			$active_sheet->setCellValue('S5',14);
			$active_sheet->setCellValue('T2','Процент поискового трафика');
			$active_sheet->setCellValue('U2','Baclink');
			$active_sheet->setCellValue('T5',15);
			$active_sheet->setCellValue('U5',16);
			$active_sheet->setCellValue('V1','https://www.nic.ru/whois/');
			$active_sheet->setCellValue('V2','Дата регистрации домена');
			$active_sheet->setCellValue('W2','Дата окончания домена');
			$active_sheet->setCellValue('X2','Дата обновления домена');
			$active_sheet->setCellValue('V5',17);
			$active_sheet->setCellValue('W5',18);
			$active_sheet->setCellValue('X5',19);
		// шапка таблицы конец  

		// заполняем тело таблицы начало
			$i = 6;		 
			foreach ($arr_row as $item) {
				$row_next = $row_start + $i;
				$active_sheet->setCellValue('A'.$row_next,$item['monitor']);
				$active_sheet->setCellValue('B'.$row_next,$item['id']);
				$active_sheet->setCellValue('C'.$row_next,date('d.m.y H:i:s',$item['Date']));			
				$active_sheet->setCellValue('D'.$row_next,$item['project']);
				$active_sheet->setCellValue('E'.$row_next,$item['cy']);
				$active_sheet->setCellValue('F'.$row_next,$item['page_yndex_pc']);
				$active_sheet->setCellValue('F'.$row_next,$item['page_yndex_dynamics']);
				$active_sheet->setCellValue('H'.$row_next,$item['page_google_pc']);
				$active_sheet->setCellValue('I'.$row_next,$item['page_google_dynamics']);
				$active_sheet->setCellValue('J'.$row_next,$item['Views']);
				$active_sheet->setCellValue('K'.$row_next,$item['max_traffic']);
				$active_sheet->setCellValue('L'.$row_next,$item['Baclink_page']);
				$active_sheet->setCellValue('M'.$row_next,$item['Baclink_domain']);
				$active_sheet->setCellValue('N'.$row_next,$item['Global_Rank']);
				$active_sheet->setCellValue('O'.$row_next,$item['Rank_in_country_country']);
				$active_sheet->setCellValue('P'.$row_next,$item['Rank_in_country_value']);
				$active_sheet->setCellValue('Q'.$row_next,$item['Acidification_index']);
				$active_sheet->setCellValue('R'.$row_next,$item['Pages_per_visit']);
				$active_sheet->setCellValue('S'.$row_next,$item['The_average_will_continue_to_visit']);
				$active_sheet->setCellValue('T'.$row_next,$item['Search_traffic_percentage']);
				$active_sheet->setCellValue('U'.$row_next,$item['baclink_alexa']);
				$active_sheet->setCellValue('V'.$row_next,$item['Domain_registration_date']);
				$active_sheet->setCellValue('W'.$row_next,$item['Domain_end_date']);
				$active_sheet->setCellValue('X'.$row_next,$item['Domain_renewal_date']);
				$i++;
				}
		// заполняем тело таблицы конец

		// Форматирование (задание стилей) таблицы начало 
			$style_all_table = array(		//	стили для всей таблицы
				'borders'=>array(
					'outline'=>array(
						'style'=>PHPExcel_Style_Border::BORDER_THICK
						),
					'allborders'=>array(
						'style'=>PHPExcel_Style_Border::BORDER_THIN,
						'color'=>array(
							'rgb'=>'000000'
							)
						)
					),
				'font'=>array(
					'name'=>'Times New Roman',
					'size'=>10,
					'indent'=>1
					),
				'alignment'=>array(
					'horizontal'=>PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
					'vertical'=>PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
					'rotation'=>0
					)								
				);
				$active_sheet->getStyle('A1:X'.($i-1))->applyFromArray($style_all_table);

			$style_header = array(		//	стили для шапки таблицы
				'font'=>array(
					'bold'=>true,
					'name'=>'Times New Roman',
					'size'=>12
					),
				);
				$active_sheet->getStyle('A1:X5')->applyFromArray($style_header);

			$style_vertical_text = array(		//	стили для вертикального текста
				'alignment'=>array(
					'rotation'=>90
					),
				'font'=>array(
					'size'=>8
					)												
				);
				$active_sheet->getStyle('E2')->applyFromArray($style_vertical_text);				
				$active_sheet->getStyle('J2')->applyFromArray($style_vertical_text);				
				$active_sheet->getStyle('L3')->applyFromArray($style_vertical_text);				
				$active_sheet->getStyle('M3')->applyFromArray($style_vertical_text);				
				$active_sheet->getStyle('Q3')->applyFromArray($style_vertical_text);				
				$active_sheet->getStyle('R3')->applyFromArray($style_vertical_text);				
				$active_sheet->getStyle('S3')->applyFromArray($style_vertical_text);				
				$active_sheet->getStyle('T2')->applyFromArray($style_vertical_text);				
				$active_sheet->getStyle('U2')->applyFromArray($style_vertical_text);	
			
			$style_left_text = array(		//	стили для ячеек с выравниванием по левому краю
				'alignment'=>array(
					'horizontal'=>PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT
					)								
				);
				$active_sheet->getStyle('A6:A'.($i-1))->applyFromArray($style_left_text);							
				$active_sheet->getStyle('D6:D'.($i-1))->applyFromArray($style_left_text);							
		
			$style_text_small_size = array(		//	стили для ячеек с маленьким размером текста 
				'font'=>array(
					'size'=>8
					),								
				);
				$active_sheet->getStyle('A5:X5')->applyFromArray($style_text_small_size);
				$active_sheet->getStyle('K5:K'.($i-1))->applyFromArray($style_text_small_size);

			$style_text_large_size = array(		//	стили для ячеек с большим размером текста 
				'font'=>array(
					'size'=>14
					),								
				);
				$active_sheet->getStyle('D5:D'.($i-1))->applyFromArray($style_text_large_size);

			$style_line_wrap = array(		//	стили для ячеек с переносом строк
				'alignment'=>array(
					'wrap'=> TRUE,
					'vertical'=>PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER
					)								
				);
				$active_sheet->getStyle('F1:X'.($i-1))->applyFromArray($style_line_wrap);				
		
			$style_cell_fill = array(		//	стили для ячеек с заливкой
				'fill'=>array(	
					'type'       => PHPExcel_Style_Fill::FILL_SOLID,
					'color'   => array(
						'rgb' => 'D5FBF0'
						)
					)
				);
				$active_sheet->getStyle('E2:E'.($i-1))->applyFromArray($style_cell_fill);
				$active_sheet->getStyle('J2:J'.($i-1))->applyFromArray($style_cell_fill);
				$active_sheet->getStyle('N2:N'.($i-1))->applyFromArray($style_cell_fill);
				$active_sheet->getStyle('Q2:Q'.($i-1))->applyFromArray($style_cell_fill);
				$active_sheet->getStyle('T2:T'.($i-1))->applyFromArray($style_cell_fill);

			$style_text_color = array(		//	стили для ячеек с текстом выделенным отдельным цветом
				'font'=>array(
					'color'   => array(
						'rgb' => '00FF00'
						)
					),							
				);
				$active_sheet->getStyle('A6:A'.($i-1))->applyFromArray($style_text_color);

		// Форматирование (задание стилей) таблицы конец 		

		//	даём команду браузеру отдать на скачивание файл в формате эксель, указываем его имя и даём команду сохранить
		// header("Content-Type:application/vnd.ms-excel");
		// header("Content-Disposition:attachment;filename='simple.xlsx'");
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExecel, 'Excel2007');
		// $objWriter->save('php://output');	//	Сохраняет браузер через форму "Сохранить файл"
		$objWriter->save('simple.xlsx');

		exit();

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







 ?>