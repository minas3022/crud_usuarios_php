<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql = "INSERT INTO usuarios (usuario, senha, email) VALUES (:usuario, :senha,:email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['usuario' => $usuario, 'senha' => $senha,'email' => $email]);

    header("Location: read.php");
}

include 'templates/header.php';
?>

<div class="container mt-5">
    <h2>Criar Novo Usuário</h2>
    <form method="POST" action="create.php">
        <div class="form-group">
            <label for="usuario">Usuário</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email">
        </div>
        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
    <a href="read.php" class="btn btn-secondary mt-3">Voltar</a>
</div>

<?php include 'templates/footer.php'; ?>
