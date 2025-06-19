<?php
include("conexao.php");
$responsaveis = $conn->query("SELECT * FROM responsavel");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Responsáveis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-warning">Responsáveis Cadastrados</h2>

    <table class="table table-dark table-hover table-bordered">
        <thead class="table-light text-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Crachá</th>
                <th>Telefone</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($r = $responsaveis->fetch_assoc()): ?>
                <tr>
                    <td><?= $r['idresponsavel'] ?></td>
                    <td><?= $r['nome'] ?></td>
                    <td><?= $r['cracha'] ?></td>
                    <td><?= $r['telefone'] ?></td>
                    <td>
                        <span class="badge <?= $r['ativo'] ? 'bg-success' : 'bg-danger' ?>">
                            <?= $r['ativo'] ? 'Ativo' : 'Inativo' ?>
                        </span>
                    </td>
                    <td>
                        <a href="editar.responsavel.php?id=<?= $r['idresponsavel'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="deletar.responsavel.php?id=<?= $r['idresponsavel'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="inicio.php" class="btn btn-secondary mt-3">Voltar</a>
</div>
</body>
</html>
