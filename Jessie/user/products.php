<?php
session_start();
$category = $_GET["category"];

include("./config/db_connect.php");

$sql = "SELECT * FROM products WHERE product_category = '$category'";
$result = mysqli_query($conn, $sql);
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

        /* header */
        .header {
            margin-top: 120px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            text-transform: uppercase;
        }

        /* Products */
        .products {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            padding: 20px;
        }

        .products .product-card {
            width: calc(100% / 4 - 20px);
        }

        .products .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            object-position: center;
        }

        .product-card .buttons {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
            margin-top: 10px;
        }

        .buttons a {
            width: 100%;
        }

        .buttons a button {
            padding: 10px;
            width: 100%;
            background: var(--orange);
            color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
        }

        .buttons a button:hover {
            background: var(--dark-orange);
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

    <!-- Header -->
    <div class="header">
        <h1><?php echo $category ?></h1>
    </div>

    <!-- Product Listing -->
    <div class="products">
        <?php if ($result):
            if (mysqli_num_rows($result) > 0):
                while ($product = mysqli_fetch_assoc($result)): ?>
                    <div class="product-card">
                        <img src="../product_images/<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>" class="product-image">
                        <p><?php echo $product['product_name']; ?></p>
                        <p class="price">₦ <?php echo $product['product_price']; ?></p>
                        <div class="buttons">
                            <a href="product_details.php?id=<?php echo $product['id']; ?>">
                                <button>View details</button>
                            </a>
                            <!-- <a href="add_to_cart.php?id=<?php // echo $product['id']; ?>">
                                <button>Add to cart</button>
                            </a> -->
                        </div>
                    </div>
                <?php endwhile;
            else: ?>
                <p style="text-align: center; margin-bottom: 20px;">There are no products with this category</p>
        <?php
            endif; 
            endif;?>
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