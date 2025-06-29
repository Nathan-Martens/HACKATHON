<?php
include("conexao.php");
include_once "utils/main.php";
if (!main::verificarUsuarioLogado()) {
    header("Location: login.php");
    exit();
}

$nome = $_POST['nome'];
$cracha = $_POST['cracha'];
$telefone = $_POST['telefone'];
$ativo = isset($_POST['ativo']) ? 1 : 0;

$stmt = $conn->prepare("INSERT INTO responsavel (nome, cracha, telefone, ativo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $nome, $cracha, $telefone, $ativo);

if ($stmt->execute()) {
    echo "<script>alert('Responsável cadastrado com sucesso!'); window.location.href='listar.responsaveis.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar responsável.'); history.back();</script>";
}
?>
