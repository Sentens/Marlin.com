<?php
$driver = 'mysql'; // тип базы данных, с которой мы будем работать 
$host = 'localhost';// альтернатива '127.0.0.1' - адрес хоста, в нашем случае локального
$db_name = 'marlin_db'; // имя базы данных 
$db_user = 'root'; // имя пользователя для базы данных 
$db_password = ''; // пароль пользователя 
$charset = 'utf8'; // кодировка по умолчанию 
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // массив с дополнительными настройками подключения. В данном примере мы установили отображение ошибок, связанных с базой данных, в виде исключений

$dsn = "$driver:host=$host;dbname=$db_name;charset=$charset";
$pdo = new PDO($dsn, $db_user, $db_password, $options);


$sql = "SELECT * FROM users where id = 1";
$statement = $pdo->prepare($sql);
$statement->execute($data);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);


$sql = "INSERT INTO `comments` (`id_comment`, `id_user`, `comment`, `date`) VALUES (NULL, '1', 'sdfsdfsdf', '2019-08-25');";
$statement = $pdo->prepare($sql);
$statement->execute($data);

if (isset($_POST['user_name']) and !empty($_POST['user_name'])) {
	$user_name = $_POST['user_name'];
	echo "Ваше имя: ".$user_name."<br>";
}

if (isset($_POST['comment']) and !empty($_POST['comment'])) {
	$comment = $_POST['comment'];
	echo "Ваш комментарий: ".$comment."<br>";
}


 ?>