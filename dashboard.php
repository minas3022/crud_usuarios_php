<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
?>

<?php include 'templates/header.php'; ?>

<div class="container mt-5">
    <h2>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h2>
    <a href="logout.php" class="btn btn-danger">Sair</a>
</div>

<?php include 'templates/footer.php'; ?>
