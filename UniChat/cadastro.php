<?php

    session_start();

    if (!isset($_SESSION['usuario'])){
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UniVibe - cadastro</title>

        <!-- CSS -->
        <link rel = "stylesheet" href = "style.css">
        <!-- /CSS -->

        <!-- BOOSTRAP -->
        <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <!-- /BOOSTRAP -->
        <!-- ICONE -->
        <!-- /ICONE -->
    </head>
    <body class= "d-flex justify-content-center align-items-center vh-100">
        <!-- CORPO DO SITE -->
        <div class = "brLogin p-5 shadow rounded">
            <form method = "post" action = "app/http/cadas.php" enctype ="multipart/form-data" >
                
                <div class = "d-flex justify-content aling-items-center flex-column">
                    <h3 class = "display-4 fs-1 text-center">CADASTRA-SE</h3>
                </div>

                <?php if ( isset ( $_GET['error'] ) ){ ?>

                    <div class = "alert alert-warning" role = "alert" >

                        <?php echo htmlspecialchars($_GET['error']);?>"
                    </div>
                <?php }

                    if (isset ( $_GET['nome'] ) ){

                        $name = $_GET['nome'];
                        
                    }else $nome = "";

                    if (isset ( $_GET['usuario'] ) ){

                        $usuario = $_GET['usuario'];
                        
                    }else $usuario = "";
                ?>
                
                <div class = "mb-3">
                    <label class = "form-label">Nome</label>
                    <input type="text" name = "nome" value = "<?php $nome ?>" class = "form-control">
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Nome do Usuario</label>
                    <input type="text" name = "usuario" value = "<?php $usuario ?>" class = "form-control">
                </div>
                <div class = "mb-3">
                    <label for = "form-label">Senha</label>
                    <input type = "password" name = "senha" class = "form-control">
                </div>
                <div class = "mb-3">
                    <label class = "form-label">Foto de perfil</label>
                    <input type="file" name = "imgp" class = "form-control">
                </div>
                <button type = "submit" class = "btn btn-primary">Inscrever-se</button>
                <a href = "index.php">Cadastra-se</a>
            </form>
        </div>
        <!-- /CORPO DO SITE -->
    </body>
</html>
<?php
    }else{

        header("Location: home.php");
        exit;
    } 
?>