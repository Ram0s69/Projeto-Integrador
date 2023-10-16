<!DOCTYPE html>
<html lang="pt-br">

<?php include_once "componentes/head.php" ?>

<body>
   <?php include_once "componentes/header.php" ?>

   <main>
      <div class="container-forms">
         <form action="php/login.php" method="post" class="active" id="form-login">
            <h2 class="titulo">Login</h2>

            <?= alerta() ?>

            <input type="hidden" name="operacao" value="verificar">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <input type="submit" value="Entrar" class="btn">
            <button class="btn-muda" type="button">Não possui uma conta? Registrar-se</button>
         </form>

         <form method="post" action="php/login.php" id="form-register" enctype="multipart/form-data">
            <h2 class="titulo">Criar conta</h2>

            <input type="hidden" name="operacao" value="criar">

            <label for="imagem">Imagem de perfil:</label>
            <input type="file" id="imagem" name="imagem" required>

            <label for="nome">Nome completo:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="nascimento">Data de nascimento:</label>
            <input type="date" id="nascimento" name="nascimento" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" minlength="3" required>

            <input type="submit" class="btn">
            <button class="btn-muda" type="button">Já possui uma conta? Fazer login</button>
         </form>
      </div>
   </main>

   <?php include_once "componentes/footer.php" ?>

   <script>
      const login = document.querySelector("#form-login");
      const register = document.querySelector("#form-register");
      const btns = document.querySelectorAll(".btn-muda");

      btns.forEach(btn => {
         btn.addEventListener("click", function() {
            if (login.classList.contains("active")) {
               login.classList.remove("active");
               register.classList.add("active");
               return;
            }

            login.classList.add("active");
            register.classList.remove("active");
         });
      });
   </script>
</body>

</html>