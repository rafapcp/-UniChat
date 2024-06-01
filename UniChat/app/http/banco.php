<?php

    #Nome do servidor
    $sNome = "localhost";
    #nome do usuario
    $uNome = "root";
    #Senha
    $senhaBanc = "";
    #Nome do banco de dados
    $nome_banco = "uniVibe";
    

    try 
    {
        $conn = new PDO ("mysql:host=$sNome; nome_banco = $nome_banco", $uNome, $senhaBanc);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){

        echo "Falha de Conexão: ". $e->getMessage();
    
    }
?>