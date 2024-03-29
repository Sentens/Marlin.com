<?php 
//===================================================================
//================== Основы работы с массивами на PHP ===============
//===================================================================

/*Создайте массив $arr=['a', 'b', 'c']. Выведите значение
массива на экран с помощью функции var_dump().*/
$arr=['a', 'b', 'c'];
var_dump($arr);

/*С помощью массива $arr из предыдущего номера выведите на
экран содержимое первого, второго и третьего элементов.*/
echo $arr[0];
echo $arr[1];
echo $arr[2];

/*Создайте массив $arr=['a', 'b', 'c', 'd'] и с его помощью
выведите на экран строку 'a+b, c+d'.*/
$arr=['a', 'b', 'c', 'd'];
echo $arr[0].'+'.$arr[1].','.$arr[2].'+'.$arr[3];

/*Создайте массив $arr с элементами 2, 5, 3, 9.
Умножьте первый элемент массива на второй, а третий элемент на четвертый.
Результаты сложите, присвойте переменной $result. Выведите на экран значение этой переменной.*/
$arr=['2', '5', '3', '9'];
$result = ($arr[0]*$arr[1])+($arr[2]*$arr[3]);
echo $result;

/*Заполните массив $arr числами от 1 до 5. Не объявляйте массив,
а просто заполните его присваиванием $arr[] = новое значение.*/
$arr=['1', '2', '3', '4', '5'];
$arr[0] = 11;
$arr[1] = 22;
$arr[2] = 33;
$arr[3] = 44;
$arr[4] = 55;

/*Создайте массив $arr. Выведите на экран элемент с ключом 'c'.*/
$arr = ['a'=>1, 'b'=>2, 'c'=>3];
echo $arr['c'];

/*Создайте массив $arr. Найдите сумму элементов этого массива.*/
$arr = ['a'=>1, 'b'=>2, 'c'=>3];
$arr_sum = $arr['a']+$arr['b']+$arr['c'];

/*Создайте массив заработных плат $arr. Выведите на экран зарплату Пети и Коли.*/
$arr = ['Коля'=>'1000$', 'Вася'=>'500$', 'Петя'=>'200$'];
echo $arr['Петя'];
echo $arr['Коля'];

/*Создайте ассоциативный массив дней недели. Ключами в нем должны служить
номера дней от начала недели (понедельник - должен иметь ключ 1, вторник - 2 и т.д.).
Выведите на экран текущий день недели.*/
$arr_days = ['1'=>'Пн', '2'=>'Вт', '3'=>'Ср', '4'=>'Чт', '5'=>'Пт', '6'=>'Сб', '7'=>'Вс',];
echo $arr_days['7'];

/*Пусть теперь номер дня недели хранится в переменной $day,
например там лежит число 3. Выведите день недели, соответствующий значению переменной $day.*/
$day = '3';
echo $arr_days[$day];

/*Создайте многомерный массив $arr. С его помощью выведите на экран
слова 'joomla', 'drupal', 'зеленый', 'красный'.*/
$arr = [
    'cms'=>['joomla', 'wordpress', 'drupal'],
    'colors'=>['blue'=>'голубой', 'red'=>'красный', 'green'=>'зеленый']
];

echo "'".$arr['cms']['0']."', '".$arr['cms']['2']."', '".$arr['colors']['green']."', '".$arr['colors']['red']."'";


/*Создайте двухмерный массив. Первые два ключа - это 'ru' и 'en'.
Пусть первый ключ содержит элемент, являющийся массивом названий
дней недели по-русски, а второй - по-английски. Выведите с помощью
этого массива понедельник по-русски и среду по английски (пусть понедельник - это первый день).*/
$arr_lang_day = [
		'ru'=> ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
		'en'=> ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']
];

echo $arr_lang_day['ru']['0'];
echo $arr_lang_day['en']['2'];

/*Пусть теперь в переменной $lang хранится язык (она принимает одно
из значений или 'ru', или 'en' - либо то, либо то), а в переменной
$day - номер дня. Выведите словом день недели, соответствующий
переменным $lang и $day. То есть: если, к примеру, $lang = 'ru' и $day = 3 - то выведем 'среда'.*/
$lang = 'ru';
$day = 3;
echo $arr_lang_day[$lang][$day];

 ?>