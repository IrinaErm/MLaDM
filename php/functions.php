<?php
		$arr = $_POST['cell'];		
		$n = $_POST['n'];
		$p = $_POST['p'];
		
		$k = 0;
		$mas = [];						//перевод в двумерный массив
		$temp = [];
		$res = [];
		$i = 0;
		$j = 0;
		for ($i = 0; $i < $n; $i++){
			$mas[$i] = [];
			$res[$i] = [];
			$temp[$i] = [];
			for ($j = 0; $j < $n; $j++){
				$mas[$i][$j] = 0;
				$res[$i][$j] = 0;
				$temp[$i][$j] = 0;
				if($i == $j) {
					$res[$i][$j] = 1;
				}			
			}	
		}
		
		while($k < $p*2) {
			$ti = $arr[$k];
			$tj = $arr[$k+1];
			$mas[$ti][$tj] = 1;
			$temp[$ti][$tj] = 1;
			$k += 2;
		}
		
		for($k = 0; $k < $n; $k++) {
			for ($i = 0; $i < $n; $i++) {					//возведение матрицы в степень n-1
				for ($j = 0; $j < $n; $j++) {
					for ($z = 0; $z < $n; $z++) {
						$temp[$i][$j] += $temp[$i][$z] * $mas[$z][$j];
					}
					if ($temp[$i][$j] > 1) {
						$temp[$i][$j] = 1;
					}
				}		
			}
			
			for ($i = 0; $i < $n; $i++) {				
				for ($j = 0; $j < $n; $j++) {
					$res[$i][$j] += $temp[$i][$j];
					if ($res[$i][$j] > 1) {
						$res[$i][$j] = 1;
					}
				}		
			}
		}

		$k = 0;
		echo("Матрица достижимости: <br>");
		$html = '<table>';
		for ($i = 0; $i < $n; $i++){
			$html .= '<tr>';
			for ($j = 0; $j < $n; $j++){
				$html .= '<td> <input type="number" name="cell[]" min="-1" max="10000" value="'.$res[$i][$j].'"></td>';						
			}
			$html .= '</tr>';       
		}
		$html .= '</table>';
		
		echo "$html";
?>