<?php
require 'header.php';

if(isset($_SESSION['user'])){
    header("Location: index.php");
}
?>

<section id="section-login">
    <div class="card">
        <img src="src/resources/LOGO-MINIMAL.svg" alt="Livros" class="logo-minimal">
        <form action="logar.php" method="POST" class="flex flex-col">
            <div class="mb-[35px]">
                <label for="user"><img src="src/resources/icons/user.svg" alt="Icone de usuário">
                    <p>Usuário</p></label>
                <input type="text" name="user" id="user" class="field">
                <?php
                if (isset($_SESSION['error-user'])) {
                    echo '<p class="alert alert-danger mt-1">' . $_SESSION['error-user'] . '</p>';
                }
                ?>
            </div>
            <div class="mb-[15px]">
                <label for="pass"><img src="src/resources/icons/key.svg" alt="Icone de senha">
                    <p>Senha</p></label>
                <input type="password" name="pass" id="pass" class="field">
                <?php
                if (isset($_SESSION['success-cadastro'])) {
                    echo '<p class="alert alert-success mt-1">' . $_SESSION['success-cadastro'] . '</p>';
                }
                if (isset($_SESSION['error-pass'])) {
                    echo '<p class="alert alert-danger mt-1">' . $_SESSION['error-pass'] . '</p>';
                }
                if (isset($_SESSION['error-find']) && empty($_SESSION['error-pass']) && empty($_SESSION['error-user'])) {
                    echo '<p class="alert alert-danger mt-1">' . $_SESSION['error-find'] . '</p>';
                }
                ?>
            </div>
            <a href="cadastro.php" class="text-sm text-white hover:underline w-fit font-light">Não tem uma conta?</a>

            <button type="submit" class="btn-join bg-white text-gc-dark-green text-[20px]">Entrar</button>
        </form>
        <div class="w-[300px]">
            <a href="index.php" class="flex text-white w-fit font-light text-sm mb-[40px]">
                <img src="src/resources/icons/arrow-left.svg" alt="Seta para esquerda">
                Voltar
            </a>
        </div>
    </div>
</section>

</body>
</html>