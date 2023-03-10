<?php
session_start();
require "connect.php";

$query = $pdo->prepare("SELECT * FROM tab_usuarios");
$query->execute();
$fetchUsers = $query->fetchAll();

if (isset($_GET['delete'])) {
    $query = $pdo->prepare("DELETE FROM tab_usuarios WHERE user_id =?");
    $query->execute([$_GET['delete']]);
    header("Location: test.php");
}

?>

<h2>Lista de usuários:</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Usuário</th>
        <th>Senha</th>
        <th>Joined At</th>
        <th>Email</th>
        <th>Permissão</th>
        <th>Remover</th>
        <!--        <th>Excluir</th>-->
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($fetchUsers as $user) {
        echo '<tr>';
        echo '<td>' . $user['user_id'] . '</td>';
        echo '<td>' . $user['user_name'] . '</td>';
        echo '<td>' . $user['user_password'] . '</td>';
        echo '<td>' . $user['user_joined_at'] . '</td>';
        echo '<td>' . $user['user_email'] . '</td>';
        echo '<td>' . $user['user_permissions'] . '</td>';
        if ($user['user_permissions'] != 2) {
            echo '<td><a href="?delete=' . $user['user_id'] . '">X</a></td>';
        } else {
            echo '<td>X</td>';
        }
        echo '</tr>';
    }
    ?>
    </tbody>
</table>


<?php
$temp = array(
    "title" => "Teste",
    "description" => "Descrição vai ir aqui",
    "categories" => array("categoria 1", "categoria 2"),
    "autor" => "Nome do autor",
    "editora" => "Nome da editora",
    "ano" => "Ano de publicação",
    "pages" => 123,
    "image" => null,
);

setcookie('add-temp', json_encode($temp), time() + 1800);

$tempdecode = json_decode($_COOKIE['add-temp'], true);

var_dump($tempdecode);
echo array_keys($temp);

setcookie('add-temp', json_encode($temp), time() + 1800);


$query = $pdo->prepare("SELECT * FROM tab_usuarios WHERE user_id =?");
$query->execute([$_SESSION['user-id']]);
$user = $query->fetch();

echo '<h2>Usuário: ' . $user['user_name'] . '</h2>';

var_dump(isset($_SESSION['error']));

foreach ($_SESSION['error'] as $id => $error) {
    echo '<p>' . $id . '</p>';
}
?>

<?php
$title = 'Teste3';
$queryAutorId = $pdo->prepare("SELECT * FROM tab_livros WHERE tab_livros.livro_title LIKE :title");
$queryAutorId->bindParam(':title', $title, PDO::PARAM_STR);
$queryAutorId->execute();
$autorId = $queryAutorId->fetch();

var_dump($autorId);
echo strlen($autorId['livro_image']);

?>

