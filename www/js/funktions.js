$(document).ready(function() {
	
	$(".UpdateListHyp").click(function() {

		alert("Обновить список хайпов");
		// var test_ajax = {
		// 	t_aj:555,
		// 	GetListHyp:1
		// }

		// $.ajax({
		// 	type:'POST',
		// 	url:'http://hypmonbot/processing_events.php',
		// 	dataType:'json',
		// 	data:"GetListHyp="+JSON.stringify(test_ajax),
		// 	success:function (html) {
		// 		$("<tr class='for_tabl_str'>"+html+"</tr>").appendTo(".main_tabl");
		// 		alert(html);
		// 	}
		})

	$(document).scroll(function(){
		// alert("Прокрутка");

		scrolify($(".tblNeedsScrolling"), 150);


		})

	})



// function scrolify(tblAsJQueryObject, height){
//     var oTbl = tblAsJQueryObject;
//     // для очень длинных таблиц вы можете удалить 4 следующие линии
//     // и поместить таблицу в ДИВ и назначить ему высоту и свойство overflow
//     var oTblDiv = $("<div/>");
//     oTblDiv.css('height', height);
//     oTblDiv.css('overflow','scroll');
//     oTbl.wrap(oTblDiv);
//     // сохраняем оригинальную ришину
//     oTbl.attr("data-item-original-width", oTbl.width());
//     oTbl.find('thead tr td').each(function(){
//         $(this).attr("data-item-original-width",$(this).width());
//     });
//     oTbl.find('tbody tr:eq(0) td').each(function(){
//         $(this).attr("data-item-original-width",$(this).width());
//     });
//     // клонируем оригинальную таблицу
//     var newTbl = oTbl.clone();
//     // удаляем заголовки из оригинальной таблицы
//     oTbl.find('thead tr').remove();
//     // удаляем тело таблицы из новой таблицы
//     newTbl.find('tbody tr').remove();
//     oTbl.parent().parent().prepend(newTbl);
//     newTbl.wrap("<div/>");
//     // заменяем исходную ширину столбца
//     newTbl.width(newTbl.attr('data-item-original-width'));
//     newTbl.find('thead tr td').each(function(){
//         $(this).width($(this).attr("data-item-original-width"));
//     });
//     oTbl.width(oTbl.attr('data-item-original-width'));
//     oTbl.find('tbody tr:eq(0) td').each(function(){
//         $(this).width($(this).attr("data-item-original-width"));
//     });
// }
// $(document).ready(function(){
//     scrolify($('#tblNeedsScrolling'), 160); // 160 is height
// });