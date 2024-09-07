<?php
include 'db.php';
include 'templates/header.php';

$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_atualizado = $_POST['usuario'];
    $email_atualizado = $_POST['email'];

    if (!empty($_POST['senha'])) {
        $senha_atualizada = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET usuario = :usuario, senha = :senha, email = :email WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['usuario' => $usuario_atualizado, 'senha' => $senha_atualizada, 'email' => $email_atualizado, 'id' => $id]);
    } else {
        $sql = "UPDATE usuarios SET usuario = :usuario, email = :email WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['usuario' => $usuario_atualizado, 'email' => $email_atualizado, 'id' => $id]);
    }

    header('Location: read.php');
}
?>

<h2>Editar Usuário</h2>

<form method="POST" action="update.php?id=<?php echo $id; ?>">
    <div class="form-group">
        <label for="usuario">Usuário</label>
        <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario['usuario']; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario['email']; ?>" required>
    </div>
    <div class="form-group">
        <label for="senha">Nova Senha (deixe em branco para não alterar)</label>
        <input type="password" class="form-control" id="senha" name="senha">
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>

<?php include 'templates/footer.php'; ?>
