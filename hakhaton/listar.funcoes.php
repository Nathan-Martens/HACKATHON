<?php
include("conexao.php");
$funcoes = $conn->query("SELECT * FROM funcao");

$type = $_GET["type"] ?? null;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Funções</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-warning">Funções Cadastradas</h2>

    <table class="table table-dark table-bordered table-hover">
        <thead class="table-light text-dark">
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Permissão</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($f = $funcoes->fetch_assoc()): ?>
                <tr>
                    <td><?= $f['idfuncao'] ?></td>
                    <td><?= $f['tipoFuncao'] ?></td>
                    <td><?= $f['permissao'] ?></td>
                    <td>
                        <span class="badge <?= $f['ativo'] ? 'bg-success' : 'bg-danger' ?>">
                            <?= $f['ativo'] ? 'Ativo' : 'Inativo' ?>
                        </span>
                    </td>
                    <td>
                        <a href="editar.funcao.php?id=<?= $f['idfuncao'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="deletar.funcao.php?id=<?= $f['idfuncao'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja excluir esta função?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="inicio.php" class="btn btn-secondary mt-3">Voltar</a>
</div>
</body>
</html>
