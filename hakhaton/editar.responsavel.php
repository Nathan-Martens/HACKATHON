<?php
include("conexao.php");

$idresponsavel = $_GET['id'] ?? null;

if (!$idresponsavel) {
    echo "<script>alert('ID inválido.'); window.location.href='listar.responsaveis.php';</script>";
    exit;
}

$busca = $conn->prepare("SELECT * FROM responsavel WHERE idresponsavel = ?");
$busca->bind_param("i", $idresponsavel);
$busca->execute();
$res = $busca->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Responsável</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-warning">Editar Responsável</h2>

    <form action="atualizar.responsavel.php" method="post">
        <input type="hidden" name="idresponsavel" value="<?= $res['idresponsavel'] ?>">

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= $res['nome'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Crachá</label>
            <input type="text" name="cracha" class="form-control" value="<?= $res['cracha'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="<?= $res['telefone'] ?>" required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="ativo" value="1" <?= $res['ativo'] ? 'checked' : '' ?>>
            <label class="form-check-label">Ativo</label>
        </div>

        <button type="submit" class="btn btn-warning">Atualizar</button>
        <a href="listar.responsaveis.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
