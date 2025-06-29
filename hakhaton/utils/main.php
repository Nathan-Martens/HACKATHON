<?php
include("conexao.php");

class main {
    public static function verificarUsuarioLogado() {
        include_once __DIR__ . '/../conexao.php';
        global $conn;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['idUsuario'])) {
            $usuarioSessao = intval($_SESSION['idUsuario']);
            $sql = "SELECT idusuario FROM usuarios WHERE idusuario = $usuarioSessao LIMIT 1";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                return true;
            }
        }
        return false;
    }

    public static function verificarUsuarioAdmin() {
        include_once __DIR__ . '/../conexao.php';
        global $conn;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['idUsuario'])) {
            $usuarioSessao = intval($_SESSION['idUsuario']);
            $sql = "SELECT isadmin FROM usuarios WHERE idusuario = $usuarioSessao LIMIT 1";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (!empty($row['isadmin']) && $row['isadmin'] == 1) {
                    return true;
                }
            }
        }
        return false;
    }
}