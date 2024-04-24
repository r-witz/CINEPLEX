<?php

require_once '../database/user.php';
require_once 'bcrypt.php';

$userClass = new User();
$bcrypt = new Bcrypt();

if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email address.';
        header('Location: ../pages/register.php');
        exit;
    }

    $hashedPassword = $bcrypt->hash($password);

    if($userClass->createUser($pseudo, $email, $hashedPassword)) {
        $_SESSION['success'] = 'Successful registration. You can now log in.';
        header('Location: ../index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Registration error.';
        header('Location: ../pages/register.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Missing field';
    header('Location: ../pages/register.php');
    exit;
}
