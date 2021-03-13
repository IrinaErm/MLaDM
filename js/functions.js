function generateTable() {
	var n = document.getElementById("n").value;
	var p = document.getElementById("p").value;
	
	var html = '<form name="form" method="post" action="php/functions.php">';
	html += '<input type="hidden" name="n" value="'+n+'"/>';
	html += '<input type="hidden" name="p" value="'+p+'"/>';
    html += '<table>';
    for (var i = 0; i < p; i++) {
		html += '<tr>';
		for(var j = 0; j < 2; j++) {
			html += '<td> <input type="number" name="cell[]" min="-1" max="10000"></td>';
		}
		html += '</tr>';       
    }
    html += '</table>';
	html += '<input type="submit" name="first"/> </form>';

    document.getElementById('table').innerHTML = html; 
}