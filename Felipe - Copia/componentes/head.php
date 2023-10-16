<?php

session_start();

function url($path = null)
{
   $url = "http://localhost/ingoG/Felipe/";
   return $url . $path;
}

function alerta()
{
   $mensagens = [
      "erro" => [
         "senha" => "Senha incorreta",
         "email" => "Email incorreto",
         "email_existe" => "Email já existe",
         "imagem" => "Erro ao fazer upload da imagem",

         "session" => "Você deve estar conectado",
         "cadastrar" => "Erro ao cadastrar",

         "deletar_questao" => "Erro ao deletar questão",
         "deletar_alternativa" => "Erro ao deletar alternativa",
      ],
      "sucesso" => [
         "cadastrar" => "Cadastrado com sucesso",
         "deletar" => "Deletado com sucesso",
         "editar" => "Editado com sucesso",

         "mensagem" => "Mensagem enviada",
      ]
   ];

   if (!empty($_GET["erro"])) {
      $chave = $_GET["erro"];
      $mensagem  = $mensagens["erro"][$chave] ?? null;

      return
         "<div class=\"alerta erro\">
                <p>{$mensagem}</p>
                <button>X</button>
              </div>";
   };

   if (!empty($_GET["sucesso"])) {
      $chave = $_GET["sucesso"];
      $mensagem  = $mensagens["sucesso"][$chave] ?? null;

      return
         "<div class=\"alerta sucesso\">
                <p>{$mensagem}</p>
                <button>X</button>
              </div>";
   };

   return "";
}

?>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="shortcut icon" href="<?= url("assets/imagens/logo.png") ?>" type="image/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <link rel="stylesheet" type="text/css" href="<?= url("assets/css/estilo.css") ?>">

   <title>Equações</title>

   <script>
      window.addEventListener("load", function() {
         document.body.classList.add("loaded");
      })
   </script>
</head>