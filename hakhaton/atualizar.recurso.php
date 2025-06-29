<?php include("conexao.php"); ?>
<?php include_once "utils/main.php"; if (!main::verificarUsuarioLogado()) { header("Location: login.php"); exit(); }

// Coleta dos dados
$idrecurso        = $_POST['idrecurso'];
$descricao        = $_POST['descricao'];
$dataDevolucao    = $_POST['dataDevolucao'];
$horarioDevolucao = $_POST['horarioDevolucao'];

// Atualiza os dados
$sql = "UPDATE recurso 
        SET descricao = ?, dataDevolucao = ?, horarioDevolucao = ?
        WHERE idrecurso = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $descricao, $dataDevolucao, $horarioDevolucao, $idrecurso);

if ($stmt->execute()) {
    header("Location: listar.recursos.php?atualizado=1");
} else {
    echo "<p class='text-danger'>Erro ao atualizar: " . $conn->error . "</p>";
}
?>
