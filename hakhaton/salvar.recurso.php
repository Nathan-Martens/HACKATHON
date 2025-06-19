<?php
include("conexao.php");

// Coleta dos dados
$descricao       = $_POST['descricao'];
$quantidade      = $_POST['quantidade'];
$idresponsavel   = $_POST['responsavel'];
$idtiporecurso   = $_POST['tiporecurso'];
$dataLocacao     = $_POST['dataLocacao'];
$horarioLocacao  = $_POST['horarioLocacao'];


 if ($idresponsavel == "" || $idtiporecurso == "") {
        header("Location: cadastro.php?tipo=danger&mensagem=O campo responsavel e tipo de tipo de recurso precisa ser Prenchido!");
        exit();
    }
// Query de inserção
$sql = "INSERT INTO recurso (descricao, quantidade, idresponsavel, idtiporecurso, dataLocacao, horarioLocacao)
        VALUES ('$descricao', '$quantidade', '$idresponsavel ', '$idtiporecurso', '$dataLocacao', '$horarioLocacao')";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siisss", $descricao, $quantidade, $idresponsavel, $idtiporecurso, $dataLocacao, $horarioLocacao);

if ($stmt->execute()) {
    header("Location: listar.recursos.php?sucesso=1");
} else {
    echo "<p class='text-danger'>Erro ao salvar: " . $conn->error . "</p>";
}