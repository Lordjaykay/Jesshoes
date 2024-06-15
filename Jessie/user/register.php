<?php
session_start();

if (isset($_SESSION["user_email"])) {
    header("Location: index.php");
    exit();
}

include("./config/db_connect.php");

$username = $email = $address = $phone = $password = $error = "";

if (isset($_POST["register"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $password = password_hash(mysqli_real_escape_string($conn, $_POST["password"]), PASSWORD_DEFAULT);

    if (empty($username) || empty($email) || empty($address) || empty($phone) || empty($password)) {
        $input_error = "Input fields cannot be empty";
    }

    $sql = "INSERT INTO users (username, email, address, phone, password) VALUES ('$username', '$email', '$address', '$phone', '$password')";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        $input_error = "An error occurred, try again";
    } else {
        header("Location: login.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jesshoes - Register</title>
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

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container form {
            width: 100%;
            max-width: 400px;
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

        .input-box input {
            width: 100%;
            padding: 6px 5px;
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

        form p {
            text-align: center;
            margin-top: 15px;
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
    <div class="container">
        <form action="" method="post">
            <h2>Register</h2>
            <?php if ($error !== ""): ?>
                <p class="error"><?php echo $error ?></p>
            <?php else: ?>
                <p></p>
            <?php endif; ?>
            <div class="input-box">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username) ?>">
            </div>
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
            </div>
            <div class="input-box">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address) ?>">
            </div>
            <div class="input-box">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone) ?>">
            </div>
            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
            </div>
            <button type="submit" name="register">Register</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>