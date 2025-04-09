<?php
include '../includes/header.php';
include '../includes/navbar.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<h1>Bienvenue, <?php echo $_SESSION['username']; ?>!</h1>
<p>Welcome to your administration platform.</p>
<?php include '../includes/footer.php'; ?>