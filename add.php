<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    mysqli_query($conn, "INSERT INTO posts (title, content) VALUES ('$title', '$content')");
    echo "✅ Post added successfully";
}
?>

<h2>Add Post</h2>

<form method="post">
    Title: <input type="text" name="title" required><br><br>
    Content:<br>
    <textarea name="content" required></textarea><br><br>
    <button name="add">Add Post</button>
</form>

<br>
<a href="dashboard.php">Back to Dashboard</a>
