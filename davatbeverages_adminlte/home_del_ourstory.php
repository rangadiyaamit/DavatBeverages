<?php
session_start();
require_once 'conn.php';
if (isset($_SESSION['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM our_story WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header('location:home_ourstory.php');
    }
}
