<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Março/2023
---------------------------------------------------------------------------------->
<!-- turmasProfListar.php -->

<html>

<head>
    <meta charset="UTF-8">
    <title>IE - Instituição de Ensino</title>
    <link rel="icon" type="image/png" href="../imagens/IE_favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/customize.css">
</head>

<body>
    <!-- Inclui MENU.PHP  -->
    <?php require '../geral/menuPerfilProf.php'; ?>
    <?php require '../bd/conectaBD.php'; ?>

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
                    <h2>Listagem de Alunos</h2>
                </div>

                <!-- Acesso ao BD-->
                <?php

                $id = $_SESSION['ID_Usuario'];

                // Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}

                // Faz Select na Base de Dados
                $sql = "SELECT t.ID_Turma, p.nome, d.nomeDisc, t.ano, t.semestre FROM TB_Turma as t, TB_Disciplina as d, TB_Usuario as P WHERE p.ID_Usuario = $id AND t.ID_Disciplina = d.ID_Disciplina AND t.ID_Usuario = p.ID_Usuario ORDER BY  t.ano, t.semestre, d.nomeDisc";
                echo "<div class='w3-responsive w3-card-4'>";
                if ($result = $conn->query($sql)) {
                    echo "<table class='w3-table-all'>";
                    echo "	<tr>";
                    echo "	  <th>Turma</th>";
                    echo "	  <th>Professor</th>";
                    echo "	  <th>Ano</th>";
                    echo "	  <th>Semestre</th>";
                    echo "	  <th>Disciplina</th>";
                    echo "	</tr>";
                    if ($result->num_rows > 0) {
                        // Apresenta cada linha da tabela
                        while ($row = $result->fetch_assoc()) {
                            $cod = $row["ID_Turma"];
                            echo "<tr>";
                            echo "<td>";
                            echo $cod;
                            echo "</td><td>";
                            echo $row["nome"];
                            echo "</td><td>";
                            echo $row["ano"];
                            echo "</td><td>";
                            echo $row["semestre"];
                            echo "</td><td>";
                            echo $row["nomeDisc"];
                            echo "</td>";

                            //Atualizar e Excluir registro de prof
                ?>
                            </tr>
                <?php
                        }
                    }
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<p>&nbsp;Erro executando SELECT: " . $conn-> error . "</p>";
                }

                $conn->close(); //Encerra conexao com o BD

                ?>
            </div>
        </div>

        <?php require '../geral/sobre.php'; ?>

        <!-- FIM PRINCIPAL -->
    </div>
    <!-- Inclui RODAPE.PHP  -->
    <?php require '../geral/rodape.php'; ?>

</body>

</html>