<?php
include("conexao.php");

// Buscar responsáveis ativos
$responsaveis = $conn->query("SELECT idresponsavel, nome FROM responsavel WHERE ativo = 1");

// Buscar tipos de recurso ativos
$tipos = $conn->query("SELECT idtiporecurso, tiporecurso FROM tiporecurso WHERE ativo = 1");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Recurso</title>
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
            max-width: 600px;
            margin-top: 3rem;
        }

        h2.text-warning {
            color: var(--laranja-vibrante);
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        label.form-label {
            color: var(--branco);
            font-weight: 600;
        }

        textarea.form-control,
        input.form-control,
        select.form-select {
            background-color: #00509e; /* Azul um pouco mais claro */
            color: var(--branco);
            border: none;
            transition: background-color 0.3s ease;
        }

        textarea.form-control:focus,
        input.form-control:focus,
        select.form-select:focus {
            background-color: #0066cc;
            color: var(--branco);
            box-shadow: 0 0 5px var(--laranja-vibrante);
        }

        button.btn-warning {
            background-color: var(--laranja-vibrante);
            border: none;
            font-weight: 700;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button.btn-warning:hover,
        button.btn-warning:focus {
            background-color: var(--laranja-claro);
            color: var(--azul-escuro);
        }

        a.btn-outline-light {
            color: var(--laranja-vibrante);
            border: 2px solid var(--laranja-vibrante);
            font-weight: 600;
            transition: all 0.3s ease;
            text-align: center;
            display: inline-block;
            width: 100%;
            margin-top: 1rem;
            padding: 0.5rem 0;
            border-radius: 4px;
            text-decoration: none;
        }

        a.btn-outline-light:hover,
        a.btn-outline-light:focus {
            background-color: var(--laranja-vibrante);
            color: var(--branco);
            border-color: var(--laranja-vibrante);
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-warning">Cadastrar Novo Recurso</h2>
    <form action="salvar.recurso.php" method="POST" class="mt-4">
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao" id="descricao" required></textarea>
        </div>
        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" class="form-control" name="quantidade" id="quantidade" min="1" required>
        </div>
        <div class="mb-3">
            <label for="responsavel" class="form-label">Responsável</label>
            <select class="form-select" name="responsavel" id="responsavel" required>
                <option value="">Selecione</option>
                <?php while ($r = $responsaveis->fetch_assoc()) { ?>
                    <option value="<?= $r['idresponsavel'] ?>"><?= $r['nome'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="tiporecurso" class="form-label">Tipo de Recurso</label>
            <select class="form-select" name="tiporecurso" id="tiporecurso" required>
                <option value="">Selecione</option>
                <?php while ($t = $tipos->fetch_assoc()) { ?>
                    <option value="<?= $t['idtiporecurso'] ?>"><?= $t['tiporecurso'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="dataLocacao" class="form-label">Data de Locação</label>
            <input type="date" class="form-control" name="dataLocacao" id="dataLocacao" required>
        </div>
        <div class="mb-3">
            <label for="horarioLocacao" class="form-label">Horário de Locação</label>
            <input type="time" class="form-control" name="horarioLocacao" id="horarioLocacao" required>
        </div>
        <button type="submit" class="btn btn-warning">Salvar</button>
        <a href="inicio.php" class="btn-outline-light">Cancelar</a>
    </form>
</div>
</body>
</html>
