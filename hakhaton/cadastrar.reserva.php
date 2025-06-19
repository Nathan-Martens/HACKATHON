<?php
include("conexao.php");

// Buscar recursos ativos
$recursos = $conn->query("SELECT idrecurso, descricao FROM recurso WHERE ativo = 1");

// Buscar responsáveis ativos
$responsaveis = $conn->query("SELECT idresponsavel, nome FROM responsavel WHERE ativo = 1");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-warning">Nova Reserva</h2>
    <form action="salvar.reserva.php" method="post">
        <div class="mb-3">
            <label for="idrecurso" class="form-label">Recurso</label>
            <select name="idrecurso" id="idrecurso" class="form-select" required>
                <option value="">Selecione</option>
                <?php while ($rec = $recursos->fetch_assoc()): ?>
                    <option value="<?= $rec['idrecurso'] ?>"><?= $rec['descricao'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="idresponsavel" class="form-label">Responsável</label>
            <select name="idresponsavel" id="idresponsavel" class="form-select" required>
                <option value="">Selecione</option>
                <?php while ($resp = $responsaveis->fetch_assoc()): ?>
                    <option value="<?= $resp['idresponsavel'] ?>"><?= $resp['nome'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição da Reserva</label>
            <input type="text" name="descricao" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Data e Hora da Reserva</label>
            <input type="datetime-local" name="datahora_reserva" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Data e Hora de Devolução</label>
            <input type="datetime-local" name="datahora_devolucao" class="form-control" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="ativo" value="1" class="form-check-input" checked>
            <label class="form-check-label">Reserva Ativa</label>
        </div>

        <button type="submit" class="btn btn-warning">Salvar Reserva</button>
        <a href="inicio.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>
