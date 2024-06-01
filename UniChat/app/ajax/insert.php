<?php 

session_start();

# Verifica se o usuário está logado
if (isset($_SESSION['username'])) {

	if (isset($_POST['message']) &&
        isset($_POST['to_id'])) {
	
	# Arquivo de conexão com o banco de dados
	include '../db.conn.php';

	# Obtém os dados da requisição XHR e armazena-os em variáveis
	$message = $_POST['message'];
	$to_id = $_POST['to_id'];

	# Obtém o ID do usuário logado da SESSÃO
	$from_id = $_SESSION['user_id'];

	$sql = "INSERT INTO 
	       chats (from_id, to_id, message) 
	       VALUES (?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$res  = $stmt->execute([$from_id, $to_id, $message]);
    
    # Se a mensagem for inserida com sucesso
    if ($res) {
    	/*
       Verifica se esta é a primeira
       conversa entre eles
       */
       $sql2 = "SELECT * FROM conversations
               WHERE (user_1=? AND user_2=?)
               OR    (user_2=? AND user_1=?)";
       $stmt2 = $conn->prepare($sql2);
	   $stmt2->execute([$from_id, $to_id, $from_id, $to_id]);

	    // Configurando o fuso horário
		// Isso depende da sua localização ou configurações do seu PC
		define('TIMEZONE', 'Africa/Addis_Ababa');
		date_default_timezone_set(TIMEZONE);

		$time = date("h:i:s a");

		if ($stmt2->rowCount() == 0 ) {
			# Insere-os na tabela conversations 
			$sql3 = "INSERT INTO 
			         conversations(user_1, user_2)
			         VALUES (?,?)";
			$stmt3 = $conn->prepare($sql3); 
			$stmt3->execute([$from_id, $to_id]);
		}
		?>

		<p class="rtext align-self-end
		          border rounded p-2 mb-1">
		    <?=$message?>  
		    <small class="d-block"><?=$time?></small>      	
		</p>

    <?php 
     }
  }
}else {
	header("Location: ../../index.php");
	exit;
}
