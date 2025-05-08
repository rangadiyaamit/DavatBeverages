<?php
session_start();
require_once 'conn.php';
if (isset($_SESSION['fullname'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM core_values WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header('location:about_core_values.php');
    }
} else {
    header('location:login.php');
}
