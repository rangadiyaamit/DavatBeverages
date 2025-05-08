<?php
session_start();
require_once 'conn.php';
if (isset($_SESSION['fullname'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM registration WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
    header('location:user_list.php');
        
    }
} else {
    header('location:login.php');
}
