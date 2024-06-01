<?php 

function getConversation($user_id, $conn){
    /*
      Obtendo todas as conversas 
      para o usuário atual (logado)
    */
    $sql = "SELECT * FROM conversations
            WHERE user_1=? OR user_2=?
            ORDER BY conversation_id DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $user_id]);

    if($stmt->rowCount() > 0){
        $conversations = $stmt->fetchAll();

        /*
          Criando um array vazio para 
          armazenar a conversa do usuário
        */
        $user_data = [];
        
        # Loop através das conversas
        foreach($conversations as $conversation){
            # Se a linha user_1 das conversas for igual ao user_id
            if ($conversation['user_1'] == $user_id) {
            	$sql2  = "SELECT *
            	          FROM users WHERE user_id=?";
            	$stmt2 = $conn->prepare($sql2);
            	$stmt2->execute([$conversation['user_2']]);
            } else {
            	$sql2  = "SELECT *
            	          FROM users WHERE user_id=?";
            	$stmt2 = $conn->prepare($sql2);
            	$stmt2->execute([$conversation['user_1']]);
            }

            $allConversations = $stmt2->fetchAll();

            # Inserindo os dados no array 
            array_push($user_data, $allConversations[0]);
        }

        return $user_data;

    } else {
    	$conversations = [];
    	return $conversations;
    }  

}
