<?php 
//===================================================================
//======Правильное использование пользовательских функций============
//===================================================================

//Сделайте функцию isNumberInRange, которая параметром принимает число и проверяет, что оно больше нуля и меньше 10. Если это так - пусть функция возвращает true, если не так - false.

function isNumberInRange($number){
	return ($number > 0 and $number < 10);
}
echo isNumberInRange(5);

// Дан массив с числами. Запишите в новый массив только те числа, которые больше нуля и меньше 10-ти. Для этого используйте вспомогательную функцию isNumberInRange из предыдущей задачи.

$arr = [1, 2, 3, 44, 51, 6, 7, 22];

function newArrayInRange($array){
	foreach ($array as $value) {
		if (isNumberInRange($value)) {
			$new_arr[] = $value;
		}
	}
	var_dump($new_arr);
}

newArrayInRange($arr);

echo "<br>";
// Сделайте функцию getDigitsSum (digit - это цифра), которая параметром принимает целое число и возвращает сумму его цифр.

function getDigitsSum($number){
	$arr = str_split($number, 1);
	$sum = 0;
    foreach ($arr as $elem) {
        $sum += intval($elem);
    }

    return $sum;
}


// Найдите все года от 1 до 2019, сумма цифр которых равна 13. Для этого используйте вспомогательную функцию getDigitsSum из предыдущей задачи.

function getSumInYear(){
	for ($i=0; $i <= 2019; $i++) {
		if (getDigitsSum($i) == 13) {
			echo $i."<br>";
		}
	}
}

// getSumInYear();


// Сделайте функцию isEven() (even - это четный), которая параметром принимает целое число и проверяет: четное оно или нет. Если четное - пусть функция возвращает true, если нечетное - false.

function isEven($number){
	if ($number % 2) {
		return false;
	}
	return true;
}

echo isEven(30);


// Дан массив с целыми числами. Создайте из него новый массив, где останутся лежать только четные из этих чисел. Для этого используйте вспомогательную функцию isEven из предыдущей задачи.

$arr = [1, 2, 3, 44, 51, 6, 7, 22];

function evenNumberInArray($arr){
	foreach ($arr as $value) {
		if (isEven($value)) {
			$new_arr[] = $value;
		}
	}
	return $new_arr;
}

var_dump(evenNumberInArray($arr));

// Сделайте функцию getDivisors, которая параметром принимает число и возвращает массив его делителей (чисел, на которое делится данное число).

function getDivisors($number){
	for ($i=1; $i <= $number; $i++) { 
		if ($number % $i === 0) {
			$new_arr[] = $i;
		}
	}
	return $new_arr;
}
echo "<pre>";
var_dump(getDivisors(40));
echo "</pre>";

// Сделайте функцию getCommonDivisors, которая параметром принимает 2 числа, а возвращает массив их общих делителей. Для этого используйте вспомогательную функцию getDivisors из предыдущей задачи.

function getCommonDivisors($number1, $number2){
	$result = array_intersect(getDivisors($number1), getDivisors($number2));
	var_dump($result);
}

getCommonDivisors(100, 200);


 ?>