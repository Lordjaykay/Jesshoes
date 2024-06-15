<?php 
session_start();

if (!isset($_SESSION["user_email"])) {
    header("Location: login.php");
    exit();
}

include('./config/db_connect.php');

$total_amount = 0;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jesshoes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            margin: 0;
            padding: 0;
            list-style: none;
            text-decoration: none;
            box-sizing: border-box;
            font-family: 'Poppins';
            transition: .3s all;
            scroll-behavior: smooth;
        }

        :root {
            --orange: orange;
            --dark-orange: #ff6a00;
            --black: #444;
            --shadow: #e6e6e6;
        }

        body {
            overflow-x: hidden;
        }

        a {
            color: var(--black);
        }

        a:hover, a.active {
            color: var(--orange);
        }

        h1 {
            font-size: 35px;
        }

        h2 {
            font-size: 27px;
        }

        p {
            font-size: 20px;
        }

        .categories, .blog, .contact {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 20px;
            padding: 40px;
        }

        .categories-title, .blog-title, .contact-title {
            text-align: center;
        }

        /* Navbar */
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 40px;
            box-shadow: 0 0 30px var(--shadow);
            font-size: 17px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #fff;
            z-index: 100;
        }

        nav label {
            font-size: 30px;
        }

        nav ul {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 30px;
            text-transform: uppercase;
        }

        nav .menu-icon {
            display: none;
            cursor: pointer;
        }

        /* Cart */
        .cart {
            margin-top: 120px;
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        td:last-child {
            text-align: right;
        }

        .total {
            margin-top: 20px;
        }

        .cart a button {
            color: #fff;
            background: var(--orange);
            padding: 10px 15px;
            border: none;
            outline: none;
            cursor: pointer;
            margin-top: 10px;
        }

        /* Footer */
        footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background: var(--orange);
            color: #fff;
            flex-wrap: wrap;
            gap: 20px;
        }

        footer a {
            color: #fff;
        }

        footer a:hover {
            color: var(--shadow);
        }

        @media screen and (max-width: 800px) {
            nav .menu-icon {
                display: block;
            }

            nav ul {
                position: fixed;
                top: 150px;
                right: -100%;
                padding: 20px;
                flex-direction: column;
                align-items: flex-end;
                background: var(--shadow);
                width: 200px;
                border-radius: 10px;
            }

            .show {
                right: 20px;
            }
        }

        @media screen and (max-width: 700px) {
            footer {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <label>JES<span style="color: orange;">SHOES</span></label>

        <ul id="menu">
            <li title="Home"><a href="index.php">Home</a></li>
            <li title="About"><a href="index.php#about">About</a></li>
            <li title="Shop"><a href="index.php#categories">Category</a></li>
            <li title="Blog"><a href="index.php#blog">Blog</a></li>
            <li title="Contact"><a href="index.php#contact">Contact</a></li>
            <li title="Cart"><a href="cart.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
            <?php if (isset($_SESSION["user_email"])): ?>
                <li title="Logout"><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
            <?php else: ?>
                <li title="Login"><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
            <?php endif; ?>
        </ul>
        <label title="Menu" class="menu-icon" id="menu-icon"><i class="fa fa-bars" aria-hidden="true"></i></label>
    </nav>

    <!-- Cart Items -->
    <div class="cart">
        <h2>Your Shopping Cart</h2>
        <?php if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION["cart"] as $product) : ?>
                    <tr>
                        <td><?php echo $product['product_name'] ?></td>
                        <td><?php echo $product['product_size'] ?></td>
                        <td><?php echo $product['product_price'] ?></td>
                        <td><?php echo $product['quantity'] ?></td>
                        <td><?php echo $total_amount += intval($product['product_price']) * intval($product['quantity']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <div class="total">
            <p>Total: ₦<?php echo $total_amount ?></p>
        </div>
        <a href="checkout.php?amount=<?php echo $total_amount ?>"><button>Checkout</button></a>
        <?php else : ?>
            <p>Your cart is empty, <a href="index.php#categories" style="color: blue;">Start shopping</a></p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>Copyright &copy; <span id="year"></span> | All Rights Reserved</p>
        <div class="social-media">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
        </div>
    </footer>

    <script>
        const year = document.getElementById('year');

        year.innerText = new Date().getFullYear();

        const menuIcon = document.getElementById('menu-icon');
        const menu = document.getElementById('menu');

        menuIcon.addEventListener('click', () => {
            menu.classList.toggle('show');
        });
    </script>
</body>
</html>