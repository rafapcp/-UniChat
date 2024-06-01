<?php
    session_start();
    //Verificando os campo Usuario e Senha

    if( isset($_POST['usuario'] ) && isset( $_POST['senha'] ) )
    {

        //Conexao com banco
        include '../banco.php';

        //Pegandos os campos digitados(Usuario e Senha)
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        //Validação dos campos
        if ( empty( $usuario ) ) {

          $em = "Campo Usuario obrigatorio";
          
          header("Location: ../../index.php?error=$em");
        
        }elseif( empty( $senha ) ){
            
            $em = "Campo Senha obrigatorio";
          
            header("Location: ../../index.php?error=$em");
  
            
        }else{

            //Verificando se o usuario ja está cadastrado no banco de dados
            $sql = "SELECT *
                    FROM usuarios
                    WHERE usuario = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([$usuario]);
            
            //Condição para verificar se está cadastrado
            if( $stmt->rowCount() === 1 ){
               
                //Verificando o usuario
               $usuario = $stmt->fetch(); 

               //Verificando se cadastro já existe
               if ( $usuario['usuario'] === $usuario ){

                    if( password_verify ($senha, $usuario ['senha'] ) ){

                        //Crinado SESSION
                        $_SESSION['usuario'] = $usuario['usuario'];
                        $_SESSION['nome'] = $usuario['nome'];
                        $_SESSION['id_usuario'] = $usuario['id_usuario'];

                        header("Location: ../../home.php");
                        
                    }else{

                        $em = "Nome de usuario ou senha incorreto ";
          
                        header("Location: ../../index.php?error=$em");
                    }

               }else{

                $em = "Nome de usuario ou senha incorreto ";

                header("Location: ../../index.php?error=$em");

               }
            }
        }

    }else{
        header("Location: ../../index.php");
        exit;
    }

?>