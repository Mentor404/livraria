<?php
session_start();
require 'connect.php';
?>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/axt3mgh.css">
    <title>Document</title>
</head>
<body>
<nav class="flex container mx-auto items-center h-[100px] relative bg-white relative">
    <img src="src/resources/LOGO.png" alt="Livraria digital logo" class="h-[50px]">
    <ul class="flex mx-auto gap-nav">
        <li><a href="index.php">Início</a></li>
        <li><a href="catalogo.php">Catálogo</a></li>
        <li><a href="/comunity">Comunidade</a></li>
    </ul>
    <?php
    if (isset($_SESSION['user'])){
        echo '<a href="logout.php">Sair</a>';
    } else {
        echo '<a href="entrar.php">Entrar</a>';
    }
    ?>
</nav>