<?php include("conexao.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Responsável</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-warning">Cadastrar Responsável</h2>

    <form action="salvar.responsavel.php" method="post">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Crachá</label>
            <input type="text" name="cracha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="ativo" value="1" checked>
            <label class="form-check-label">Ativo</label>
        </div>

        <button type="submit" class="btn btn-warning">Salvar</button>
        <a href="inicio.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>
