<?php
require 'header.php';

if(isset($_SESSION['user'])){
    header("Location: index.php");
}
?>

<section id="section-login">
    <div class="card">
        <img src="src/resources/LOGO-MINIMAL.svg" alt="Livros" class="logo-minimal">
        <form action="cadastrar.php" method="POST" class="flex flex-col">
            <div class="mb-[35px]">
                <label for="user"><img src="src/resources/icons/user.svg" alt="Icone de usuário">
                    <p>Usuário</p></label>
                <input type="text" name="user" id="user" class="field">
                <?php
                if (isset($_SESSION['error']['blank-u'])) {
                    echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['blank-u'] . '</p>';
                }
                if (isset($_SESSION['error']['already-take'])) {
                    echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['already-take'] . '</p>';
                }
                ?>
            </div>
            <div class="mb-[35px]">
                <label for="user"><img src="src/resources/icons/check.svg" alt="Icone de email">
                    <p>Email</p></label>
                <input type="email" name="email" id="email" class="field">
            </div>
            <div class="mb-[15px]">
                <label for="pass"><img src="src/resources/icons/key.svg" alt="Icone de senha">
                    <p>Senha</p></label>
                <input type="password" name="pass" id="pass" class="field">
                <?php
                if (isset($_SESSION['error']['blank-p'])) {
                    if(empty($password)){
                        echo '<p class="alert alert-danger mt-1">' . $_SESSION['error']['blank-p'] . '</p>';
                    }
                }
                ?>
            </div>
            <a href="entrar.php" class="text-sm text-white hover:underline w-fit font-light">Já possui uma conta?</a>

            <button type="submit" class="btn-join bg-white text-gc-dark-green text-[20px]">Cadastrar</button>
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