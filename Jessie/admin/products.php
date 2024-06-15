<?php
session_start();

$admin_email = $_SESSION["admin_email"];

if (!isset($admin_email)) {
    header("Location: login.php");
    exit();
}

include "./config/db_connect.php";

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jesshoes Admin Panel</title>
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
            padding: 30px;
            box-shadow: 0 0 30px var(--shadow);
            font-size: 17px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #fff;
            z-index: 100;
        }

        nav label, .sidebar label {
            font-size: 30px;
        }

        .sidebar label {
            margin: 20px;
        }

        nav a {
            text-transform: uppercase;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        nav .nav-icons {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 20px;
        }
        
        nav i {
            cursor: pointer;
        }

        /* Sidebar */
        .sidebar {
            position: absolute;
            top: 0;
            left: -100%;
            z-index: 100;
            background: #fff;
            height: 100vh;
            width: 300px;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            flex-direction: column;
            gap: 70px;
            box-shadow: 0 0 10px var(--shadow);
        }

        .show {
            left: 0;
        }

        .sidebar ul li {
            background: var(--shadow);
            width: 300px;
            padding: 15px;
        }

        .sidebar ul li:not(:last-child) {
            margin-bottom: 20px;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 15px;
        }

        .sidebar ul li a.active {
            color: var(--orange);
        }

        /* Dashboard Content */
        .content {
            margin-top: 105px;
            padding: 25px;
        }

        .content .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .header a {
            color: #fff;
            background: var(--orange);
            padding: 10px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header a:hover {
            color: #fff;
            background: var(--dark-orange);
        }

        .products {
            margin-top: 30px;
            display: flex;
            justify-content: flex-start;
            gap: 20px;
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
            justify-content: center;
            padding: 20px;
            background: var(--orange);
            color: #fff;
            flex-wrap: wrap;
            gap: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <label>JES<span style="color: orange;">SHOES</span></label>
        <div class="nav-icons">
            <?php if (!isset($admin_email)): ?>
                <a href="login.php" title="Login"><i class="fa fa-sign-in" aria-hidden="true"></i> <span>Login</span></a>
            <?php else: ?>
                <a href="logout.php" title="Logout"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span></a>
            <?php endif; ?>
            <i class="fa fa-bars" title="Menu" id="menu-icon"></i>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="sidebar" id="menu">
        <label>JES<span style="color: orange;">SHOES</span></label>
        <ul>
            <!-- <li><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li> -->
            <li><a href="products.php" class="active"><i class="fas fa-store"></i><span>Products</span></a></li>
            <li><a href="orders.php"><i class="fa fa-shopping-cart"></i><span>Orders</span></a></li>
            <!-- <li><a href="blogs.php"><i class="fa fa-newspaper"></i><span>Blogs</span></a></li> -->
        </ul>
    </aside>

    <!-- Dashboard Content -->
    <main class="content">
        <div class="header">
            <h2>All Products</h2>
            <a href="add_product.php"><i class="fa fa-plus"></i><span>Add Product</span></a>
        </div>

        <div class="products">
            <?php if ($result):
                if (mysqli_num_rows($result) > 0):
                    while ($product = mysqli_fetch_assoc($result)): ?>
                        <div class="product-card">
                            <img src="../product_images/<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>" class="product-image">
                            <p><?php echo $product['product_name']; ?></p>
                            <p class="price">₦ <?php echo $product['product_price']; ?></p>
                            <div class="buttons">
                                <a href="edit_product.php?id=<?php echo $product['id']; ?>">
                                    <button><i class="fa fa-pencil"></i> Edit</button>
                                </a>
                                <a href="delete_product.php?id=<?php echo $product['id']; ?>">
                                    <button><i class="fa fa-trash"></i> Delete</button>
                                </a>
                            </div>
                        </div>
                    <?php endwhile;
                else: ?>
                    <p style="text-align: center;">You have no products</p>
            <?php
                endif; 
                endif;?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>Copyright &copy; <span id="year"></span> | All Rights Reserved</p>
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