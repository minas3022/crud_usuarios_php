<?php
include 'db.php';
include 'templates/header.php';

$sql = "SELECT * FROM usuarios";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Usuários Cadastrados</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['usuario']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td>
                <a href="update.php?id=<?php echo $usuario['id']; ?>" class="btn btn-warning">Editar</a>
                <a href="delete.php?id=<?php echo $usuario['id']; ?>" class="btn btn-danger">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'templates/footer.php'; ?>
