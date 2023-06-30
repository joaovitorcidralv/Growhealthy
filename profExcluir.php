<!DOCTYPE html>


<html>
<head>

    <title>GrowHealthy</title>
    <link rel="icon" type="image/png" href="imagens/logo1.png"/>
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
	
				// Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}


				$cref=$_GET['CREF'];
				
				// Faz Select na Base de Dados
				$sql = "SELECT CREF, Nome, Celular, dt_nasc, login FROM Personal WHERE CREF = $cref";
				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";  
				if ($result = $conn->query($sql)) {
					if ($result->num_rows == 1) {
						$row   = $result->fetch_assoc();
						$dataN = explode('-', $row["dt_nasc"]);
						$ano = $dataN[0];
						$mes = $dataN[1];
						$dia = $dataN[2];
						$nova_data = $dia . '/' . $mes . '/' . $ano;
			?>
						<div class="w3-container w3-cyan">
							<h2>Exclusão do Personal</h2>
						</div>
						<form class="w3-container" action="ProfExcluir_exe.php" method="post" onsubmit="return check(this.form)">
							<input type="hidden" id="Id" name="Id" value="<?php echo $row['CREF']; ?>">
							<p>
							<label class="w3-text-cyan"><b>Nome: </b> <?php echo $row['Nome']; ?> </label></p>
							<p>
							<label class="w3-text-cyan"><b>Celular: </b><?php echo $row['Celular']; ?></label></p>
							<p>
							<label class="w3-text-cyan"><b>Data de Nascimento: </b><?php echo $nova_data; ?></label></p>
							<p>
							<label class="w3-text-cyan"><b>Login: </b><?php echo $row['login']; ?></label></p>
							<p>
							<input type="submit" value="Confirma exclusão?" class="w3-btn w3-red" >
							<input type="button" value="Cancelar" class="w3-btn w3-cyan" onclick="window.location.href='profListar.php'"></p>
						</form>
			<?php 
					}else{?>
						<div class="w3-container w3-cyan">
						<h2>Tentativa de exclusão de Personal inexistente</h2>
						</div>
						<br>
					<?php }
				}else {
					echo "<p style='text-align:center'>Erro executando DELETE: " . $conn-> error . "</p>";
				}
				echo "</div>"; //Fim form
				$conn->close();   //Encerra conexao com o BD

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
