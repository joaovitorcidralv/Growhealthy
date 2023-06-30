<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8">
	  <title>GrowHealthy</title>
	  <link rel="icon" type="image/png" href="imagens/IE_favicon.png" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="../css/customize.css">
	</head>
	<body>
	<!-- Inclui MENU.PHP  -->
	<?php require '../geral/menuPerfilNutricionista.php'; ?>
	<?php require '../bd/conectaBD.php'; ?>
	
	<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
	<div class="w3-main w3-container" style="margin-left:270px;margin-top:200px;margin-right:270px;">

	<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">

	  <p class="w3-large">
	  <div class="w3-code cssHigh notranslate">
	  <!-- Acesso em:-->
		<?php

		date_default_timezone_set("America/Sao_Paulo");
		$data = date("d/m/Y H:i:s",time());
		echo "<p class='w3-small' > ";
		echo "Acesso em: ";
		echo $data;
		echo "</p> "
		?>
		<div class="w3-container w3-theme">
		<h2>Atualização de Dieta</h2>
		</div>
		<!-- Acesso ao BD-->
		<?php
			// Recebe os dados que foram preenchidos no formulário, com os valores que serão atualizados
			$idAluno      = $_POST['idAluno'];  // identifica o registro a ser alterado
			$descricao    = $_POST['descricao'];
			$idNutricionista   = $_SESSION['id'];
			

			// Cria conexão
			$conn = new mysqli($servername, $username, $password, $database);

			// Verifica conexão 
			if ($conn->connect_error) {
				die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
			}

			?>
			
			<?php
		
			// Faz Update na Base de Dados
			$sql = "INSERT INTO Dieta (descricao, aluno_id, nutricionista_id) 
					VALUES ('$descricao','$idAluno','$idNutricionista')";
			

			echo "<div class='w3-responsive w3-card-4'>";
			if ($result = $conn->query($sql)) {
				echo "<p>&nbsp;Dieta postada com sucesso! </p>";
			} else {
				echo "<p>&nbsp;Erro executando UPDATE: " . $conn-> error . "</p>";
			}
			echo "</div>";
			$conn->close(); //Encerra conexao com o BD

		?>
	  </div>
	</div>

	<?php require '../geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require '../geral/rodape.php';?>

</body>
</html>
