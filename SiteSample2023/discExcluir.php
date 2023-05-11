<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Março/2023
---------------------------------------------------------------------------------->
<!-- discExcluir.php -->

<html>
<head>
    <title>IE - Instituição de Ensino</title>
    <link rel="icon" type="image/png" href="imagens/IE_favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body onload="w3_show_nav('menuDisc')">
<!-- Inclui MENU.PHP  -->
<?php require 'geral/menu.php';?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <p class="w3-large">
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

                <!-- Acesso ao BD-->
				<?php
				$id=$_GET['id'];
				
				// Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}
				
				// Faz Select na Base de Dados
				$sql = "SELECT ID_Disciplina, NomeDisc, Ementa FROM TB_Disciplina WHERE ID_Disciplina = $id";
				echo "<div class='w3-responsive w3-card-4'>"; //Inicio form
				if ($result = $conn->query($sql)){
					if ($result->num_rows == 1) {
						$row = $result->fetch_assoc(); 
					?>
						<div class="w3-container w3-theme">
							<h2>Exclusão do Disciplina Cód. = [<?php echo $row['ID_Disciplina']; ?>]</h2>
						</div>
						<form class="w3-container" action="discExcluir_exe.php" method="post" onsubmit="return check(this.form)">
							<input type="hidden" id="Id" name="Id" value="<?php echo $row['ID_Disciplina']; ?>">
							<p>
							<label class="w3-text-IE"><b>Nome: </b> <?php echo $row['NomeDisc']; ?> </label></p>
							<p>
							<label class="w3-text-IE"><b>Ementa: </b><?php echo $row['Ementa']; ?></label></p>
							<p>
							<input type="submit" value="Confirma exclusão?" class="w3-btn w3-red" >
							<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='discListar.php'"></p>
						</form>
					<?php 
					}else{?>
						<div class="w3-container w3-theme">
						<h2>Tentativa de exclusão de Disciplina inexistente</h2>
						</div>
						<br>
					<?php }
				}
				else {
					echo "Erro executando DELETE: " . $conn->connect_error ;
				}
				echo "</div>"; //Fim form
				$conn->close(); //Encerra conexao com o BD

			?>

			</div>
		</p>
	</div>

	<?php require 'geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'geral/rodape.php';?>

</body>
</html>
