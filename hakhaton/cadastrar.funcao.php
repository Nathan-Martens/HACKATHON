<?php include("conexao.php"); ?>
<?php include_once "utils/main.php"; if (!main::verificarUsuarioLogado()) { header("Location: login.php"); exit(); }?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Função</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-warning">Cadastrar Função</h2>

    <form action="salvar.funcao.php" method="post">
        <div class="mb-3">
            <label class="form-label">Tipo de Função</label>
            <input type="text" name="tipo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Permissão</label>
            <select name="permissao" class="form-select" required>
                <option value="">Selecione</option>
                <option value="Administrador">Administrador</option>
                <option value="Cadastro/Edição">Cadastro/Edição</option>
                <option value="Somente Visualização">Somente Visualização</option>
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="ativo" class="form-check-input" value="1" checked>
            <label class="form-check-label">Ativo</label>
        </div>

        <button class="btn btn-warning" type="submit">Salvar</button>
        <a href="inicio.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>
