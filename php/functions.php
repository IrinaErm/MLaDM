<?php
		/**
		*@var матрица
		*/
		$arr = $_POST['mas'];
		/**
		*@var вершина начала пути
		*/
		$start = $_POST['from'];
		$start--;
		/**
		*@var вершина конца пути
		*/
		$end = $_POST['to'];
		$end--;
		$mas = preg_split("/[\n]/", $arr);	
		
		/**
		*@var общее количество вершин графа
		*/
		$n = count($mas);
		
		$distance = array();
		$ver = array();
		$ver_res = array();
		
		if(check($mas, $n)) {	
			fillArr($distance, $ver);
			Dijkstra($distance, $ver, $start, $end);			
			getPath($distance, $mas, $start, $end);
			printResult($distance, $ver_res, $end);
		}
		
		/**
			@param $mas матрица графа
			@param $mas кол-во вершин
			@return boolean
		*/
		function check($mas, $n) {
			global $mas, $n;
			$show = true;
			for ($i = 0; $i < $n; $i++){
				$mas[$i] = trim($mas[$i]);
				$mas[$i] = preg_split("/[\s,]+/", $mas[$i]);
				if (count($mas[$i]) != count($mas)) {
					echo "Матрица введена неправильно"; 
					$show = false;
					break;
				}
				for ($j = 0; $j < $n; $j++) {
					if ($mas[$i][$j] < 0) {
						echo "Введено отрицательное число (строка ";
						echo $i+1;
						echo " столбец ";
						echo $j+1;
						echo ")";
						$show = false;
						break;
					}
				}
			}
			
			return $show;
		}
		
		/**
			@param $distance массив расстояний
			@param $mas массив пройденных вершин
		*/
		function fillArr($distance, $ver) {
			global $distance, $ver, $n, $mas;
			for ($i = 0; $i < $n; $i++){
				$distance[$i] = PHP_INT_MAX;
				$ver[$i] = false;
				for ($j = 0; $j < $n; $j++){
					if ($mas[$i][$j] == '0') {
						$mas[$i][$j] = PHP_INT_MAX;
					}
				}					
			}
		}
		
		/**
			@param $distance массив расстояний
			@param $mas массив пройденных вершин
			@param $start начальная вершина
			@param $end конечная вершина
		*/
		function Dijkstra($distance, $ver, $start, $end) {
			global $distance, $ver, $start, $end, $n, $mas;
			$k = 0;	
			$distance[$start] = 0;
			$min_ver = $start;
			$min_distance = 0;
			$dist_ans = 0;
			while ($min_distance < PHP_INT_MAX) {
				$t = $min_ver;
				$ver[$t] = true;	//окрашиваем вершину
				for ($j = 0; $j < $n; $j++) {							//определение расстояния до ближайших вершин, запись наименьшего
					if($distance[$t] + $mas[$t][$j] < $distance[$j]) {
						$distance[$j] = $distance[$t] + $mas[$t][$j];
					}
				}									
				
				$min_distance = PHP_INT_MAX;			//определение след. вершины
				for ($j = 0; $j < $n; $j++) {
					if (!($ver[$j])) {	//проверять вершины, пока есть незакрашенные
						if($distance[$j] < $min_distance) {
							$min_distance = $distance[$j];	
						}
						$min_ver = $j;	//переходить к след. вершине, если есть связь
					}
				}
			}							
		}

		/**
			@param $distance массив расстояний
			@param $mas массив пройденных вершин
			@param $start начальная вершина
			@param $end конечная вершина
		*/
		function getPath($distance, $mas, $start, $end) {
			global $distance, $mas, $start, $end, $n, $ver_res;
			if(!($distance[$end] >= PHP_INT_MAX)) {
				//запись вершин пути
				$i = $end;	//конец пути
				$ver_res[0] = $end;
				$k = 1;
				$length = $distance[$end];
				$vers = 0;
				while($i > $start) {	//пока не дойдет до начальной вершины 
					for($j = 0; $j < $n; $j++) {
						if ($mas[$j][$i] != PHP_INT_MAX) {
							$temp = $length - $mas[$j][$i];
							if ($temp == $distance[$j]) {	//если совпадает с отмеченной длиной
								$length = $temp;
								$i = $j;
								$ver_res[$k] = $i;
								$k++;						
							}
							$vers++;
						}				
					}
				}
			}			
		}
		
		/**
			@param $distance массив расстояний
			@param $ver_res массив вершин кратчайшего пути
			@param $end конечная вершина
		*/
		function printResult($distance, $ver_res, $end) {
			global $distance, $ver_res, $end;
			if($distance[$end] >= PHP_INT_MAX) {
				echo("Пути между вершинами не существует <br>");
			}
			else {
				echo("Длина кратчайшего пути: $distance[$end] <br>");
				echo("Путь: ");
				for($i = count($ver_res) - 1; $i >= 0; $i--)
				{
				  echo ($ver_res[$i]+1)." ";
				}
			}		
		}
?>