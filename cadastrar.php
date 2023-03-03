<?php
session_start();
require 'connect.php';

if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}


if (isset($_POST['user']) && isset($_POST['email']) && isset($_POST['pass'])) {

    $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username)) {
        $_SESSION['error']['blank-u'] = "Por favor, preencha este campo.";
        header("Location: cadastro.php");
    }
    if (empty($password)) {
        $_SESSION['error']['blank-p'] = "Por favor, preencha este campo.";
        header("Location: cadastro.php");
    }

    $sql_verify = "SELECT * FROM tab_usuarios WHERE user_name =:usuario";
    $query = $pdo->prepare($sql_verify);
    $query->bindParam(':usuario', $username, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() != 0) {
        $_SESSION['error']['already-take'] = "Este usuário já existe.";
        header("Location: cadastro.php");
    }

    if (!empty($username) && !empty($password) && $query->rowCount() == 0) {
        $query = $pdo->prepare("INSERT INTO tab_usuarios (user_name,user_password,user_joined_at,user_email) VALUES (?, ?,NOW(), ?)");
        $securePassword = password_hash($password, PASSWORD_DEFAULT);
        $query->execute([$username, $securePassword, $email]);
        $_SESSION['success-cadastro'] = "Usuario cadastrado com sucesso!";
        header("Location: entrar.php");
    } else {
        header("Location: cadastro.php");
    }


} else {
    header("Location: cadastro.php");
}