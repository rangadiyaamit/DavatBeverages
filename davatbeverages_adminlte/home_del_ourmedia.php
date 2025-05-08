<?php
session_start();
require_once 'conn.php';
if (!isset($_SESSION['id'])) {
    header('location:login.php');
}
$id = $_GET['id'];
$sql = "DELETE FROM our_media WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    header('location:home_ourmedia.php');
}
