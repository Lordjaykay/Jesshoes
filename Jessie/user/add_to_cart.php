<?php
session_start();

include('./config/db_connect.php');

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $productId = $_GET['id'];
    $size = $_GET['size'];

    $cart_sql = "SELECT * FROM products WHERE id = $productId";
    $cart_result = mysqli_query($conn, $cart_sql);
    $cart_product = mysqli_fetch_assoc($cart_result);

    if ($cart_product) {
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }

        $existing_index = array_search($productId, array_column($_SESSION["cart"], 'id'));
        if ($existing_index !== false) {
            $_SESSION["cart"][$existing_index]['quantity'] += 1;
        } else {
            $product_details = array(
                'id' => $cart_product['id'],
                'product_name' => $cart_product['product_name'],
                'product_image' => $cart_product['product_image'],
                'product_size' => $size,
                'product_price' => $cart_product['product_price'],
                'quantity' => 1
            );
            array_push($_SESSION["cart"], $product_details);
        }

        header("Location: cart.php");
        exit();
    } else {
        echo "Product not found";
    }
} else {
    header('Location: index.php');
    exit;
}
