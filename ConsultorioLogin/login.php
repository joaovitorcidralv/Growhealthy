<html>
    <!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Agosto/2022
---------------------------------------------------------------------------------->
<!-- Login.php --> 
	<head>
    <meta charset="UTF-8">
      <title>Clínica Médica ABC</title>
	  <link rel="icon" type="image/png" href="imagens/favicon.png" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="css/customize.css">
	</head>
<body>

<?php
    session_start(); // informa ao PHP que iremos trabalhar com sessão
    require 'bd/conectaBD.php'; 

    // Cria conexão
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica conexão 
    if ($conn->connect_error) {
        die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
    }

    $usuario = $conn->real_escape_string($_POST['Login']); // prepara a string recebida para ser utilizada em comando SQL
    $senha   = $conn->real_escape_string($_POST['Senha']); // prepara a string recebida para ser utilizada em comando SQL
    
    // Faz Select na Base de Dados
    $sql = "SELECT ID_Usuario, nome FROM Usuario WHERE login = '$usuario' AND senha = md5('$senha')";
    if ($result = $conn->query($sql)) {
        if ($result->num_rows == 1) {         // Deu match: login e senha combinaram
            $row = $result->fetch_assoc();
            $_SESSION ['login']       = $usuario;           // Ativa as variáveis de sessão
            $_SESSION ['ID_Usuario']  = $row['ID_Usuario'];
            $_SESSION ['nome']        = $row['nome'];
            unset($_SESSION ['nao_autenticado']);
            unset($_SESSION ['mensagem_header'] ); 
            unset($_SESSION ['mensagem'] ); 
            header('location: /ConsultorioLogin/medlistar.php'); // Redireciona para a página de funcionalidades.
            exit();
            
        }else{
            $_SESSION ['nao_autenticado'] = true;         // Ativa ERRO nas variáveis de sessão
            $_SESSION ['mensagem_header'] = "Login";
            $_SESSION ['mensagem']        = "ERRO: Login ou Senha inválidos.";
            header('location: /ConsultorioLogin/index.php'); // Redireciona para página inicial
            exit();
        }
    }
    else {
        echo "Erro ao acessar o BD: " . $conn ->error;
    }
    $conn->close();  //Encerra conexao com o BD
?>
	</body>
</html>