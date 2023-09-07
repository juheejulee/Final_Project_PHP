<?php
$title = 'Welcome';
require __DIR__ . '/header.php';

if (isset($_GET['signout'])) {
    echo 'signout';
    session_unset();
    session_destroy();
    setcookie('email', '', time() - 3600, '/', '', false, true); // Pour effacer le cookie, on met une date d'expiration dans le passé
}

if (isset($_COOKIE['email'])) {
    header("Location: game/startpage.php");
    exit;
} else {
    header("Location: form/connection.php");
    exit;
}
