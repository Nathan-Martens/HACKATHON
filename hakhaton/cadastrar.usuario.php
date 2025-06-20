<?php
include("conexao.php");
session_start();

// Restringe a administradores
if (!isset($_SESSION['idusuario']) || $_SESSION['tipo'] != 'Administrador') {
    header("Location: login.php");
    exit;
}

// Cadastro ao enviar formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = ($_POST['senha']);
    $tipo = $_POST['tipo'];
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, tipo, ativo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $nome, $email, $senha, $tipo, $ativo);

    if ($stmt->execute()) {
        echo "<script>alert('Usuário cadastrado com sucesso.'); window.location.href='inicio.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar usuário.'); history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-warning">Cadastrar Novo Usuário</h2>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de Usuário</label>
            <select name="tipo" class="form-select" required>
                <option value="Administrador">Gerente/(Administrador)</option>
                <option value="Cadastro/Edição">Coordenador/Professor/Instrutor</option>
                <option value="Reserva">Administrativo</option>
                <option value="Externo">Externo</option>
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="ativo" class="form-check-input" value="1" checked>
            <label class="form-check-label">Ativo</label>
        </div>

        <button class="btn btn-warning" type="submit">Cadastrar</button>
    </form>
</div>
</body>
</html>
