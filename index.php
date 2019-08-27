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


// Проверяем есть ли данные в сессии
if (empty($_SESSION['name']) or empty($_SESSION['id'])) {

    // Вносим значение кук в переменные
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];

    // Проверяем, есть ли в куках емейл
    if ($email) {
        $stmt=$pdo->prepare("SELECT id, name, password FROM users WHERE email = :emeil");
        $stmt->bindValue(':emeil', $email);
        $stmt->execute();
        $result = $stmt -> fetch();

        //Если пароль в куках соответствует паролю в БД, записываем сессию
        if ($password === $result['password']) {
            $_SESSION['name'] = $result['name'];
            $_SESSION['id'] = $result['id'];
        }else{
            header('Location: /login.php');
        }

    }
}


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
                            <div class="card-header"><h3>Комментарии</h3></div>

                            <div class="card-body">
<?php
    if ($_SESSION['add_comment'])
    {
?>
                                <div class="alert alert-success" role="alert">
                                   Комментарий успешно добавлен
                                </div>
<?php
unset($_SESSION['add_comment']);
}
        $sql = "SELECT * FROM comments AS c LEFT JOIN users AS u ON c.id_user = u.id ORDER BY `date` DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($comments as $user) {
 ?>
                                <div class="media">
                                  <img src="<?php echo $user['user_photo']; ?>" class="mr-3" alt="..." width="64" height="64">
                                  <div class="media-body">
                                    <h5 class="mt-0"><?php echo $user['name']; ?></h5> 
                                    <span><small><?php echo date('d/m/Y', strtotime($user['date'])); ?></small></span>
                                    <p>
                                        <?php echo $user['comment']; ?>
                                    </p>
                                  </div>
                                </div>
<?php 
}
?>
                            </div>
                        </div>
                    </div>
                <?php if (isset($_SESSION['name'])): ?>
                            <div class="col-md-12" style="margin-top: 20px;">
                                <div class="card">
                                    <div class="card-header"><h3>Оставить комментарий</h3></div>

                                    <div class="card-body">
                                        <form action="add_comment.php" method="post">
                                          <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Сообщение</label>
                                            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            <?php
                                            if ($_SESSION['error_empty_comment'])
                                            {
                                                echo '<div style="color:red;">Это поле не должно быть пустым!</div>';
                                                unset($_SESSION['error_empty_comment']);
                                            }
                                            ?>   
                                          </div>
                                          <button type="submit" class="btn btn-success">Отправить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php else: ?>
                        <div style="width: 100%; padding: 10px; margin: 15px; display: flex; justify-content: flex-start; background: #e1f0fc;">
                            Чтобы оставить комментарий &nbsp<a href="/login.php"> авторизируйтесь</a></div>
                    <?php endif ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
