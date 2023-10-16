<!DOCTYPE html>
<html lang="pt-br">

<?php

include_once "php/conexao.php";
include_once "componentes/head.php";

if (!isset($_SESSION['usuario'])) header("Location: login.php?erro=session");

$questoes = $conexao->query("SELECT * FROM questao")->fetch_all();

$equacoes = [
   "1" => "1° Grau",
   "2" => "2° Grau",
   "3" => "3° Grau"
];

$dificuldades = [
   "1" => "Fácil",
   "2" => "Média",
   "3" => "Difícil"
];

$modo_edicao = isset($_GET["modo_edicao"]);

?>

<body>
   <?php include_once "componentes/header.php" ?>

   <main>
      <div class="container">
         <?= alerta() ?>

         <div class="container-perfil">
            <div class="perfil-linha">
               <div class="card-perfil">
                  <img src="<?= url("uploads/{$_SESSION['usuario']["imagem"]}") ?>" alt="Imagem de Perfil">

                  <div>
                     <h2><?= $_SESSION['usuario']["nome"] ?></h2>
                     <p>E-mail: <?= $_SESSION['usuario']["email"] ?></p>
                     <p>Nascimento: <?= date('d/m/Y', strtotime($_SESSION['usuario']["data_nascimento"]))  ?></p>

                     <form action="<?= url("php/login.php") ?>" method="post" class="unstyled">
                        <button type="submit" class="btn">Excluir conta</button>

                        <input type="hidden" name="id_usuario" value="<?= $_SESSION['usuario']["idUsuario"] ?>">
                        <input type="hidden" name="operacao" value="excluir">
                     </form>
                  </div>
               </div>

               <?php if ($_SESSION["usuario"]["tipo_usuario"] == 1) : ?>
                  <div class="tabela-container">
                     <table>
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Enunciado</th>
                              <th>Resposta</th>
                              <th>Tipo de equação</th>
                              <th>Dificuldade</th>
                              <th>Ações</th>
                           </tr>
                        </thead>

                        <tbody>
                           <?php foreach ($questoes as $questao) : ?>
                              <tr>
                                 <td><?= $questao[0] ?></td>
                                 <td><?= $questao[1] ?></td>
                                 <td><?= $questao[2] ?></td>
                                 <td><?= $equacoes[$questao[3]] ?></td>
                                 <td><?= $dificuldades[$questao[4]] ?></td>
                                 <td>
                                    <div class="linha-tabela">
                                       <form action="#" method="get" class="unstyled">
                                          <button type="submit" class="btn"><i class="fa-solid fa-pencil"></i></button>

                                          <input type="hidden" name="questao" value="<?= $questao[0] ?>">
                                          <input type="hidden" name="modo_edicao" value="true">
                                       </form>

                                       <form action="<?= url("php/questao.php") ?>" method="post" class="unstyled">
                                          <button type="submit" class="btn"><i class="fa-solid fa-trash"></i></button>

                                          <input type="hidden" name="questao" value="<?= $questao[0] ?>">
                                          <input type="hidden" name="operacao" value="excluir">
                                       </form>
                                    </div>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  </div>
               <?php endif; ?>
            </div>

            <?php if ($_SESSION["usuario"]["tipo_usuario"] == 1) : ?>
               <div class="perfil-linha">
                  <?php if (!$modo_edicao) : ?>
                     <div>
                        <form action="<?= url("php/questao.php") ?>" method="post">
                           <h2 class="titulo">Adicionar questão</h2>

                           <input type="hidden" name="operacao" value="criar">

                           <label for="enunciado">Enunciado</label>
                           <input type="text" name="enunciado" id="enunciado" required>

                           <div class="linha">
                              <div>
                                 <label for="tipo_equacao">Tipo de equação</label>
                                 <select name="tipo_equacao" id="tipo_equacao" required>
                                    <option value="1">1° grau</option>
                                    <option value="2">2° grau</option>
                                    <option value="3">3° grau</option>
                                 </select>
                              </div>

                              <div>
                                 <label for="dificuldade">Dificuldade</label>
                                 <select name="dificuldade" id="dificuldade" required>
                                    <option value="1">Fácil</option>
                                    <option value="2">Média</option>
                                    <option value="3">Difícil</option>
                                 </select>
                              </div>
                           </div>

                           <label for="alternativas">Alternativas</label>
                           <input type="text" name="alternativas" id="alternativas" placeholder="1, 2, 3, 4, 5" required>
                           <small class="mensagem-apoio">*coloque as alternativas separadas por vírgula*</small>

                           <label for="resposta">Resposta</label>
                           <select name="resposta" id="resposta" required></select>

                           <button type="submit" class="btn">Adicionar</button>
                        </form>
                     </div>

                  <?php else :
                     $id_questao = $_GET["questao"];
                     $questao = $conexao->query("SELECT * FROM questao WHERE idQuestao = {$id_questao}")->fetch_assoc();
                     $query_alternativas = $conexao->query("SELECT texto FROM alternativa WHERE idQuestao = {$id_questao}")->fetch_all();
                     $alternativas = [];

                     foreach ($query_alternativas as $alternativa) {
                        $alternativas[] = $alternativa[0];
                     }
                  ?>
                     <div>
                        <form action="<?= url("php/questao.php") ?>" method="post">
                           <h2 class="titulo">Editar questão</h2>

                           <input type="hidden" name="operacao" value="editar">
                           <input type="hidden" name="questao" value="<?= $questao['idQuestao'] ?>">

                           <label for="enunciado">Enunciado</label>
                           <input type="text" name="enunciado" id="enunciado" required value="<?= $questao['enunciado'] ?>">

                           <div class="linha">
                              <div>
                                 <label for="tipo_equacao">Tipo de equação</label>
                                 <select name="tipo_equacao" id="tipo_equacao" required>
                                    <option value="1" <?= $questao['tipo_equacao'] == "1" ? "selected" : "" ?>>1° grau</option>
                                    <option value="2" <?= $questao['tipo_equacao'] == "2" ? "selected" : "" ?>>2° grau</option>
                                    <option value="3" <?= $questao['tipo_equacao'] == "3" ? "selected" : "" ?>>3° grau</option>
                                 </select>
                              </div>

                              <div>
                                 <label for="dificuldade">Dificuldade</label>
                                 <select name="dificuldade" id="dificuldade" required>
                                    <option value="1" <?= $questao['dificuldade'] == "1" ? "selected" : "" ?>>Fácil</option>
                                    <option value="2" <?= $questao['dificuldade'] == "2" ? "selected" : "" ?>>Média</option>
                                    <option value="3" <?= $questao['dificuldade'] == "3" ? "selected" : "" ?>>Difícil</option>
                                 </select>
                              </div>
                           </div>

                           <label for="alternativas">Alternativas</label>
                           <input type="text" name="alternativas" id="alternativas" placeholder="1, 2, 3, 4, 5" required value="<?= join(",", $alternativas) ?>">
                           <small class="mensagem-apoio">*coloque as alternativas separadas por vírgula*</small>

                           <label for="resposta">Resposta</label>
                           <select name="resposta" id="resposta" required></select>

                           <button type="submit" class="btn">Editar</button>
                        </form>
                     </div>
                  <?php endif; ?>
               </div>
            <?php endif ?>
         </div>
      </div>
   </main>

   <?php include_once "componentes/footer.php" ?>
</body>

<script>
   const inputAlternativas = document.querySelector("#alternativas");
   const inputResposta = document.querySelector("#resposta");

   function set() {
      const alternativas = inputAlternativas.value.split(",")
      inputResposta.innerHTML = "";

      for (let alternativa of alternativas) {
         alternativa = alternativa.trim();

         if (alternativa == "") continue;

         const option = `<option value="${alternativa}">${alternativa}</option>`;
         inputResposta.innerHTML += option;
      }
   }

   set();
   inputAlternativas.addEventListener("input", set);
</script>

</html>