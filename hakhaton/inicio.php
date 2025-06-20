<?php
session_start();
include("conexao.php");

// Desloga se já estava logado
if (isset($_SESSION['idUsuario'])) {
    header("Location: inicio.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $usuario = mysqli_fetch_assoc($result);
        $_SESSION['idUsuario'] = $usuario['idUsuario'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['nivel'] = $usuario['nivel'];

        header("Location: inicio.php");
        exit();
    } else {
        $erro = "Email ou senha inválidos.";
    }
}
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
    </style>
</head>
    <body>
        <div class="container mt-5" style="background-color: whitesmoke; border-radius: 5px; box-shadow: #b2c9dc 2px 2px 2px 1px;">
            <div>
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
                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="listar.funcoes.php" class="btn btn-outline-senac w-100">Listar Funções</a>
                    </div>
                    <div class="col-md-6">
                        <a href="cadastrar.funcao.php" class="btn btn-senac w-100">Cadastrar Função</a>
                    </div>
                </div>    
            </div>
            <div class=" text-center mt-4">
                <div class="">
                    <a href="cadastrar.usuario.php" class="btn w-50" style="background-color:#003865 ; color: white;">Cadastrar usuario</a>
                </div>
            </div>
            <br>
            <a href="logout.php" class="btn btn-sm btn-outline-light ms-3 w-50">Sair</a>
        </div>
    </body>
</html>
