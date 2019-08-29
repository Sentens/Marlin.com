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

$user_name = $_POST['name'];
$email = $_POST['email'];
$id = $_SESSION['id'];
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
		// Проверяем валидацию емейла
	if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
		  $_SESSION['error_email_valid'] = 1;
	 	  $flag = 1;
	}else{
		// Если прошел валидацию, то проверяем есть ли такой емейл в базе
		$stmt=$pdo->prepare("SELECT email FROM users WHERE email = :email");
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$result = $stmt -> fetch();

		// Если true, то этот емейл уже занят
		if ($result) {
			$_SESSION['error_email_in_base'] = 1;
			$flag = 1;
		}	
	}
}

// Если одно из значений не выполняет условиям, переходим на страницу профиля и завершаем скрипт.
if ($flag == 1) {
	header('Location: /profile.php');
	exit;
}


// Если все в порядке и image существует, переносим и генерируем ему новое уникальное имя.
if (isset($_FILES['image']) and $_FILES['image']['tmp_name'] !== "") {
	//Удаляем старый файл с сервера
	$stmt=$pdo->prepare("SELECT user_photo FROM users WHERE $id = :id");
	$stmt->bindValue(':id', $id);
	$stmt->execute();
	$find_photo = $stmt -> fetch();

	//Если изображение аватара не стандартное, есть в директории и это файл, то удаляем его
	if ($find_photo['user_photo'] !== 'img/no-user.jpg' and file_exists($find_photo['user_photo']) and is_file($find_photo['user_photo'])) {
		$find_photo = unlink($find_photo['user_photo']);
	}

	//Уникальное имя
	$user_photo = "img/".md5(uniqid()).'.jpeg';

	//Путь к загруженному файлу во временном хранилище
	$tmp_name = $_FILES['image']['tmp_name'];

	//Путь, куда необходимо переместить файл
	move_uploaded_file($tmp_name, $user_photo);

	//Обновляем user_photo в сессии
	$_SESSION['user_photo'] = $user_photo;
}else{
	// Если поле FILE пустое, обновляем текущую картинку
	$user_photo = $_SESSION['user_photo'];
}

//Обновляем данные профиля
$sql = "UPDATE users SET name = :user_name, email = :email, user_photo = :user_photo WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':user_photo', $user_photo);
$stmt->bindValue(':id', $id);
$stmt->execute();

$_SESSION['success_update'] = 1;
header('Location: /profile.php');


?>