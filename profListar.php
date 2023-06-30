<!DOCTYPE html>

<html>
<head>
    <title>GrowHealthy</title>
    <link rel="icon" type="image/png" href="imagens/logo1.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body  onload="w3_show_nav('menuProf')">
<!-- Inclui MENU.PHP  -->
<?php require 'geral/menu.php'; ?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:15px;margin-right:270px;">

    <div class="w3-main w3-container" style="margin-left:270px;margin-top:200px;margin-right:270px;">
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
            <div class="w3-main w3-container" style="margin-left:270px;margin-top:200px;margin-right:270px;">
			<h2>Listagem de Professores</h2>
			</div>

            <!-- Acesso ao BD-->
            <?php

                // Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}


                // Faz Select na Base de Dados
                $sql = "SELECT id, Nome, celular, Email FROM aluno WHERE personal_id = $_SESSION ['id']";
                echo "<div class='w3-responsive w3-card-4'>";
                if ($result = $conn->query($sql)) {
                    echo "<table class='w3-table-all'>";
                    echo "	<tr>";
                    echo "	  <th>Nome</th>";
                    echo "	  <th>Celular</th>";
                    echo "	  <th>Email</th>";                
                    echo "	  <th> </th>";
                    echo "	  <th> </th>";
                    echo "	</tr>";
                    if ($result->num_rows > 0) {
                        // Apresenta cada linha da tabela
                        while ($row = $result->fetch_assoc() ) {
                            $dataN = explode('-', $row["dt_nasc"]);
                            $ano = $dataN[0];
                            $mes = $dataN[1];
                            $dia = $dataN[2];
                            $nova_data = $dia . '/' . $mes . '/' . $ano;
                            echo "<tr>";
                            echo $row["Nome"];
                            echo "</td><td>";
                            echo $row["Celular"];
                            echo "</td><td>";
                            echo $nova_data;
                            echo "</td><td>";
                            echo $row["login"];
                            echo "</td><td>";
                            //Atualizar e Excluir registro de personal
            ?>                      
                            <a href='profAtualizar.php'><img src='imagens/Edit.png' title='Editar Personal' width='32'></a>
                            </td><td>
                            <a href='profExcluir.php'><img src='imagens/Delete.png' title='Excluir Personal' width='32'></a>
                            </td>
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
    
	<?php require 'geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'geral/rodape.php';?>

</body>
</html>
