<?php
session_start();
require_once 'conn.php';
if (isset($_SESSION['fullname'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE category=$id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['product'] = 0;
        header('location:product_category.php');
        exit;
    } else {
        $sql = "DELETE FROM product_category WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['product'] = 1;
            header('location:product_category.php');
            exit;
        }
    }
} else {
    header('location:login.php');
}
