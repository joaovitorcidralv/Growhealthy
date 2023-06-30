<?php 
    require 'bd/conectaBD.php'; 
    require 'aluno.php';
    

    $idALuno    = $_SESSION ['id'];
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Recupera os valores enviados
        $email = $_POST["Email"];
        $altura = $_POST["Altura"];
        $peso = $_POST["Peso"];
        $restricaoFisica = $_POST["restFisica"];
        $restricaoAlimentar = $_POST["restAlimentar"];
        $senhaNova  = $_POST["SenhaL"];
        
    }

    // Cria conexão
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica conexão 
    if ($conn->connect_error) {
        die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
    }

    // Faz Select na Base de Dados
    $sql = "UPDATE aluno SET email='$email', altura='$altura', peso='$peso', restricoesFisicas='$restricaoFisica', restricoesAlimentares='$restricaoAlimentar'  WHERE id = '$idAluno'";
    //Inicio DIV form
    echo "<div class='w3-responsive w3-card-4'>";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado) {
        echo "Query executada com sucesso!";
    } else {
    echo "Erro ao executar a query: " . mysqli_error($conexao);
}
?>
    