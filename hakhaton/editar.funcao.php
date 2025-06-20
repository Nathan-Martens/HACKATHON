<?php
include("conexao.php");

$idfuncao = $_GET['id'] ?? null;

if (!$idfuncao) {
    echo "<script>alert('ID inválido.'); window.location.href='listar.funcoes.php';</script>";
    exit;
}

$busca = $conn->prepare("SELECT * FROM funcao WHERE idfuncao = ?");
$busca->bind_param("i", $idfuncao);
$busca->execute();
$funcao = $busca->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Função</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-warning">Editar Função</h2>

    <form action="atualizar.funcao.php" method="post">
        <input type="hidden" name="idfuncao" value="<?= $funcao['idfuncao'] ?>">

        <div class="mb-3">
            <label class="form-label">Tipo de Função</label>
            <input type="text" name="tipo" class="form-control" value="<?= $funcao['tipo'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Permissão</label>
            <select name="permissao" class="form-select" required>
                <option value="">Selecione</option>
                <option value="Administrador" <?= $funcao['permissao'] == 'Administrador' ? 'selected' : '' ?>>Administrador</option>
                <option value="Cadastro/Edição" <?= $funcao['permissao'] == 'Cadastro/Edição' ? 'selected' : '' ?>>Cadastro/Edição</option>
                <option value="Somente Visualização" <?= $funcao['permissao'] == 'Somente Visualização' ? 'selected' : '' ?>>Somente Visualização</option>
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="ativo" value="1" class="form-check-input" <?= $funcao['ativo'] ? 'checked' : '' ?>>
            <label class="form-check-label">Ativo</label>
        </div>

        <button type="submit" class="btn btn-warning">Atualizar</button>
        <a href="listar.funcoes.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>