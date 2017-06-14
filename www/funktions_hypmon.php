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
		$page_1 = file_get_contents("https://bitmakler.com/investmentfund");
				$patern_1 = '#<b onclick="openpage\(\'(https?://(?:www\.)?.*\.*/)#U'; 
				if (!preg_match_all($patern_1,$page_1,$result_1a,PREG_PATTERN_ORDER)) { 
				    echo "patern_1 ненайден или ошибка";
				    return false;
					} 		
	 
				for ($q=0; $q < count($result_1a[1]); $q++) { 			//  с массива всех значений извлекаем только нужные
					$result_1[$q] = $result_1a[1][$q];
					}

					$result_1c = array('1'=>'https://bitmakler.com/investmentfund','2' => count($result_1));
					array_unshift($result_1, $result_1c);

		// $page_2 = GetWebPage('http://allhyipmon.ru/rating');
		// 	$patern_2 = '#<div>\d{1,2}\. <b><a href="/monitor/.*>(.*)</a></b>.*мониторингов</div>#U'; 
		// 	$n=0;
		// 	$result_2 = array();
		// 	do{

		// 		if (!preg_match_all($patern_2,$page_2,$result_2a,PREG_PATTERN_ORDER)) { 
		// 		    echo "patern_2 ненайден или ошибка";
		// 		    return false;
		// 			} 

		// 		for ($q=0; $q < count($result_2a[1]); $q++) { 			//  с массива всех значений извлекаем только нужные
		// 			$result_2b[$q] = $result_2a[1][$q];
		// 			}
		// 		$result_2 = array_merge($result_2,$result_2b);

		// 		$n++;
		// 		$url = 'http://allhyipmon.ru/rating?page='.$n.'<br>';
		// 		 // echo $url;

		// 		set_time_limit(90);
		// 		sleep(rand(2,8));
		// 		$page_2 = GetWebPage($url);

		// 	}while ($n <= 6);

		// 		$result_2c = array('1'=>'http://allhyipmon.ru/rating','2' => count($result_2));
		// 		array_unshift($result_2, $result_2c);

		// $page_3 = GetWebPage('http://list4hyip.com/');
		// 		$patern_3 = '#<a.*target="_blank">.*<img src=.*(?!list4hyip.com)(https?://(?!mozshot.nemui.org).*/)#sU'; 
		// 		if (!preg_match_all($patern_3,$page_3,$result_3a,PREG_PATTERN_ORDER)) { 
		// 		    echo "patern_3 ненайден или ошибка";
		// 		    return false;
		// 			} 
		// 		for ($q=0; $q < count($result_3a[1]); $q++) { 			//  с массива всех значений извлекаем только нужные
		// 			if ($result_3a[1][$q] == "http://list4hyip.com/") {	//	удаляем не нужное
		// 				continue;
		// 				}
		// 			$result_3[$q] = $result_3a[1][$q];
		// 			}

		// 			$result_3c = array('1'=>'http://list4hyip.com/','2' => count($result_3));
		// 			array_unshift($result_3, $result_3c);

	    // $result = array_merge($result_1,$result_2,$result_3);
        // return $result;
        return $result_1;
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
		
			 // echo $page;
			 // exit;

			$patern_0 = '#<a href="https://yaca.yandex.ru/yca/cy/ch/.*" target="_blank">(.*)</a>#'; 		//	ТИЦ 
			if (!preg_match_all($patern_0,$page,$result_0,PREG_PATTERN_ORDER)) { 
			    echo "patern_0 ненайден или ошибка<br>";
			    return false;
				} 

			// $patern_1 = '#<a href="http:\/\/yandex.ru\/yandsearch\?text=host.*target="_blank">(.*)</a>#sU'; 			// шт.  Яндекс
			// $patern_1 = '#<a href="http:\/\/yandex.ru\/yandsearch\?text=host%3Awww.'.$URL_hyp.'\W*target="_blank">(.*)</a>#sU'; 			// шт.  Яндекс
			$patern_1 = '#href="http:\/\/yandex.ru\/yandsearch\?text=host%3A'.$URL_hyp.'.*target="_blank">(.*)</a>#sU'; 			// шт.  Яндекс

			// echo $patern_1;
			// echo "<br>";

			if (!preg_match_all($patern_1,$page,$result_1,PREG_PATTERN_ORDER)) { 
			    echo "patern_1 ненайден или ошибка<br>";
			    // return false;
				} 

			$patern_2 = '#<a href="http:\/\/yandex.ru\/yandsearch\?text=host%3Awww.'.$URL_hyp.'target="_blank">.*</a>\W*&nbsp;<span class="red">(.*)</span>#sU'; 		// динамика
			if (!preg_match_all($patern_2,$page,$result_2,PREG_PATTERN_ORDER)) { 
				$result_2 = array('0' => '',array('0' => '0'));
			    echo "patern_2 ненайден или ошибка";
			    // return false;
				} 

			$patern_3 = '#<a href="https:\/\/www\.google\.com\/search\?\e*q=site:.*" target="_blank">\e*(.*)</a>#sU'; 				// шт.		Гугл
			if (!preg_match_all($patern_3,$page,$result_3,PREG_PATTERN_ORDER)) { 
			    echo "patern_3 ненайден или ошибка";
			    return false;
				} 		

			$patern_4 = '#href="https:\/\/www\.google\.com\/search\?\e*q=site:'.$URL_hyp.'" target="_blank">\e*.*\e*&nbsp;<span.*>(.*)<\/span>#sU'; 	// динамика
			if (!preg_match_all($patern_4,$page,$result_4,PREG_PATTERN_ORDER)) { 
			    echo "patern_4 ненайден или ошибка";
			    // return false;
				} 		

			echo "<br>";
			echo $patern_4;
			echo "<br>";
			print_r($result_4);


			// $patern_5 = '#<td>Просмотры</td>.*(?:>\d*.*<).*(?:>\d*.*<).*(?:>\d*.*<).*(?:>\d*.*<).*>(\d*.*)<.*</tr>#sU'; 		
			// $patern_5 = '#<td>Просмотры</td>(?:\r\n\t*<td class="text-right">(?:\d*(?:&nbsp;)*\d+)</td>){2}.*(\d*(?:&nbsp;)*\d+)<#sU'; 		
			$patern_5 = '#<td>Просмотры</td>(?:\W*<td.*</td>){2}(?:\W*<td.*>(.*)</td>)#sU'; 		//  Просмотры
			if (!preg_match_all($patern_5,$page,$result_5,PREG_PATTERN_ORDER)) { 
			    echo "patern_5 ненайден или ошибка";
			    return false;
				} 		

			$patern_6 = '#<p>.*Место в стране <img.*>(.*\w*):.*</p>#sU'; 					//	 	 	Максимум трафика из
			if (!preg_match_all($patern_6,$page,$result_6,PREG_PATTERN_ORDER)) { 
			    echo "patern_6 ненайден или ошибка";
			    return false;
				} 		

			$patern_7 = '#<div.*<div class="info-test">Ссылается страниц</div>\v*\t*</div>\v*\t*<div class="col-sm-8 content-test">\v*\t*(.*)\v*\t*<img#sU'; //  Baclink - страницы
			if (!preg_match_all($patern_7,$page,$result_7,PREG_PATTERN_ORDER)) { 
			    echo "patern_7 ненайден или ошибка";
			    return false;
				} 
			if (is_string($result_7[1][0])) {   
					$result_7[1][0] = 0;
					}


			$patern_8 = '#<div class="info-test">Ссылаются доменов</div>\v*\t*</div>\v*\t*<div class="col-sm-8 content-test">v*\t*(.*)\v*\t*<img#sU'; 	//  Baclink - домены
			if (!preg_match_all($patern_8,$page,$result_8,PREG_PATTERN_ORDER)) { 
			    echo "patern_8 ненайден или ошибка";
			    return false;
				} 	
			if (is_string($result_8[1][0])) {
				$result_8[1][0] = 0;
				}		

		$page = GetWebPage('http://www.alexa.com/siteinfo/'.$URL_hyp);	

			// echo $page;
			
			$patern_9 = '#alt=\W*Global rank icon\W*<strong.*-->(.*)<\/strong>#sU'; 		// Популярность - Global - Значение
			if (!preg_match_all($patern_9,$page,$result_9,PREG_PATTERN_ORDER)) { 
			    echo "patern_9 ненайден или ошибка";
			    return false;
				} 	

			$patern_10 = '#Rank in\W*<a.*>(.*)</a>#sU'; 									// Популярность - Rank in country - Страна
			if (!preg_match_all($patern_10,$page,$result_10,PREG_PATTERN_ORDER)) { 
			    echo "patern_10 ненайден или ошибка";
			    return false;
				} 	

			$patern_11 = '#<div>\W*<img.*<strong.*vmiddle">(.*)</strong>.*</div>#sU'; 		// Популярность - Rank in country - Значение
			if (!preg_match_all($patern_11,$page,$result_11,PREG_PATTERN_ORDER)) { 
			    echo "patern_11 ненайден или ошибка";
			    return false;
				} 	


			$patern_16 = '#Bounce Rate.*vmiddle">(.*)</strong>#sU'; 						//	Активность пользователей - Показатель отказов
			if (!preg_match_all($patern_16,$page,$result_16,PREG_PATTERN_ORDER)) { 
			    echo "patern_16 ненайден или ошибка";
			    return false;
				} 	

			$patern_17 = '#Daily Pageview.*vmiddle">(.*)</strong>#sU'; 
			if (!preg_match_all($patern_17,$page,$result_17,PREG_PATTERN_ORDER)) { 			// Активность пользователей - Страниц за везит
			    echo "patern_17 ненайден или ошибка";
			    return false;
				} 	

			$patern_18 = '#Daily Time on Site.*vmiddle">(.*)</strong>#sU'; 
			if (!preg_match_all($patern_18,$page,$result_18,PREG_PATTERN_ORDER)) { 			// Активность пользователей - Ср. продолжит визита, м-с
			    echo "patern_18 ненайден или ошибка";
			    return false;
				} 	

			$patern_19 = '#Search Visits.*vmiddle">(.*)</strong>#sU'; 
			if (!preg_match_all($patern_19,$page,$result_19,PREG_PATTERN_ORDER)) { 			// Процент поискового трафика
			    echo "patern_19 ненайден или ошибка";
			    return false;
				} 	



		// print_r($result_0);
		// print_r($result_1);
		// print_r($result_2);
		// print_r($result_3);
		// print_r($result_4);
		
		

		$arr_param_hyp = array_merge($result_0[1],$result_1[1],$result_2[1],$result_3[1],$result_4[1],$result_5[1],$result_6[1],$result_7[1],$result_8[1],$result_9[1],$result_10[1],$result_16[1],$result_17[1],$result_18[1],$result_19[1]);

		echo "<br>-------------------------------------------------------------------------------------------------<br>";

			print_r($arr_param_hyp);

		echo "<br>-------------------------------------------------------------------------------------------------<br>";


		return $arr_param_hyp;

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