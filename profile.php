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

$stmt=$pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindValue(':id', $id);
$stmt->execute();
$result = $stmt -> fetch();

?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    Project
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <?php if (isset($_SESSION['name'])): ?>
                            <li><a href="#" class="nav-link">Привет <?php echo $_SESSION['name']; ?></a></li>
                            <li class="nav-item"><a class="nav-link" href="profile.php">Профиль</a>
                            <li class="nav-item"><a class="nav-link" href="admin.php">Админка</a>
                            <li class="nav-item"><a class="nav-link" href="exit2.php">Выход</a></li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
          <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h3>Профиль пользователя</h3></div>

                        <div class="card-body">
<?php if ($_SESSION['success_update']): ?>
                        <div class="alert alert-success" role="alert">
                            Профиль успешно обновлен
                        </div>
<?php endif;
unset($_SESSION['success_update']);
?>
                          

                            <form action="update_profile.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Name</label>
                                            <input type="text" class="form-control" name="name" id="exampleFormControlInput1" value="<?php echo $result['name']; ?>">
                                            <span class="text text-danger">   
                                            <?php
                                            if ($_SESSION['error_empty_user_name'])
                                            {
                                                echo 'Поле не должно быть пустым';
                                                unset($_SESSION['error_empty_user_name']);
                                            }
                                            ?>   
                                            </span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Email</label>
                                            <input type="email" class="form-control " name="email" id="exampleFormControlInput1" value="<?php echo $result['email']; ?>">
                                            <span class="text text-danger">   
                                            <?php
                                            if ($_SESSION['error_empty_email'])
                                            {
                                                echo 'Поле не должно быть пустым';
                                                unset($_SESSION['error_empty_email']);
                                            }
                                            if ($_SESSION['error_email_valid'])
                                            {
                                                echo 'Данное поле не является емейлом';
                                                unset($_SESSION['error_email_valid']);
                                            }
                                            if ($_SESSION['error_email_in_base'])
                                            {
                                                echo 'Данный емейл уже есть в базе';
                                                unset($_SESSION['error_email_in_base']);
                                            }
                                            ?>   
                                            </span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Аватар</label>
                                            <input type="file" class="form-control" name="image" id="exampleFormControlInput1">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="<?php echo $result['user_photo']; ?>" alt="" class="img-fluid">
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-warning">Edit profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header"><h3>Безопасность</h3></div>

                        <div class="card-body">
							<?php if ($_SESSION['success_update_password']): ?>
								<div class="alert alert-success" role="alert">
									Пароль успешно обновлен
								</div>
							<?php endif;
							unset($_SESSION['success_update_password']);
							 ?>
                            <form action="update_password.php" method="post">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Current password</label>
                                            <input type="password" name="current" class="form-control" id="exampleFormControlInput1">
                                            <span class="text text-danger">  
											<?php
                                            if ($_SESSION['error_empty_current_password'])
                                            {
                                                echo 'Поле не должно быть пустым';
                                                unset($_SESSION['error_empty_current_password']);
                                            }
                                            if ($_SESSION['error_password'])
                                            {
                                                echo 'Неверный текущий пароль';
                                                unset($_SESSION['error_password']);
                                            }
                                            ?>   
                                        	</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">New password</label>
                                            <input type="password" name="password" class="form-control" id="exampleFormControlInput1">
                                            <span class="text text-danger">  
											<?php
                                            if ($_SESSION['error_empty_new_password'])
                                            {
                                                echo 'Поле не должно быть пустым';
                                                unset($_SESSION['error_empty_new_password']);
                                            }
                                            if ($_SESSION['error_new_passwords_not_same'])
                                            {
                                                echo 'Новые пароли не совпадают';
                                            }
                                            if ($_SESSION['error_new_passwords_strlen'])
                                            {
                                                echo 'Минимум 6 символов';
                                            }
                                            ?>   
                                        	</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Password confirmation</label>
                                            <input type="password" name="password_confirmation" class="form-control" id="exampleFormControlInput1">
                                            <span class="text text-danger">  
											<?php
                                            if ($_SESSION['error_empty_new_password_confirmation'])
                                            {
                                                echo 'Поле не должно быть пустым';
                                                unset($_SESSION['error_empty_new_password_confirmation']);
                                            }
                                            if ($_SESSION['error_new_passwords_not_same'])
                                            {
                                                echo 'Новые пароли не совпадают';
                                                unset($_SESSION['error_new_passwords_not_same']);
                                            }
                                            if ($_SESSION['error_new_passwords_strlen'])
                                            {
                                                echo 'Минимум 6 символов';
                                                unset($_SESSION['error_new_passwords_strlen']);
                                            }
                                            ?>   
                                        	</span>
                                        </div>

                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>
</body>
</html>
