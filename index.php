<?php
require 'header.php'
?>

<div class="section-wrap">
    <section id="section1">
        <div class="pl-[20%] pt-[160px]">
            <h1 class="title text-white">
                Livraria<br/> Digital
            </h1>

            <div class="divisor mt-[43px] mb-[20px]"></div>

            <p class=" text-white text-md max-w-[377px] mb-[40px]">
                A livraria digital oferece acesso a uma vasta seleção de títulos,
                incluindo clássicos intemporais e best-sellers atuais. O usuário pode navegar por categorias
                cuidadosamente selecionadas e descobrir novidades.
                É possível ler amostras grátis antes de decidir de compra. A biblioteca do usuário estará
                sempre disponível,
                permitindo a leitura digital conveniente em qualquer lugar. A inscrição oferece acesso a uma biblioteca
                virtual completa,
                proporcionando a satisfação de ter sempre um grande número de opções de leitura à disposição.
            </p>
            <div class="flex justify-between w-[377px]">
                <?php
                if(!isset($_SESSION['user'])){
                    echo '<a href="cadastro.php" class="btn-full bg-white ">Cadastrar-se</a>';
                }
                ?>
                <a href="catalogo.php" class="btn-outline">Catálogo</a>
            </div>
        </div>

        <img src="src/resources/small-bg.png" class="fixed left-0 -bottom-2">
    </section>

    <section id="section2">
        <h2 class="title text-light-green pb-[20px] text-4xl">Comunidade<br/> Literária</h2>
        <p class="text-light-green max-w-[223px] mb-[45px] text-md">
            A seção de comunidade da livraria digital permite que os usuários se conectem e discutam assuntos
            relacionados
            à leitura. É possível compartilhar recomendações e opiniões, participar de debates sobre livros e autores,
            e descobrir novas perspectivas. Os usuários também podem contribuir com suas análises e resenhas, fornecendo
            uma fonte valiosa de informações para a comunidade. Junte-se a essa comunidade vibrante de apreciadores da
            literatura e expanda seus horizontes.
        </p>
        <a href="#" class="btn-full bg-light-green text-white ">Conferir</a>
    </section>
</div>


<img src="src/resources/books2_1.png" alt="prateleira com livros" class="absolute right-[28%] top-[124px]">


</body>
</html>