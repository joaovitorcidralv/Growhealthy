<html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Março/2023
---------------------------------------------------------------------------------->
<!-- Cadastro.php -->

<head>
    <meta charset="UTF-8">
    <title>IE - Instituição de Ensino</title>
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

    $nome    = $conn->real_escape_string($_POST['nome']);    // prepara a string recebida para ser utilizada em comando SQL
    $login   = $conn->real_escape_string($_POST['Login']);   // prepara a string recebida para ser utilizada em comando SQL
    $celular = $conn->real_escape_string($_POST['Celular']); // prepara a string recebida para ser utilizada em comando SQL
    $senha   = $conn->real_escape_string($_POST['Senha']);   // prepara a string recebida para ser utilizada em comando SQL
    $dt_nasc = $conn->real_escape_string($_POST['dt_nasc']); // prepara a string recebida para ser utilizada em comando SQL
    $genero  = $conn->real_escape_string($_POST['genero']);  // prepara a string recebida para ser utilizada em comando SQL

    //Criptografa Senha
	$md5Senha = md5($senha);
        
    $tipoUsu = 1; // Usuário Administrador

    // Não recebe uma imagem binária e faz Insert na Base de Dados
    $sql = "INSERT INTO TB_Usuario (Nome, Celular, DataNasc, ID_Genero, Login, Senha, ID_TipoUsu, Foto) VALUES ('$nome','$celular','$dt_nasc', '$genero','$login','$md5Senha', $tipoUsu, NULL)";

    if ($result = $conn->query($sql)) {
        $msg = "Registro cadastrado com sucesso! Você já pode realizar login.";
    } else {
        $msg = "Erro executando INSERT: " . $conn-> error . " Tente novo cadastro.";
    }
    $_SESSION['nao_autenticado'] = true;
    $_SESSION['mensagem_header'] = "Cadastro";
    $_SESSION['mensagem']        = $msg;
    $conn->close();  //Encerra conexao com o BD
    header('location: index.php'); 
    ?>
</body>
</html>