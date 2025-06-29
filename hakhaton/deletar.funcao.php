<?php
include("conexao.php");
include_once "utils/main.php";

if (!main::verificarUsuarioLogado()) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>alert('ID inválido!'); window.location.href='listar.funcoes.php';</script>";
    exit;
}

// Busca todos os responsáveis vinculados a esta função
$responsaveis = $conn->query("SELECT idresponsavel FROM responsavel WHERE idfuncao = $id");
if ($responsaveis && $responsaveis->num_rows > 0) {
    while ($resp = $responsaveis->fetch_assoc()) {
        $idresp = $resp['idresponsavel'];
        // Exclui todos os recursos vinculados a este responsável
        $delRec = $conn->prepare("DELETE FROM recurso WHERE idresponsavel = ?");
        $delRec->bind_param("i", $idresp);
        $delRec->execute();
    }
}
// Exclui todos os responsáveis vinculados a esta função
$deleteResp = $conn->prepare("DELETE FROM responsavel WHERE idfuncao = ?");
$deleteResp->bind_param("i", $id);
$deleteResp->execute();
// Agora exclui a função
$stmt = $conn->prepare("DELETE FROM funcao WHERE idfuncao = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    echo "<script>alert('Função, responsáveis e recursos vinculados excluídos com sucesso!'); window.location.href='listar.funcoes.php';</script>";
} else {
    echo "<script>alert('Erro ao excluir: {$conn->error}'); history.back();</script>";
}
?>