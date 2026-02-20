<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
?>

<h2>Welcome, <?php echo $_SESSION['user']; ?> 🎉</h2>

<a href="add.php">Add Post</a> |
<a href="view.php">View Posts</a> |
<a href="logout.php">Logout</a>
