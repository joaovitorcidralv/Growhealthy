<html>


<head>
    <meta charset="UTF-8">
    <title>GrowHealthy</title>
    <link rel="icon" type="image/png" href="imagens/logo1.png" />
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
    $email   = $conn->real_escape_string($_POST['Email']);
    $senha   = $conn->real_escape_string($_POST['Senha']);   // prepara a string recebida para ser utilizada em comando SQL
    $dt_nasc = $conn->real_escape_string($_POST['dt_nasc']); // prepara a string recebida para ser utilizada em comando SQL
    $genero  = $conn->real_escape_string($_POST['genero']);  // prepara a string recebida para ser utilizada em comando SQL
    $cpf     = $conn->real_escape_string($_POST['cpf']);  // prepara a string recebida para ser utilizada em comando SQL
    $tipo    = $conn->real_escape_string($_POST['tipo']);  // prepara a string recebida para ser utilizada em comando SQL
    $crn     = $conn->real_escape_string($_POST['crn']);  // prepara a string recebida para ser utilizada em comando SQL
    $cref    = $conn->real_escape_string($_POST['cref']);  // prepara a string recebida para ser utilizada em comando SQL
    $peso    = $conn->real_escape_string($_POST['peso']);  // prepara a string recebida para ser utilizada em comando SQL
    $altura  = $conn->real_escape_string($_POST['altura']);  // prepara a string recebida para ser utilizada em comando SQL

    

    $verify = true;
    $dado = '';
    // Não recebe uma imagem binária e faz Insert na Base de Dados
    if ($tipo == 'aluno') {
    $sql = "INSERT INTO Aluno (cpf, login, celular, nome, Genero, email,Peso,Altura,senha)
     VALUES ('$cpf','$login','$celular', '$nome', '$genero','$email','$peso','$altura','$senha')";
        $find = "SELECT * FROM Aluno WHERE cpf = '$cpf'";
        $verify = ($conn->query($find)->num_rows == 0);
        $dado = 'cpf';
    }
    elseif($tipo == 'personal') {
    $sql = "INSERT INTO Personal (Nome, Genero, Email, CREF, login, dt_nasc, cpf, celular, senha)
    VALUES ('$nome','$genero','$email', '$cref', '$login','$dt_nasc','$cpf','$celular','$senha')"; 
   
        $find = "SELECT * FROM Personal WHERE cpf = '$cpf'"; 
        $find2 = "SELECT * FROM Personal WHERE CREF = '$cref'";
        $verify = ($conn->query($find)->num_rows + $conn->query($find2)->num_rows == 0);  
        $dado = 'Cref ou Cpf'; 

    }
    elseif($tipo == 'nutricionista') {
        $sql = "INSERT INTO Nutricionista (Nome, Genero, Email, CRN, login, dt_nasc, cpf, celular, senha)
        VALUES ('$nome','$genero','$email', '$crn', '$login','$dt_nasc','$cpf','$celular','$senha')"; 
            

        $find = "SELECT * FROM Nutricionista WHERE cpf = '$cpf'"; 
        $find2 = "SELECT * FROM Nutricionista WHERE CRN = '$crn'";
        $verify = ($conn->query($find)->num_rows + $conn->query($find2)->num_rows == 0);  
        $dado = 'Cref ou Cpf'; 

        }

    

    if ($verify) {
        if ($result = $conn->query($sql)) {
            $msg = "Registro cadastrado com sucesso! Você já pode realizar login.";
        } else {
            $msg = "Erro executando INSERT: " . $conn-> error . " Tente novo cadastro.";
        } 


    
    } else {
        $msg = $dado." cadastrado(s). Por favor preencha com novos dados.";
    }





    $_SESSION['nao_autenticado'] = true;
    $_SESSION['mensagem_header'] = "Cadastro";
    $_SESSION['mensagem'] = $msg;
    $conn->close();  //Encerra conexao com o BD
    header('location: index.php'); 
    ?>
</body>
</html>
