function gid(i) {

	var k = document.getElementById(i)
	// console.info(k);
	return k;
	}	//	поиск/получение элемента по id



function CEL(s) {return document.createElement(s);}		//	Создает новый элемент с указанным тегом
function ACH(p,c) {p.appendChild(c);}		//	добавляет дочерний элемент в конец дочерних элементов

function getScrollWidth() {
	var dv = CEL('div');		
		dv.style.overflowY = 'scroll'; 
		dv.style.width = '50px'; 
		dv.style.height = '50px'; 
		dv.style.position = 'absolute';
		dv.style.visibility = 'hidden';	//при display:none размеры нельзя узнать. visibility:hidden - сохраняет геометрию, 
									// а выше было position=absolute - не сломает разметку
	ACH(document.body,dv);
	var scrollWidth = dv.offsetWidth - dv.clientWidth;
	document.body.removeChild(dv);
	return (scrollWidth);
	}

function setSum(tbl, rr, cc) {

	// console.info("******  function setSum  *******");
	// console.info(tbl);
	debugger;
	var rowCount = tbl.rows.length,sum = '';

	for (var i=rr; i<rowCount; i++) {
		var row = tbl.rows[i];
		for (var j=cc; j < row.cells.length; j++) {
			sum = Math.floor(Math.random()*10000) + '';
			row.cells[i,j].innerHTML = sum.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ');
			row.cells[i,j].style.textAlign = 'right';
		}
	}
	}

// function FixAction(el) {
// 	// FixHeaderCol(gid('t1'),1,1,400,170);

// 		console.info("**** function FixAction:  ");
// 		console.info(" el:  ");
// 		console.info(el);

// 	FixHeaderCol(gid('tabl_1'),3,3,400,214);
// 	// FixHeaderCol(gid('t3'),10,6,1000,415);
// 	// FixHeaderCol(gid('t4'),1,0,340,120);
// 	// FixHeaderCol(gid('t5'),0,2,340,150);

// 	el.parentNode.removeChild(el);		//	parentNode - возвращает родителя определенного элемента
// 										// removeChild(el) - удаляет дочерний элемент из DOM. Возвращает удаленный элемент
// 	}

