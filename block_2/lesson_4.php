<?php 
//===================================================================
//====================== Приемы работы с массивами ==================
//===================================================================


//Заполните массив следующим образом: в первый элемент запишите 'x', во второй 'xx', в третий 'xxx' и так далее.
$arr = array();
for ($i=0; $i < 10; $i++) {
	for ($j=0; $j <= $i; $j++) {
		$arr[$i] .= 'x';
	}
}



//С помощью двух вложенных циклов заполните массив следующим образом: в первый элемент запишите '1', во второй '22', в третий '333' и так далее.
$arr = array();
for ($i=0; $i < 10; $i++) {
	for ($j=0; $j < $i; $j++) { 
		$arr[$i] .= $i;
	}
}
echo "<pre>";
var_dump($arr);
echo "<pre>";

// Сделайте функцию arrayFill, которая будет заполнять массив заданными значениями. Первым параметром функция принимает значение, которым заполнять массив, а вторым - сколько элементов должно быть в массиве. Пример: arrayFill('x', 5) сделает массив ['x', 'x', 'x', 'x', 'x'].

function arrayFill($value, $count){
	for ($i=0; $i <= $count; $i++) { 
		$arr[] = $value;
	}
	return $arr;
}
print_r(arrayFill('X', 10));

// Дан массив с числами. Узнайте сколько элементов с начала массива надо сложить, чтобы в сумме получилось больше 10-ти. Считайте, что в массиве есть нужное количество элементов.

$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

$int = 0;
for ($i=0; $i < count($arr); $i++) {
	if ($int > 10) {
		echo $i;
		break;
	}else{
		$int += $arr[$i];
	}
}
echo "<br>";
// Многомерные массивы
// Дан двухмерный массив с числами, например [[1, 2, 3], [4, 5], [6]]. Найдите сумму элементов этого массива. Массив, конечно же, может быть произвольным.

$arr = [[1, 2, 3], [4, 5], [6]];

$count = 0;
foreach ($arr as $value) {
	for ($i=0; $i < count($value); $i++) {
		$count += $value[$i];
	}
}
echo $count;
echo "<br>";

// Дан трехмерный массив с числами, например [[[1, 2], [3, 4]], [[5, 6], [7, 8]]]. Найдите сумму элементов этого массива. Массив, конечно же, может быть произвольным.

$arr = [[[1, 2], [3, 4]], [[5, 6], [7, 8]]];

$count = 0;
foreach ($arr as $value) {
	foreach ($value as $sub_value) {
			foreach ($sub_value as $elem) {
			$count += $elem;
		}
	}
}

echo $count;
echo "<br>";
// С помощью двух циклов создайте массив [[1, 2, 3], [4, 5, 6], [7, 8, 9]].
$arr = array();
$count = 1;
for ($i=0; $i <= 2; $i++) {
	$arr[$i] = $i;
	$arr[$i] = [];
	for ($j=0; $j < 3; $j++) { 
		$arr[$i][] = $count ;
		$count++;
	}
}

var_dump($arr);

 ?>