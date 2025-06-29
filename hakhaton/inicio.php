<?php
session_start();
include("conexao.php");
include_once "utils/main.php";

if (!main::verificarUsuarioLogado()) {
    header("Location: login.php");
    exit();
}
$isAdmin = main::verificarUsuarioAdmin();
?>
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
        .btn-sair {
            background-color: #dc3545;
            color: #fff;
            border: none;
            font-weight: bold;
            margin-top: 20px;
            width: 100%;
            padding: 10px 0;
            border-radius: 5px;
            transition: background 0.2s;
        }
        .btn-sair:hover {
            background-color: #b52a37;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5" style="background-color: whitesmoke; border-radius: 5px; box-shadow: #b2c9dc 2px 2px 2px 1px;">
        <div>
            <h1 class="text-center text-senac">Sistema de Gestão de Recursos</h1>
            <?php if ($isAdmin): ?>
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
            <div class="row mt-4">
                <div class="col-md-6">
                    <a href="listar.funcoes.php" class="btn btn-outline-senac w-100">Listar Funções</a>
                </div>
                <div class="col-md-6">
                    <a href="cadastrar.funcao.php" class="btn btn-senac w-100">Cadastrar Função</a>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="cadastrar.usuario.php" class="btn w-50" style="background-color:#003865 ; color: white;">Cadastrar usuario</a>
            </div>
            <?php else: ?>
            <div class="row mt-4">
                <div class="col-md-12">
                    <a href="cadastrar.reserva.php" class="btn btn-senac w-100">Cadastrar Reserva</a>
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
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="logout.php" class="btn btn-sair">Sair</a>
        </div>
    </div>
</body>
</html>
