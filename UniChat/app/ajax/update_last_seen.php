<?php  

session_start();

# Verifica se o usuário está logado
if (isset($_SESSION['username'])) {
	
	# Arquivo de conexão com o banco de dados
	include '../db.conn.php';

	# Obtém o nome de usuário do usuário logado da SESSÃO
	$id = $_SESSION['user_id'];

	$sql = "UPDATE users
	        SET last_seen = NOW() 
	        WHERE user_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

}else {
	header("Location: ../../index.php");
	exit;
}
