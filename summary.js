"use strict";

function summaryButton(id)
{
	let field = id.value;
	let num = document.getElementById('pLoop').innerHTML;
	let rowTitle = 'questionRow' + num;

	//document.write(field);
	//document.write(document.getElementById('pLoop'));
	document.getElementById(rowTitle).style.display= 'table-row-group';
	document.getElementById('pLoop').innerHTML++;
	
	if(document.getElementById('pLoop') == field)
		document.getElementById('qButton').style.display = 'none';
}