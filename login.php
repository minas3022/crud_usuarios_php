<?php
session_start();
include 'db.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica se o usuário existe
    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['usuario' => $usuario]);
    $user = $stmt->fetch();

    if ($user) {
        // Verifica se a senha está correta
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['usuario'] = $user['usuario'];
            header('Location: dashboard.php');
        } else {
            $erro = 'Senha incorreta';
        }
    } else {
        $erro = 'Usuário não encontrado';
    }
}

include 'templates/header.php';
?>

<div class="container mt-5">
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <div class="form-group">
            <label for="usuario">Usuário</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <?php if ($erro): ?>
            <div class="alert alert-danger"><?php echo $erro; ?></div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php include 'templates/footer.php'; ?>
