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

if (!isset($_GET['delete'])) {
?>
<div class="container mx-auto">
    <div class="w-full">
        <table class="gerenciarTable">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Remover</th>
            </tr>
            <?php
            $queryLivros = $pdo->prepare("SELECT * FROM tab_livros ORDER BY livro_title");
            $queryLivros->execute();
            $livros = $queryLivros->fetchAll();


            foreach ($livros as $livro) {
                echo '<tr>';
                echo '<td class="text-center w-10">' . $livro['livro_id'] . '</td>';
                echo '<td>' . $livro['livro_title'] . '</td>';
                echo '<td class="w-14"><a href="?delete=' . $livro['livro_id'] . '"><img src="src/resources/icons/trash.svg" alt="remover" class="mx-auto"></a></td>';
                echo '</tr>';
            }
            ?>
            <tr class="bg-g-light-green ">
                <td colspan="4" class="text-center text-white"><a href="adicionar-livro.php" class="underline px-10 hover:font-bold">Cadastrar
                        novo Livro</a></td>
            </tr>
        </table>
        <a href="catalogo.php" class="underline">Voltar</a>

        <?php
        successMessage();
        errorMessage();
        ?>
    </div>

    <?php
    }

    // delete
    if (isset($_GET['delete'])) {
        $queryLivros = $pdo->prepare("SELECT * FROM tab_livros WHERE livro_id = ?");
        $queryLivros->execute([$_GET['delete']]);
        $livro = $queryLivros->fetch();
        $linha = $queryLivros->rowCount();

        if (empty($_GET['delete']) || $linha == 0) {
            $_SESSION['error']['ukn'] = 'Livro não encontrado.';
            $_SESSION['error']['time'] = time();
            header('Location: gerenciar-livros.php');
        } else {
            $queryDelete = $pdo->prepare("DELETE FROM tab_livros WHERE livro_id = :delete");
            $queryDelete->bindParam(':delete', $_GET['delete'], PDO::PARAM_STR);
            $queryDelete->execute();

            $_SESSION['success']['remove'] = 'Livro ' . $livro['livro_title'] . ' removido com sucesso.';
            $_SESSION['success']['time'] = time();
            header('Location: gerenciar-livros.php');
        }
    }
    ?>
</div>