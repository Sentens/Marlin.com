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

$user_name = $_POST['user_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];

$flag = 0;
// Проверяем не пустое ли поле user_name
if (empty($user_name)) {
	$_SESSION['error_empty_user_name'] = 1;
	$flag = 1;
}

// Проверяем не пустое ли поле email
if (empty($email)) {
	$_SESSION['error_empty_email'] = 1;
	$flag = 1;
}else{
	// Если не пустое, проверяем валидацию
	if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
		  $_SESSION['error_email_valid'] = 1;
	 	  $flag = 1;
	}
}
// Проверяем не пустое ли поле password
if (empty($password)) {
	$_SESSION['error_empty_password'] = 1;
	$flag = 1;
}

// Проверяем не пустое ли поле password_confirmation
if (empty($password_confirmation)) {
	$_SESSION['error_empty_password_confirmation'] = 1;
	$flag = 1;
}

// Проверяем совпадают ли поля password и password_confirmation
if ((!empty($password) and !empty($password_confirmation)) and ($password !== $password_confirmation)) {
	$_SESSION['error_password_valid'] = 1;
	$flag = 1;
}else{
	// Проверяем длину строки пароля минимум 6 символов
	if (strlen($password) < 6 ) {
		$_SESSION['error_password_strlen'] = 1;
		$flag = 1;
	}
	// Проверяем длину строки пароля минимум 6 символов
	if (strlen($password_confirmation) < 6 ) {
		$_SESSION['error_password_confirmation_strlen'] = 1;
		$flag = 1;
	}
}




// Если одно из значений не выполняет условиям, переходим на страницу регистрации и завершаем скрипт.
if ($flag == 1) {
	header('Location: /register.php');
	exit;
}

$password = password_hash($password, PASSWORD_BCRYPT);
$sql = "INSERT INTO users (id, name, email, password) VALUES (NULL, :user_name, :email, :password)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_name', $user_name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->execute();

header('Location: /register.php');


?>