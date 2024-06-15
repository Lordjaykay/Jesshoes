<?php
session_start();

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

        /* Header */
        header {
            display: flex;
            align-items: center;
            justify-content: space-around;
            gap: 40px;
            padding: 40px;
            position: relative;
            overflow: hidden;
            min-height: calc(100vh - 120px);
            margin-top: 120px;
        }

        header .hero-text {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            flex-direction: column;
            gap: 40px;
        }

        header img {
            width: 1000px;
        }

        header .background {
            position: absolute;
            top: -500px;
            right: 450px;
            height: 100%;
            z-index: -1;
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            transform: rotate(-45deg);
        }

        .background div.second {
            background: linear-gradient(120deg, var(--dark-orange), var(--orange));
            width: 400px;
            height: 400%;
        }

        .background div.third {
            background: linear-gradient(120deg, var(--dark-orange), var(--orange));
            width: 30px;
            height: 140%;
        }

        /* Benefits */
        .benefits {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            margin: 30px auto;
            box-shadow: 0 0 20px var(--shadow);
            width: 80%;
            border-radius: 10px;
        }

        .benefits .benefit {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 8px;
            padding: 70px;
            text-align: center;
        }

        .benefit i {
            font-size: 30px;
        }

        /* About */
        .about {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 40px;
        }

        .about img {
            width: 600px;
        }

        .about .about-text {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            flex-direction: column;
            gap: 20px;
        }

        /* Categories */
        .categories .category {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            margin: 30px auto;
        }

        .category .cat {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 8px;
            padding: 70px;
            text-align: center;
            box-shadow: 0 0 10px var(--shadow);
        }

        .cat img {
            width: 100%;
            height: 200px;
        }

        .cat i {
            font-size: 30px;
        }

        /* Blog */
        .blog .blogs {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-direction: row;
            gap: 20px;
        }

        .blogs .blog-content {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-direction: column;
            margin-top: 20px;
        }

        .blog-content img {
            width: 400px;
            height: 400px;
            object-fit: contain;
            object-position: center;
        }

        .blog-content .blog-text {
            background: var(--shadow);
            width: 400px;
            height: auto;
            padding: 20px;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            flex-direction: column;
            gap: 20px;
        }

        /* Contact */
        .contact-content {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 25px;
            width: 100%;
        }

        .contact-content .contact-info {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            flex-direction: column;
            gap: 20px;
            flex-basis: 40%;
            width: 100%;
        }

        .contact-info > div {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .contact-info > div i {
            font-size: 24px;
            color: var(--orange);
        }

        .contact-info > div h2 {
            color: var(--orange);
        }

        .contact-info .map {
            width: 100%;
            height: 320px;
            background: var(--black);
        }

        .contact-content form.contact-form {
            width: 50%;
        }

        .contact-form .input-box {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            flex-direction: column;
            gap: 13px;
            margin-bottom: 15px;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 12px;
        }

        .contact-form textarea {
            max-width: 100%;
            min-width: 100%;
            max-height: 200px;
            min-height: 200px;
        }

        .contact-form button {
            width: 100%;
            padding: 10px 15px;
            background: var(--orange);
            color: #fff;
            outline: none;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 23px;
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

        @media screen and (max-width: 1200px) {
            header img {
                display: none;
            }
        }

        @media screen and (max-width: 1000px) {
            .about {
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
                text-align: center;
            }

            .about .about-text {
                align-items: center;
                justify-content: center;
            }

            .blog .blogs {
                flex-direction: column;
            }
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

            .category .cat {
                width: 100%;
            }

            .cat img {
                object-fit: cover;
                object-position: center;
            }

            .blog-content img {
                width: 100%;
                object-fit: cover;
                object-position: center;
            }

            .blog-content .blog-text {
                width: 100%;
            }
        }

        @media screen and (max-width: 700px) {
            .contact-info, .contact-form {
                flex-basis: 100%;
                width: 100%;
            }

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
            <li title="Home"><a href="#">Home</a></li>
            <li title="About"><a href="#about">About</a></li>
            <li title="Shop"><a href="#categories">Category</a></li>
            <li title="Blog"><a href="#blog">Blog</a></li>
            <li title="Contact"><a href="#contact">Contact</a></li>
            <li title="Cart"><a href="cart.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
            <?php if (isset($_SESSION["user_email"])): ?>
                <li title="Logout"><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
            <?php else: ?>
                <li title="Login"><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
            <?php endif; ?>
        </ul>
        <label title="Menu" class="menu-icon" id="menu-icon"><i class="fa fa-bars" aria-hidden="true"></i></label>
    </nav>

    <!-- Hero section -->
    <header>
        <div class="hero-text">
            <h1>JES<span style="color: orange;">SHOES</span> New <br>Collection!</h1>
            <p>Jesshoes is a shoe brand showcasing the best of shoes around the world. Go to our categories section to see the various categories of shoes and to the products page to see the see all our products.</p>
        </div>
        <img src="./assets/hero-img.png" alt="Hero Image">
        <div class="background">
            <div class="first"></div>
            <div class="first"></div>
            <div class="second"></div>
            <div class="third"></div>
        </div>
    </header>

    <!-- Benefits -->
    <section class="benefits">
        <div class="benefit">
            <i class="fa fa-truck"></i>
            <h2>Free Delivery</h2>
            <p>Free shipping on all order</p>
        </div>
        <div class="benefit">
            <i class="fa fa-refresh"></i>
            <h2>Return Policy</h2>
            <p>Free shipping on all order</p>
        </div>
        <div class="benefit">
            <i class="fa fa-headphones"></i>
            <h2>24/7 Support</h2>
            <p>Free shipping on all order</p>
        </div>
        <div class="benefit">
            <i class="fa fa-database"></i>
            <h2>Secure Payment</h2>
            <p>Free shipping on all order</p>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="about">
        <img src="./assets/about-img.jpg" alt="About Image">
        <div class="about-text">
            <h1>About Us</h1>
            <p>Jesshoes is a shoe brand showcasing the best of shoes around the world. Go to our categories section to see the various categories of shoes and to the products page to see the see all our products.</p>
        </div>
    </section>

    <!-- Category -->
    <section id="categories" class="categories">
        <div class="categories-title">
            <h1>Category</h1>
            <p>Take a look at the categories of products we sell</p>
        </div>
        <div class="category">
            <a href="products.php?category=brogues" class="cat">
                <img src="./assets/categories/brogues.png" alt="Brogues">
                <h2>Brogues</h2>
            </a>
            <a href="products.php?category=sneakers" class="cat">
                <img src="./assets/categories/sneakers.png" alt="Sneakers">
                <h2>Sneakers</h2>
            </a>
            <a href="products.php?category=cleats" class="cat">
                <img src="./assets/categories/cleats.png" alt="Cleats">
                <h2>Cleats</h2>
            </a>
            <a href="products.php?category=block-heels" class="cat">
                <img src="./assets/categories/block-heels.png" alt="Block Heels">
                <h2>Block heels</h2>
            </a>
            <a href="products.php?category=boots" class="cat">
                <img src="./assets/categories/boots.png" alt="Boots">
                <h2>Boots</h2>
            </a>
        </div>
    </section>

    <!-- Blog -->
    <section class="blog" id="blog">
        <div class="blog-title">
            <h1>Blogs</h1>
            <p>Check out our latest blogs</p>
        </div>
        <div class="blogs">
            <div class="blog-content">
                <img src="./assets/about-img.jpg" alt="Blog">
                <div class="blog-text">
                    <div>
                        <a href="#"><h2>The essence of this website</h2></a>
                        <p>This website is to give you a good look at the shoes we sell</p>
                    </div>
                    <p>20th January, 2024</p>
                </div>
            </div>
            <div class="blog-content">
                <img src="./assets/hero-img.png" alt="Blog">
                <div class="blog-text">
                    <div>
                        <a href="#"><h2>Shoes, an essential part of dressing</h2></a>
                        <p>Learn about how you can choose shoes to match your dressing</p>
                    </div>
                    <p>22nd March, 2024</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="contact" id="contact">
        <div class="contact-title">
            <h1>Contact</h1>
            <p>Feel free to contact us to know more about us</p>
        </div>
        <div class="contact-content">
            <div class="contact-info">
                <div>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <div>
                        <h2>Address</h2>
                        <p>Army Estate, Kurudu</p>
                    </div>
                </div>
                <div>
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <div>
                        <h2>Phone</h2>
                        <p>+234 801 234 5678</p>
                    </div>
                </div>
                <div>
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <div>
                        <h2>Email</h2>
                        <p>jesshoes@gmail.com</p>
                    </div>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3939.058235451896!2d7.359415209249423!3d9.149213390879098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104ddf2ff0e42c63%3A0x8d545425daea8e18!2sArmy%20Estate%2C%2014%20Nsi-Eke%20Cres%2C%20Kubwa%20900001%2C%20Federal%20Capital%20Territory!5e0!3m2!1sen!2sng!4v1711101507867!5m2!1sen!2sng" height="320" style="width: 100%; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <form class="contact-form">
                <div class="input-box">
                    <label for="name">Your name</label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="input-box">
                    <label for="email">Your email</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="input-box">
                    <label for="subject">Your subject</label>
                    <input type="text" id="subject" name="subject">
                </div>
                <div class="input-box">
                    <label for="message">Message</label>
                    <textarea name="message" id="message"></textarea>
                </div>
                <button>Submit</button>
            </form>
        </div>
    </section>

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