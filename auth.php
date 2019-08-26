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

$flag = 0;
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email)) {
	$_SESSION['error_empty_email'] = 1;
	$flag = 1;
}else{
	// Проверяем валидацию емейла
	if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
		  $_SESSION['error_email_valid'] = 1;
	 	  $flag = 1;
	}
}

if (empty($password)) {
	$_SESSION['error_empty_password'] = 1;
	$flag = 1;
}


if ($flag == 1) {
	header('Location: /login.php');
	exit;
}

	// Ищем, есть ли в базе пользователь с таким емейлом
	$stmt=$pdo->prepare("SELECT id, name, email, password FROM users WHERE email = :emeil");
	$stmt->bindParam(':emeil', $email);
	$stmt->execute();
	$result = $stmt -> fetch();
	// Если есть такой емейл
	if ($result) {
		// Проверяем захешированные пароли
		if (password_verify($password, $result['password'])) {
			//Записываем в сессию вход
		    $_SESSION['name'] = $result['name'];
		    $_SESSION['id'] = $result['id'];
		    header('Location: /index.php');
		}else{
			// Если нет
			$_SESSION['error_password'] = 1;
			$flag = 1;
		}
	}else{
		$_SESSION['error_find_email'] = 1;
		$flag = 1;
	}




if ($flag == 1) {
	header('Location: /login.php');
	exit;
}




?>