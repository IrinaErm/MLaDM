<?php
		$arr = $_POST['cell'];		
		$n = $_POST['n'];
		
		$k = 0;
		$mas = [];						//перевод в двумерный массив
		for ($i = 0; $i < $n; $i++){
			$mas[$i] = [];
			for ($j = 0; $j < $n; $j++){
				$mas[$i][$j] = $arr[$k];
				$k++;
			}	
		}
		
		//начало алгоритма
		$distance = [];
		$ver = [];
		$min_ver = 0;		
		$min_dists = [];
		$k = 0; //кол-во вариантов путей из нач. вершины
		$l = 0;
		for ($i = 0; $i < $n; $i++){	
			if ($mas[$min_ver][$i] != 10000) {
				$distance[$l] = [];	
				//$distance[$k][0] = 0;					
				for ($s = 0; $s < $n; $s++){	
					$distance[$l][$s] = 10000;
					$ver[$s] = false;			
				}
				
				$temp = $min_ver;
				$distance[$l][0] = 0;//$mas[$min_ver][$i];	//нач. точка
				$min_distance = 0;
				
				$min_res = 0;
				$ver_res = [];				
				
				while ($min_distance < 10000) {
					$t = $temp;
					$ver[$t] = true;	//окрашиваем вершину
					if ($t == $min_ver) {
						$distance[$l][$i] = $distance[$l][$t] + $mas[$t][$i];
					}
					else {
						for ($j = 0; $j < $n; $j++) {							//определение расстояния до ближайших вершин, запись наименьшего
							if($distance[$l][$t] + $mas[$t][$j] < $distance[$l][$j]) {
							$distance[$l][$j] = $distance[$l][$t] + $mas[$t][$j];
							}
						}
					}				

					$min_res = $min_distance;
					$min_distance = 10000;			//определение след. вершины
					for ($j = 0; $j < $n; $j++) {
						if ($t == $min_ver) {
							$min_distance = $distance[$l][$i];	
							$temp = $i;
							break;
						}						
						else if (!($ver[$j]) && $distance[$l][$j] < $min_distance) {	//проверять вершины, пока есть незакрашенные
							$min_distance = $distance[$l][$j];	
							$temp = $j;	//переходить к след. вершине, если есть связь
						}
					}
				}
				$min_dists[$k] = $min_res;
				$k++;
				$l++;
			}			
		}	
		
		$min_res = $min_dists[0];
		$l = 0;
		for($i = 1; $i < count($min_dists); $i++) {
			if($min_dists[$i] < $min_res) {
				$min_res = $min_dists[$i];
				$l = $i;
			}
		}	
		
		//запись вершин пути
		$i = $n - 1;	//конец пути
		$ver_res[0] = $n - 1;
		$k = 1;
		$length = $min_res;	//длина
		$none = true;
		while($i >= 0) {	//пока не дойдет до начальной вершины
			$j = 0;
			$none = true;
			while($j < $n) {
				if ($mas[$i][$j] != 10000) {
					$temp = $length - $mas[$i][$j];
					if ($temp == $distance[$l][$i]) {	//если совпадает с отмеченной длиной
						$length = $temp;
						$j = $n;
						$ver_res[$k] = $i;
						$k++;
						$none = false;
						$i--;
					}
				}
				$j++;				
			}
			if($none) {
				$i--;
			}
		}
				
		echo("Длина кратчайшего пути: $min_res <br>");
		echo("Путь: ");
		for($i = count($ver_res) - 1; $i >= 0; $i--)
		{
		  echo $ver_res[$i]." ";
		}
?>