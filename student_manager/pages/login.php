<?php
include_once '../includes/header.php';
include_once '../config/database.php';
include_once '../classes/User.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if ($identifiedUser = $user->authenticate($username, $password)) {
        $_SESSION['user_id'] = $identifiedUser['id']; // Correction : utiliser $identifiedUser
        $_SESSION['username'] = $identifiedUser['username']; // Correction
        $_SESSION['role'] = $identifiedUser['role'];
        header("Location: home.php");
        exit();
    } else {
        echo '<div class="alert alert-danger">Identifiants incorrects.</div>';
    }
}
?>

<h2>Connexion</h2>
<form method="POST">
    <div class="mb-3">
        <label class="form-label">Nom d'utilisateur</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php include_once '../includes/footer.php'; ?>