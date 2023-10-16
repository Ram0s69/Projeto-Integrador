<!DOCTYPE html>
<html lang="pt-br">

<?php

include_once "componentes/head.php";
if (!isset($_SESSION['usuario'])) header("Location: login.php?erro=session")

?>

<body>
   <?php include_once "componentes/header.php" ?>

   <main>
      <div class="container centro">
         <h2 class="titulo">Acessar exercícios</h2>

         <section class="card-container centro">
            <article class="card">
               <img src="<?= url("assets/imagens/1-grau.webp") ?>" alt="Imagem do Card">

               <div class="card-content">
                  <h3 class="subtitulo">Equação de 1° Grau</h3>

                  <form action="<?= url("nivel-exercicio.php") ?>" method="post">
                     <button type="submit" class="card-btn">Acessar lista de exercícios</button>
                     <input type="hidden" name="equacao" value="1">
                  </form>
               </div>
            </article>

            <article class="card">
               <img src="<?= url("assets/imagens/2-grau.webp") ?>" alt="Imagem do Card">

               <div class="card-content">
                  <h3 class="subtitulo">Equação de 2° Grau</h3>

                  <form action="<?= url("nivel-exercicio.php") ?>" method="post">
                     <button type="submit" class="card-btn">Acessar lista de exercícios</button>
                     <input type="hidden" name="equacao" value="2">
                  </form>
               </div>
            </article>

            <article class="card">
               <img src="<?= url("assets/imagens/3-grau.webp") ?>" alt="Imagem do Card">

               <div class="card-content">
                  <h3 class="subtitulo">Equação de 3° Grau</h3>

                  <form action="<?= url("nivel-exercicio.php") ?>" method="post">
                     <button type="submit" class="card-btn">Acessar lista de exercícios</button>
                     <input type="hidden" name="equacao" value="3">
                  </form>
               </div>
            </article>
         </section>
      </div>
   </main>

   <?php include_once "componentes/footer.php" ?>
</body>

</html>