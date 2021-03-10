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
		for ($i = 0; $i < $n; $i++){	
			if ($mas[$min_ver][$i] != 10000) {				
				for ($s = 0; $s < $n; $s++){	
					$distance[$s] = 10000;
					$ver[$s] = false;			
				}
				
				$temp = $min_ver;
				$distance[0] = 0;//$mas[$min_ver][$i];	//нач. точка
				$min_distance = 0;
				
				$min_res = 0;
				$ver_res = [];				
				
				while ($min_distance < 10000) {
					$t = $temp;
					$ver[$t] = true;	//окрашиваем вершину
					if ($t == $min_ver) {
						$distance[$i] = $distance[$t] + $mas[$t][$i];
					}
					else {
						for ($j = 0; $j < $n; $j++) {							//определение расстояния до ближайших вершин, запись наименьшего
							if($distance[$t] + $mas[$t][$j] < $distance[$j]) {
								$distance[$j] = $distance[$t] + $mas[$t][$j];
							}
						}
					}				

					$min_res = $min_distance;
					$min_distance = 10000;			//определение след. вершины
					for ($j = 0; $j < $n; $j++) {
						if ($t == $min_ver) {
							$min_distance = $distance[$i];	
							$temp = $i;
							break;
						}						
						else if (!($ver[$j]) && $distance[$j] < $min_distance) {	//проверять вершины, пока есть незакрашенные
							$min_distance = $distance[$j];	
							$temp = $j;	//переходить к след. вершине, если есть связь
						}
					}
				}
				$min_dists[$k] = $min_res;
				$k++;
			}			
		}	
		
		$min_res = $min_dists[0];
		for($i = 1; $i < count($min_dists); $i++) {
			if($min_dists[$i] < $min_res) {
				$min_res = $min_dists[$i];
			}
		}	
				
		echo("Длина кратчайшего пути: $min_res <br>");
		
?>