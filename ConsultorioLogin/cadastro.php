<html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Agosto/2022
---------------------------------------------------------------------------------->
<!-- Cadastro.php -->

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

    $nome    = $conn->real_escape_string($_POST['nome']); // prepara a string recebida para ser utilizada em comando SQL
    $login   = $conn->real_escape_string($_POST['Login']); // prepara a string recebida para ser utilizada em comando SQL
    $celular = $conn->real_escape_string($_POST['Celular']); // prepara a string recebida para ser utilizada em comando SQL
    $senha   = $conn->real_escape_string($_POST['Senha1']); // prepara a string recebida para ser utilizada em comando SQL

    // Faz Insert na Base de Dados
    $sql = "INSERT INTO Usuario (Nome, Celular, Login, Senha) VALUES ('$nome','$celular','$login',md5('$senha'))";

    if ($result = $conn->query($sql)) {
        $msg = "Registro cadastrado com sucesso! Você já pode realizar login.";
        $_SESSION['nao_autenticado'] = true;
        $_SESSION['mensagem_header'] = "Cadastro";
        $_SESSION['mensagem']        = $msg;
        header('location: /ConsultorioLogin/index.php');
        exit();
    } else {
        $msg = "Erro executando INSERT: " . $conn->error . " Tente novo cadastro.";
        $_SESSION['nao_autenticado'] = true;
        $_SESSION['mensagem_header'] = "Cadastro";
        $_SESSION['mensagem']        = $msg;
        header('location: /ConsultorioLogin/index.php'); //Redireciona para página inicial, para tentativa de login com o 
        // usuário recém cadastrado

        exit();
    }
    header('location: index.php');

    $conn->close();  //Encerra conexao com o BD
    ?>
</body>

</html>