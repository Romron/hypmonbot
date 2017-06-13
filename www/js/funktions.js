$(document).ready(function() {
	$(".UpdateListHyp").click(function() {

		alert("Обновить список хайпов");
		var test_ajax = {
			t_aj:555,
			GetListHyp:1
		}

		$.ajax({
			type:'POST',
			url:'http://hypmonbot/processing_events.php',
			dataType:'json',
			data:"GetListHyp="+JSON.stringify(test_ajax),
			success:function (html) {
				$("<tr class='for_tabl_str'>"+html+"</tr>").appendTo(".main_tabl");
				alert(html);
			}
		})



	})

	$(".UpdateParamHyp").click(function() {
		// alert(location.href);			// тестовая строка
		// var test_ajax = {
		// 	t_aj:555,
		// 	GetListHyp:1
		// }

		// $.ajax({
		// 	type:'POST',
		// 	url:'http://localhost/hypmonbot/www/processing_events.php',
		// 	dataType:'json',
		// 	data:"GetListHyp="+JSON.stringify(test_ajax),
		// 	success:function (html) {
		// 		$("<tr class='for_tabl_str'>"+html+"</tr>").appendTo(".main_tabl");
		// 	}
		// })



	})	
})