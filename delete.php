<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header('Location: read.php');
?>
