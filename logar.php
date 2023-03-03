<?php
session_start();
require 'connect.php';

if (isset($_SESSION['error-user'])) {
    unset($_SESSION['error-user']);
}
if (isset($_SESSION['error-pass'])) {
    unset($_SESSION['error-pass']);
}
if (isset($_SESSION['error-find'])) {
    unset($_SESSION['error-find']);
}
if (isset($_SESSION['success-cadastro'])) {
    unset($_SESSION['success-cadastro']);
}


if (isset($_POST['user']) && isset($_POST['pass'])) {


    $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username)) {
        $_SESSION['error-user'] = "Por favor, digite o usuário";
        header("Location: entrar.php");
    }
    if (empty($password)) {
        $_SESSION['error-pass'] = "Por favor, digite a senha";
        header("Location: entrar.php");
    }

    $sql_verify = "SELECT * FROM tab_usuarios WHERE user_name =:usuario";
    $query = $pdo->prepare($sql_verify);
    $query->bindParam(':usuario', $username, PDO::PARAM_STR);
    $query->execute();

    if (($query) AND ($query->rowCount() != 0)) {
        $row_user = $query->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $row_user['user_password'])) {
            $_SESSION['user']['name'] = $row_user['user_name'];
            $_SESSION['user']['id'] = $row_user['user_id'];
            $_SESSION['user']['permission'] = $row_user['user_permissions'];
            header("Location: index.php");
        } else {
            $_SESSION['error-find'] = "Usuário ou senha inválidos";
            header("Location: entrar.php");
        }
    } else {
        $_SESSION['error-find'] = "Usuário ou senha inválidos";
        header("Location: entrar.php");
    }

} else {
    header("Location: entrar.php");
}