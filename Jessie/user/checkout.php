<?php
session_start();

$user_email = $_SESSION["user_email"];
$amount = $_GET["amount"];

if (!isset($user_email)) {
    header("Location: login.php");
    exit();
}

include('./config/db_connect.php');

$sql = "SELECT * FROM users WHERE email = '$user_email'";
$result = mysqli_query($conn, $sql);

$username = $email = $address = $phone = '';

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $username = $row["username"];
    $email = $row["email"];
    $address = $row["address"];
}

$cart_data = serialize($_SESSION["cart"]);
$total_amount = $amount * 100;

$curl = curl_init();

$callback_url = 'http://localhost/jessie/user/index.php';

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
        'amount' => $total_amount,
        'email' => $email,
        'callback_url' => $callback_url
    ]),
    CURLOPT_HTTPHEADER => [
        "authorization: Bearer sk_test_c5ff4bc084f5fb32fc14fbed874bdeefa92cb61a",
        "content-type: application/json",
        "cache-control: no-cache"
    ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
    die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);

if (!$tranx['status']) {
    print_r('API returned error: ' . $tranx['message']);
} else {
    $order_sql = "INSERT INTO orders (username, email, address, cart_data, total_amount) VALUES ('$username', '$email', '$address', '$cart_data', '$amount')";
    $order_result = mysqli_query($conn, $order_sql);

    if ($order_result) {
        unset($_SESSION["cart"]);

        header('Location: ' . $tranx['data']['authorization_url']);
        exit();
    } else {
        return;
    }
}