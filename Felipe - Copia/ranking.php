<!DOCTYPE html>
<html lang="pt-br">

<?php

include_once "componentes/head.php";
include_once "php/conexao.php";
if (!isset($_SESSION['usuario'])) header("Location: login.php?erro=session");

$usuarios = $conexao->query("SELECT pontuacao, nome, imagem FROM usuario ORDER BY pontuacao DESC")->fetch_all();

?>

<body>
   <?php include_once "componentes/header.php" ?>

   <main>
      <div class="container">
         <h2 class="titulo">Ranking</h2>

         <table>
            <tr>
               <th class="subtitulo">Posição</th>
               <th class="subtitulo">Jogador</th>
               <th class="subtitulo">Pontuação</th>
            </tr>
            <?php foreach ($usuarios as $chave => $usuario) : ?>
               <tr>
                  <td><?= intval($chave) + 1 ?></td>
                  <td>
                     <div class="linha-tabela">
                        <img src="<?= url("uploads/{$usuario[2]}") ?>" alt="Imagem de Perfil" width="32">
                        <?= $usuario[1] ?>
                     </div>
                  </td>
                  <td><?= $usuario[0] ?? 0 ?></td>
               </tr>
            <?php endforeach; ?>
         </table>
      </div>
   </main>

   <?php include_once "componentes/footer.php" ?>
</body>

</html>