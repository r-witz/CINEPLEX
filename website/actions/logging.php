<?php

require_once '../database/user.php';

$userClass = new User();

if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
    $pseudo = filter_var($_POST['pseudo']);
    $password = $_POST['password'];

    if (!$pseudo) {
        $_SESSION['error'] = 'Invalid username.';
        header('Location: ../pages/login.php');
        exit;
    }

    $user = $userClass->getUserByPseudo($pseudo);
    if ($user) {
        if (($password == $user['password'])) {
            $_SESSION['account'] = $pseudo;
            header('Location: ../index.php');
        } else {
            $_SESSION['error'] = 'Incorrect password.';
            header('Location: ../pages/login.php');
        }
    } else {
        $_SESSION['error'] = 'User not found.';
        header('Location: ../pages/login.php');
    }
} else {
    $_SESSION['error'] = 'Missing field';
    header('Location: ../pages/login.php');
}
exit;