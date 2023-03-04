<?php
require 'connect.php';
$id = $_GET['id'];

if(!isset($id)) {
    header('Location: catalogo.php');
}

$queryLivro = $pdo->prepare("SELECT * FROM tab_livros WHERE livro_id = :id");
$queryLivro->bindParam(':id', $id, PDO::PARAM_STR);
$queryLivro->execute();
$livro = $queryLivro->rowCount();
if($livro == 0) {
    header('Location: catalogo.php');
}
?>

<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/axt3mgh.css">
    <title>Livraria</title>
</head>
<body>
<div class="section-wrap">
    <section id="section-l-1">
        <nav class="pl-10 pt-6">
            <ul class="flex text-light-green">
                <li><a href="index.php">Início</a></li>
                <li><img src="src/resources/icons/arrow-right.svg" alt="seta para direita" class="p-1.5"></li>
                <li><a href="catalogo.php">Catálogo</a></li>
                <li><img src="src/resources/icons/arrow-right.svg" alt="seta para direita" class="p-1.5"></li>
                <?php
                $queryLivro = $pdo->prepare("SELECT * FROM tab_livros WHERE livro_id = :id");
                $queryLivro->bindParam(':id', $id, PDO::PARAM_STR);
                $queryLivro->execute();
                $livro = $queryLivro->fetch();
                echo '<li><a href="">'.$livro['livro_title'].'</a></li>';
                ?>
            </ul>
        </nav>

        <div class="container">

            <?php
            echo '<h1 class="l-title">'.$livro['livro_title'].'</h1>';

            echo '<p>'.$livro['livro_description'].'</p>'
            ?>

            <h2 class="text-dark-yellow text-[16px] mb-[10px]">Codex</h2>

            <div class="l-tags">
                <?php
                $queryTags = $pdo->prepare("SELECT * FROM tab_livros_categorias WHERE fk_livro_id = :id");
                $queryTags->bindParam(':id', $id);
                $queryTags->execute();
                $tags = $queryTags->fetchAll(PDO::FETCH_ASSOC);

                foreach($tags as $tag) {
                    $queryTagName = $pdo->prepare("SELECT categoria_name FROM tab_categorias JOIN tab_livros_categorias on categoria_id = fk_categoria_id WHERE fk_categoria_id = :id");
                    $queryTagName->bindParam(':id', $tag['fk_categoria_id']);
                    $queryTagName->execute();
                    $tagName = $queryTagName->fetchColumn(0);
                    echo '<p>'.$tagName.'</p>';
                }
                ?>
            </div>

            <div class="divisor mt-[20px] mb-[10px] w-[360px] border-1 border-light-yellow rounded-full"></div>

            <div class="codexWrapper">
                <div>
                    <p>Autor:</p>
                    <?php
                        $queryLivroAutor = $pdo->prepare("SELECT autor_name FROM tab_autores JOIN tab_livros_autores on autor_id = fk_autor_id WHERE fk_livro_id = :id");
                        $queryLivroAutor->bindParam(':id', $id);
                        $queryLivroAutor->execute();
                        $autor = $queryLivroAutor->fetchColumn(0);
                        echo '<p>'.$autor.'</p>';
                    ?>
                </div>
                <div>
                    <p>Editora:</p>
                    <?php
                    $queryLivroEditora = $pdo->prepare("SELECT editora_name FROM tab_editoras JOIN tab_livros_editoras  on editora_id = fk_editora_id WHERE fk_livro_id = :id");
                    $queryLivroEditora->bindParam(':id', $id);
                    $queryLivroEditora->execute();
                    $editora = $queryLivroEditora->fetchColumn(0);
                    echo '<p>'.$editora.'</p>';
                    ?>
                </div>
                <div>
                    <p>Ano de publicação:</p>
                    <?php
                    echo '<p>'.$livro['livro_ano'].'</p>'
                    ?>
                </div>
                <div>
                    <p>Número de páginas:</p>
                    <?php
                    echo '<p>'.$livro['livro_paginas'].'</p>'
                    ?>
                </div>
                <div>
                    <p>Adicionado por:</p>
                    <?php
                    $queryLivroUsuario = $pdo->prepare("SELECT user_name FROM tab_usuarios JOIN tab_livros_usuarios on user_id = fk_user_id WHERE fk_livro_id = :id");
                    $queryLivroUsuario->bindParam(':id', $id);
                    $queryLivroUsuario->execute();
                    $usuario = $queryLivroUsuario->fetchColumn(0);
                    echo '<p>'.$usuario.'</p>';
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section id="section-l-2">
        <img src="src/resources/background-card-large.png" alt="Fundo" class="bg-l">
        <?php
        if(strlen($livro['livro_image']) > 0) {
            echo '<img src="'.$livro['livro_image'].'" alt="Capa do livro" class="absolute w-[495px] rounded-[10px] h-[757px] ml-[120px]">';

        } else {
            echo '<img src="src/resources/image-blank.png" alt="Capa do livro" class="absolute w-[495px] rounded-[10px] h-[757px] ml-[120px]">';
        }
        ?>
    </section>
</div>


</body>
</html>