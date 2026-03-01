<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] != 'admin') {
    die("Access Denied");
}

if (isset($_POST['add'])) {

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (empty($title) || empty($content)) {
        die("All fields are required!");
    }

    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        echo "✅ Post added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
<h2>Add Post</h2>

<form method="post">
    Title: <input type="text" name="title" required><br><br>
    Content:<br>
    <textarea name="content" required></textarea><br><br>
    <button type="submit" name="add">Add Post</button>
</form>

<br>
<a href="dashboard.php">Back to Dashboard</a>