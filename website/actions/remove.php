<?php
$film_id = $_POST['film-id'];
$email = $_SESSION['account'];

$ch = curl_init('http://php-api/cart');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('user_email' => $email, 'film_id' => $film_id)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$response = curl_exec($ch);
curl_close($ch);

header('Location: /cart.php');
?>