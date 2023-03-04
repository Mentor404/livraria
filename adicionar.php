<?php
require 'header.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

?>

<div class="adicionarWrapper">
    <form action="adicionar-livro.php" method="post">
        <label for="livro-title">Título:</label>
        <input type="text" class="" id="livro-title" name="livro-title">
        <?php

        if (isset($_SESSION['error']['title-empty'])) {
            echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['title-empty'] . '</p>';
        }
        if (isset($_SESSION['error']['livro-already-take'])) {
            echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['livro-already-take'] . '</p>';
        }
        if (isset($_SESSION['sucess']['adicionar'])) {
            echo '<p class="alert alert-success mt-1">' . $_SESSION['sucess']['adicionar'] . '</p>';
        }
        ?>

        <label for="livro-description">Descrição:</label>
        <textarea name="livro-description" id="livro-description"></textarea>
        <?php
        if (isset($_SESSION['error']['description-empty'])) {
            if (empty($descricao)) {
                echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['description-empty'] . '</p>';
            }
        }
        ?>

        <label for="livro-categoria">Categorias:</label>
        <div class="categoriasWrapper">
            <?php
            $queryCategorias = "SELECT * FROM tab_categorias ORDER BY categoria_name";
            $query = $pdo->prepare($queryCategorias);
            $query->execute();
            $categorias = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($categorias as $categoria) {
                echo '<div class="wrapper">';
                echo '<label for="' . $categoria['categoria_name'] . '">' . $categoria['categoria_name'] . '</label>';
                echo '<input type="checkbox" name="livro-categoria[]" id="' . $categoria['categoria_name'] . '" value="' . $categoria['categoria_name'] . '">';
                echo '</div>';
            }
            ?>
        </div>
        <?php
        if ($_SESSION['user']['permission'] == 2) {
            echo '<a href="gerenciar-categorias.php?categorias" class="underline hover:font-bold">Gerenciar categorias</a><br>';
        }
        if (isset($_SESSION['error']['category-empty'])) {
            echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['category-empty'] . '</p>';
        }
        ?>

        <label for="autor">Autor:</label>
        <select name="autor" id="autor">
            <option selected disabled hidden> Selecione um autor
                <?php
                $queryAutores = "SELECT * FROM tab_autores ORDER BY autor_name";
                $query = $pdo->prepare($queryAutores);
                $query->execute();
                $autores = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($autores as $autor) {
                    echo '<option value="' . $autor['autor_name'] . '">' . $autor['autor_name'] . '</option>';
                }
                ?>
        </select>
        <?php
         if($_SESSION['user']['permission'] == 2){
            echo '<a href="gerenciar-autores.php" class="underline hover:font-bold">Gerenciar autores</a><br>';
        }

        if (isset($_SESSION['error']['autor-empty'])) {
            echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['autor-empty'] . '</p>';
        }
        ?>

        <label for="editora">Editora:</label>
        <select name="editora" id="editora">
            <option selected disabled hidden> Selecione uma editora</option>
            <?php
            $queryEditoras = "SELECT * FROM tab_editoras ORDER BY editora_name";
            $query = $pdo->prepare($queryEditoras);
            $query->execute();
            $editoras = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($editoras as $editora) {
                echo '<option value="' . $editora['editora_name'] . '">' . $editora['editora_name'] . '</option>';
            }
            ?>
        </select>
        <?php
        if($_SESSION['user']['permission'] == 2){
            echo '<a href="gerenciar-editoras.php" class="underline hover:font-bold">Gerenciar editoras</a><br>';
        }

        if (isset($_SESSION['error']['editora-empty'])) {
            echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['editora-empty'] . '</p>';
        }
        ?>

        <label for="ano">Ano de publicação:</label>
        <input type="number" name="ano" id="ano">
        <?php
        if (isset($_SESSION['error']['ano-empty'])) {
            echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['ano-empty'] . '</p>';
        }
        ?>

        <label for="paginas">Número de páginas</label>
        <input type="number" name="paginas" id="paginas">
        <?php
        if (isset($_SESSION['error']['paginas-empty'])) {
            echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['paginas-empty'] . '</p>';
        }
        ?>

        <label for="image">URL da capa:</label>
        <input type="url" name="image" id="image" placeholder="https://www">

        <input type="submit" value="Adicionar" class="btn-submit border border-neutral-500">
    </form>
</div>
