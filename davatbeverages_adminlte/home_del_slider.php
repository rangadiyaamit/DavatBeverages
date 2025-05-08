<?php
session_start();
require_once 'conn.php';
if (isset($_SESSION['fullname'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM home_slider WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header('location:home_slider.php');
    
    }
} else {
    header('location:login.php');
}
