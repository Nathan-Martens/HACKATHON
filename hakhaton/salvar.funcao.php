<?php
include("conexao.php");
include_once "utils/main.php";
if (!main::verificarUsuarioLogado()) {
    header("Location: login.php");
    exit();
}

$tipo = $_POST['tipo'];
$permissao = $_POST['permissao'];
$ativo = isset($_POST['ativo']) ? 1 : 0;

$stmt = $conn->prepare("INSERT INTO funcao (tipo, permissao, ativo) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $tipo, $permissao, $ativo);

if ($stmt->execute()) {
    echo "<script>alert('Função cadastrada com sucesso!'); window.location.href='listar.funcoes.php';</script>";
} else {
    echo "<script>alert('Erro ao salvar função.'); history.back();</script>";
}
?>