function FixHeaderCol(tbl, fixRows, fixCols, ww, hh) {

	var scrollWidth = getScrollWidth(), cont = CEL('div'), tblHead = CEL('table'), tblCol = CEL('table'), tblFixCorner = CEL('table');
	cont.className = 'divFixHeaderCol';	// cont (видимо сокращение от контейнер) это div обёртка в которой демонстрируеться работа скрипта
	cont.style.width = ww + 'px'; cont.style.height = hh + 'px';	
	tbl.parentNode.insertBefore(cont,tbl);	//	цепочка методов: первый возвращает родителя элемента "tbl", 
											//	второй, добавляет элемент в список дочерних элементов перед указанным
											//	т.е. новый элемент cont вставляеться перед tbl и получаем таблицу в обёртке дива
	ACH(cont,tbl);		//	добавляет новый элемент tbl в конец дочерних элементов cont

	var rows = tbl.rows, rowsCnt = rows.length, i=0, j=0, colspanCnt=0, columnCnt=0, newRow, newCell, td;
		// tbl.rows - возвращает колекцию, надо понимать обычный масив, всех строк tbl
		// rows.length - возвращает количество элементов в масиве rows т.е. количество строк в таблице

		// console.info(rows.rowsCnt);

	// Берем самую первую строку (это rows[0]) и получаем истинное число столбцов в ТАБЛИЦЕ (учитывается colspan)
	for (j=0; j<rows[0].cells.length; j++) {columnCnt += rows[0].cells[j].colSpan;}
		//	.cells - возвращает колекцию всех элементов <td> в данной строке
		//	cells[j].colSpan - по видимуму возвращает кол-вообьединённыхячеек т.е. значение атрибута colspan длякаждого <td>

	var delta = columnCnt - fixCols;

	// Пробежимся один раз по всем строкам и построим наши фиксированные таблицы
	for (i=0; i<rowsCnt; i++) {
		columnCnt = 0; colspanCnt = 0;
		newRow = rows[i].cloneNode(true), td = rows[i].cells;
		for (j=0; j<td.length; j++) {
			columnCnt += td[j].colSpan;//кол-во столбцов в данной строке с учетом colspan
			if (i<fixRows) {//ну и заодно фиксируем заголовок
				newRow.cells[j].style.width = getComputedStyle(td[j]).width;
				ACH(tblHead,newRow);
			}
		}

		newRow = CEL('tr');
		for (j=0; j<fixCols; j++) {
			if (!td[j]) continue;
			colspanCnt += td[j].colSpan;
			if (columnCnt - colspanCnt >= delta) {
				newCell = td[j].cloneNode(true);
				newCell.style.width = getComputedStyle(td[j]).width;
				newCell.style.height = td[j].clientHeight - parseInt(getComputedStyle(td[j]).paddingBottom) - parseInt(getComputedStyle(td[j]).paddingTop) + 'px';


				ACH(newRow,newCell);
			}
		}
		if (i<fixRows) {ACH(tblFixCorner,newRow);}
		ACH(tblCol,newRow.cloneNode(true));
	} // Закончили пробегаться один раз по всем строкам и строить наши фиксированные таблицы

	tblFixCorner.style.position = 'absolute'; 
	tblFixCorner.style.zIndex = '3'; 
	tblFixCorner.style.backgroundColor = 'white'; 
	tblFixCorner.className = 'fixRegion';
	
	tblHead.style.position = 'absolute'; tblHead.style.zIndex = '2'; 
	tblHead.style.width = tbl.offsetWidth + 'px'; 
	tblHead.style.backgroundColor = 'white';
	tblHead.className = 'fixRegion';
	tblHead.style.backgroundColor = 'white';

	tblCol.style.position = 'absolute'; tblCol.style.zIndex = '2'; tblCol.className = 'fixRegion';
	tblCol.style.backgroundColor = 'white';

	cont.insertBefore(tblHead,tbl);
	cont.insertBefore(tblFixCorner,tbl);
	cont.insertBefore(tblCol,tbl);

	var bodyCont = CEL('div');
	bodyCont.style.cssText = 'position:absolute;';

	// Горизонтальная прокрутка
	var divHscroll = CEL('div'), d1 = CEL('div');
	divHscroll.style.cssText = 'width:100%; bottom:0; overflow-x:auto; overflow-y:hidden; position:absolute; z-index:3;';
	divHscroll.onscroll = function () {
		var x = -this.scrollLeft + 8 + 'px';
		bodyCont.style.left = x;
		tblHead.style.left = x;
	}

	d1.style.width = tbl.offsetWidth + scrollWidth + 'px';
	d1.style.height = '2px';

	ACH(divHscroll,d1);
	ACH(cont,divHscroll);
	ACH(bodyCont,tbl);
	ACH(cont,bodyCont);

	// Вертикальная прокрутка
	var divVscroll = CEL('div'), d2 = CEL('div');
	divVscroll.style.cssText = 'height:100%; right:0; overflow-x:hidden; overflow-y:auto; position:absolute; z-index:3';
	divVscroll.onscroll = function () {
		var y = -this.scrollTop + 29 +'px';
		bodyCont.style.top = y;
		tblCol.style.top = y;
	}

	d2.style.height = tbl.offsetHeight + scrollWidth + 'px';
	d2.style.width = scrollWidth + 'px';

	ACH(divVscroll,d2);
	ACH(cont,divVscroll);

	cont.addEventListener('wheel', myWheel);
	function myWheel(e) {
		e = e || window.event;
		var delta = e.deltaY || e.detail || e.wheelDelta;
		var z = delta > 0 ? 1 : -1;
		divVscroll.scrollTop = divVscroll.scrollTop + z*17;
		e.preventDefault ? e.preventDefault() : (e.returnValue = false);
	}
	} //FixHeaderCol

// setSum(gid('t1'),0,0);
//setSum(gid('tabl_1'),2,1);
// setSum(gid('t3'),2,2);
// setSum(gid('t4'),0,0);
// setSum(gid('t5'),0,0);
