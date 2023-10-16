<?php

if (!isset($_POST['equacao'])) die("Erro ao carregar página");

$equacao = $_POST['equacao'];

?>
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
         <h2 class="titulo">Lista de Exercicíos de Equação de <?= $equacao ?>° Grau</h2>

         <section class="card-container centro">
            <article class="card">
               <img src="<?= url("assets/imagens/facil.webp") ?>" alt="Imagem do Card">
               <div class="card-content">
                  <h3 class="subtitulo">Fácil</h3>

                  <form action="<?= url("exercicio.php") ?>" method="post">
                     <button type="submit" class="card-btn">Selecionar exercícios fáceis</button>
                     <input type="hidden" name="nivel" value="1">
                     <input type="hidden" name="equacao" value="<?= $equacao ?>">
                  </form>
               </div>
            </article>

            <article class="card">
               <img src="<?= url("assets/imagens/medio.webp") ?>" alt="Imagem do Card">
               <div class="card-content">
                  <h3 class="subtitulo">Médio</h3>

                  <form action="<?= url("exercicio.php") ?>" method="post">
                     <button type="submit" class="card-btn">Selecionar exercícios médios</button>
                     <input type="hidden" name="nivel" value="2">
                     <input type="hidden" name="equacao" value="<?= $equacao ?>">
                  </form>
               </div>
            </article>

            <article class="card">
               <img src="<?= url("assets/imagens/dificil.webp") ?>" alt="Imagem do Card">
               <div class="card-content">
                  <h3 class="subtitulo">Difícil</h3>

                  <form action="<?= url("exercicio.php") ?>" method="post">
                     <button type="submit" class="card-btn">Selecionar exercícios difíceis</button>
                     <input type="hidden" name="nivel" value="3">
                     <input type="hidden" name="equacao" value="<?= $equacao ?>">
                  </form>
               </div>
            </article>
         </section>
      </div>
   </main>

   <?php include_once "componentes/footer.php" ?>
</body>

</html>