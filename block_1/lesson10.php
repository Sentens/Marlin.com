<?php 
//===================================================================
//========================      Работа с датами в PHP     ===========
//===================================================================

// Задачи для решения
// Timestamp: time и mktime
// Для решения задач данного блока вам понадобятся следующие функции: time, mktime.
//Выведите текущее время в формате timestamp.
echo time();

//Выведите 1 марта 2025 года в формате timestamp.

echo mktime(0, 0, 0, 3, 1, 2025);

//Выведите 31 декабря текущего года в формате timestamp. Скрипт должен работать независимо от года, в котором он запущен.

echo mktime(0, 0, 0, 12, 31);

//Найдите количество секунд, прошедших с 13:12:59 15-го марта 2000 года до настоящего момента времени.

echo time() - mktime(13, 12, 59, 3, 15, 2000);

//Найдите количество целых часов, прошедших с 7:23:48 текущего дня до настоящего момента времени.
echo intval((time() - mktime(7, 23, 48))/3600);


//Функция date
//Для решения задач данного блока вам понадобятся следующие функции: date.
//Выведите на экран текущий год, месяц, день, час, минуту, секунду.
echo date('H:i:s, d.m.Y');

//Выведите текущую дату-время в форматах '2025-12-31', '31.12.2025', '31.12.13', '12:59:59'.
echo date('Y-m-d')."<br>";
echo date('d.m.Y')."<br>";
echo date('d.m.y')."<br>";
echo date('H:i:s')."<br>";

//С помощью функций mktime и date выведите 12 февраля 2025 года в формате '12.02.2025'.
echo date('d.m.Y', mktime(0, 0, 0, 2, 12, 2025));

//Создайте массив дней недели $week. Выведите на экран название текущего дня недели с помощью массива $week и функции date. Узнайте какой день недели был 06.06.2006, в ваш день рождения.

$week = ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"];
echo $week[date('w', mktime(0, 0, 0, 6, 6, 2006))];
echo $week[date('w', mktime(0, 0, 0, 8, 22, 1989))];


//Создайте массив месяцев $month. Выведите на экран название текущего месяца с помощью массива $month и функции date.
$months = array( 1 => 'Январь' , 'Февраль' , 'Март' , 'Апрель' , 'Май' , 'Июнь' , 'Июль' , 'Август' , 'Сентябрь' , 'Октябрь' , 'Ноябрь' , 'Декабрь' );
echo $months[date('n')];

//Найдите количество дней в текущем месяце. Скрипт должен работать независимо от месяца, в котором он запущен.
echo date('t');

//Сделайте поле ввода, в которое пользователь вводит год (4 цифры), а скрипт определяет високосный ли год.
$year = 1989;
echo date('L', mktime(0, 0, 0, 0, 0, $year));

//Сделайте форму, которая спрашивает дату в формате '31.12.2025'. С помощью функций mktime и explode переведите эту дату в формат timestamp. Узнайте день недели (словом) за введенную дату.

$date = '31.12.2011'; // Форма ввода даты
$week = ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"];
$arr = explode('.', $date);
$mktime = mktime(0, 0, 0, $arr['1'], $arr['0'], $arr['2']);
echo $mktime;
echo $week[date('w', $mktime)];


//Сделайте форму, которая спрашивает дату в формате '2025-12-31'. С помощью функций mktime и explode переведите эту дату в формат timestamp. Узнайте месяц (словом) за введенную дату.
$date = '2025-12-31'; // Форма ввода даты
$months = array( 1 => 'Январь' , 'Февраль' , 'Март' , 'Апрель' , 'Май' , 'Июнь' , 'Июль' , 'Август' , 'Сентябрь' , 'Октябрь' , 'Ноябрь' , 'Декабрь' );
$arr = explode('-', $date);
$mktime = mktime(0, 0, 0, $arr['1'], $arr['2'], $arr['0']);
echo $mktime;
echo $months[date('n', $mktime)];

//Сравнение дат
//Сделайте форму, которая спрашивает две даты в формате '2025-12-31'. Первую дату запишите в переменную $date1, а вторую в $date2. Сравните, какая из введенных дат больше. Выведите ее на экран.
$date1 = '2032-08-21';
$date2 = '2022-02-08';
$arr_date1 = explode('-', $date1);
$mktime_date1 = mktime(0, 0, 0, $arr_date1['1'], $arr_date1['2'], $arr_date1['0']);
$arr_date2 = explode('-', $date2);
$mktime_date2 = mktime(0, 0, 0, $arr_date2['1'], $arr_date2['2'], $arr_date2['0']);

if ($mktime_date1 > $mktime_date2) {
	echo "Date1 больше Date2<br>";
	echo $mktime_date1." > ".$mktime_date2;
}else{
	echo "Date2 больше Date1<br>";
	echo $mktime_date2." > ".$mktime_date1;
}

//На strtotime
//Для решения задач данного блока вам понадобятся следующие функции: strtotime.
//Дана дата в формате '2025-12-31'. С помощью функции strtotime и функции date преобразуйте ее в формат '31-12-2025'.

echo date('d-m-Y', strtotime('2025-12-31'));

//Сделайте форму, которая спрашивает дату-время в формате '2025-12-31T12:13:59'. С помощью функции strtotime и функции date преобразуйте ее в формат '12:13:59 31.12.2025'.
//Прибавление и отнимание дат
$date = '2025-12-31T12:13:59';
echo date('H:i:s d.m.Y', strtotime($date));

//Для решения задач данного блока вам понадобятся следующие функции: date_create, date_modify, date_format.
//В переменной $date лежит дата в формате '2025-12-31'. Прибавьте к этой дате 2 дня, 1 месяц и 3 дня, 1 год. Отнимите от этой даты 3 дня.
    $date = date_create('2025-12-31');
    date_modify($date, '2 days');
    date_modify($date, '3day 1 month');
    date_modify($date, '1 year');
    date_modify($date, '-3 days');
    echo date_format($date, 'd.m.Y');

//Задачи
//Узнайте сколько дней осталось до Нового Года. Скрипт должен работать в любом году.
$countDate = date('z');
$days_in_Year = date('L')?366:365;
$toNewYearDays = $days_in_Year-$countDate;
echo $toNewYearDays;

//Сделайте форму с одним полем ввода, в которое пользователь вводит год. Найдите все пятницы 13-е в этом году. Результат выведите в виде массива дат.
$date = '2026';
$arr_days = [];
for ($i=1; $i <= 12; $i++) { 
	$day_in_month = date('t', mktime(0, 0, 0, $i, 1, $date));
	for ($k=0; $k <= $day_in_month; $k++) { 
		$day_week = date('w', mktime(0, 0, 0, $i, $k, $date));
		if ($day_week == '5' and $k == 13) {
			$arr_days[$i] = $k;
		}
	}	
}
var_dump($arr_days);

//Узнайте какой день недели был 100 дней назад.
$week = ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"];
$date = date_create(date('Y-m-d'));
date_modify($date, '-100 days');
echo $week[date_format($date, 'w')];
?>