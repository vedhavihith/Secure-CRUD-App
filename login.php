<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {

    if (empty($_POST['username']) || empty($_POST['password'])) {
        die("All fields are required!");
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "❌ Invalid username or password";
    }

    $stmt->close();
}
?>

<h2>Login</h2>
<form method="post" onsubmit="return validateForm()">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <button type="submit" name="login">Login</button>
</form>
<script>
function validateForm() {
    var username = document.forms[0]["username"].value;
    var password = document.forms[0]["password"].value;

    if (username == "" || password == "") {
        alert("All fields are required!");
        return false;
    }
    return true;
}
</script>