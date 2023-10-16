<?php

session_start();
if (!isset($_SESSION['usuario'])) header("Location: login.php?erro=session");

include_once "conexao.php";

$operacao = $_POST['operacao'] ?? "";

if ($operacao == "criar") {
   $id_usuario = $_SESSION['usuario']['idUsuario'];
   $mensagem = $_POST['mensagem'];

   $sql = "INSERT INTO contato(usuario_idUsuario, mensagem) VALUES('$id_usuario', '$mensagem');";
   $conexao->query($sql);

   header("Location: ../contato.php?sucesso=mensagem");
   exit();
}

if ($operacao == "editar") {
   $id_questao = $_POST['questao'];

   $idsuario = $_POST['enunciado'];
   $resposta = $_POST['resposta'];
   $tipo_equacao = $_POST['tipo_equacao'];
   $dificuldade = $_POST['dificuldade'];

   $alternativas = explode(",", $_POST['alternativas']);

   $sql = "UPDATE questao SET enunciado = '$enunciado', resposta = '$resposta', tipo_equacao = '$tipo_equacao', dificuldade = '$dificuldade' WHERE idQuestao = $id_questao";
   $conexao->query($sql);

   $sql = "DELETE FROM alternativa WHERE idQuestao = $id_questao";
   $conexao->query($sql);

   foreach ($alternativas as $alternativa) {
      $sql = "INSERT INTO alternativa(idQuestao, texto) VALUES('$id_questao', '$alternativa');";
      $conexao->query($sql);
   }

   header("Location: ../perfil.php");
   exit();
}


if ($operacao == "excluir") {
   $questao = $_POST['questao'];

   $sql = "DELETE FROM alternativa WHERE idQuestao = {$questao}";
   if (!$conexao->query($sql)) {
      header("Location: ../perfil.php?erro=deletar_alternativa");
      exit();
   }

   $sql = "DELETE FROM questao WHERE idQuestao = {$questao}";
   if ($conexao->query($sql)) {
      header("Location: ../perfil.php?sucesso=deletar_questao");
   } else {
      header("Location: ../perfil.php?erro=deletar_questao");
   }

   exit();
}
