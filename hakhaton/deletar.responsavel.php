<?php
include("conexao.php");
include_once "utils/main.php";

if (!main::verificarUsuarioLogado()) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>alert('ID inválido!'); window.location.href='listar.responsaveis.php';</script>";
    exit;
}

$delete = $conn->prepare("DELETE FROM responsavel WHERE idresponsavel = ?");
$delete->bind_param("i", $id);

if ($delete->execute()) {
    echo "<script>alert('Responsável excluído com sucesso!'); window.location.href='listar.responsaveis.php';</script>";
} else {
    echo "<script>alert('Erro ao excluir.'); history.back();</script>";
}
?>
