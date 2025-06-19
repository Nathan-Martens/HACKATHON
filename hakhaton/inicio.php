<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Recursos - Senac</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #003865; /* Azul Senac */
            color: #ffffff;
        }
        .btn-senac {
            background-color: #f68b1f;
            border: none;
            color: white;
        }
        .btn-senac:hover {
            background-color: #fbb040;
            color: #003865;
        }
        .btn-outline-senac {
            border: 2px solid #f68b1f;
            color: #f68b1f;
        }
        .btn-outline-senac:hover {
            background-color: #fbb040;
            color: #003865;
        }
        .text-senac {
            color: #f68b1f;
        }
        h1 {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center text-senac">Sistema de Gestão de Recursos</h1>
    <div class="row mt-4">
        <div class="col-md-6">
            <a href="listar.recursos.php" class="btn btn-outline-senac w-100">Listar Recursos</a>
        </div>
        <div class="col-md-6">
            <a href="cadastrar.recurso.php" class="btn btn-senac w-100">Cadastrar Recurso</a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <a href="listar.reservas.php" class="btn btn-outline-senac w-100">Listar Reservas</a>
        </div>
        <div class="col-md-6">
            <a href="cadastrar.reserva.php" class="btn btn-senac w-100">Cadastrar Reserva</a>
        </div>
    </div>
        <div class="row mt-4">
        <div class="col-md-6">
            <a href="listar.responsaveis.php" class="btn btn-outline-senac w-100">Listar Responsaveis</a>
        </div>
        <div class="col-md-6">
            <a href="cadastrar.responsavel.php" class="btn btn-senac w-100">Cadastrar Responsaveis</a>
        </div>
    </div>
</div>
</body>
</html>
