<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Março/2023
---------------------------------------------------------------------------------->
<!-- profListar.php -->

<html>
<head>
    <title>IE - Instituição de Ensino</title>
    <link rel="icon" type="image/png" href="imagens/IE_favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body  onload="w3_show_nav('menuProf')">
<!-- Inclui MENU.PHP  -->
<?php require 'geral/menu.php'; ?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
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
            <div class="w3-container w3-theme">
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
                $sql = "SELECT ID_Usuario, Nome, Celular, DataNasc, Login, Foto FROM TB_Usuario WHERE ID_TipoUsu = 2";
                echo "<div class='w3-responsive w3-card-4'>";
                if ($result = $conn->query($sql)) {
                    echo "<table class='w3-table-all'>";
                    echo "	<tr>";
                    echo "	  <th>Código</th>";
                    echo "	  <th>Imagem</th>";
                    echo "	  <th>Nome</th>";
                    echo "	  <th>Celular</th>";
                    echo "	  <th>Data Nascimento</th>";
                    echo "	  <th>Login</th>";
                    echo "	  <th> </th>";
                    echo "	  <th> </th>";
                    echo "	</tr>";
                    if ($result->num_rows > 0) {
                        // Apresenta cada linha da tabela
                        while ($row = $result->fetch_assoc() ) {
                            $dataN = explode('-', $row["DataNasc"]);
                            $ano = $dataN[0];
                            $mes = $dataN[1];
                            $dia = $dataN[2];
                            $cod = $row["ID_Usuario"];
                            $nova_data = $dia . '/' . $mes . '/' . $ano;
                            echo "<tr>";
                            echo "<td>";
                            echo $cod;
                            echo "</td>";
                            if ($row['Foto']) {?>
                                <td>
                                    <img id="imagemSelecionada" class="w3-circle w3-margin-top" src="data:image/png;base64,<?= base64_encode($row['Foto']) ?>" />
                                </td><td>
                                <?php
                            } else {
                                ?>
                                <td>
                                    <img id="imagemSelecionada" class="w3-circle w3-margin-top" src="imagens/pessoa.jpg" />
                                </td><td>
                                <?php
                            }
                            echo $row["Nome"];
                            echo "</td><td>";
                            echo $row["Celular"];
                            echo "</td><td>";
                            echo $nova_data;
                            echo "</td><td>";
                            echo $row["Login"];
                            echo "</td><td>";
                            //Atualizar e Excluir registro de prof
            ?>                      
                            <a href='profAtualizar.php?id=<?php echo $cod; ?>'><img src='imagens/Edit.png' title='Editar Professor' width='32'></a>
                            </td><td>
                            <a href='profExcluir.php?id=<?php echo $cod; ?>'><img src='imagens/Delete.png' title='Excluir Professor' width='32'></a>
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
