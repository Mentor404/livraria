<?php
require 'header.php';

if (!isset($_SESSION['user']['name'])) {
    header('Location: catalogo.php');
}

if (isset($_POST['name']) && isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

if (isset($_SESSION['success']['time']) && time() - $_SESSION['success']['time'] > 5) {
    unset($_SESSION['success']);
}

if (!isset($_GET['edit']) && !isset($_GET['delete']) && !isset($_GET['add'])) {
?>
<div class="container mx-auto">
    <div class="w-full">
        <table class="gerenciarTable">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Modificar</th>
                <th>Remover</th>
            </tr>
            <?php
            $queryCategorias = $pdo->prepare("SELECT * FROM tab_categorias ORDER BY categoria_name");
            $queryCategorias->execute();
            $categorias = $queryCategorias->fetchAll();


            foreach ($categorias as $categoria) {
                echo '<tr>';
                echo '<td class="text-center w-10">' . $categoria['categoria_id'] . '</td>';
                echo '<td>' . $categoria['categoria_name'] . '</td>';
                echo '<td class="w-14"><a href="?edit=' . $categoria['categoria_id'] . '"><img src="src/resources/icons/edit-2.svg" alt="editar" class="mx-auto"></a></td>';
                echo '<td class="w-14"><a href="?delete=' . $categoria['categoria_id'] . '"><img src="src/resources/icons/trash.svg" alt="remover" class="mx-auto"></a></td>';
                echo '</tr>';
            }
            ?>
            <tr class="bg-g-light-green ">
                <td colspan="4" class="text-center text-white"><a href="?add" class="underline px-10 hover:font-bold">Cadastrar
                        nova categoria</a></td>
            </tr>
        </table>
        <a href="adicionar.php" class="underline">Voltar</a>

        <?php
        if (isset($_SESSION['success']['add'])) {
            echo '<p class="alert alert-success mt-1">' . $_SESSION['success']['add'] . '</p>';
            header("Refresh:6");
        }
        if (isset($_SESSION['success']['remove'])) {
            echo '<p class="alert alert-success mt-1">' . $_SESSION['success']['remove'] . '</p>';
            header("Refresh:6");
        }
        if (isset($_SESSION['error']['ukn'])) {
            echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['ukn'] . '</p>';
        }
        ?>
    </div>

    <?php
    }

    // add
    if (isset($_GET['add'])) {
        echo '<div class="adicionarWrapper">';
        echo '<form method="POST" action="">';
        echo '<label for="name">Nome da categoria:</label>';
        echo '<input type="text" name="name" id="name">';
        if (isset($_SESSION['error']['empty'])) {
            echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['empty'] . '</p>';
        }
        if (isset($_SESSION['error']['blank'])) {
            echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['blank'] . '</p>';
        }
        if (isset($_SESSION['error']['take'])) {
            echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['take'] . '</p>';
        }
        echo '<a href="gerenciar-categorias.php" class="underline">Voltar</a>';
        echo ' <input type="submit" value="Confirmar" class="btn-submit border border-neutral-500">';
        echo '</form>';
        echo '</div>';

        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $queryCategorias = $pdo->prepare("SELECT * FROM tab_categorias WHERE categoria_name = :categoria");
            $queryCategorias->bindParam(':categoria', $_POST['name']);
            $queryCategorias->execute();
            $categorias = $queryCategorias->rowCount();

            if ($categorias == 0) {
                $query = $pdo->prepare("INSERT INTO tab_categorias (categoria_name) VALUES (:categoria_name)");
                $query->bindParam(':categoria_name', $_POST['name'], PDO::PARAM_STR);
                $query->execute();
                $_SESSION['success']['add'] = 'Categoria ' . $_POST['name'] . ' criado com sucesso.';
                $_SESSION['success']['time'] = time();
                header("Location: gerenciar-categorias.php");
            } else {
                $_SESSION['error']['take'] = 'Essa categoria já existe.';
                header('Location: gerenciar-categorias.php?add');
            }
        }
        if (isset($_POST['name']) && empty($_POST['name'])) {
            $_SESSION['error']['blank'] = 'Um nome precisa ser informado.';
            header('Location: gerenciar-categorias.php?add');
        }
    }

    // delete

    if (isset($_GET['delete'])) {
        $queryCategoria = $pdo->prepare("SELECT * FROM tab_categorias WHERE categoria_id = ?");
        $queryCategoria->execute([$_GET['delete']]);
        $categoria = $queryCategoria->fetch();
        $linha = $queryCategoria->rowCount();

        if (empty($_GET['delete']) || $linha == 0) {
            $_SESSION['error']['ukn'] = 'Não encontrei essa categoria.';
            header('Location: gerenciar-categorias.php');
        } else {
            $queryDelete = $pdo->prepare("DELETE FROM tab_categorias WHERE categoria_id = :delete");
            $queryDelete->bindParam(':delete', $_GET['delete'], PDO::PARAM_STR);
            $queryDelete->execute();

            $_SESSION['success']['remove'] = 'Categoria ' . $categoria['categoria_name'] . ' removida com sucesso.';
            header('Location: gerenciar-categorias.php');
            $_SESSION['success']['time'] = time();
        }
    }

    //   edit

    if (isset($_GET['edit']) && !empty($_GET['edit'])) {
        $queryCategoria = $pdo->prepare("SELECT * FROM tab_categorias WHERE categoria_id = ?");
        $queryCategoria->execute([$_GET['edit']]);
        $categoria = $queryCategoria->fetch();
        $linha = $queryCategoria->rowCount();

        echo '<div class="adicionarWrapper">';
        if ($linha == 0) {
            echo '<p class="text-red-500 text-center bg-red-100 py-1.5 rounded-full">Categoria não encontrada</p>';
            echo '<a href="gerenciar-categorias.php" class="underline">Voltar</a>';

        } else {
            echo '<form method="POST" action="">';
            echo '<label for="name-e">Nome da categoria:</label>';
            echo '<input type="text" name="name-e" id="name-e" value="' . $categoria['categoria_name'] . '">';
            if (isset($_SESSION['error']['empty'])) {
                echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['empty'] . '</p>';
            }
            if (isset($_SESSION['error']['already'])) {
                echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['already'] . '</p>';
            }
            echo '<a href="gerenciar-categorias.php" class="underline">Voltar</a>';
            echo ' <input type="submit" value="Confirmar" class="btn-submit border border-neutral-500">';
            echo '</form>';
            echo '</div>';

            if (isset($_POST['name-e'])) {
                $queryVerify = $pdo->prepare("SELECT * FROM tab_categorias");
                $queryVerify->execute();
                $verifys = $queryVerify->fetchAll();

                foreach ($verifys as $verify) {
                    if ($verify['categoria_name'] == $_POST['name-e']) {
                        $_SESSION['error']['already'] = 'Essa categoria já está cadastrada.';
                        header('Location: gerenciar-categorias.php?edit=' . $_GET['edit']);
                    }
                }
            }

            if (isset($_POST['name-e']) && !empty($_POST['name-e']) && $categoria['categoria_name'] != $_POST['name-e']) {
                $queryUpdate = $pdo->prepare("UPDATE tab_categorias SET categoria_name = ? WHERE categoria_id = ?");
                $queryUpdate->execute([$_POST['name-e'], $_GET['edit']]);
                header("Location: gerenciar-categorias.php");
            }

            if (isset($_POST['name-e']) && empty($_POST['name-e'])) {
                $_SESSION['error']['empty'] = 'O nome não pode ser vazio.';
                header('Location: gerenciar-categorias.php?edit=' . $_GET['edit']);
            }
        }

    }
    ?>


</div>