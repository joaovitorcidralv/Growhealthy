<?php
// Estabelecer a conexão com o banco de dados
require '../bd/conectaBD.php';

// Cria conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verifica conexão 
if ($conn->connect_error) {
    die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
}

$idNutricionista = $_GET['id'];

session_start();
if (isset($_SESSION['id'])) {
    $idAluno = $_SESSION['id'];
}
$sql = "UPDATE aluno SET nutricionista_id='$idNutricionista' WHERE id = '$idAluno'";

$resultado = mysqli_query($conn, $sql);
if ($resultado) {
    echo "Query executada com sucesso!";
} else {
    echo "Erro ao executar a query: " . mysqli_error($conexao);
}
