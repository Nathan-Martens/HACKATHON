<?php
include("conexao.php");
include_once "utils/main.php";
if (!main::verificarUsuarioLogado()) {
    header("Location: login.php");
    exit();
}
include("menssagens.php"); // se você usa para exibir mensagens padrão

// Receber dados do formulário
$idrecurso = $_POST['idrecurso'];
$idresponsavel = $_POST['idresponsavel'];
$descricao = $_POST['descricao'];
$datahora_reserva = $_POST['datahora_reserva'];
$datahora_devolucao = $_POST['datahora_devolucao'];
$ativo = isset($_POST['ativo']) ? 1 : 0;

// Validação de conflito de horário para o mesmo recurso
$confere = $conn->prepare("
    SELECT * FROM reserva 
    WHERE idrecurso = ? AND ativo = 1 
    AND (
        (? BETWEEN datahora_reserva AND datahora_devolucao)
        OR (? BETWEEN datahora_reserva AND datahora_devolucao)
        OR (datahora_reserva BETWEEN ? AND ?)
    )
");
$confere->bind_param("issss", $idrecurso, $datahora_reserva, $datahora_devolucao, $datahora_reserva, $datahora_devolucao);
$confere->execute();
$result = $confere->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Conflito: o recurso já está reservado nesse intervalo!'); history.back();</script>";
    exit;
}

// Inserir nova reserva
$stmt = $conn->prepare("
    INSERT INTO reserva (idrecurso, idresponsavel, descricao, datahora_reserva, datahora_devolucao, ativo)
    VALUES (?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("iisssi", $idrecurso, $idresponsavel, $descricao, $datahora_reserva, $datahora_devolucao, $ativo);

if ($stmt->execute()) {
    echo "<script>alert('Reserva cadastrada com sucesso!'); window.location.href='listar.reservas.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar reserva.'); history.back();</script>";
}
?>
