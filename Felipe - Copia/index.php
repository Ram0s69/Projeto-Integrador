<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "componentes/head.php" ?>

<body>
   <?php include_once "componentes/header.php" ?>

   <main class="explicacao">
      <div class="container">
         <h2 class="titulo">Teoria e Explicações</h2>

         <article class="texto">
            <h3 class="subtitulo">Primeiro Grau</h3>

            <p>
               A equação de primeiro grau é uma sentença matemática que possui uma incógnita elevada ao grau 1. Incógnitas são representadas por letras, denotando valores desconhecidos, e a igualdade é fundamental na equação.
               A forma geral da equação de primeiro grau é <span class="simbolo-matematico">ax + b = 0</span>, onde "a" e "b" são números reais, e "a" é diferente de zero.
               O objetivo ao escrever uma equação de primeiro grau é encontrar o valor da incógnita que satisfaça a igualdade, conhecido como solução ou raiz da equação.
            </p>
         </article>

         <article class="texto">
            <h3 class="subtitulo">Segundo Grau</h3>

            <p>
               A equação de segundo grau é caracterizada pela presença da variável "x" elevada ao quadrado "²", tendo a seguinte forma geral: <span class="simbolo-matematico">ax² + bx + c = 0</span>.
               Para que a equação seja válida, os coeficientes "a", "b" e "c" devem pertencer aos números reais, sendo "a" diferente de zero.
               A forma mais tradicional de resolver uma equação quadrática é utilizando a fórmula de Bhaskara. Essa fórmula é um método para encontrar as raízes reais de uma equação de segundo grau, fazendo uso apenas de seus coeficientes. Vale lembrar que coeficiente é o número que multiplica uma incógnita na equação.
               A fórmula de Bhaskara é dada pela seguinte expressão:
            </p>

            <img src="<?= url("assets/imagens/bhaskara.webp") ?>" alt="Imagem do Card" width="250">
         </article>

         <article class="texto">
            <h3 class="subtitulo">Terceiro Grau</h3>
            <p>
               Uma equação de terceiro grau, também conhecida como equação cúbica, é uma equação polinomial onde a maior potência da variável é três.
               Essas equações podem ser escritas na forma geral: <span class="simbolo-matematico">ax³+bx²+cx+d=0</span>.
               As equações cúbicas podem ter até três soluções reais ou complexas. A solução para essas equações pode ser encontrada através de métodos analíticos ou numéricos, dependendo das propriedades específicas da equação. Uma das abordagens é usar a fórmula de Cardano-Tartaglia para encontrar as raízes, embora seja uma fórmula complexa e não muito prática para equações gerais.
            </p>
         </article>

         <section class="cards-acessar-exercicios">
            <h3 class="subtitulo">Para um melhor entendimento, é recomendado praticar alguns exercícios</h3>
            <small>A resolução de problemas reais ajuda a consolidar o conhecimento teórico e a aprimorar as habilidades de resolução de equações matemáticas.</small>

            <div class="card-container">
               <article class="card">
                  <div class="card-content">
                     <h3 class="subtitulo">Primeiro Grau</h3>

                     <form action="<?= url("nivel-exercicio.php") ?>" method="post">
                        <button type="submit" class="btn card-btn">Acessar lista de exercícios</button>
                        <input type="hidden" name="equacao" value="1">
                     </form>
                  </div>
               </article>

               <article class="card">
                  <div class="card-content">
                     <h3 class="subtitulo">Segundo Grau</h3>

                     <form action="<?= url("nivel-exercicio.php") ?>" method="post">
                        <button type="submit" class="btn card-btn">Acessar lista de exercícios</button>
                        <input type="hidden" name="equacao" value="2">
                     </form>
                  </div>
               </article>

               <article class="card">
                  <div class="card-content">
                     <h3 class="subtitulo">Terceiro Grau</h3>

                     <form action="<?= url("nivel-exercicio.php") ?>" method="post">
                        <button type="submit" class="btn card-btn">Acessar lista de exercícios</button>
                        <input type="hidden" name="equacao" value="3">
                     </form>
                  </div>
               </article>
            </div>
         </section>
      </div>
   </main>

   <?php include_once "componentes/footer.php" ?>
</body>

</html>