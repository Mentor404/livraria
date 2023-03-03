<?php
session_start();
require 'connect.php';

if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}
if (isset($_SESSION['sucess'])) {
    unset($_SESSION['sucess']);
}


$titulo = filter_input(INPUT_POST, 'livro-title', FILTER_SANITIZE_SPECIAL_CHARS);
$descricao = filter_input(INPUT_POST, 'livro-description', FILTER_SANITIZE_SPECIAL_CHARS);
$categorias = $_POST['livro-categoria']; //array
$autor = $_POST['autor'];
$editora = $_POST['editora'];
$ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_NUMBER_INT);
$paginas = filter_input(INPUT_POST, 'paginas', FILTER_SANITIZE_NUMBER_INT);
$image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_URL);

if (empty($titulo)) {
    $_SESSION['error']['title-empty'] = 'Título não pode ser vazio';
    header("Location: adicionar.php");
}
if (empty($descricao)) {
    $_SESSION['error']['description-empty'] = 'Descrição não pode ser vazia';
    header("Location: adicionar.php");
}
if (empty($categorias)) {
    $_SESSION['error']['category-empty'] = 'O livro precisa ter pelo menos uma categoria';
    header("Location: adicionar.php");
}
if (empty($autor)) {
    $_SESSION['error']['autor-empty'] = 'O autor precisa ser selecionado';
    header("Location: adicionar.php");
}
if (empty($editora)) {
    $_SESSION['error']['editora-empty'] = 'A editora precisa ser selecionada';
    header("Location: adicionar.php");
}
if (empty($ano)) {
    $_SESSION['error']['ano-empty'] = 'O ano não pode ser vazio';
    header("Location: adicionar.php");
}
if (empty($paginas)) {
    $_SESSION['error']['paginas-empty'] = 'O campo de páginas precisa ser preenchido';
    header("Location: adicionar.php");
}

$sql_verify = "SELECT * FROM tab_livros WHERE livro_title =:titulo";
$query = $pdo->prepare($sql_verify);
$query->bindParam(':titulo', $titulo, PDO::PARAM_STR);
$query->execute();

if ($query->rowCount() != 0) {
    $_SESSION['error']['livro-already-take'] = "Este livro já foi cadastrado";
    header("Location: adicionar.php");
}

if (!empty($titulo) && !empty($descricao) && !empty($categorias) && !empty($autor) && !empty($editora) && !empty($ano) && !empty($paginas) && $query->rowCount() == 0) {
    $queryLivros = $pdo->prepare("INSERT INTO tab_livros (livro_title, livro_description, livro_ano, livro_paginas, livro_image) VALUES (?, ?, ?, ?, ?) ");
    $queryLivros->execute([$titulo, $descricao, $ano, $paginas, $image]);

    $queryLivroId = $pdo->prepare("SELECT livro_id FROM tab_livros WHERE livro_title LIKE :title");
    $queryLivroId->bindParam(':title', $titulo, PDO::PARAM_STR);
    $queryLivroId->execute();
    $livroId = $queryLivroId->fetchColumn(0);

    $queryAutorId = $pdo->prepare("SELECT autor_id FROM tab_autores WHERE autor_name LIKE :autor");
    $queryAutorId->bindParam(':autor', $autor, PDO::PARAM_STR);
    $queryAutorId->execute();
    $autorId = $queryAutorId->fetchColumn(0);

    $queryEditoraId = $pdo->prepare("SELECT editora_id FROM tab_editoras WHERE editora_name LIKE :editora");
    $queryEditoraId->bindParam(':editora', $editora, PDO::PARAM_STR);
    $queryEditoraId->execute();
    $editoraId = $queryEditoraId->fetchColumn(0);

    foreach ($categorias as $categoria) {
        $queryCategoriaId = $pdo->prepare("SELECT categoria_id FROM tab_categorias WHERE categoria_name LIKE :categoria");
        $queryCategoriaId->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $queryCategoriaId->execute();
        $categoriaId = $queryCategoriaId->fetchColumn(0);

        $queryLivroCategorias = $pdo->prepare("INSERT INTO tab_livros_categorias (fk_livro_id, fk_categoria_id) VALUES (?,?) ");
        $queryLivroCategorias->execute([$livroId, $categoriaId]);
    }

    $queryLivrosAutores = $pdo->prepare("INSERT INTO tab_livros_autores (fk_livro_id, fk_autor_id) VALUES (?,?) ");
    $queryLivrosAutores->execute([$livroId, $autorId]);

    $queryLivroEditoras = $pdo->prepare("INSERT INTO tab_livros_editoras (fk_livro_id, fk_editora_id) VALUES (?,?) ");
    $queryLivroEditoras->execute([$livroId, $editoraId]);

    $queryLivrosUsuarios = $pdo->prepare("INSERT INTO tab_livros_usuarios (fk_livro_id, fk_user_id) VALUES (?,?) ");
    $queryLivrosUsuarios->execute([$livroId, $_SESSION['user']['id']]);

    $_SESSION['sucess']['adicionar'] = 'Livro adicionado com sucesso';
    header("Location: adicionar.php");
} else {
    header("Location: adicionar.php");
}