<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$id");
$post = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    mysqli_query($conn, "UPDATE posts SET title='$title', content='$content' WHERE id=$id");
    header("Location: view.php");
}
?>

<h2>Edit Post</h2>

<form method="post">
    Title: <input type="text" name="title" value="<?php echo $post['title']; ?>"><br><br>
    Content:<br>
    <textarea name="content"><?php echo $post['content']; ?></textarea><br><br>
    <button name="update">Update</button>
</form>
