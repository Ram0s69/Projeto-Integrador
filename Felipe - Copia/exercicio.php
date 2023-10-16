<!DOCTYPE html>
<html lang="pt-br">

<?php

include_once "componentes/head.php";
if (!isset($_SESSION['usuario'])) header("Location: login.php?erro=session");

include_once "php/conexao.php";

if (
   !isset($_POST['equacao']) and !isset($_POST['nivel']) and
   !isset($_GET['equacao']) and !isset($_GET['nivel'])
) die("Erro ao carregar página");

$equacao = $_POST['equacao'] ?? $_GET['equacao'];
$nivel = $_POST['nivel'] ?? $_GET['nivel'];;

$query = $conexao->query("SELECT * FROM questao WHERE dificuldade = '{$nivel}' AND tipo_equacao = '{$equacao}' ORDER BY RAND()");

$questoes = $query->fetch_all();
$num_questoes = $query->num_rows;

$q = [];

foreach ($questoes as $questao) {
   $alternativas = $conexao->query("SELECT * FROM alternativa WHERE idQuestao = '{$questao[0]}' ORDER BY RAND()")->fetch_all();
   $questao[5] = $alternativas;
   $q[] = $questao;
}

$letras = [
   "0" => "A)",
   "1" => "B)",
   "2" => "C)",
   "3" => "D)",
   "4" => "E)",
   "5" => "F)",
   "6" => "G)",
   "7" => "H)",
   "8" => "I)",
]

?>

<body>
   <?php include_once "componentes/header.php" ?>

   <main>
      <div class="container centro">
         <section class="exercicio-container">
            <article class="enunciado">
               <div>
                  <?php if (empty($q)) : ?>

                     <div class="alerta erro">
                        <p>Nenhuma questão encontrada</p>

                        <button>X</button>
                     </div>

                  <?php else : ?>

                     <form action="<?= url("php/verifica-resposta.php") ?>" method="post" id="enunciado" class="unstyled">
                        <input type="hidden" name="equacao" value="<?= $equacao ?>">
                        <input type="hidden" name="nivel" value="<?= $nivel ?>">

                        <?php foreach ($q as $chave => $questao) : ?>
                           <div data-questao>
                              <header>
                                 <h2 class="titulo">Questão <?= $chave + 1 ?></h2>
                              </header>

                              <div class="body">
                                 <p><?= $questao[1] ?></p>

                                 <ul class="alternativas">
                                    <?php foreach ($questao[5] as $chave => $alternativa) :
                                       $random = rand();
                                    ?>
                                       <li>
                                          <label for="res-<?= $random ?>">
                                             <span><?= $letras[$chave] ?></span>

                                             <input type="radio" name="resposta-<?= $questao[0] ?>" value="<?= $alternativa[2] ?>" id="res-<?= $random ?>" required>
                                             <span><?= $alternativa[2] ?></span>
                                          </label>
                                       </li>
                                    <?php endforeach; ?>
                                 </ul>
                              </div>
                           </div>

                           <input type="hidden" name="questao[]" value="<?= $questao[0] ?>">
                        <?php endforeach; ?>
                     </form>

                  <?php endif ?>
               </div>

               <footer>
                  <div>
                     <a href="<?= url("exercicios.php") ?>" class="btn outline">Acessar outros exercícios</a>

                     <?php if (!isset($_GET['acertos'])) : ?>
                        <input type="submit" value="Responder" form="enunciado" class="btn">
                     <?php endif; ?>
                  </div>

                  <?php if (!isset($_GET['acertos'])) : ?>
                     <div>
                        <button type="submit" class="btn" data-prev><i class="fa-solid fa-arrow-left"></i></button>
                        <button type="submit" class="btn" data-next><i class="fa-solid fa-arrow-right"></i></button>
                     </div>
                  <?php endif; ?>
               </footer>
            </article>

            <article class="calculator">
               <input type="text" id="display" disabled />

               <div class="calculator-body">
                  <button id="ac" class="operator">AC</button>
                  <button id="de" class="operator">DE</button>
                  <button id="." class="operator">.</button>
                  <button id="/" class="operator">/</button>

                  <button id="7">7</button>
                  <button id="8">8</button>
                  <button id="9">9</button>
                  <button id="*" class="operator">*</button>

                  <button id="4">4</button>
                  <button id="5">5</button>
                  <button id="6">6</button>

                  <button id="-" class="operator">-</button>
                  <button id="1">1</button>
                  <button id="2">2</button>
                  <button id="3">3</button>
                  <button id="+" class="operator">+</button>

                  <button id="0">0</button>
                  <button id="=" class="equal operator">=</button>
                  <button id="" class="equal operator large">Historico</button>

                  <form id="equationForm">
                     <input type="hidden" name="equacacao" value="<?= $equacao ?>" id="equacao">

                     <span>
                        <label for="coefficientA">Coeficiente A:</label>
                        <input type="number" id="coefficientA" required>
                     </span>

                     <span>
                        <label for="coefficientB"><?= $equacao == 1 ? "Termo indep." : "Coeficiente B:" ?></label>
                        <input type="number" id="coefficientB" required>
                     </span>

                     <?php if ($equacao == 2 or $equacao == 3) : ?>
                        <span>
                           <label for="coefficientC"><?= $equacao == 2 ? "Termo indep." : "Coeficiente C:" ?></label>
                           <input type="number" id="coefficientC" required>
                        </span>
                     <?php endif; ?>

                     <?php if ($equacao == 3) : ?>
                        <span>
                           <label for="coefficientD">Termo indep.:</label>
                           <input type="number" id="coefficientD" required>
                        </span>
                     <?php endif; ?>
                  </form>
               </div>

               <footer>
                  <div id="result"></div>
                  <input type="submit" value="Calcular" class="btn" form="equationForm" />
                  <input type="reset" value="Resetar" class="btn outline" form="equationForm" />
               </footer>
            </article>
         </section>
      </div>
   </main>

   <?php include_once "componentes/footer.php" ?>

   <script src="<?= url("assets/js/calculadora.js") ?>"></script>

   <script src="<?= url("assets/js/equacao.js") ?>"></script>

   <script>
      const questoes = document.querySelectorAll("[data-questao]");
      const btnPrev = document.querySelector("[data-prev]");
      const btnNext = document.querySelector("[data-next]");
      let index = 0;

      function mostrarQuestao() {
         questoes.forEach(questao => questao.classList.remove("active"));
         questoes[index].classList.add("active");
      }

      btnPrev.addEventListener("click", function() {
         if (index <= 0) return;
         index--;

         mostrarQuestao();
      });

      btnNext.addEventListener("click", function() {
         if (index >= questoes.length - 1) return;
         index++;

         mostrarQuestao();
      });

      questoes[index].classList.add("active");

      document.addEventListener("keypress", function(event) {
         if (event.code == "KeyA") btnPrev.click();
         if (event.code == "KeyD") btnNext.click();
      });
   </script>
</body>

</html>