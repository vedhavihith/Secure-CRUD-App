<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

/* 🔍 SEARCH */
$search = "";
$where = "";

if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where = "WHERE title LIKE '%$search%' OR content LIKE '%$search%'";
}

/* 📄 PAGINATION */
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$start = ($page - 1) * $limit;

/* FETCH POSTS */
$query = "SELECT * FROM posts $where ORDER BY id DESC LIMIT $start, $limit";
$result = mysqli_query($conn, $query);

/* COUNT TOTAL POSTS */
$total_query = "SELECT COUNT(*) as total FROM posts $where";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_posts = $total_row['total'];
$total_pages = ceil($total_posts / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">CRUD Blog App</span>
        <a href="dashboard.php" class="btn btn-light btn-sm">Dashboard</a>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">

<h2 class="mb-3">All Posts</h2>

<!-- SEARCH FORM -->
<form method="GET" class="d-flex mb-4">
    <input type="text" name="search"class="form-control me-2"placeholder="Search posts..."value="<?php echo $search; ?>">
    <button class="btn btn-primary">Search</button>
</form>

<!-- POSTS DISPLAY -->
<?php if(mysqli_num_rows($result) > 0) { ?>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['title']; ?></h5>
                <p class="card-text"><?php echo $row['content']; ?></p>

                <a href="edit.php?id=<?php echo $row['id']; ?>"class="btn btn-warning btn-sm">Edit</a>

                <a href="delete.php?id=<?php echo $row['id']; ?>"class="btn btn-danger btn-sm"onclick="return confirm('Are you sure you want to delete this post?');">Delete
                </a>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="alert alert-info">No posts found.</div>
<?php } ?>

<!-- PAGINATION -->
<?php if($total_pages > 1) { ?>
<nav>
<ul class="pagination justify-content-center">
<?php for ($i = 1; $i <= $total_pages; $i++) { ?>
    <li class="page-item <?php if($i == $page) echo 'active'; ?>">
        <a class="page-link"href="view.php?page=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?>
        </a>
    </li>
<?php } ?>
</ul>
</nav>
<?php } ?>

</div>

</body>
</html>
