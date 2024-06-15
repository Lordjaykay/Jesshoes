<?php
session_start();

$admin_email = $_SESSION["admin_email"];

if (!isset($admin_email)) {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"];

include "./config/db_connect.php";

$product_name = $product_price = $product_desc = $category = $error = "";

include "./config/db_connect.php";

$sqli = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($conn, $sqli);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $product_name = $row["product_name"];
        $category = $row["product_category"];
        $product_price = $row["product_price"];
        $product_desc = $row["product_desc"];
    }
}

if (isset($_POST["edit_product"])) {
    $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    $product_price = mysqli_real_escape_string($conn, $_POST["product_price"]);
    $product_desc = mysqli_real_escape_string($conn, $_POST["product_desc"]);

    if (empty($product_name) || empty($category) || empty($product_price) || empty($product_desc)) {
        $error = "Input fields cannot be empty";
    } else {
        if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] === UPLOAD_ERR_OK) {
            $img_name = $_FILES["product_image"]["name"];
            $tmp_name = $_FILES["product_image"]["tmp_name"];
            $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $allowed_extensions = ["jpg", "jpeg", "png"];
            if (in_array($img_ext, $allowed_extensions)) {
                $new_img_name = time() . $img_name . '.' . $img_ext;
                $destination = "../product_images/" . $new_img_name;

                if (move_uploaded_file($tmp_name, $destination)) {
                    $sql = "UPDATE products SET product_img = '$new_img_name', product_name = '$product_name', product_category = '$category', product_price = '$product_price', product_desc = '$product_desc' WHERE id = '$id'";
                    $query = mysqli_query($conn, $sql);

                    if ($query) {
                        header("Location: products.php");
                        exit();
                    } else {
                        $error = "Failed to update product information";
                    }
                } else {
                    $error = "Failed to move uploaded image";
                }
            } else {
                $error = "Please upload an image file (jpg, jpeg, png)";
            }
        } else {
            $sql = "UPDATE products SET product_name = '$product_name', product_category = '$category', product_price = '$product_price', product_desc = '$product_desc' WHERE id = '$id'";
            $query = mysqli_query($conn, $sql);

            if ($query) {
                header("Location: products.php");
                exit();
            } else {
                $error = "Failed to update product information";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jesshoes Admin Panel - Add Products</title>
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
            gap: 20px;
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

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container form {
            width: 100%;
            max-width: 800px;
            border: 1px solid #777;
            padding: 20px;
            border-radius: 10px;
        }

        form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form .input-box {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
            width: 100%;
        }

        .input-box input, .input-box textarea, .input-box select {
            width: 100%;
            padding: 6px 5px;
        }

        .input-box textarea {
            max-width: 100%;
            min-width: 100%;
            max-height: 200px;
            min-height: 200px;
        }

        form button {
            width: 100%;
            padding: 10px 15px;
            border: none;
            outline: none;
            cursor: pointer;
            color: #fff;
            background: var(--orange);
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

        .error {
            margin: 10px auto;
            padding: 10px;
            color: #721c24;
            background: #f8d7da;
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
            <!-- <li><a href="index.php" class="active"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li> -->
            <li><a href="products.php"><i class="fas fa-store"></i><span>Products</span></a></li>
            <li><a href="orders.php"><i class="fa fa-shopping-cart"></i><span>Orders</span></a></li>
            <!-- <li><a href="blogs.php"><i class="fa fa-newspaper"></i><span>Blogs</span></a></li> -->
        </ul>
    </aside>

    <!-- Dashboard Content -->
    <main class="content">
        <div class="header">
            <h2>Add Products</h2>
            <a href="products.php"><i class="fa fa-arrow-left"></i><span>Go back</span></a>
        </div>

        <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
                <?php if ($error !== ""): ?>
                    <p class="error"><?php echo $error ?></p>
                <?php else: ?>
                    <p></p>
                <?php endif; ?>

                <div class="input-box">
                    <label for="product_image">Product image:</label>
                    <input type="file" id="product_image" name="product_image" value="<?php echo htmlspecialchars($product_image) ?>" required>
                </div>

                <div class="input-box">
                    <label for="product_name">Product name:</label>
                    <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product_name) ?>" required>
                </div>

                <div class="input-box">
                    <label for="category">Product category:</label>
                    <select id="category" name="category">
                        <option value="">Select a category</option>
                        <option value="Brogues">Brogues</option>
                        <option value="Sneakers">Sneakers</option>
                        <option value="Cleats">Cleats</option>
                        <option value="Block heels">Block heels</option>
                        <option value="Boots">Boots</option>
                    </select>
                </div>

                <div class="input-box">
                    <label for="product_price">Product price:</label>
                    <input type="number" id="product_price" name="product_price" value="<?php echo htmlspecialchars($product_price) ?>" required>
                </div>

                <div class="input-box">
                    <label for="product_desc">Product description:</label>
                    <textarea type="text" id="product_desc" name="product_desc" required><?php echo htmlspecialchars($product_desc) ?></textarea>
                </div>

                <button type="submit" name="edit_product">Edit Product</button>
            </form>
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