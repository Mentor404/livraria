<?php
require 'header.php';
?>

<div class="container mt-[15px]">
    <form action="" method="post" class="flex catalogo container overflow-auto">
        <div>
            <label for="busca-especifica">
                Busca específica:
            </label>
            <input type="text" name="busca-especifica" id="busca-especifica" placeholder="Digite aqui"
                   class="w-[230px] h-[30px] bg-g-gray rounded-[10px] p-3">
        </div>

        <div>
            <label for="busca-por">
                Buscar por:
            </label>
            <select name="buca-por" id="busca-por" class="select-search">
                <option selected disabled hidden>Tudo</option>
                <option value="titulo">Título</option>
                <option value="autor">Autor</option>
            </select>
        </div>

        <div>
            <label for="busca-categoria">
                Categoria:
            </label>
            <select name="buca-categoria" id="busca-categoria" class="select-search">
                <option selected disabled hidden> Todas as categorias</option>
                <option value="acao">Ação</option>
                <option value="drama">Drama</option>
            </select>
        </div>

        <button type="submit" class="w-[100px] h-[30px] rounded-[10px] mt-[29px] text-center bg-light-yellow">Buscar</button>
        <?php
        if (isset($_SESSION['user'])) {
            echo '<a href="adicionar.php" class="ml-5 px-4 h-[30px] rounded-[10px] mt-[29px] bg-light-green text-center text-white">Adicionar novo livro</a>';
            if($_SESSION['user']['permission'] == 2) {
                echo '<a href="gerenciar-livros.php" class="ml-5 px-4 h-[30px] rounded-[10px] mt-[29px] bg-dark-green text-center text-white">Gerenciar livros</a>';
            }
        }
        ?>
    </form>

    <!--    display-->
    <div class="catalogoWrapper">

        <?php
        $sql_verify = "SELECT * FROM tab_livros ORDER BY livro_title";
        $query = $pdo->prepare($sql_verify);
        $query->execute();
        $livros = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($livros as $livro) {
            echo '<a class="catalogo-card" href="livro.php?id=' . $livro['livro_id'] . '">';
            if(strlen($livro['livro_image']) > 0) {
                echo '<div class="cover" style="background-image:url(' . $livro['livro_image'] . ')"></div>';
            } else {
                echo '<div class="cover" style="background-image:url(src/resources/image-blank.png)"></div>';
            }
            echo '<h2 class="card-title">' . $livro['livro_title'] . '</h2>';
            echo '<p class="card-content">' . $livro['livro_description'] . '</p>';
            echo '</a>';
        }
        ?>

    </div>

</div>
