<?php
  session_start();

  # verificar se nome de usuário e senha foram enviados
  if(isset($_POST['username']) && isset($_POST['password'])) {

      # arquivo de conexão com o banco de dados
      include '../db.conn.php';

      # obter dados da solicitação POST e armazená-los em variáveis
      $password = $_POST['password'];
      $username = $_POST['username'];

      # validação simples do formulário
      if(empty($username)){
          # mensagem de erro
          $em = "Nome de usuário é obrigatório";

          # redirecionar para 'index.php' e passar a mensagem de erro
          header("Location: ../../index.php?error=$em");
      } elseif(empty($password)){
          # mensagem de erro
          $em = "Senha é obrigatória";

          # redirecionar para 'index.php' e passar a mensagem de erro
          header("Location: ../../index.php?error=$em");
      } else {
          $sql  = "SELECT * FROM users WHERE username=?";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$username]);

          # se o nome de usuário existir
          if($stmt->rowCount() === 1){
              # buscando dados do usuário
              $user = $stmt->fetch();

              # verificando a senha criptografada
              if (password_verify($password, $user['password'])) {

                  # login com sucesso
                  # criando a SESSÃO
                  $_SESSION['username'] = $user['username'];
                  $_SESSION['name'] = $user['name'];
                  $_SESSION['user_id'] = $user['user_id'];

                  # redirecionar para 'home.php'
                  header("Location: ../../home.php");
                  exit(); // termina o script após redirecionamento

              } else {
                  # mensagem de erro
                  $em = "Nome de usuário ou senha incorretos";
              }
          } else {
              # mensagem de erro
              $em = "Esse usuário não existe";

              # redirecionar para 'index.php' e passar a mensagem de erro
              header("Location: ../../index.php?error=$em");
              exit(); // termina o script após redirecionamento
          }
      }
  } else {
      header("Location: ../../index.php");
      exit;
  }
?>
