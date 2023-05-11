<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Março/2023
---------------------------------------------------------------------------------->
<!-- discAtualizar.php --> 

<html>
	<head>
		<meta charset="UTF-8">
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
				$id = $_GET['id'];

				// Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}

				// Faz Select na Base de Dados
				$sql = "SELECT ID_Disciplina, NomeDisc, Ementa, FotoBin FROM TB_Disciplina WHERE ID_Disciplina = $id";

				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = $conn->query($sql)){
					if ($result->num_rows == 1) {
						$row = $result->fetch_assoc(); 
						?>
						<div class="w3-container w3-theme">
						<h2>Altere os dados da Disciplina Cód. = [<?php echo $row['ID_Disciplina']; ?>]</h2>
						</div>
						<form class="w3-container" action="discAtualizar_exe.php" method="post" onsubmit="return check(this.form)" enctype="multipart/form-data">
						<table class='w3-table-all'>
							<tr>
								<td style="width:50%;">
								<input type="hidden" id="Id" name="Id" value="<?php echo $row['ID_Disciplina']; ?>">
								<p>
									<label class="w3-text-IE"><b>Nome</b></label>
									<input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" title="Nome da disciplina entre 10 e 100 letras." value="<?php echo $row['NomeDisc']; ?>" required>
								</p>
								<p>
									<label class="w3-text-IE"><b>Ementa</b></label>
									<textarea class="w3-input w3-border w3-light-grey " name="Ementa" rows="5" title="Texto Descritivo" required><?php echo $row['Ementa']; ?></textarea>
								</p>
								</td>
								<td style="text-align:center">
								<p>
									<label class="w3-text-IE"><b>Imagem</b></label>
									<?php
									if ($row['FotoBin']) {
									?>
								<p><img id="imagemSelecionada" src="data:image/png;base64,<?= base64_encode($row['FotoBin']) ?>" /></p>
								<?php
										} else {
								?>
								<p><img id="imagemSelecionada" src="imagens/imagem.png" /></p>
								<?php
										}
								?>
								<p>
								<label class="w3-btn w3-theme"><b>Selecione uma imagem</b>
									<input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
									<input type="file" id="Imagem" name="Imagem" accept="imagem/*" onchange="validaImagem(this);"></label>
								</p>
								</td>
							</tr>
							<tr>
								<td colspan="2">
								<p>
									<input type="submit" value="Alterar" class="w3-btn w3-red">
									<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='discListar.php'">
								</p>
								</td>
							</tr>
						</table>
						<br>
						</form>
						<?php
					}else{?>
						<div class="w3-container w3-theme">
						<h2>Disciplina inexistente</h2>
						</div>
						<br>
					<?php
					}
				} else {
					echo "<p style='text-align:center'>Erro executando UPDATE: " . $conn-> error . "</p>";
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