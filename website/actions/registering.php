<?php
$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$password = $_POST['password'];

$ch = curl_init('http://php-api/register');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["pseudo" => $pseudo, "email" => $email, "password" => $password]));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$response = json_decode($response, true);

if ($response['message'] === 'User registered successfully') {
    $_SESSION['account'] = $email;
} else {
    $_SESSION['error_register'] = $response['message'];
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
