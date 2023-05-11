<!DOCTYPE html>
<!--
Desenvolvimento Web
PUCPR
Profa. Cristina V. P. B. Souza
Março/2023
-->
<html>

<head>
	<meta charset="UTF-8"><meta charset="UTF-8">
	<title>IE - Instituição de Ensino</title>
	<link rel="icon" type="image/png" href="imagens/IE_favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="css/customize.css">
</head>

<body onload="w3_show_nav('menuDisc')">
	<!-- Inclui MENU.PHP  -->
	<?php require 'geral/menu.php'; ?>
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

				$nome   = $_POST['Nome'];
				$ementa = $_POST['Ementa'];

				if ($_FILES['Imagem']['size'] == 0) { // Não recebeu uma imagem binária
					$sql = "INSERT INTO TB_Disciplina (NomeDisc, ementa, FotoBin) VALUES ('$nome','$ementa', NULL)";
				} else {                              // Recebeu uma imagem binária
					$imagem = addslashes(file_get_contents($_FILES['Imagem']['tmp_name'])); // Prepara para salvar em BD
					$sql = "INSERT INTO TB_Disciplina (NomeDisc, ementa, FotoBin) VALUES ('$nome','$ementa', '$imagem')";
				}

				// Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}

				?>
				<div class='w3-responsive w3-card-4'>
				<div class="w3-container w3-theme">
				<h2>Inclusão de Nova Disciplina</h2>
				</div>
				<?php
				if ($result = $conn->query($sql)){
					echo "<p>&nbsp;Registro cadastrado com sucesso! </p>";
				} else {
					echo "<p>&nbsp;Erro executando INSERT: " . $conn-> error . "</p>";
				}
				echo "</div>";
				$conn->close();   //Encerra conexao com o BD

				?>
			</div>
		</div>


		<footer class="w3-panel w3-padding w3-card-4 w3-light-grey w3-center w3-opacity">
			<p>
			<nav>
				<a class="w3-btn w3-theme w3-hover-white" onclick="document.getElementById('id01').style.display='block'">Sobre</a>
			</nav>
			</p>
		</footer>

		<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'geral/rodape.php'; ?>
</body>

</html>