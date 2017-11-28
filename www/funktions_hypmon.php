<?php 
	function GetWebPage( $url, $conect_out = 120, $tim_out = 120){    
       
       // echo "Вход в функцию: ".__FUNCTION__."<br><br><br>";		

		$headers = array(
			'GET ' . $url . ' HTTP/1.0',
			'Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash,
		                  application/vnd.ms-excel, application/msword, */*',
			'Accept-Language: ru,zh-cn;q=0.7,zh;q=0.3',
			'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)'
			// 'Proxy-Connection: Keep-Alive'
			);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
        curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки

		curl_setopt($ch, CURLOPT_COOKIESESSION, true);  
        curl_setopt($ch, CURLOPT_COOKIEJAR,    __DIR__."/cookies/cookies.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE,   __DIR__."/cookies/cookies.txt");  
      
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        curl_setopt($ch, CURLOPT_HEADER, true);		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  
        curl_setopt($ch, CURLOPT_REFERER, $url);       

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

        if ($result['errno'] != 0) {  // если ошибка
         	echo "<br>Код ошибки: &nbsp".$result['errmsg']; 
           return $result;
          }     
        if ($result['http_code'] != 200){
           	echo "<br>Запрос по адресу: &nbsp-&nbsp".$url;
           	echo "<br>&nbsp&nbsp&nbsp&nbsp Код ответа сервера: &nbsp".$result['http_code']."<br>";       // если ошибка....
          	return $result;
          }
        // если не ошибка
        
            $page = $result['content'];
            // echo $page;
            return $page;
      }

	function GetHypNam(){

       	// Добавить мониторы для сбора хайпов:
		// 		1. https://fairmonitor.com/home/ 

       // echo "<br> Вход в функцию: ".__FUNCTION__."<br>";		


		// $page_1 = file_get_contents("https://bitmakler.com/investmentfund");
		// $page_1 = GetWebPage("https://bitmakler.com/investmentfund");
		// 	if (is_array($page_1)) { $page_1 = implode(" ", $page_1);}				
		// 		$patern_1 = '#<b onclick="openpage\(\'(https?://(?:www\.)?.*\.*/)#U'; 
		// 		if (!preg_match_all($patern_1,$page_1,$result_1a,PREG_PATTERN_ORDER)) { 
		// 		    echo "func GetHypNam:  patern_1 ненайден или ошибка";
		// 		    return false;
		// 			} 		
	 
		// 		for ($q=0; $q < count($result_1a[1]); $q++) { 			//  с массива всех значений извлекаем только нужные
		// 			$result_1[$q] = $result_1a[1][$q];
		// 			}

		// 			$result_1c = array('1'=>'https://bitmakler.com/investmentfund','2' => count($result_1));
		// 			array_unshift($result_1, $result_1c);

		// $page_2 = GetWebPage('http://allhyipmon.ru/rating');
		// 	if (is_array($page_2)) { $page_2 = implode(" ", $page_2);}
		// 	$patern_2 = '#<div>\d{1,2}\. <b><a href="/monitor/.*>(.*)</a></b>.*мониторингов</div>#U'; // рабочий вариант
		// 	$n=0;
		// 	$result_2 = array();
		// 	do{
		// echo $n."&nbsp;&nbsp; итерация цыкла DO-WHILE в функции: ".__FUNCTION__."<br><br><br>";		
		// 		if (!preg_match_all($patern_2,$page_2,$result_2a,PREG_PATTERN_ORDER)) { 
		// 		    echo "func GetHypNam:  patern_2 ненайден или ошибка";
		// 		    return false;
		// 			} 

		// 		for ($q=0; $q < count($result_2a[1]); $q++) { 			//  с массива всех значений извлекаем только нужные
		// 			$result_2b[$q] = $result_2a[1][$q];
		// 			}
		// 		$result_2 = array_merge($result_2,$result_2b);

		// 		$n++;
		// 		$url = 'http://allhyipmon.ru/rating?page='.$n.'<br>';
		// // 		 // echo $url;

		// 		// sleep(rand(1,5));
		// 		sleep(mt_rand(1,5));
		// 		$page_2 = GetWebPage($url);

		// 	// }while ($n <= 5);		//	рабочий вариант строки
		// 	}while ($n <= 1);		//	для тестов

				// $result_2c = array('1'=>'http://allhyipmon.ru/rating','2' => count($result_2));
				// array_unshift($result_2, $result_2c);

		$page_3 = GetWebPage('http://list4hyip.com/');
				if (is_array($page_3)) { $page_3 = implode(" ", $page_3);}	
				// $patern_3 = '#<a.*target="_blank">.*<img src=.*(?!list4hyip.com)(https?://(?!mozshot.nemui.org).*/)#sU'; 	// рабочая строка
				$patern_3 = '#<a.*target="_blank">.*<img src=.*(?!list4hyip.com)(https?://(?!mozshot.nemui.org).*)/#sU'; 	// для тестов
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
	 	//  $result = array_merge(/*$result_1,*/$result_2,$result_3);
 		//  return $result;
        // return $result_1;
        // return $result_2;
         return $result_3;
		}

	function ParsSeoParamHayp($URL_hyp){     
		// предполагаеться вызов в теле ф-ции GetHypNam поочерёдно для каждого массива хайпов отдельно.
		// т.е один хайп проганяется поочерёдно по всем сераисам анализа сайтов
		// заполняеться вся строка и только после этого переходм к другому хайпу 

		$page = GetWebPage('https://a.pr-cy.ru/'.$URL_hyp);		
			if (is_array($page)) { $page = implode(" ", $page);}		

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
			
			// echo "<br><br>".$page;

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

		// $page = GetWebPage('https://www.nic.ru/whois/?query='.$URL_hyp);	
		$page = GetWebPage('http://hoston.com.ua/domains/whois?domain='.$URL_hyp);	

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

		for ($i=count($arr_param_hyp); $i < 20; $i++) { 
			array_push($arr_param_hyp, 'X');
			}


		// echo "<br> Конец выполнения функции &nbsp - &nbsp".date("d.m.y H:i:s",time());
		return $arr_param_hyp;

		}

	function conect_DB(){	
		/* Соединяемся, выбираем базу данных */
	    // $link_DB = mysqli_connect('mysql.zzz.com.ua','romron','Rom343714','romron');
	    // $link_DB = mysqli_connect('db3.ho.ua','hypmonbot','Rom343714','hypmonbot',3306);
	    $link_DB = mysqli_connect('hypmon.mysql.ukraine.com.ua','hypmon_1','Rom343714','hypmon_1');
	    

	    if (mysqli_connect_errno()) {
	    	echo "<br> Ошибка при подключении к базе данных (".mysqli_connect_errno()."): ".mysqli_connect_error();
	    	}else{
	    	echo '<br> Соединение установлено... ' . mysqli_get_host_info($link_DB) . "<br><br>";
	    	}
	    return $link_DB;	
		}

	function querySelectFromDB($name_table,$link_DB,$name_field="*",$text_query=""){	//	Данная функция извликает данные из базы
	    /* Выполняем SQL-запрос */
	    
	    echo "<br>".__FUNCTION__."&nbsp&nbsp получено поле: &nbsp&nbsp".$name_field."<br>";

	    $query = "SELECT `".$name_field."` FROM`".$name_table."`".$text_query;

	    //        SELECT `ORDER BY `project`` FROM`Work_table_1`
	    //        SELECT      *            FROM `test_2` ORDER BY `project`
	    echo "<br>".$query."<br><br>";

	    $result = mysqli_query($link_DB,$query) or die(__FUNCTION__."&nbsp&nbspQuery failed : " . mysql_error());	    

	   	return $result;
		}

	function queryInputIntoDB($name_table,$link_DB,$HypMonName,$NameHyp,$ArrParamHype) {	//	Данная функция добавляет данные в базу
		
		$date_today = time();	//	получаем текушее кол-во секунд в эпохе Юникс

		for ($q=0; $q < 30; $q++) { 
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

			    $query_input = "INSERT INTO ".$name_table."(`monitor`, 
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
			    									`Domain_renewal_date`,
			    									`Min_deposit`,			    									 
			    									`Interest_rate_in_value`,			    									 
			    									`Period_of_payment_of_interest`,			    									 
			    									`Min_term_of_deposit_value`,			    									 
			    									`Min_term_of_deposit_units`,			    									 
			    									`Payback_period`,			    									 
			    									`Profit_for_the_whole_period`,			    									 
			    									`Profit_per_day`,			    									 
			    									`ROI`,			    									 
			    									`Profitability`,			    									 
			    									`Profitability_per_cent_per_year`			    									 
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
			    									'".$ArrParamHype[19]."',
			    									'".$ArrParamHype[20]."',
			    									'".$ArrParamHype[21]."',
			    									'".$ArrParamHype[22]."',
			    									'".$ArrParamHype[23]."',
			    									'".$ArrParamHype[24]."',
			    									'".$ArrParamHype[25]."',
			    									'".$ArrParamHype[26]."',
			    									'".$ArrParamHype[27]."',
			    									'".$ArrParamHype[28]."',
			    									'".$ArrParamHype[29]."',
			    									'".$ArrParamHype[30]."'
			    									)";
			    /* Выполняем SQL-запрос */
			    mysqli_query($link_DB,$query_input) or die("Query failed : " . mysqli_error($link_DB));
			}

	function OutputResultSQL_InExcel($result_query_SQL){

		//		Установить одинаковую высоту строк
		//		
		//	-.	Если среди полученных фин показателей есть нули то в соответствующие ячейки блока расчётных фин данных вставлять формулы. Т.Е. при ручном введении в пустую, нулевую, ячейкку произвольного числа 
		//		остальные ячейки автомат просчитываються
		//	+.	В общей таблице отмечать цветом (0F0DD3 - синий) и размером 11 дату возникновения проэкта всю остальную строку - цветом и жирным шрифтом -- ПЕРВАЯ СТРОКА БЛОКА
		//	+.	В общей таблице отмечать обычным шрифтом и размером 8 все строки от возникновения проэкта до сегоднешней даты
		//	+.	В общей таблице отмечать жирным шрифтом и размером 11 сегодняшнюю дату всю остальную строку - только жирным шрифтом -- ПОСЛЕДНЯЯ СТРОКА БЛОКА 
		//	+.	Установить фильтры на 5-ю строку
		// 	5.	В общей таблице отмечать цветом (B47908 - коричневый) и размером 11 последнюю дату ищезнувшего проэкта (т.е. в скаме нет и проэкта нет. Статус - "ПРОБЛЕМА") 
		//		-- может быть ПОСЛЕДНЕЙ СТРОКОЙ БЛОКА
		//	7.	В общей таблице отмечать цветом и размером 11 дату и монитор по которому выпал проэкт в скам -- ПОСЛЕДНЯЯ СТРОКА БЛОКА 
		//	6.	В общей таблице отмечать цветом (F9FED6 - светло жолтый) фон проэктов который ведётся по разным мониторам  
		//		Определяеться по нахождению проэкта на скам-странице сайта. всю остальную строку - цветом и жирным шрифтом (Статус - "СКАМ")
		//	8.	Сформировать на отдельных листах таблицы по пунктам СКАМ и ПРОБЛЕМА
		// 	9.	Колонки блоков проэктов с наблюдаемой динамикой выдилять фоном (понижение один фон повышение второй фон) чем выше динамика тем ярче фон 
		// 	10.	Строки с новыми проэктами выделять 
		
		$current_date = time();

		for ($i=0; $i < mysqli_num_rows($result_query_SQL); $i++) { 	//	Из полученного обьекта базы данных формируем АССОЦИАТИВНЫЙ массив 
			$arr_row[] = mysqli_fetch_assoc($result_query_SQL); 
				// if ($i>100) { break; }		// для тестов
				}

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
			$active_sheet->getColumnDimension('A')->setWidth(22);
			$active_sheet->getColumnDimension('B')->setAutoSize(true);		
			$active_sheet->getColumnDimension('C')->setWidth(18);		
			$active_sheet->getColumnDimension('D')->setWidth(18);
			$active_sheet->getColumnDimension('E')->setAutoSize(true);		
			$active_sheet->getColumnDimension('F')->setAutoSize(true);		
			$active_sheet->getColumnDimension('G')->setAutoSize(true);		
			$active_sheet->getColumnDimension('H')->setWidth(6);		
			$active_sheet->getColumnDimension('I')->setAutoSize(true);		
			$active_sheet->getColumnDimension('J')->setAutoSize(true);		
			$active_sheet->getColumnDimension('K')->setWidth(10);		
			$active_sheet->getColumnDimension('L')->setWidth(6);		
			$active_sheet->getColumnDimension('M')->setWidth(6);		
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
			$active_sheet->getColumnDimension('Y')->setWidth(6);		
			$active_sheet->getColumnDimension('Z')->setWidth(9);		
			$active_sheet->getColumnDimension('AA')->setAutoSize(true);		
			$active_sheet->getColumnDimension('AB')->setAutoSize(true);		
			$active_sheet->getColumnDimension('AC')->setWidth(8);		
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
			$active_sheet->mergeCells('Y1:AI1');
			$active_sheet->mergeCells('Y2:AC2');
			$active_sheet->mergeCells('AD2:AI2');
			$active_sheet->mergeCells('Y3:Y4');
			$active_sheet->mergeCells('Z3:AA3');
			$active_sheet->mergeCells('AB3:AC3');
			$active_sheet->mergeCells('AD3:AD4');
			$active_sheet->mergeCells('AE3:AE4');
			$active_sheet->mergeCells('AF3:AF4');
			$active_sheet->mergeCells('AG3:AG4');
			$active_sheet->mergeCells('AH3:AH4');
			$active_sheet->mergeCells('AI3:AI4');
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
				$active_sheet->setCellValue('Y1','Финансовые показатели проэктов');
				$active_sheet->setCellValue('Y2','ПОЛУЧЕННЫЕ');
				$active_sheet->setCellValue('AD2','РАСЧЁТНЫЕ');
				$active_sheet->setCellValue('Y3','Мин. депозит');
				$active_sheet->setCellValue('Z3','Проц. Ставка, %');
				$active_sheet->setCellValue('AB3','Мин. срок вклада');
				$active_sheet->setCellValue('AD3','Срок окупаемости, дней');
				$active_sheet->setCellValue('AE3','Прибыль за весь периуд, $');
				$active_sheet->setCellValue('AF3','Прибыль в день, $');
				$active_sheet->setCellValue('AG3','ROI, %');
				$active_sheet->setCellValue('AH3','Доходность, %');
				$active_sheet->setCellValue('AI3','Доходность в процентах годовых, %');
				$active_sheet->setCellValue('Z4','Значение');
				$active_sheet->setCellValue('AA4','Период выплаты процентов');
				$active_sheet->setCellValue('AB4','Значение');
				$active_sheet->setCellValue('AC4','Единицы измерения');
				$active_sheet->setCellValue('V5',17);
				$active_sheet->setCellValue('W5',18);
				$active_sheet->setCellValue('X5',19);
				$active_sheet->setCellValue('Y5',20);
				$active_sheet->setCellValue('Z5',21);
				$active_sheet->setCellValue('AA5',22);
				$active_sheet->setCellValue('AB5',23);
				$active_sheet->setCellValue('AC5',24);
				$active_sheet->setCellValue('AD5',25);
				$active_sheet->setCellValue('AE5',26);
				$active_sheet->setCellValue('AF5',27);
				$active_sheet->setCellValue('AG5',28);
				$active_sheet->setCellValue('AH5',29);
				$active_sheet->setCellValue('AI5',30);
		// шапка таблицы конец  

		// заполняем тело таблицы начало
			$i = 6;	
			$q = 0;	 
			foreach ($arr_row as $item) {
				$row_next = $row_start + $i;
				
				foreach ($item as $key => $value) {		// вместо нулей ставлю пустые строки 
					if ($value == '0' or is_null($value)) {
							$item[$key] = '';
							}
					}
				
				$active_sheet->setCellValue('A'.$row_next,$item['monitor']);
				$active_sheet->setCellValue('B'.$row_next,$item['id']);
				$active_sheet->setCellValue('C'.$row_next,date('d.m.y H:i:s',$item['date']));
				$active_sheet->setCellValue('D'.$row_next,$item['project']);
				//	групировка строк
					if ($item['project'] == $previous_item_project) {
						$active_sheet->getRowDimension($i-1)->setOutlineLevel(1);		//	Какая строка и на какой уровень свернуть
						$active_sheet->getRowDimension($i-1)->setVisible(false);		//	Скрыть свёрнутую строку
						// $active_sheet->setShowSummaryBelow(false);					//	указатель свёрнутой строки, крестик, сверху тогда на виду оста'ться первая строка блока, '
						if ($q == 0) {								//	Cтили первой строки блока
							$n_first_row = $i-1;	// номер первой строки объединяемых ячеек
							$style_first_str_block = array(		
								'font'=>array(
									'bold'=>true,
									'size'=>10,
									'color'   => array(
										// 'rgb' => '0F0DD3'
										'rgb' => '3C7BAF'
										),								
									),
								);
							$style_first_str_cell_date = array(		
								'font'=>array(
									'bold'=>true,
									'size'=>12
									),
								);
							$active_sheet->getStyle('C'.($i-1))->applyFromArray($style_first_str_block);						
							$active_sheet->getStyle('E'.($i-1).':AI'.($i-1))->applyFromArray($style_first_str_block);						
							$active_sheet->getStyle('C'.($i-1).':D'.($i-1))->applyFromArray($style_first_str_cell_date);							
							}
						$style_str_in_middle_block = array(			//	Стили строк в середине блока		
							'font'=>array(
								'size'=>8,
								'color'   => array(
									'rgb' => '000000'
									),								
								),
							);						
						$active_sheet->getStyle('C'.$i.':X'.$i)->applyFromArray($style_str_in_middle_block);							
						$q = 1;
					}elseif ($q != 0) {
						$active_sheet->getRowDimension($i)->setCollapsed(true);	//	Выводить строки свёрнутыми, указывать номер строки следующей за последней строкой блока
						$q = 0;
						//	Cтили последней строки блока  сдесь проверять текущий статус проэкта: OK, PROBLEM, SCAM
						if ($PROBLEM == 1) {
							# code...
							}elseif ($SCAM == 1) {
							# code...
							}else{
								$style_last_str_block = array(		
									'font'=>array(
										'bold'=>true,
										'size'=>10,
										'color'   => array(
											'rgb' => '000000'
											),								
										),
									);
								$style_last_str_cell_date = array(		
									'font'=>array(
										'size'=>11
										),
									);
								$active_sheet->getStyle('C'.($i-1).':X'.($i-1))->applyFromArray($style_last_str_block);						
								$active_sheet->getStyle('C'.($i-1).':D'.($i-1))->applyFromArray($style_last_str_cell_date);									
								}
							$active_sheet->mergeCells('D'.$n_first_row.':'.'D'.($i-1));
						}
				$active_sheet->setCellValue('E'.$row_next,$item['cy']);
				$active_sheet->setCellValue('F'.$row_next,$item['page_yndex_pc']);
				$active_sheet->setCellValue('F'.$row_next,$item['page_yndex_dynamics']);
				$active_sheet->setCellValue('H'.$row_next,$item['page_google_pc']);
				$active_sheet->setCellValue('I'.$row_next,$item['page_google_dynamics']);
				$active_sheet->setCellValue('J'.$row_next,$item['Views']);
				// $active_sheet->setCellValue('K'.$row_next,$item['max_traffic']);
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
				$active_sheet->setCellValue('Y'.$row_next,$item['Min_deposit']);
				$active_sheet->setCellValue('Z'.$row_next,$item['Interest_rate_in_value']);
				$active_sheet->setCellValue('AA'.$row_next,$item['Period_of_payment_of_interest']);
				$active_sheet->setCellValue('AB'.$row_next,$item['Min_term_of_deposit_value']);
				$active_sheet->setCellValue('AC'.$row_next,$item['Min_term_of_deposit_units']);
				$active_sheet->setCellValue('AD'.$row_next,$item['Payback_period']);
				$active_sheet->setCellValue('AE'.$row_next,$item['Profit_for_the_whole_period']);
				$active_sheet->setCellValue('AF'.$row_next,$item['Profit_per_day']);
				$active_sheet->setCellValue('AG'.$row_next,$item['ROI']);
				$active_sheet->setCellValue('AH'.$row_next,$item['Profitability']);
				$active_sheet->setCellValue('AI'.$row_next,$item['Profitability_per_cent_per_year']);
				$previous_item_project = $item['project'];
				$i++;
				}
		// заполняем тело таблицы конец

		// Форматирование (задание стилей) таблицы начало 
			$active_sheet->getRowDimension('4')->setRowHeight(45);		//	устанавливаем высоту строк
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
					// 'size'=>10,
					'indent'=>1
					),
				'alignment'=>array(
					'horizontal'=>PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
					'vertical'=>PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
					'rotation'=>0
					)								
				);
				$active_sheet->getStyle('A1:AI'.($i-1))->applyFromArray($style_all_table);

			$style_header = array(		//	стили для шапки таблицы
				'font'=>array(
					'bold'=>true,
					'name'=>'Times New Roman',
					'size'=>12
					),
				);
				$active_sheet->getStyle('A1:AI5')->applyFromArray($style_header);
			$active_sheet->freezePane('A6');	//	закрепляем шапку т.е. всё что выше и левее указаной ячейки будет зафиксировано

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
				$active_sheet->getStyle('Y3')->applyFromArray($style_vertical_text);	
				$active_sheet->getStyle('Z4')->applyFromArray($style_vertical_text);	
				$active_sheet->getStyle('AC4')->applyFromArray($style_vertical_text);	
				$active_sheet->getStyle('AD3')->applyFromArray($style_vertical_text);	
				$active_sheet->getStyle('AE3')->applyFromArray($style_vertical_text);	
				$active_sheet->getStyle('AF3')->applyFromArray($style_vertical_text);	
				$active_sheet->getStyle('AG3')->applyFromArray($style_vertical_text);	
				$active_sheet->getStyle('AH3')->applyFromArray($style_vertical_text);	
				$active_sheet->getStyle('AI3')->applyFromArray($style_vertical_text);	
				$active_sheet->getStyle('AA4')->applyFromArray($style_vertical_text);	
				$active_sheet->getStyle('AB4')->applyFromArray($style_vertical_text);	
			
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
				$active_sheet->getStyle('A5:AI5')->applyFromArray($style_text_small_size);
				$active_sheet->getStyle('K5:K'.($i-1))->applyFromArray($style_text_small_size);

			// $style_text_large_size = array(		//	стили для ячеек с большим размером текста 
			// 	'font'=>array(
			// 		'size'=>14
			// 		),								
			// 	);
			// 	$active_sheet->getStyle('D5:D'.($i-1))->applyFromArray($style_text_large_size);

			$style_line_wrap = array(		//	стили для ячеек с переносом строк
				'alignment'=>array(
					'wrap'=> TRUE,
					'vertical'=>PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER
					)								
				);
				$active_sheet->getStyle('A1:AI'.($i-1))->applyFromArray($style_line_wrap);				
		
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
						'rgb' => '195912'
						)
					),							
				);
				$active_sheet->getStyle('A6:A'.($i-1))->applyFromArray($style_text_color);

			$active_sheet->getStyle('N6:N'.($i-1))->getNumberFormat()->setFormatCode('#,##0');	//	разделяем группы разрядов
			$active_sheet->getStyle('J6:J'.($i-1))->getNumberFormat()->setFormatCode('#,##0');	

			//	Скрываем столбцы
			$active_sheet->getColumnDimension('A')->setVisible(true);
			$active_sheet->getColumnDimension('B')->setVisible(false);

			// групируем столбцы 
				$active_sheet->getColumnDimension('V')->setOutlineLevel(1);
				$active_sheet->getColumnDimension('W')->setOutlineLevel(1);
				$active_sheet->getColumnDimension('X')->setOutlineLevel(1);
				$active_sheet->getColumnDimension('V')->setVisible(false);		//	Скрыть свёрнутую строку
				$active_sheet->getColumnDimension('W')->setVisible(false);		//	Скрыть свёрнутую строку
				$active_sheet->getColumnDimension('X')->setVisible(false);		//	Скрыть свёрнутую строку
				$active_sheet->getColumnDimension('Y')->setCollapsed(true);	//	Выводить строки свёрнутыми, указывать номер строки следующей за последней строкой блока

				$active_sheet->getColumnDimension('F')->setOutlineLevel(1);
				$active_sheet->getColumnDimension('G')->setOutlineLevel(1);
				$active_sheet->getColumnDimension('H')->setOutlineLevel(1);
				$active_sheet->getColumnDimension('I')->setOutlineLevel(1);
				$active_sheet->getColumnDimension('F')->setVisible(false);		//	Скрыть свёрнутую строку
				$active_sheet->getColumnDimension('G')->setVisible(false);		//	Скрыть свёрнутую строку
				$active_sheet->getColumnDimension('H')->setVisible(false);		//	Скрыть свёрнутую строку
				$active_sheet->getColumnDimension('I')->setVisible(false);		//	Скрыть свёрнутую строку
				$active_sheet->getColumnDimension('J')->setCollapsed(true);	//	Выводить строки свёрнутыми, указывать номер строки следующей за последней строкой блока

				$active_sheet->getColumnDimension('O')->setOutlineLevel(1);
				$active_sheet->getColumnDimension('P')->setOutlineLevel(1);
				$active_sheet->getColumnDimension('O')->setVisible(false);		//	Скрыть свёрнутую строку
				$active_sheet->getColumnDimension('P')->setVisible(false);		//	Скрыть свёрнутую строку
				$active_sheet->getColumnDimension('Q')->setCollapsed(true);	//	Выводить строки свёрнутыми, указывать номер строки следующей за последней строкой блока	

				$active_sheet->getColumnDimension('K')->setOutlineLevel(1);
				$active_sheet->getColumnDimension('L')->setOutlineLevel(1);
				$active_sheet->getColumnDimension('M')->setOutlineLevel(1);
				$active_sheet->getColumnDimension('K')->setVisible(false);		//	Скрыть свёрнутую строку
				$active_sheet->getColumnDimension('L')->setVisible(false);		//	Скрыть свёрнутую строку
				$active_sheet->getColumnDimension('M')->setVisible(false);		//	Скрыть свёрнутую строку
				$active_sheet->getColumnDimension('N')->setCollapsed(true);	//	Выводить строки свёрнутыми, указывать номер строки следующей за последней строкой блока			

			//	устанока фильтров
			$active_sheet->setAutoFilter('E5:AI5');
		// Форматирование (задание стилей) таблицы конец 		

		//	даём команду браузеру отдать на скачивание файл в формате эксель, указываем его имя и даём команду сохранить
		// header("Content-Type:application/vnd.ms-excel");
		// header("Content-Disposition:attachment;filename='simple.xlsx'");
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExecel, 'Excel2007');
		// $objWriter->save('php://output');	//	Сохраняет браузер через форму "Сохранить файл"
		$objWriter->save('simple.xlsx');

		exit();

		}

	function ParsFinParamHyp($URL_hyp)    {

		$str_URL = 'http://allhyipmon.ru/';
		$arr_result = array();
		$arr_fin_param_hyp = array();

		$patern_URL ='#(?:https?:\/\/)?[w]{0,3}\.?(.*)/?#';
			if (!preg_match_all($patern_URL,$URL_hyp,$result_URL,PREG_PATTERN_ORDER)) { 
			    echo "func TEST:  $patern_URL ненайден или ошибка";
			    return false;
				} 			
		// Получаем фин параметры с монитора http://allhyipmon.ru
			// $str_URL = 'http://allhyipmon.ru/monitor/'.$result_URL[1][0];		// формирую URL страницы подробностей для данного хайпа
			// $page_details = GetWebPage($str_URL);		// получаю страницы подробностей для данного хайпа
			
			// $patern_1 = '#<tr class="polz".*Минимальный вклад.*;">\$? ?([\d\.]+)<\/b>#';	//	минимальный вклад
			// 	if (!preg_match_all($patern_1,$page_details,$result_1,PREG_PATTERN_ORDER)) { 
			// 	    // echo "func TEST:  patern_1 ненайден или ошибка";
			// 		} 	
			// 	$result_1[1] = str_replace('.',',',$result_1[1]);								
		
			// $patern_2 = '#<td>Планы:<\/td><td><b style="color:\#155a9e;">(.*)<\/b>#';		//	остальные фин паказатели
			// 	if (!preg_match_all($patern_2,$page_details,$result_2,PREG_PATTERN_ORDER)) { 
			// 	    // echo "func TEST:  patern_2 ненайден или ошибка";
			// 		// exit();
			// 		} 				
			
			// 	$patern_2_1 = '#^-? ?(\d+\.?,?\d{0,3})%?#m';								//	процентная ставка
			// 		if (!preg_match_all($patern_2_1,$result_2[1][0],$result_2_1,PREG_PATTERN_ORDER)) { 
			// 		    // echo "func TEST:  patern_2_1 ненайден или ошибка<br>";
			// 			// exit();
			// 			} 	
			// 		$result_2_1[1] = str_replace('.',',',$result_2_1[1]);									
			
			// 	$patern_2_2 = '#^.*([dD]aily|день|[Hh]ourly|[dD]ays?|monthly)#m';			//	периуд мин процентной ставки
			// 		if (!preg_match_all($patern_2_2,$result_2[1][0],$result_2_2,PREG_PATTERN_ORDER)) { 
			// 		    // echo "func TEST:  patern_2_2 ненайден или ошибка<br>";
			// 			// exit();
			// 			} 	
		
			// 	$patern_2_3 = '#^.*(?:(?:в день)|на|[Ff]or|to) +(\d{0,}(бессрочно)?)#m';	//	Мин. срок вклада
			// 		if (!preg_match_all($patern_2_3,$result_2[1][0],$result_2_3,PREG_PATTERN_ORDER)) { 
			// 		    // echo "func TEST:  patern_2_2_2 ненайден или ошибка<br>";
			// 			// exit();
			// 			} 	
		
			// 	$patern_2_4 = '#^.*\d+ +(день|дней|дня|days?|hours?|года?|months?)#mi';		//	час,  день, неделя...
			// 		if (!preg_match_all($patern_2_4,$result_2[1][0],$result_2_4,PREG_PATTERN_ORDER)) { 
			// 		    // echo "func TEST:  patern_2_2_4 ненайден или ошибка<br>";
			// 			// exit();
			// 			} 	

		// Получаем фин параметры с монитора http://list4hyip.com
			$page_list4hyip = GetWebPage('http://list4hyip.com');		// получаю страницу с перечнем хайпов
		


		array_push($arr_result,$result_1[1][0],$result_2_1[1][0],$result_2_2[1][0],$result_2_3[1][0],$result_2_4[1][0]);
		array_push($arr_fin_param_hyp,$arr_result);
		$str_URL = '';
		array_splice($arr_result,0);

		return $arr_fin_param_hyp[0];
		}

	function CalcFinParamHyp($Arr_Fin_Param_Hyp){
			
		// -. добавить оценку риска для каждого из проэктов

		$Arr_Fin_Param_Hyp[0] = str_replace(",",".",$Arr_Fin_Param_Hyp[0]);
		$Arr_Fin_Param_Hyp[1] = str_replace(",",".",$Arr_Fin_Param_Hyp[1]);
		$Arr_Fin_Param_Hyp[3] = str_replace(",",".",$Arr_Fin_Param_Hyp[3]);

		//	защита от деления на ноль
			if ($Arr_Fin_Param_Hyp[0] == '0' or $Arr_Fin_Param_Hyp[0] == '' or 	//	минимальный вклад
				$Arr_Fin_Param_Hyp[1] == '0' or $Arr_Fin_Param_Hyp[1] == '' or 	// процентная ставка
				$Arr_Fin_Param_Hyp[3] == '0' or $Arr_Fin_Param_Hyp[3] == '') {	//	Мин. срок вклада
					
					$payback_period = "" ;
					$profit_for_the_whole_period = "";
					$profit_per_day = "";
					$ROI = "";
					$profitability = "";
					$profitability_per_cent_per_year = "";

					$CalcFinParamHyp = array($payback_period,$profit_for_the_whole_period,$profit_per_day,$ROI,$profitability,$profitability_per_cent_per_year);
					return $CalcFinParamHyp;	
					}

		$patern_hour = '#hour#i';
		if (preg_match($patern_hour,$Arr_Fin_Param_Hyp[2])) {
			$Arr_Fin_Param_Hyp[1] = $Arr_Fin_Param_Hyp[1]*24;
			}


		$profit_per_day = round(($Arr_Fin_Param_Hyp[1]/100*$Arr_Fin_Param_Hyp[0]),2);		//Прибыль в день
		$payback_period = round(($Arr_Fin_Param_Hyp[0]/$profit_per_day),0);		// Срок окупаемости - ДНЕЙ
		$profit_for_the_whole_period = round(($profit_per_day * $Arr_Fin_Param_Hyp[3]),2);		// Прибыль за весь периуд
		$ROI = round((($profit_for_the_whole_period - $Arr_Fin_Param_Hyp[0]) * 0.01),2);	// ROI
		$profitability = round(($profit_for_the_whole_period / $Arr_Fin_Param_Hyp[0] / 0.01),2);	// Доходность 
		$profitability_per_cent_per_year = round(($profit_for_the_whole_period / $Arr_Fin_Param_Hyp[0] * 365 / $Arr_Fin_Param_Hyp[3] / 0.01),2);
		$CalcFinParamHyp = array($payback_period,$profit_for_the_whole_period,$profit_per_day,$ROI,$profitability,$profitability_per_cent_per_year);
		echo "<br>";

		return $CalcFinParamHyp;
		}

	function Build_tree_arr($arr_0,$n=0)  {

		if ($GLOBALS["n"] == 0) { 
			$resalt_str .= "Array &nbsp;( <br>";
			// $GLOBALS["n"] = 1; 
		}
		$GLOBALS["n"]++;		
		if(is_array($arr_0)) {
			foreach ($arr_0 as $key => $value) {
				if (is_array($value)) {
					// for ($W=0; $W < 3*$GLOBALS["n"]; $W++) { $resalt_str .= "&nbsp;"; }	
					$resalt_str .= "[".$key."] => "./*$GLOBALS["n"].*/"&nbsp;Array (<br> ";
					$resalt_str .= Build_tree_arr($value,$n);
					for ($W=0; $W < 4/**$GLOBALS["n"]*/; $W++) { $resalt_str .= "&nbsp;"; }	
					$resalt_str .= ")<br>";
					if ($n !== 0 and $GLOBALS["n"]-1 > $n) {return $resalt_str;}
				}else{
						for ($W=0; $W < 4/**$GLOBALS["n"]*/; $W++) { $resalt_str .= "&nbsp;"; }
						$resalt_str .= "[".$key."] &nbsp; => &nbsp;".trim(strip_tags($value))."<br>";
					}
			}
		}
		return $resalt_str;
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

	function DataProcessing(){



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





 ?>