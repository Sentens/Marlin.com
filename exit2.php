<?php
session_start();

unset($_SESSION['name']);
unset($_SESSION['id']);
session_destroy();

setcookie("email", '', time() - 3600);
setcookie("password", '', time() - 3600);


header('Location: /login.php');

?>