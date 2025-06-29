<?php include("conexao.php"); ?>
<?php include_once "utils/main.php"; if (!main::verificarUsuarioLogado()) { header("Location: login.php"); exit(); }

$id = $_POST['idresponsavel'];
$nome = $_POST['nome'];
$cracha = $_POST['cracha'];
$telefone = $_POST['telefone'];
$ativo = isset($_POST['ativo']) ? 1 : 0;

$stmt = $conn->prepare("UPDATE responsavel SET nome=?, cracha=?, telefone=?, ativo=? WHERE idresponsavel=?");
$stmt->bind_param("sssii", $nome, $cracha, $telefone, $ativo, $id);

if ($stmt->execute()) {
    echo "<script>alert('Responsável atualizado com sucesso!'); window.location.href='listar.responsaveis.php';</script>";
} else {
    echo "<script>alert('Erro ao atualizar.'); history.back();</script>";
}
?>