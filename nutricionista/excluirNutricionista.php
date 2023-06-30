<?php 
    require '../geral/menuPerfilNutricionista.php'; 
	require '../bd/conectaBD.php'; 
    $idNutricionista    = $_SESSION ['id'];
    
    // Cria conexão
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica conexão 
    if ($conn->connect_error) {
        die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
    }

    // Faz Select na Base de Dados
    $sql = "DELETE FROM nutricionista WHERE id= '$idNutricionista'";

    if ($conn->query($sql) === true) {
        echo "<script>alert('A conta foi excluída com sucesso.');</script>";
    } else {
        $errorMsg = "Erro ao excluir a conta: " . $conn->error;
        echo "<script>alert('$errorMsg');</script>";
    }
    

        // Fecha a conexão com o banco de dados
        $conn->close();
        session_destroy();
        header ("Location:../logout.php");
        exit();
    ?>