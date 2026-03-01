<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>
Welcome, <?php echo $_SESSION['user']; ?> 🎉 <br>
Role: <?php echo $_SESSION['role']; ?>
</h2>

<a href="add.php">Add Post</a> |
<a href="view.php">View Posts</a> |
<a href="logout.php">Logout</a>
