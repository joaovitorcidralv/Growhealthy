<!DOCTYPE html>
<html>
	<head>

	  <title>GrowHealthy</title>
	  <link rel="icon" type="image/png" href="../imagens/logo1.png" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="../css/customize.css">
	</head>
<body>
<!-- Inclui MENU.PHP  -->
<?php require '../geral/menuPerfilPersonal.php';?>
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
	<div class="w3-container w3-cyan">
	<h2>Exclusão de Aluno</h2>
	</div>

	<!-- Acesso ao BD-->
	<?php
		// ID do registro a ser excluído
		$id = $_POST['Id'];		

		// Cria conexão
		$conn = new mysqli($servername, $username, $password, $database);

		// Verifica conexão 
		if ($conn->connect_error) {
			die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
		}

		// Faz DELETE na Base de Dados
		$sql = "DELETE FROM TB_Usuario WHERE ID_Usuario = $id";

		echo "<div class='w3-responsive w3-card-4'>";
		if ($result = $conn->query($sql)) {
			echo "<p>&nbsp;Registro excluído com sucesso! </p>";
		} else {
			echo "<p>&nbsp;Erro executando DELETE: " .  $conn->connect_error . "</p>";
		}
        echo "</div>";
		$conn->close();  //Encerra conexao com o BD

		?>
  	</div>
	</div>


	
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	

</body>
</html>
