<!DOCTYPE html>


<html>
	<head>

	  <title>GrowHealthy</title>
	  <link rel="icon" type="image/png" href="imagens/logo1.png" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="css/customize.css">
	</head>
<body onload="w3_show_nav('menuProf')">
<!-- Inclui MENU.PHP  -->
<?php require 'geral/menu.php';?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

<div class="w3-main w3-container" style="margin-left:270px;margin-top:200px;margin-right:270px;">

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
	<h2>Exclusão de Personal</h2>
	</div>

	<!-- Acesso ao BD-->
	<?php
		// ID do registro a ser excluído
		$cref = $_POST['CREF'];		

		// Cria conexão
		$conn = new mysqli($servername, $username, $password, $database);

		// Verifica conexão 
		if ($conn->connect_error) {
			die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
		}

		// Faz DELETE na Base de Dados
		$sql = "DELETE FROM Personal WHERE CREF = $cref";

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


	<?php require 'geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'geral/rodape.php';?>

</body>
</html>
