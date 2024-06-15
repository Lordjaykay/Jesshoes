<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jesshoes";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Database connection error");
}