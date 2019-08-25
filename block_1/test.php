<?php 
$week = ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"];

    $date = date_create(date('Y-m-d'));
    date_modify($date, '-100 days');
    echo $week[date_format($date, 'w')];
 ?>