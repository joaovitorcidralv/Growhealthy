<!DOCTYPE html>
<html>
<head>
    <title>GrowHealthy</title>
    <link rel="icon" type="image/png" href="imagens/logo1.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/customize.css">
</head>
<?php require 'bd/conectaBD.php'; ?>

<div id="Sobre" class="w3-modal w3-animate-opacity" >
    <div class="w3-modal-content">
        <header class="w3-container w3-cyan">
            <span onclick="document.getElementById('Sobre').style.display='none'" class="w3-button w3-display-topright">&times;</span>


            <h2>Escolha um(a) Personal para fazer seu atendimento</h2>
			</div>

            <!-- Acesso ao BD-->
            <?php
                $idAluno = $_SESSION['id'];
                
                // Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}

                // Faz Select na Base de Dados
                $sql = "SELECT id, nome, cref FROM personal";
                echo "<div class='w3-modal-content'>";
                if ($result = $conn->query($sql)) {
                    echo "<table class='w3-table-all'>";
                    echo "	<tr>";
                    echo "	  <th>id</th>";
                    echo "	  <th>Nome</th>";
                    echo "	  <th>cref</th>";       
                    echo "	  <th> </th>";
                    echo "	  <th> </th>";
                    echo "	</tr>";
                    if ($result->num_rows > 0) {
                        // Apresenta cada linha da tabela
                        while ($row = $result->fetch_assoc() ) {
                            
                            echo "<tr>";
                            echo "</td><td>";
                            echo $row["id"];
                            echo "</td><td>";
                            echo $row["nome"];
                            echo "</td><td>";
                            echo $row['cref'];
                            echo "</td><td>";
                            ?>                      
                            <a class="w3-btn w3-cyan w3-hover-white" style="text-decoration:none" href='geral/personalSolicitar_exe.php?id=<?php echo $row['id']; ?>' class = "button">Contratar</a>
                            
                            </td><td>
                            
                            </tr>
            <?php
                        }
                    }
                        echo "</table>";
                        echo "</div>";
                } else {
                    echo "Erro executando SELECT: " . $conn->connect_error;
                }
                $conn->close();

            ?>
    </div>
</div>
