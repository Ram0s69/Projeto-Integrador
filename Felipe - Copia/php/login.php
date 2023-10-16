<?php

session_start();

include_once 'conexao.php';

$operacao = $_POST['operacao'] ?? '';

if ($operacao == 'criar') {
   $nome = $_POST['nome'];
   $nascimento = $_POST['nascimento'];
   $email = $_POST['email'];
   $senha =  password_hash($_POST['senha'], PASSWORD_BCRYPT);
   $email = $_POST['email'];

   $sql = "SELECT * FROM usuario WHERE email = '$email';";
   if ($conexao->query($sql)->num_rows > 0) {
      header("Location: ../login.php?erro=email_existe");
      exit();
   }

   $imagem = $_FILES['imagem'];
   $nova_imagem = rand() . '.' . pathinfo($imagem['name'], PATHINFO_EXTENSION);
   $arquivo = "../uploads/{$nova_imagem}";

   if (!move_uploaded_file($imagem['tmp_name'], $arquivo)) {
      header("Location: ../login.php?erro=imagem");
      exit();
   }

   $sql = "INSERT INTO usuario(nome, data_nascimento, email, senha, imagem) VALUES('$nome', '$nascimento', '$email', '$senha', '$nova_imagem');";

   if ($conexao->query($sql)) {
      header("Location: ../login.php?sucesso=cadastrar");
      exit();
   }

   header("Location: ../login.php?erro=cadastrar");
   exit();
}

if ($operacao == 'verificar') {
   $email = $_POST['email'];
   $senha = $_POST['senha'];

   $sql = "SELECT * FROM usuario WHERE email = '$email';";

   if ($conexao->query($sql)->num_rows <= 0) {
      header("Location: ../login.php?erro=email");
      exit();
   }

   $usuario = $conexao->query($sql)->fetch_assoc();
   $senha_usuario = $usuario["senha"];

   if (!password_verify($senha, $senha_usuario)) {
      header("Location: ../login.php?erro=senha");
      exit();
   }

   unset($usuario["senha"]);
   $_SESSION['usuario'] = $usuario;

   header("Location: ../index.php");
   exit();
}

if ($operacao == 'excluir') {
   $id_usuario = $_POST['id_usuario'];

   $sql = "DELETE FROM contato WHERE usuario_idUsuario = $id_usuario";
   $conexao->query($sql);

   $sql = "DELETE FROM usuario WHERE idUsuario = $id_usuario";

   $arquivo = "../uploads/{$_SESSION['usuario']["imagem"]}";
   unlink($arquivo);

   if ($conexao->query($sql)) {
      session_unset();
      session_destroy();

      header("Location: ../login.php?sucesso=deletar");
      exit();
   } else {
      header("Location: ../perfil.php?erro=deletar");
      exit();
   }
}

if ($operacao == 'desconectar') {
   session_unset();
   session_destroy();

   header("Location: ../login.php");
   exit();
}

if ($operacao == 'update') {
   $codigo = $_POST['codigo'];
   $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
   $nascimento = isset($_POST["nascimento"]) ? $_POST["nascimento"] : "";
   $cidade = isset($_POST["cidade"]) ? $_POST["cidade"] : "";
   $email = isset($_POST["email"]) ? $_POST["email"] : "";
   $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";

   $sql = "UPDATE usuarios SET ";

   if (!empty($_POST["nome"])) {
      $sql .= "nome='$nome', ";
   }

   if (!empty($_POST["nascimento"])) {
      $sql .= "data_nas='$nascimento', ";
   }

   if (!empty($_POST["cidade"])) {
      $sql .= "cidade='$cidade', ";
   }

   if (!empty($_POST["email"])) {
      $sql .= "`e-mail`='$email', ";
   }

   if (!empty($_POST["senha"])) {
      $sql .= "senha='$senha', ";
   }

   $sql = rtrim($sql, ", ");

   $sql .= " WHERE idusuarios='$codigo'";

   mysqli_query($conexao, $sql);
   $linhas = mysqli_affected_rows($conexao);
   if ($linhas == 1) {
      echo '<p class="text-center">Cliente alterado.</p>';
      echo '<p class="text-center"><a href="pessoa.html"> Voltar</a></p>';
   } else {
      echo '<p class="text-center">Cliente não encontrado.</p>';
      echo '<p class="text-center"><a href="pessoa.html"> Voltar</a></p>';
   }

   exit();
}
