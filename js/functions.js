function generateTable() {
	var mas1 = document.getElementById("mas1").value.replace(/\s+/g, " ").split(" ");
	var mas2 = document.getElementById("mas2").value.replace(/\s+/g, " ").split(" ");
	var n = document.getElementById("n").value.replace(/\s+/g, "");
	var m1 = mas1.length;
	var m2 = mas2.length;

    var html = '<table>';
    for (var i = 0; i < n; i++) {
		html += '<tr>';
		for(var j = 0; j < 2; j++) {
			html += '<td> <input type="text" class="cell"></td>';
		}
		html += '</tr>';       
    }
    html += '</table>';
	html += '<br> <input type="button" value="ОК" onClick="calc();">';
	
	document.getElementById('res').innerHTML = '<br>';
    document.getElementById('table').innerHTML = html; 
}

function calc() {
	var pairs = document.getElementsByClassName("cell");
	var mas1 = document.getElementById("mas1").value.replace(/\s+/g, " ").split(" ");
	var mas2 = document.getElementById("mas2").value.replace(/\s+/g, " ").split(" ");
	var m1 = mas1.length;
	var m2 = mas2.length;

	var k = 0;
	var ti = -1;
	var tj = -1;
	
	var mas = [];	
	for (var i = 0; i < m1; i++){
		mas[i] = [];
		for (var j = 0; j < m2; j++){
			mas[i][j] = 0;
		}				
	}	
	
	for (var i = 0; i < pairs.length / 2; i++){
		ti = -1;
		tj = -1;
		for (var j = 0; j < 2; j++){
			if (j == 0) {
				for(var z = 0; z < m1; z++) {
					if(mas1[z] == pairs[k].value) {
						ti = z;
						break;
					}
				}
				k++;
			}
			else if (j == 1) {
				for(var z = 0; z < m2; z++) {
					if(mas2[z] == pairs[k].value) {
						tj = z;
						break;
					}
				}
				k++;
			}
		}
		mas[ti][tj] = 1;		
	}
	
	for (var i = 0; i < m1; i++){
		for (var j = 0; j < m2; j++){
			document.getElementById('res').innerHTML += mas[i][j];
		}	
		document.getElementById('res').innerHTML += '<br>';		
	}
	
	var con = true;
	var k;
	for (var i = 0; i < m1; i++){
		k = 0;
		for (var j = 0; j < m2; j++){
			if(mas[i][j] == 1) {
				k++;
			}
		}
		if (k != 1) {
			con = false;
			break;
		}
	}
	for (var i = 0; i < m2; i++){
		k = 0;
		for (var j = 0; j < m1; j++){
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
		document.getElementById('res').innerHTML += 'Отношение является функцией';
	}
	else {
		document.getElementById('res').innerHTML += 'Отношение не является функцией';
	}
}