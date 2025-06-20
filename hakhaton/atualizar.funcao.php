<?php
include("conexao.php");

$id = $_POST['idfuncao'];
$tipo = $_POST['tipo'];
$permissao = $_POST['permissao'];
$ativo = isset($_POST['ativo']) ? 1 : 0;

$stmt = $conn->prepare("UPDATE funcao SET tipo = ?, permissao = ?, ativo = ? WHERE idfuncao = ?");
$stmt->bind_param("ssii", $tipo, $permissao, $ativo, $id);

if ($stmt->execute()) {
    echo "<script>alert('Função atualizada com sucesso!'); window.location.href='listar.funcoes.php';</script>";
} else {
    echo "<script>alert('Erro ao atualizar função.'); history.back();</script>";
}
?>
