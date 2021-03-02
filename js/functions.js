function generateTable() {
	var n = document.getElementById("n").value;
	if (n < 0) {
		alert("n не может быть отрицательным");
	}
    var html = '<table>';

    for (var i = 0; i < n; i++) {
		html += '<tr>';
		for(var j = 0; j < n; j++) {
			html += '<td> <input type="number" class="cell" min="0" max="1"></td>';
		}
		html += '</tr>';       
    }

    html += '</table>';

    document.getElementById('table').innerHTML = html; 

}

function check() {
	var n = document.getElementById("n").value;
	var mas = document.getElementsByClassName("cell");
	
	var s = 1;
	var k = 1;
	for (var i = 1; i <= n * n; i++) {
		if(!(mas[i-1].value == 0 || mas[i-1].value == 1)) {
			if(s == 2) {
				alert("Исправьте "+ k + " элемент во " + s + " строке");
			}
			else {
				alert("Исправьте "+ k + " элемент в " + s + " строке");
			}			
			break;
		}
		k++;
		if (i % n == 0) {
			s++;
			k = 1;
		}		
    }

	return true;
}

function reflex() {
	var n = document.getElementById("n").value;
	var mas = document.getElementsByClassName("cell");

	var k = 0;
	var con = true;
	for (var i = 0; i < n; i++){
		for (var j = 0; j < n; j++){
			if(i == j) {
				if(mas[k].value != 1) {
					con = false;
				}				
			}
			k++;
		}	
	}
	
	if(con) {
		document.getElementById('reflex').innerHTML = 'Рефлексивно';
	}
	else {
		document.getElementById('reflex').innerHTML = 'Не является рефлексивным';
	}
}

function symm() {
	var n = document.getElementById("n").value;
	var mas = document.getElementsByClassName("cell");

	var k = 0;
	var con = true;
	var mas2 = [];
	for (var i = 0; i < n; i++){
		mas2[i] = [];
		for (var j = 0; j < n; j++){
			mas2[i][j] = mas[k].value;
			k++;
		}	
	}
	
	for (var i = 0; i < n; i++){
		for (var j = 0; j < n; j++){
			if(!(mas2[i][j] == mas2[j][i])) {
				con = false;
			}
		}	
	}
	
	if(con) {
		document.getElementById('symm').innerHTML = 'Симметрично';
	}
	else {
		document.getElementById('symm').innerHTML = '';
	}
}

function getRelations() {
	check();
	reflex();
	symm();
}