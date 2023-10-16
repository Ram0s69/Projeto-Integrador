<!DOCTYPE html>
<html lang="pt-br">

<?php

include_once "componentes/head.php";
if (!isset($_SESSION['usuario'])) header("Location: login.php?erro=session");

include_once "php/conexao.php";

$dados = $_SESSION["jogo"];
$num_questoes = $dados["num_questoes"];
$nivel = $dados["nivel"];
$equacao = $dados["equacao"];

if (empty($dados)) exit("Erro ao carregar a página!");

?>

<body>
   <?php include_once "componentes/header.php" ?>

   <main>
      <div class="container centro">
         <article class="enunciado">
            <div class="pontuacao">
               <div>
                  <?= $dados['acertos'] >= $num_questoes / 2  ? '<h2 class="titulo">Parabéns!</h2><br>' : ""; ?>

                  <p>Você obteve <?= $dados['acertos'] ?>/<?= $num_questoes ?> acertos</p>
                  <p>Sua pontuação: <?= $dados['acertos'] * 5 ?></p>
               </div>

               <a href="<?= url("exercicios.php") ?>" class="btn outline">Acessar outros exercícios</a>
               <form action="<?= url("exercicio.php") ?>" method="post" class="unstyled">
                  <button type="submit" class="card-btn">Tentar novamente</button>
                  <input type="hidden" name="nivel" value="<?= $nivel ?>">
                  <input type="hidden" name="equacao" value="<?= $equacao ?>">
               </form>
            </div>
         </article>
      </div>
   </main>

   <?php include_once "componentes/footer.php" ?>
</body>

</html>