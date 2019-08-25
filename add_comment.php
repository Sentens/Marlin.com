<?php
session_start();
$driver = 'mysql'; // тип базы данных, с которой мы будем работать 
$host = 'localhost';// альтернатива '127.0.0.1' - адрес хоста, в нашем случае локального
$db_name = 'marlin_db'; // имя базы данных 
$db_user = 'root'; // имя пользователя для базы данных 
$db_password = ''; // пароль пользователя 
$charset = 'utf8'; // кодировка по умолчанию 
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // массив с дополнительными настройками подключения. В данном примере мы установили отображение ошибок, связанных с базой данных, в виде исключений

$dsn = "$driver:host=$host;dbname=$db_name;charset=$charset";
$pdo = new PDO($dsn, $db_user, $db_password, $options);

if (isset($_POST['user_name']) and !empty($_POST['user_name'])) {
	$user_name = $_POST['user_name'];

	if (isset($_POST['comment']) and !empty($_POST['comment'])) {
		$comment = $_POST['comment'];
		$date = date("Y-m-d H:i:s");
		$sql = "INSERT INTO comments (id_comment, user_name, comment, `date`) VALUES (NULL, :user_name, :comment, '$date');";
		$stmt = $pdo->prepare($sql);
		$stmt->execute($_POST);
		$_SESSION['add_comment'] = 1;
		header('Location: /index.php');
	}else{
		$_SESSION['add_comment'] = 0;
	}
}else{
	$_SESSION['add_comment'] = 0;
}

?>