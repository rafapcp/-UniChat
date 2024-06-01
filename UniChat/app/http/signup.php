<?php  

# verificar se o nome de usuário, senha e nome foram enviados
if(isset($_POST['username']) &&
   isset($_POST['password']) &&
   isset($_POST['name'])){

   # arquivo de conexão com o banco de dados
   include '../db.conn.php';
   
   # obter dados da solicitação POST e armazená-los em variáveis
   $name = $_POST['name'];
   $password = $_POST['password'];
   $username = $_POST['username'];

   # formatar os dados para a URL
   $data = 'name='.$name.'&username='.$username;

   # validação do formulário
   if (empty($name)) {
   	  # mensagem de erro
   	  $em = "O nome é obrigatório";

   	  # redirecionar para 'signup.php' e passar a mensagem de erro
   	  header("Location: ../../signup.php?error=$em");
   	  exit;
   }else if(empty($username)){
      # mensagem de erro
   	  $em = "O nome de usuário é obrigatório";

   	  /*
    	redirecionar para 'signup.php' e 
    	passar a mensagem de erro e dados
      */
   	  header("Location: ../../signup.php?error=$em&$data");
   	  exit;
   }else if(empty($password)){
   	  # mensagem de erro
   	  $em = "A senha é obrigatória";

   	  /*
    	redirecionar para 'signup.php' e 
    	passar a mensagem de erro e dados
      */
   	  header("Location: ../../signup.php?error=$em&$data");
   	  exit;
   }else {
   	  # verificando no banco de dados se o nome de usuário está em uso
   	  $sql = "SELECT username 
   	          FROM users
   	          WHERE username=?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$username]);

      if($stmt->rowCount() > 0){
      	$em = "O nome de usuário ($username) já está em uso";
      	header("Location: ../../signup.php?error=$em&$data");
   	    exit;
      }else {
      	# Upload da Foto de Perfil
      	if (isset($_FILES['pp'])) {
      		# obter dados e armazená-los em variáveis
      		$img_name  = $_FILES['pp']['name'];
      		$tmp_name  = $_FILES['pp']['tmp_name'];
      		$error  = $_FILES['pp']['error'];

      		# se não houver erro ao fazer o upload
      		if($error === 0){
               
               # obter a extensão da imagem e armazená-la em uma variável
      		   $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

               /* 
			    Converter a extensão da imagem para letras minúsculas 
				e armazená-la em uma variável 
				**/
				$img_ex_lc = strtolower($img_ex);

				/* 
				Criar um array que armazena as extensões de imagem permitidas para upload.
				*/
				$allowed_exs = array("jpg", "jpeg", "png");

				/*
				Verificar se a extensão da imagem está presente no array $allowed_exs
				*/
				if (in_array($img_ex_lc, $allowed_exs)) {
					/*
					 Renomear a imagem com o nome de usuário do usuário
					 como: username.$img_ex_lc
					*/
					$new_img_name = $username. '.'.$img_ex_lc;

					# criar o caminho de upload na pasta raiz
					$img_upload_path = '../../uploads/'.$new_img_name;

					# mover a imagem enviada para a pasta ./upload
                    move_uploaded_file($tmp_name, $img_upload_path);
				}else {
					$em = "Você não pode enviar arquivos desse tipo";
			      	header("Location: ../../signup.php?error=$em&$data");
			   	    exit;
				}

      		}
      	}

      	// criptografia da senha
      	$password = password_hash($password, PASSWORD_DEFAULT);

      	# se o usuário enviar uma Foto de Perfil
      	if (isset($new_img_name)) {

      		# inserir dados no banco de dados
            $sql = "INSERT INTO users
                    (name, username, password, p_p)
                    VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $username, $password, $new_img_name]);
      	}else {
            # inserir dados no banco de dados
            $sql = "INSERT INTO users
                    (name, username, password)
                    VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $username, $password]);
      	}

      	# mensagem de sucesso
      	$sm = "Conta criada com sucesso";

      	# redirecionar para 'index.php' e passar a mensagem de sucesso
      	header("Location: ../../index.php?success=$sm");
     	exit;
      }

   }
}else {
	header("Location: ../../signup.php");
   	exit;
}
?>
