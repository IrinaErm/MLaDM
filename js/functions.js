function generateTable() {
	var n = document.getElementById("n").value;
	
	var html = '<form name="form" method="post" action="php/functions.php">';
	html += '<input type="hidden" name="n" value="'+n+'"/>';
    html += '<table>';
    for (var i = 0; i < n; i++) {
		html += '<tr>';
		for(var j = 0; j < n; j++) {
			html += '<td> <input type="number" name="cell[]" min="-1" max="10000" value="10000"></td>';
		}
		html += '</tr>';       
    }
    html += '</table>';
	html += '<input type="submit" name="first"/> </form>';

    document.getElementById('table').innerHTML = html; 
}