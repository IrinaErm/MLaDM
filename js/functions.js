function generateTable() {
	var mas1 = document.getElementById("mas1").value.replace(/\s+/g, " ").split(" ");
	var mas2 = document.getElementById("mas2").value.replace(/\s+/g, " ").split(" ");
	var n = mas1.length;
	var m = mas2.length;

    var html = '<table>';
    for (var i = 0; i < n; i++) {
		html += '<tr>';
		for(var j = 0; j < m; j++) {
			html += '<td> <input type="number" class="cell" min="0" max="1" value="0"></td>';
		}
		html += '</tr>';       
    }
    html += '</table>';
	html += '<br> <input type="button" value="ОК" onClick="calc();">';

    document.getElementById('table').innerHTML = html; 
}

function calc() {
	var ot = document.getElementsByClassName("cell");
	var mas1 = document.getElementById("mas1").value.replace(/\s+/g, " ").split(" ");
	var mas2 = document.getElementById("mas2").value.replace(/\s+/g, " ").split(" ");
	var n = mas1.length;
	var m = mas2.length;

	var k = 0;
	var mas = [];						//перевод в двумерный массив
	for (var i = 0; i < n; i++){
		mas[i] = [];
		for (var j = 0; j < m; j++){
			mas[i][j] = ot[k].value;
			k++;
		}	
	}
	
	var con = true;
	var k;
	for (var i = 0; i < n; i++){
		k = 0;
		for (var j = 0; j < m; j++){
			if(mas[i][j] == 1) {
				k++;
			}
		}
		if (k != 1) {
			con = false;
			break;
		}
	}
	for (var i = 0; i < m; i++){
		k = 0;
		for (var j = 0; j < n; j++){
			if(mas[j][i] == 1) {
				k++;
			}
		}
		if (k > 1) {
			con = false;
			break;
		}
	}
	
	if(con) {
		document.getElementById('res').innerHTML = 'Отношение является функцией';
	}
	else {
		document.getElementById('res').innerHTML = 'Отношение не является функцией';
	}
}