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

$id = $_SESSION['id'];
// Принимаем данные
$current = $_POST['current'];
$new_password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];

//Проверяем на пустоту входящие данные
function check_empty($value, $empty_error)
{
	if (empty($value)) {
		$_SESSION[$empty_error] = 1;
		return true;
	}
}

// Проверяем не пустое ли поле current_password
$flag = check_empty($current, 'error_empty_current_password');

// Проверяем не пустое ли поле new_password
$flag = check_empty($new_password, 'error_empty_new_password');

// Проверяем не пустое ли поле Password confirmation
$flag = check_empty($password_confirmation, 'error_empty_new_password_confirmation');



// Если одно из значений не выполняет условиям, переходим на страницу профиля и завершаем скрипт.
if ($flag) {
	header('Location: /profile.php');
	exit;
}

	// Ищем, есть ли в базе пользователь с таким id
	$stmt=$pdo->prepare("SELECT password FROM users WHERE id = :id");
	$stmt->bindValue(':id', $id);
	$stmt->execute();
	$result = $stmt -> fetch();

	// Вытаскиваем пароль для проверки
	if ($result) {
		// Проверяем, совпадает ли текущий пароль
		if (password_verify($current, $result['password'])) {
			//Проверяем длину новых паролей
			if (strlen($new_password) < 6 or strlen($password_confirmation) < 6) {
					$_SESSION['error_new_passwords_strlen'] = 1;
			    	$flag = 1;
			}else{
				//Если новые пароли совпадают
			    if ($new_password == $password_confirmation) {
			    	//Сохраняем новый пароль
			    	$new_password = password_hash($new_password, PASSWORD_BCRYPT);
			    	$sql = "UPDATE users SET password = :password WHERE id = :id";
					$stmt = $pdo->prepare($sql);
					$stmt->bindValue(':id', $id);
					$stmt->bindValue(':password', $new_password);
					$stmt->execute();
			    }else{
			    	//Если новые пароли не совпадают
			    	$_SESSION['error_new_passwords_not_same'] = 1;
			    	$flag = 1;
			    }
			}
		}else{
			// Если текущий пароль не совпадает с паролем из БД
			$_SESSION['error_password'] = 1;
			$flag = 1;
		}
	}else{
		 //Если в БД не нашли пользователя с таким id, выходим.
		 header('Location: /exit2.php');
		 exit;
	}

// Если одно из значений не выполняет условиям, переходим на страницу профиля и завершаем скрипт.
if ($flag) {
	header('Location: /profile.php');
	exit;
}

// Если все ок, перенаправляем и выводим "Пароль успешно обновлен".
$_SESSION['success_update_password'] = 1;
header('Location: /profile.php');

?>