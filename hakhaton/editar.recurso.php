<?php
include("conexao.php");
include_once "utils/main.php";
if (!main::verificarUsuarioLogado()) {
    header("Location: login.php");
    exit();
}

// Verifica se o ID foi passado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do recurso não informado.");
}

$id = intval($_GET['id']);

// Busca os dados do recurso
$sql = "SELECT * FROM recurso WHERE idrecurso = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Recurso não encontrado.");
}

$recurso = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Recurso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-warning">Atualizar Devolução do Recurso</h2>
    <form action="atualizar.recurso.php" method="POST" class="mt-4">
        <input type="hidden" name="idrecurso" value="<?= $recurso['idrecurso'] ?>">

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" required><?= $recurso['descricao'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Devolução</label>
            <input type="date" name="dataDevolucao" class="form-control" value="<?= $recurso['dataDevolucao'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Horário de Devolução</label>
            <input type="time" name="horarioDevolucao" class="form-control" value="<?= $recurso['horarioDevolucao'] ?>" required>
        </div>

        <button type="submit" class="btn btn-warning">Salvar Alterações</button>
        <a href="listar.recursos.php" class="btn btn-outline-light">Cancelar</a>
    </form>
</div>
</body>
</html>
