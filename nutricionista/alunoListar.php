<!DOCTYPE html>
<html>
<head>
    <title>GrowHealthy</title>
    <link rel="icon" type="image/png" href="imagens/logo1.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/customize.css">
</head>
<body>
<!-- Inclui MENU.PHP  -->
<?php require '../geral/menuPerfilNutricionista.php'; ?>
<?php require '../bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey" style="margin-right:250px;margin-top:100px;">
        <p class="w3-large">
        <p>
        <div class="w3-code cssHigh notranslate">
            <!-- Acesso em:-->
            <?php

                date_default_timezone_set("America/Sao_Paulo");
                $data = date("d/m/Y H:i:s", time());
                echo "<p class='w3-small' > ";
                echo "Acesso em: ";
                echo $data;
                echo "</p> "
            ?>
            <div class="w3-container w3-cyan">
			<h2>Listagem de Alunos</h2>
			</div>

            <!-- Acesso ao BD-->
            <?php
                $idNutricionista = $_SESSION['id'];
                
                // Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}


                // Faz Select na Base de Dados
                $sql = "SELECT id, nome, celular, email, dt_nasc FROM aluno WHERE nutricionista_id = '$idNutricionista'";
                echo "<div class='w3-responsive w3-card-4'>";
                if ($result = $conn->query($sql)) {
                    echo "<table class='w3-table-all'>";
                    echo "	<tr>";
                    echo "	  <th>Nome</th>";
                    echo "	  <th>Celular</th>";
                    echo "	  <th>Email</th>";       
                    echo "	  <th>Data Nascimento</th>";         
                    echo "	  <th> </th>";
                    echo "	  <th> </th>";
                    echo "	</tr>";
                    if ($result->num_rows > 0) {
                        // Apresenta cada linha da tabela
                        while ($row = $result->fetch_assoc() ) {
                            
                            echo "<tr>";
                            echo "</td><td>";
                            echo $row["nome"];
                            echo "</td><td>";
                            echo $row["celular"];
                            echo "</td><td>";
                            echo $row['email'];
                            echo "</td><td>";
                            echo $row["dt_nasc"];
                            echo "</td><td>";
                            //Atualizar e Excluir registro de personal
            ?>                      
                            <a style="text-decoration:none" class ="button w3-btn w3-cyan w3-hover-white" href='dietaAtualizar.php?id=<?php echo $row['id']; ?>'>MONTAR DIETA</a>
                            
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
    

	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->


</body>
</html>
