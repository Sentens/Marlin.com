<?php 
session_start();
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
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Register</div>

                            <div class="card-body">
                                <form method="POST" action="add_user.php">

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="user_name" autofocus>

                                                <span class="invalid-feedback" role="alert">
                                                    <strong>
                                                    <?php
                                                    if ($_SESSION['error_empty_user_name']){
                                                        echo 'Поле не должно быть пустым';
                                                        unset($_SESSION['error_empty_user_name']);
                                                        };
                                                    ?>
                                            </strong>
                                                </span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                        <div class="col-md-6">
                                            <input id="email" type="text" class="form-control" name="email" >
                                            <strong style="color:#e3342f; font-size: 80%;">
                                                    <?php
                                                    if ($_SESSION['error_empty_email']){
                                                        echo 'Поле не должно быть пустым';
                                                        unset($_SESSION['error_empty_email']);
                                                    };
                                                    if ($_SESSION['error_email_valid']){
                                                        echo 'Данное поле не является емейлом';
                                                        unset($_SESSION['error_email_valid']);
                                                        };
                                                    if ($_SESSION['error_email_in_base']){
                                                        echo 'Такой емейл уже существует';
                                                        unset($_SESSION['error_email_in_base']);
                                                        };

                                                    ?>
                                            </strong>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control " name="password"  autocomplete="new-password">
                                            <strong style="color:#e3342f; font-size: 80%;">
                                                    <?php
                                                    if ($_SESSION['error_empty_password']){
                                                        echo 'Поле не должно быть пустым';
                                                        unset($_SESSION['error_empty_password']);
                                                    };
                                                    if ($_SESSION['error_password_valid']){
                                                        echo 'Пароли не совпадают';
                                                        }
                                                    if ($_SESSION['error_password_strlen']){
                                                        echo 'Длина пароля должна быть не меньше 6 символов';
                                                        unset($_SESSION['error_password_strlen']);
                                                        }
                                                    ?>
                                            </strong>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                            <strong style="color:#e3342f; font-size: 80%;">
                                                    <?php
                                                    if ($_SESSION['error_empty_password_confirmation']){
                                                        echo 'Поле не должно быть пустым';
                                                        unset($_SESSION['error_empty_password_confirmation']);
                                                    };
                                                    if ($_SESSION['error_password_valid']){
                                                        echo 'Пароли не совпадают';
                                                        unset($_SESSION['error_password_valid']);
                                                        }
                                                    if ($_SESSION['error_password_confirmation_strlen']){
                                                        echo 'Длина пароля должна быть не меньше 6 символов';
                                                        unset($_SESSION['error_password_confirmation_strlen']);
                                                        }
                                                    ?>
                                            </strong>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Register
                                            </button>
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
