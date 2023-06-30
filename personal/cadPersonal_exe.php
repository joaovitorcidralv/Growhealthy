<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>GrowHealthy</title>
	<link rel="icon" type="image/png" href="../imagens/logo1.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="../css/customize.css">
</head>

<body>
	<!-- Inclui MENU.PHP  -->
	<?php require '../geral/menuPerfilPersonal.php'; ?>
	<?php require '../bd/conectaBD.php'; ?>

	<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
	<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

		<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">

			<p class="w3-large">
			<div class="w3-code cssHigh notranslate">
				<!-- Acesso em:-->
				<<?php
				

				$idPersonal = $_SESSION['id'];

				date_default_timezone_set("America/Sao_Paulo");
				$data = date("d/m/Y H:i:s", time());
				echo "<p class='w3-small' > ";
				echo "Acesso em: ";
				echo $data;
				echo "</p> "
				?>
				<div class="w3-container w3-cyan">
					<h2>Atualização de Personal</h2>
				</div>
				<!-- Acesso ao BD-->
				<?php
				// Recebe os dados que foram preenchidos no formulário, com os valores que serão atualizados
				$nome = $_POST["Nome"];
    			$dt_nasc = $_POST["dt_nasc"];
    			$celular = $_POST["Celular"];
    			$email = $_POST["email"];
    			$login = $_POST["login"];
    			$senha = $_POST["Senha"];

				// Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}
				$sql = "UPDATE personal SET Nome = '$nome', dt_nasc = '$dt_nasc', Celular = '$celular', Email = '$email', Login = '$login', Senha = '$senha' WHERE id = $idPersonal";
				

				// Faz Update na Base de Dados
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = $conn->query($sql)) {
					echo "<p>&nbsp;Registro alterado com sucesso! </p>";
				} else {
					echo "<p>&nbsp;Erro executando UPDATE: " . $conn-> error . "</p>";
				}
				echo "</div>";
				$conn->close();  //Encerra conexao com o BD

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
