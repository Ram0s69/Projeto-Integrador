<!DOCTYPE html>
<html lang="pt-br">

<?php

include_once "php/conexao.php";
include_once "componentes/head.php";
if (!isset($_SESSION['usuario'])) header("Location: login.php?erro=session")

?>

<body>
   <?php include_once "componentes/header.php" ?>

   <main>
      <?php if (!isset($_GET["ver"])) : ?>
         <div class="container centro">
            <div class="container-form">
               <form action="<?= url("php/contato.php") ?>" method="post">
                  <h2 class="titulo">Contato</h2>

                  <?= alerta() ?>

                  <input type="hidden" name="operacao" value="criar">

                  <label for="mensagem">Mensagem:</label>
                  <textarea id="mensagem" name="mensagem" required></textarea>

                  <input type="submit" value="Enviar" class="btn">

                  <?php if ($_SESSION["usuario"]["tipo_usuario"] == 1) : ?>
                     <a href="contato.php?ver=true" class="btn outline">Ver mensagens</a>
                  <?php endif; ?>
               </form>
            </div>
         </div>
      <?php endif; ?>

      <?php if ($_SESSION["usuario"]["tipo_usuario"] == 1 and isset($_GET["ver"])) :
         $query_mensagens = $conexao->query("SELECT * FROM contato");
         $mensagens = [];

         while ($r = $query_mensagens->fetch_assoc()) {
            $mensagens[$r["idContato"]] = $r;
            $mensagens[$r["idContato"]]["usuario"] = $conexao->query("SELECT nome FROM usuario WHERE idUsuario = {$r["usuario_idUsuario"]}")->fetch_all()[0][0];
         }
      ?>
         <div class="container">
            <div class="tabela-container mb">
               <h2 class="titulo">Lista de mensagens</h2>

               <table>
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Mensagem</th>
                     </tr>
                  </thead>

                  <tbody>
                     <?php foreach ($mensagens as $mensagem) : ?>
                        <tr>
                           <td><?= $mensagem["idContato"] ?></td>
                           <td><?= $mensagem["usuario"] ?></td>
                           <td><?= $mensagem["mensagem"] ?></td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>

         <a href="contato.php" class="btn outline">Voltar</a>
      <?php endif; ?>
   </main>

   <?php include_once "componentes/footer.php" ?>
</body>

</html>