<?php
include("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>alert('ID inválido!'); window.location.href='listar.funcoes.php';</script>";
    exit;
}

$stmt = $conn->prepare("DELETE FROM funcao WHERE idfuncao = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Função excluída com sucesso!'); window.location.href='listar.funcoes.php';</script>";
} else {
    echo "<script>alert('Erro ao excluir.'); history.back();</script>";
}
?>