<?php

# Verificando campos da página cadastro

if(isset($_POST['usuario']) && isset($_POST['senha']) && isset($_POST['nome'])) {

    # Conexão de banco de dados
    include '../banco.php';

    # Pegando dados que o cliente digitou no formulário
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $usuario = $_POST['usuario'];

    # Formatação da URL
    $data = "nome=" . $nome . "&usuario=" . $usuario;

    # Validação dos campos
    if (empty($nome)) {
        # mensagem de erro
        $em = "Nome é obrigatório";

        # redirecionar para 'cadastro.php' e passar mensagem de erro
        header("Location: ../../cadastro.php?error=$em");
        exit;

    } elseif (empty($usuario)) {

        $em = 'Nome de usuário é obrigatório';

        header("Location: ../../cadastro.php?error=$em&$data");
        exit;

    } elseif (empty($senha)) {

        $em = "Senha é obrigatória";

        header("Location: ../../cadastro.php?error=$em&$data");
        exit;

    } else {

        # Verificando se usuário já existe no banco de dados
        $sql = "SELECT usuario FROM usuarios WHERE usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario]); // Movido para cá

        // Condição da consulta se existe usuário
        if($stmt->rowCount() > 0) {
            $em = "Nome de usuário ($usuario) já existe!";
            header("Location: ../../cadastro.php?error=$em&$data");
            exit;
        } else {

            // Envio da foto de perfil do Usuário
            if (isset($_FILES["imgp"])) {

                // Pegando dados e armazenando-os na variável
                $img_nome = $_FILES['imgp']['name'];
                $tmp_nome = $_FILES['imgp']['tmp_name'];
                $erro = $_FILES['imgp']['error'];

                // Caso não tenha erro
                if ($erro === 0) {
                    // Guardando a imagem
                    $img_ex = pathinfo($img_nome, PATHINFO_EXTENSION);

                    // Convertendo a imagem para guardar na variável
                    $img_ex_lc = strtolower($img_ex);

                    // Permissão das extensões das imagens
                    $permissao = array("jpg", "jpeg", "png");

                    // Verificando se está dentro da extensão permitida
                    if(in_array($img_ex_lc, $permissao)) {

                        $n_img_nome = $usuario . '.' . $img_ex_lc;

                        // Caminho de Upload do diretório
                        $img_upload = "../../uploads/" . $n_img_nome;

                        // Movendo imagem para pasta uploads
                        move_uploaded_file($tmp_nome, $img_upload);

                    } else {
                        $em = "Extensão de arquivo não permitida!";
                        header("Location: ../../cadastro.php?error=$em&$data");
                        exit;

                    }

                } else {

                    $em = "Erro desconhecido ao fazer upload do arquivo!";
                    header("Location: ../../cadastro.php?error=$em&$data");
                    exit;
                } 
            }

            // Senha hashing
            $senha = password_hash($senha, PASSWORD_DEFAULT);

            // Inserindo dados no banco de dados
            if (isset($n_img_nome)) {
                // Criando os dados no banco de dados
                $sql = "INSERT INTO usuarios (nome, usuario, senha, p_p) VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$nome, $usuario, $senha, $n_img_nome]);
            } else {
                // Criando os dados no banco de dados
                $sql = "INSERT INTO usuarios (nome, usuario, senha) VALUES (?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$nome, $usuario, $senha]);
            }

            $sm = "Conta criada com sucesso!";

            // Enviando para página de login
            header("Location: ../../index.php?success=$sm");
            exit;
        }
    }
} else {

    header("Location: ../../cadastro.php");
    exit;

}
?>
