<?php
$account = (isset($_SESSION['account'])) ? $_SESSION['account'] : "";
$film_id = $_POST['film_id'];

if ($account == "") {
    $_SESSION['error_login'] = "You need to login to add to cart";
} else {
    $ch = curl_init('http://php-api/cart');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["user_email" => $account, "film_id" => $film_id]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response, true);

    if ($response['message'] === 'Film added to cart successfully') {
        $_SESSION['message_cart'] = "Film added to cart";
    } else if ($response['message'] === 'Film already in cart') {
        $_SESSION['message_cart'] = "Film already in cart";
    } else {
        $_SESSION['message_cart'] = "Failed to add film to cart";
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>