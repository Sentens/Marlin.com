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
                            <div class="card-header"><h3>Админ панель</h3></div>

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Аватар</th>
                                            <th>Имя</th>
                                            <th>Дата</th>
                                            <th>Комментарий</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>

                                    <tbody>
<?php 

$sql = "SELECT * FROM comments AS c LEFT JOIN users AS u ON c.id_user = u.id ORDER BY `date` DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($comments as $comment) {
 ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo $comment['user_photo']; ?>" alt="" class="img-fluid" width="64" height="64">
                                            </td>
                                            <td><?php echo $comment['name']; ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($comment['date'])); ?></td>
                                            <td><?php echo $comment['comment']; ?></td>
                                            <td>
                                                <?php if ($comment['hidden']): ?>
                                                    <a href="/comment_show.php?id=<?php echo $comment['id_comment']; ?>" class="btn btn-success">Разрешить</a>
                                                <?php else: ?>
                                                    <a href="/comment_hidden.php?id=<?php echo $comment['id_comment']; ?>" class="btn btn-warning">Запретить</a>
                                                <?php endif ?>
                                                <a href="/comment_delete.php?id=<?php echo $comment['id_comment']; ?>" onclick="return confirm('are you sure?')" class="btn btn-danger">Удалить</a>
                                            </td>
                                        </tr>
<?php 
}
 ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
