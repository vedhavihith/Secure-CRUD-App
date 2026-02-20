<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM posts WHERE id=$id");

header("Location: view.php");
?>
