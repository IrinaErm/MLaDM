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
		for ($i = 0; $i < $n; $i++){	
			$distance[$i] = 10000;
			$ver[$i] = false;
		}
		$distance[0] = 0;	//нач. точка
		$min_distance = 0;
		$min_ver = 0;
		$min_res = 0;
		
		while ($min_distance < 10000) {
			$i = $min_ver;
			$ver[$i] = true;	//окрашиваем вершину
			for ($j = 0; $j < $n; $j++) {							//определение расстояния до ближайших вершин, запись наименьшего
				if($distance[$i] + $mas[$i][$j] < $distance[$j]) {
					$distance[$j] = $distance[$i] + $mas[$i][$j];
				}
			}
			$min_res = $min_distance;
			$min_distance = 10000;			//определение след. вершины
			for ($j = 0; $j < $n; $j++) {				
				if(!($ver[$j]) && $distance[$j] < $min_distance) {	//проверять вершины, пока есть незакрашенные
					$min_distance = $distance[$j];	
					$min_ver = $j;	//переходить к след. вершине, если есть связь
				}
			}
		}
		
		//print_r($min_distance);
		echo("Длина кратчайшего пути: $min_res");
?>