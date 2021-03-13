<?php
		$arr = $_POST['cell'];		
		$n = $_POST['n'];
		
		$k = 0;
		$mas = [];						//перевод в двумерный массив
		$distance = [];
		$ver = [];
		for ($i = 0; $i < $n; $i++){
			$mas[$i] = [];
			$distance[$i] = 10000;
			$ver[$i] = false;
			for ($j = 0; $j < $n; $j++){
				$mas[$i][$j] = $arr[$k];
				$k++;
			}	
		}
		
		$distance[0] = 0;
		$min_ver = 0;
		$min_distance = 0;
		$dist_ans = 0;
		while ($min_distance < 10000) {
			$t = $min_ver;
			$ver[$t] = true;	//окрашиваем вершину
			for ($j = 0; $j < $n; $j++) {							//определение расстояния до ближайших вершин, запись наименьшего
				if($distance[$t] + $mas[$t][$j] < $distance[$j]) {
					$distance[$j] = $distance[$t] + $mas[$t][$j];
				}
			}									
			
			$min_distance = 10000;			//определение след. вершины
			for ($j = 0; $j < $n; $j++) {
				if (!($ver[$j]) && $distance[$j] < $min_distance) {	//проверять вершины, пока есть незакрашенные
					$min_distance = $distance[$j];	
					$min_ver = $j;	//переходить к след. вершине, если есть связь
				}
			}
		}							
		
		//запись вершин пути
		$i = $n-1;	//конец пути
		$ver_res[0] = $n-1;
		$k = 1;
		$length = $distance[$n-1];
		$dist_ans = $distance[$n-1];

		while($i > 0) {	//пока не дойдет до начальной вершины 
			for($j = 0; $j < $n; $j++) {
				if ($mas[$j][$i] != 10000) {
					$temp = $length - $mas[$j][$i];
					if ($temp == $distance[$j]) {	//если совпадает с отмеченной длиной
						$length = $temp;
						$i = $j;
						$ver_res[$k] = $i;
						$k++;						
					}
				}				
			}
		}
		
		$k = 0;
		$html = '<table>';
		for ($i = 0; $i < $n; $i++){
			$html .= '<tr>';
			for ($j = 0; $j < $n; $j++){
				if($arr[$k] == 10000) {
					$html .= '<td> <input type="number" name="cell[]" min="-1" max="10000"></td>';
				}
				else {
					$html .= '<td> <input type="number" name="cell[]" min="-1" max="10000" value="'.$arr[$k].'"></td>';
				}				
				$k++;				
			}
			$html .= '</tr>';       
		}
		$html .= '</table>';
		
		echo "$html";
		echo "<br>";
		
		echo("Длина кратчайшего пути: $dist_ans <br>");
		echo("Путь: ");
		for($i = count($ver_res) - 1; $i >= 0; $i--)
		{
		  echo ($ver_res[$i]+1)." ";
		}
?>