<?php 
include("conexao.php");
include_once "utils/main.php";
if (!main::verificarUsuarioLogado()) {
    header("Location: login.php");
    exit();
}

// Captura filtros do formulário
$dataFiltro = $_GET['data'] ?? '';
$tipoFiltro = $_GET['tipo'] ?? '';

// Buscar tipos de recurso para o select
$tipos = $conn->query("SELECT idtiporecurso, tiporecurso FROM tiporecurso WHERE ativo = 1");

// Monta a SQL com filtros dinâmicos
$sql = "SELECT r.idrecurso, r.descricao, tr.tiporecurso, rs.nome, r.dataLocacao, r.horarioLocacao 
        FROM recurso r
        JOIN responsavel rs ON r.idresponsavel = rs.idresponsavel
        JOIN tiporecurso tr ON r.idtiporecurso = tr.idtiporecurso
        WHERE r.ativo = 1";

if (!empty($dataFiltro)) {
    $sql .= " AND r.dataLocacao = '" . $conn->real_escape_string($dataFiltro) . "'";
}
if (!empty($tipoFiltro)) {
    $sql .= " AND r.idtiporecurso = " . (int)$tipoFiltro;
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recursos Cadastrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --azul-escuro: #003865;
            --laranja-vibrante: #f68b1f;
            --laranja-claro: #fbb040;
            --branco: #ffffff;
        }

        body {
            background-color: var(--azul-escuro);
            color: var(--branco);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            background-color: var(--azul-escuro);
            padding: 2rem;
            border-radius: 8px;
        }

        h2.text-senac {
            color: var(--branco);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        form label {
            color: var(--branco);
            font-weight: 600;
        }

        .form-control, .form-select {
            background-color: #00509e;
            color: var(--branco);
            border: none;
            transition: background-color 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            background-color: #0066cc;
            color: var(--branco);
            box-shadow: 0 0 5px var(--laranja-vibrante);
        }

        .btn-senac {
            background-color: var(--laranja-vibrante);
            color: var(--branco);
            font-weight: 700;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-senac:hover, .btn-senac:focus {
            background-color: var(--laranja-claro);
            color: var(--azul-escuro);
        }

        .btn-outline-senac {
            color: var(--laranja-vibrante);
            border: 2px solid var(--laranja-vibrante);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-senac:hover, .btn-outline-senac:focus {
            background-color: var(--laranja-vibrante);
            color: var(--branco);
            border-color: var(--laranja-vibrante);
        }

        table.table-dark {
            background-color: #002b54;
            color: var(--branco);
        }

        table.table-dark th, table.table-dark td {
            vertical-align: middle;
            border-color: #004080;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #004080;
        }

        table.table-dark thead th {
            background-color: var(--azul-escuro);
            color: var(--laranja-vibrante);
            font-weight: 700;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2 class="text-senac">Recursos Cadastrados</h2>

    <!-- Formulário de Filtro -->
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Data de Locação:</label>
            <input type="date" name="data" class="form-control" value="<?= htmlspecialchars($dataFiltro) ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Tipo de Recurso:</label>
            <select name="tipo" class="form-select">
                <option value="">Todos</option>
                <?php while ($row = $tipos->fetch_assoc()) { ?>
                    <option value="<?= $row['idtiporecurso'] ?>" <?= ($tipoFiltro == $row['idtiporecurso']) ? 'selected' : '' ?>>
                        <?= $row['tiporecurso'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-senac w-100">Filtrar</button>
        </div>
    </form>

    <!-- Tabela de Recursos -->
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Tipo</th>
            <th>Responsável</th>
            <th>Data Locação</th>
            <th>Hora</th>
            <th>ações</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['idrecurso'] ?></td>
                <td><?= $row['descricao'] ?></td>
                <td><?= $row['tiporecurso'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td><?= date("d/m/Y", strtotime($row['dataLocacao'])) ?></td>
                <td><?= substr($row['horarioLocacao'], 0, 5) ?></td>
                <td>
                    <a href="editar.recurso.php?id=<?= $row['idrecurso'] ?>" class="btn btn-sm btn-outline-warning">Editar</a>
                </td>

            </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="inicio.php" class="btn btn-outline-senac mt-3">Voltar</a>
</div>
</body>
</html>
