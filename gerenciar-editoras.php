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
            $queryEditora = $pdo->prepare("SELECT * FROM tab_editoras ORDER BY editora_name");
            $queryEditora->execute();
            $editoras = $queryEditora->fetchAll();


            foreach ($editoras as $editora) {
                echo '<tr>';
                echo '<td class="text-center w-10">' . $editora['editora_id'] . '</td>';
                echo '<td>' . $editora['editora_name'] . '</td>';
                echo '<td class="w-14"><a href="?edit=' . $editora['editora_id'] . '"><img src="src/resources/icons/edit-2.svg" alt="editar" class="mx-auto"></a></td>';
                echo '<td class="w-14"><a href="?delete=' . $editora['editora_id'] . '"><img src="src/resources/icons/trash.svg" alt="remover" class="mx-auto"></a></td>';
                echo '</tr>';
            }
            ?>
            <tr class="bg-g-light-green ">
                <td colspan="4" class="text-center text-white"><a href="?add" class="underline px-10 hover:font-bold">Cadastrar
                        nova editora</a></td>
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
        echo '<label for="name">Nome da editora:</label>';
        echo '<input type="text" name="name" id="name">';
        errorMessage();
        echo '<a href="gerenciar-editoras.php" class="underline">Voltar</a>';
        echo ' <input type="submit" value="Confirmar" class="btn-submit border border-neutral-500">';
        echo '</form>';
        echo '</div>';

        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $queryEditora = $pdo->prepare("SELECT * FROM tab_editoras WHERE editora_name = :editora");
            $queryEditora->bindParam(':editora', $_POST['name']);
            $queryEditora->execute();
            $editoras = $queryEditora->rowCount();

            if ($editoras == 0) {
                $query = $pdo->prepare("INSERT INTO tab_editoras (editora_name) VALUES (:editora_name)");
                $query->bindParam(':editora_name', $_POST['name'], PDO::PARAM_STR);
                $query->execute();
                $_SESSION['success']['add'] = 'Editora ' . $_POST['name'] . ' cadastrada com sucesso.';
                $_SESSION['success']['time'] = time();
                header("Location: gerenciar-editoras.php");
            } else {
                $_SESSION['error']['take'] = 'Essa editora já existe.';
                $_SESSION['error']['time'] = time();
                header('Location: gerenciar-editoras.php?add');
            }
        }
        if (isset($_POST['name']) && empty($_POST['name'])) {
            $_SESSION['error']['blank'] = 'Um nome precisa ser informado.';
            $_SESSION['error']['time'] = time();
            header('Location: gerenciar-editoras.php?add');
        }
    }

    // delete
    if (isset($_GET['delete'])) {
        $queryEditoras = $pdo->prepare("SELECT * FROM tab_editoras WHERE editora_id = ?");
        $queryEditoras->execute([$_GET['delete']]);
        $editoras = $queryEditoras->fetch();
        $linha = $queryEditoras->rowCount();

        if (empty($_GET['delete']) || $linha == 0) {
            $_SESSION['error']['ukn'] = 'Editora não encontrada.';
            $_SESSION['error']['time'] = time();
            header('Location: gerenciar-editoras.php');
        } else {
            $queryDelete = $pdo->prepare("DELETE FROM tab_editoras WHERE editora_id = :delete");
            $queryDelete->bindParam(':delete', $_GET['delete'], PDO::PARAM_STR);
            $queryDelete->execute();

            $_SESSION['success']['remove'] = 'Editora ' . $editoras['editora_name'] . ' removida com sucesso.';
            $_SESSION['success']['time'] = time();
            header('Location: gerenciar-editoras.php');
        }
    }

    // edit
    if (isset($_GET['edit']) && !empty($_GET['edit'])) {
        $queryEditoras = $pdo->prepare("SELECT * FROM tab_editoras WHERE editora_id = ?");
        $queryEditoras->execute([$_GET['edit']]);
        $editora = $queryEditoras->fetch();
        $linha = $queryEditoras->rowCount();

        echo '<div class="adicionarWrapper">';
        if ($linha == 0) {
            echo '<p class="text-red-500 text-center bg-red-100 py-1.5 rounded-full">Editora não encontrada</p>';
            echo '<a href="gerenciar-editoras.php" class="underline">Voltar</a>';

        } else {
            echo '<form method="POST" action="">';
            echo '<label for="name-e">Nome da editora:</label>';
            echo '<input type="text" name="name-e" id="name-e" value="' . $editora['editora_name'] . '">';
            errorMessage();
            echo '<a href="gerenciar-editoras.php" class="underline">Voltar</a>';
            echo ' <input type="submit" value="Confirmar" class="btn-submit border border-neutral-500">';
            echo '</form>';
            echo '</div>';

            if (isset($_POST['name-e'])) {
                $queryVerify = $pdo->prepare("SELECT * FROM tab_editoras");
                $queryVerify->execute();
                $verifys = $queryVerify->fetchAll();

                foreach ($verifys as $verify) {
                    if ($verify['editora_name'] == $_POST['name-e']) {
                        $_SESSION['error']['already'] = 'Essa editora já está cadastrada.';
                        $_SESSION['error']['time'] = time();
                        header('Location: gerenciar-editoras.php?edit=' . $_GET['edit']);
                    }
                }
            }

            if (isset($_POST['name-e']) && !empty($_POST['name-e']) && $editora['editora_name'] != $_POST['name-e']) {
                $queryUpdate = $pdo->prepare("UPDATE tab_editoras SET editora_name = ? WHERE editora_id = ?");
                $queryUpdate->execute([$_POST['name-e'], $_GET['edit']]);
                $_SESSION['success']['update'] = 'Editora ' . $_POST['name-e'] . ' atualizada com sucesso.';
                $_SESSION['success']['time'] = time();
                header("Location: gerenciar-editoras.php");
            }

            if (isset($_POST['name-e']) && empty($_POST['name-e'])) {
                $_SESSION['error']['empty'] = 'O nome não pode ser vazio.';
                $_SESSION['error']['time'] = time();
                header('Location: gerenciar-editoras.php?edit=' . $_GET['edit']);
            }
        }
    }
    ?>
</div>