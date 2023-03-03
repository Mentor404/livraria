<?php
require 'header.php';

if (!isset($_SESSION['user']['name'])) {
    header('Location: catalogo.php');
}

if (isset($_SESSION['error']['time']) && time() - $_SESSION['error']['time'] > 5) {
    unset($_SESSION['error']);
}

if (isset($_SESSION['success']['time']) && time() - $_SESSION['success']['time'] > 5) {
    unset($_SESSION['success']);
}

/**
 * @return void
 */
function errorMessage(): void
{
    if (isset($_SESSION['error'])) {
        foreach ($_SESSION['error'] as $id => $error) {
            if ($id != 'time') {
                echo '<p class="alert alert-danger mt-1">' . $_SESSION['error'][$id] . '</p>';
            }
        }
        header("Refresh:6");
    }
}

/**
 * @return void
 */
function successMessage(): void
{
    if (isset($_SESSION['success'])) {
        foreach ($_SESSION['success'] as $id => $success) {
            if ($id != 'time') {
                echo '<p class="alert alert-success mt-1">' . $_SESSION['success'][$id] . '</p>';
            }
        }
        header("Refresh:6");
    }
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
            $queryAutores = $pdo->prepare("SELECT * FROM tab_autores ORDER BY autor_name");
            $queryAutores->execute();
            $autores = $queryAutores->fetchAll();


            foreach ($autores as $autor) {
                echo '<tr>';
                echo '<td class="text-center w-10">' . $autor['autor_id'] . '</td>';
                echo '<td>' . $autor['autor_name'] . '</td>';
                echo '<td class="w-14"><a href="?edit=' . $autor['autor_id'] . '"><img src="src/resources/icons/edit-2.svg" alt="editar" class="mx-auto"></a></td>';
                echo '<td class="w-14"><a href="?delete=' . $autor['autor_id'] . '"><img src="src/resources/icons/trash.svg" alt="remover" class="mx-auto"></a></td>';
                echo '</tr>';
            }
            ?>
            <tr class="bg-g-light-green ">
                <td colspan="4" class="text-center text-white"><a href="?add" class="underline px-10 hover:font-bold">Cadastrar
                        novo autor</a></td>
            </tr>
        </table>
        <a href="adicionar.php" class="underline">Voltar</a>

        <?php
        successMessage();
        errorMessage();
        ?>
    </div>

    <?php
    }

    // add
    if (isset($_GET['add'])) {
        echo '<div class="adicionarWrapper">';
        echo '<form method="POST" action="">';
        echo '<label for="name">Nome do autor:</label>';
        echo '<input type="text" name="name" id="name">';
        errorMessage();
        echo '<a href="gerenciar-autores.php" class="underline">Voltar</a>';
        echo ' <input type="submit" value="Confirmar" class="btn-submit border border-neutral-500">';
        echo '</form>';
        echo '</div>';

        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $queryAutores = $pdo->prepare("SELECT * FROM tab_autores WHERE autor_name = :autor");
            $queryAutores->bindParam(':autor', $_POST['name']);
            $queryAutores->execute();
            $autores = $queryAutores->rowCount();

            if ($autores == 0) {
                $query = $pdo->prepare("INSERT INTO tab_autores (autor_name) VALUES (:autor_name)");
                $query->bindParam(':autor_name', $_POST['name'], PDO::PARAM_STR);
                $query->execute();
                $_SESSION['success']['add'] = 'Autor ' . $_POST['name'] . ' cadastrado com sucesso.';
                $_SESSION['success']['time'] = time();
                header("Location: gerenciar-autores.php");
            } else {
                $_SESSION['error']['take'] = 'Esse autor já existe.';
                $_SESSION['error']['time'] = time();
                header('Location: gerenciar-autores.php?add');
            }
        }
        if (isset($_POST['name']) && empty($_POST['name'])) {
            $_SESSION['error']['blank'] = 'Um nome precisa ser informado.';
            $_SESSION['error']['time'] = time();
            header('Location: gerenciar-autores.php?add');
        }
    }

    // delete
    if (isset($_GET['delete'])) {
        $queryAutores = $pdo->prepare("SELECT * FROM tab_autores WHERE autor_id = ?");
        $queryAutores->execute([$_GET['delete']]);
        $autores = $queryAutores->fetch();
        $linha = $queryAutores->rowCount();

        if (empty($_GET['delete']) || $linha == 0) {
            $_SESSION['error']['ukn'] = 'Autor não encontrado.';
            $_SESSION['error']['time'] = time();
            header('Location: gerenciar-autores.php');
        } else {
            $queryDelete = $pdo->prepare("DELETE FROM tab_autores WHERE autor_id = :delete");
            $queryDelete->bindParam(':delete', $_GET['delete'], PDO::PARAM_STR);
            $queryDelete->execute();

            $_SESSION['success']['remove'] = 'Autor ' . $autores['autor_name'] . ' removido com sucesso.';
            $_SESSION['success']['time'] = time();
            header('Location: gerenciar-autores.php');
        }
    }

    // edit
    if (isset($_GET['edit']) && !empty($_GET['edit'])) {
        $queryAutores = $pdo->prepare("SELECT * FROM tab_autores WHERE autor_id = ?");
        $queryAutores->execute([$_GET['edit']]);
        $autor = $queryAutores->fetch();
        $linha = $queryAutores->rowCount();

        echo '<div class="adicionarWrapper">';
        if ($linha == 0) {
            echo '<p class="text-red-500 text-center bg-red-100 py-1.5 rounded-full">Autor não encontrada</p>';
            echo '<a href="gerenciar-autores.php" class="underline">Voltar</a>';

        } else {
            echo '<form method="POST" action="">';
            echo '<label for="name-e">Nome do autor:</label>';
            echo '<input type="text" name="name-e" id="name-e" value="' . $autor['autor_name'] . '">';
            errorMessage();
            echo '<a href="gerenciar-autores.php" class="underline">Voltar</a>';
            echo ' <input type="submit" value="Confirmar" class="btn-submit border border-neutral-500">';
            echo '</form>';
            echo '</div>';

            if (isset($_POST['name-e'])) {
                $queryVerify = $pdo->prepare("SELECT * FROM tab_autores");
                $queryVerify->execute();
                $verifys = $queryVerify->fetchAll();

                foreach ($verifys as $verify) {
                    if ($verify['autor_name'] == $_POST['name-e']) {
                        $_SESSION['error']['already'] = 'Esse autor já está cadastrado.';
                        $_SESSION['error']['time'] = time();
                        header('Location: gerenciar-autores.php?edit=' . $_GET['edit']);
                    }
                }
            }

            if (isset($_POST['name-e']) && !empty($_POST['name-e']) && $autor['autor_name'] != $_POST['name-e']) {
                $queryUpdate = $pdo->prepare("UPDATE tab_autores SET autor_name = ? WHERE autor_id = ?");
                $queryUpdate->execute([$_POST['name-e'], $_GET['edit']]);
                $_SESSION['success']['update'] = 'Autor ' . $_POST['name-e'] . ' atualizado com sucesso.';
                $_SESSION['success']['time'] = time();
                header("Location: gerenciar-autores.php");
            }

            if (isset($_POST['name-e']) && empty($_POST['name-e'])) {
                $_SESSION['error']['empty'] = 'O nome não pode ser vazio.';
                $_SESSION['error']['time'] = time();
                header('Location: gerenciar-autores.php?edit=' . $_GET['edit']);
            }
        }

    }
    ?>


</div>