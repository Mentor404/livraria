<?php
require 'header.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

if (isset($_SESSION['error']['time']) && time() - $_SESSION['error']['time'] > 5) {
    unset($_SESSION['error']);
}

if (isset($_SESSION['success']['time']) && time() - $_SESSION['success']['time'] > 5) {
    unset($_SESSION['success']);
}

if (isset($_COOKIE['addForm-temp'])) {
    $temp = true;
    $tempData = json_decode($_COOKIE['addForm-temp'], true);
} else {
    $temp = false;
    $tempData = null;
}


echo '<div class="adicionarWrapper">';
echo '<form action="adicionar-livro.php" method="post">';

echo '<label for="livro-title">Título:</label>';
if ($temp && $tempData['titulo']) {
    echo '<input type="text" class="" id="livro-title" name="livro-title" value="' . $tempData['titulo'] . '">';
} else {
    echo '<input type="text" class="" id="livro-title" name="livro-title">';
}

if (isset($_SESSION['error']['title-empty'])) {
    echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['title-empty'] . '</p>';
    header("Refresh:6");
}
if (isset($_SESSION['error']['livro-already-take'])) {
    echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['livro-already-take'] . '</p>';
    header("Refresh:6");
}
if (isset($_SESSION['success']['adicionar'])) {
    echo '<p class="alert alert-success mt-1">' . $_SESSION['success']['adicionar'] . '</p>';
    header("Refresh:6");
}

echo '<label for="livro-description">Descrição:</label>';
if ($temp && $tempData['descricao']) {
    echo '<textarea name="livro-description" id="livro-description">' . $tempData['descricao'] . '</textarea>';

} else {
    echo '<textarea name="livro-description" id="livro-description"></textarea>';
}

if (isset($_SESSION['error']['description-empty'])) {
    if (empty($descricao)) {
        echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['description-empty'] . '</p>';
        header("Refresh:6");
    }
}

echo '<label for="livro-categoria">Categorias:</label>';
echo '<div class="categoriasWrapper">';
$queryCategorias = "SELECT * FROM tab_categorias ORDER BY categoria_name";
$query = $pdo->prepare($queryCategorias);
$query->execute();
$categorias = $query->fetchAll(PDO::FETCH_ASSOC);


foreach ($categorias as $categoriaId => $categoria) {
    echo '<div class="wrapper">';
    echo '<label for="' . $categoria['categoria_name'] . '">' . $categoria['categoria_name'] . '</label>';
    $isChecked = false;
    if ($temp && $tempData['categorias'] > 0 && in_array($categoria['categoria_name'], $tempData['categorias'])) {
        $isChecked = true;
    }
    echo '<input type="checkbox" name="livro-categoria[]" id="' . $categoria['categoria_name'] . '" value="' . $categoria['categoria_name'] . '"';
    if ($isChecked) {
        echo ' checked';
    }
    echo '>';
    echo '</div>';
}

echo '</div>';

if ($_SESSION['user']['permission'] == 2) {
    echo '<a href="gerenciar-categorias.php?categorias" class="underline hover:font-bold">Gerenciar categorias</a><br>';
}
if (isset($_SESSION['error']['category-empty'])) {
    echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['category-empty'] . '</p>';
    header("Refresh:6");
}

echo '<label for="autor">Autor:</label>';
echo '<select name="autor" id="autor">';

$queryAutores = "SELECT * FROM tab_autores ORDER BY autor_name";
$query = $pdo->prepare($queryAutores);
$query->execute();
$autores = $query->fetchAll(PDO::FETCH_ASSOC);

if ($temp && $tempData['autor']) {
    foreach ($autores as $autor) {
        if ($autor['autor_name'] == $tempData['autor']) {
            echo '<option value="' . $autor['autor_name'] . '" selected>' . $autor['autor_name'] . '</option>';
        } else {
            echo '<option value="' . $autor['autor_name'] . '">' . $autor['autor_name'] . '</option>';
        }
    }
} else {
    echo '<option selected disabled hidden> Selecione um autor </option>';
    foreach ($autores as $autor) {
        echo '<option value="' . $autor['autor_name'] . '">' . $autor['autor_name'] . '</option>';
    }
}

echo '</select>';

if ($_SESSION['user']['permission'] == 2) {
    echo '<a href="gerenciar-autores.php" class="underline hover:font-bold">Gerenciar autores</a><br>';
}

if (isset($_SESSION['error']['autor-empty'])) {
    echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['autor-empty'] . '</p>';
    header("Refresh:6");
}

echo '<label for="editora">Editora:</label>';
echo '<select name="editora" id="editora">';

$queryEditoras = "SELECT * FROM tab_editoras ORDER BY editora_name";
$query = $pdo->prepare($queryEditoras);
$query->execute();
$editoras = $query->fetchAll(PDO::FETCH_ASSOC);

if ($temp && $tempData['editora']) {
    foreach ($editoras as $editora) {
        if ($editora['editora_name'] == $tempData['editora']) {
            echo '<option value="' . $editora['editora_name'] . '" selected>' . $editora['editora_name'] . '</option>';
        } else {
            echo '<option value="' . $editora['editora_name'] . '">' . $editora['editora_name'] . '</option>';
        }
    }
} else {
    echo '<option selected disabled hidden> Selecione uma editora </option>';
    foreach ($editoras as $editora) {
        echo '<option value="' . $editora['editora_name'] . '">' . $editora['editora_name'] . '</option>';
    }
}

echo '</select>';

if ($_SESSION['user']['permission'] == 2) {
    echo '<a href="gerenciar-editoras.php" class="underline hover:font-bold">Gerenciar editoras</a><br>';
}

if (isset($_SESSION['error']['editora-empty'])) {
    echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['editora-empty'] . '</p>';
    header("Refresh:6");
}

echo '<label for="ano">Ano de publicação:</label>';
if ($temp && $tempData['ano']) {
    echo '<input type="number" name="ano" id="ano" value="' . $tempData['ano'] . '">';
} else {
    echo '<input type="number" name="ano" id="ano">';
}

if (isset($_SESSION['error']['ano-empty'])) {
    echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['ano-empty'] . '</p>';
    header("Refresh:6");
}


echo '<label for="paginas">Número de páginas</label>';
if ($temp && $tempData['paginas']) {
    echo '<input type="number" name="paginas" id="paginas" value="' . $tempData['paginas'] . '">';
} else {
    echo '<input type="number" name="paginas" id="paginas">';
}

if (isset($_SESSION['error']['paginas-empty'])) {
    echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['paginas-empty'] . '</p>';
    header("Refresh:6");
}


echo '<label for="image">URL da capa:</label>';
if ($temp && $tempData['image']) {
    echo '<input type="url" name="image" id="image" placeholder="https://www" value="' . $tempData['image'] . '">';
} else {
    echo '<input type="url" name="image" id="image" placeholder="https://www">';
}

?>

<input type="submit" value="Adicionar" class="btn-submit border border-neutral-500">
</form>
</div>
