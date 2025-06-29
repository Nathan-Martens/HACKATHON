<?php include("conexao.php"); ?>
<?php include_once "utils/main.php"; if (!main::verificarUsuarioLogado()) { header("Location: login.php"); exit(); }

$id = $_POST['idfuncao'];
$tipo = $_POST['tipoFuncao'] ?? '';
$permissao = $_POST['permissao'] ?? '';
$ativo = isset($_POST['ativo']) ? 1 : 0;

// Log para depuração
file_put_contents('log_permissao.txt', date('Y-m-d H:i:s') . " - permissao recebida: $permissao\n", FILE_APPEND);

$stmt = $conn->prepare("UPDATE funcao SET tipoFuncao = ?, permissao = ?, ativo = ? WHERE idfuncao = ?");
$stmt->bind_param("ssii", $tipo, $permissao, $ativo, $id);

if ($stmt->execute()) {
    echo "<script>alert('Função atualizada com sucesso!'); window.location.href='listar.funcoes.php';</script>";
} else {
    echo "<script>alert('Erro ao atualizar função.'); history.back();</script>";
}
?>
