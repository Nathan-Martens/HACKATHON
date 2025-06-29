<?php
include("conexao.php");
include_once "utils/main.php";
if (!main::verificarUsuarioLogado()) {
    header("Location: login.php");
    exit();
}

// Filtros (recebidos via GET) Feito por conta da necessidade de horario e de controle para devolução do recurso
$filtroRecurso = $_GET['recurso'] ?? '';
$filtroResponsavel = $_GET['responsavel'] ?? '';
$filtroDataInicio = $_GET['data_inicio'] ?? '';
$filtroDataFim = $_GET['data_fim'] ?? '';

// Montar SQL base
$sql = "
    SELECT r.idreserva, r.descricao, r.datahora_reserva, r.datahora_devolucao, r.ativo,
           rec.descricao AS recurso_nome, resp.nome AS responsavel_nome
    FROM reserva r
    JOIN recurso rec ON r.idrecurso = rec.idrecurso
    JOIN responsavel resp ON r.idresponsavel = resp.idresponsavel
    WHERE 1
";

// Aplicar filtros dinamicamente
if (!empty($filtroRecurso)) {
    $sql .= " AND rec.idrecurso = '$filtroRecurso'";
}
if (!empty($filtroResponsavel)) {
    $sql .= " AND resp.idresponsavel = '$filtroResponsavel'";
}
if (!empty($filtroDataInicio) && !empty($filtroDataFim)) {
    $sql .= " AND r.datahora_reserva BETWEEN '$filtroDataInicio' AND '$filtroDataFim'";
}

// Executar consulta
$reservas = $conn->query($sql);

// Buscar dados para filtros (recursos e responsáveis ativos)
$recursos = $conn->query("SELECT idrecurso, descricao FROM recurso WHERE ativo = 1");
$responsaveis = $conn->query("SELECT idresponsavel, nome FROM responsavel WHERE ativo = 1");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-warning">Reservas Cadastradas</h2>

    <form method="get" class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label">Recurso</label>
            <select name="recurso" class="form-select">
                <option value="">Todos</option>
                <?php while ($rec = $recursos->fetch_assoc()): ?>
                    <option value="<?= $rec['idrecurso'] ?>" <?= $filtroRecurso == $rec['idrecurso'] ? 'selected' : '' ?>>
                        <?= $rec['descricao'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Responsável</label>
            <select name="responsavel" class="form-select">
                <option value="">Todos</option>
                <?php while ($resp = $responsaveis->fetch_assoc()): ?>
                    <option value="<?= $resp['idresponsavel'] ?>" <?= $filtroResponsavel == $resp['idresponsavel'] ? 'selected' : '' ?>>
                        <?= $resp['nome'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Data Início</label>
            <input type="date" name="data_inicio" class="form-control" value="<?= $filtroDataInicio ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Data Fim</label>
            <input type="date" name="data_fim" class="form-control" value="<?= $filtroDataFim ?>">
        </div>
        <div class="col-12">
            <button class="btn btn-warning" type="submit">Filtrar</button>
            <a href="listar.reservas.php" class="btn btn-secondary">Limpar</a>
        </div>
    </form>

    <?php if ($reservas->num_rows > 0): ?>
        <table class="table table-bordered table-dark table-hover">
            <thead class="table-light text-dark">
                <tr>
                    <th>ID</th>
                    <th>Recurso</th>
                    <th>Responsável</th>
                    <th>Descrição</th>
                    <th>Início</th>
                    <th>Devolução</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($res = $reservas->fetch_assoc()): ?>
                    <tr>
                        <td><?= $res['idreserva'] ?></td>
                        <td><?= $res['recurso_nome'] ?></td>
                        <td><?= $res['responsavel_nome'] ?></td>
                        <td><?= $res['descricao'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($res['datahora_reserva'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($res['datahora_devolucao'])) ?></td>
                        <td>
                            <span class="badge <?= $res['ativo'] ? 'bg-success' : 'bg-danger' ?>">
                                <?= $res['ativo'] ? 'Ativo' : 'Inativo' ?>
                            </span>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning mt-4">Nenhuma reserva encontrada.</div>
    <?php endif; ?>

    <a href="inicio.php" class="btn btn-secondary mt-3">Voltar</a>
</div>
</body>
</html>
