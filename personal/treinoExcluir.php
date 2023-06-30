<!DOCTYPE html>
<html>
<head>

    <title>GrowHealthy</title>
    <link rel="icon" type="image/png" href="../imagens/logo1.png"/>
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


				$id=$_GET['id'];
				
				// Faz Select na Base de Dados
				$sql = "SELECT ID_usuario, Nome, Celular, DataNasc, Login FROM TB_Usuario WHERE ID_usuario = $id";
				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";  
				if ($result = $conn->query($sql)) {
					if ($result->num_rows == 1) {
						$row   = $result->fetch_assoc();
						$dataN = explode('-', $row["DataNasc"]);
						$ano = $dataN[0];
						$mes = $dataN[1];
						$dia = $dataN[2];
						$nova_data = $dia . '/' . $mes . '/' . $ano;
			?>
						<div class="w3-container w3-cyan">
							<h2>Exclusão do Aluno Cód. = [<?php echo $row['ID_usuario']; ?>]</h2>
						</div>
						<form class="w3-container" action="treinoExcluir_exe.php" method="post" onsubmit="return check(this.form)">
							<input type="hidden" id="Id" name="Id" value="<?php echo $row['ID_usuario']; ?>">
							<p>
							<label class="w3-text-IE"><b>Nome: </b> <?php echo $row['Nome']; ?> </label></p>
							<p>
							<label class="w3-text-IE"><b>Celular: </b><?php echo $row['Celular']; ?></label></p>
							<p>
							<label class="w3-text-IE"><b>Data de Nascimento: </b><?php echo $nova_data; ?></label></p>
							<p>
							<label class="w3-text-IE"><b>Login: </b><?php echo $row['Login']; ?></label></p>
							<p>
							<input type="submit" value="Confirma exclusão?" class="w3-btn w3-red" >
							<input type="button" value="Cancelar" class="w3-btn w3-cyan" onclick="window.location.href='alunoListar.php'"></p>
						</form>
			<?php 
					}else{?>
						<div class="w3-container w3-cyan">
						<h2>Tentativa de exclusão de Aluno inexistente</h2>
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
	
	
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	

</body>
</html>
