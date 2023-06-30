<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>GrowHealthy</title>
		<link rel="icon" type="image/png" href="../imagens/logo1.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="../css/customize.css">
		<script type="text/javascript" src="../js/myScript.js"></script>
	</head>
<body>
	<!-- Inclui MENU.PHP  -->
	<?php require '../geral/menuPerfilPersonal.php'; ?>
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

                <?php
				require __DIR__ . '/vendor/autoload.php';
				use Orhanerday\OpenAi\OpenAi;

				$open_ai_key = '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';
				$open_ai = new OpenAi($open_ai_key);

				$complete = $open_ai->completion([
					'model' => 'text-davinci-003',
					'prompt' => "Crie um plano de treino para uma
                    pessoa com essas características: genero:  altura:  peso:  restricoes fisicas: ",
					'temperature' => 0.3,
					'max_tokens' => 2048,
					'n' => 1,
					'stop' => null
				]);
				$response = json_decode($complete, true);
				$response = $response["choices"][0]["text"];

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
				$sql = "SELECT id, nome, genero, dt_nasc, altura, peso, restricoesFisicas, restricoesAlimentares FROM aluno WHERE id = '$id'";

				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = $conn->query($sql)) {
					if ($result->num_rows == 1) {
						$row        = $result->fetch_assoc(); 
						$idAluno    = $row['id'];
						$nome       = $row['nome'];
						$dataNasc   = $row['dt_nasc'];
						$genero     = $row['genero'];
						$altura     = $row['altura'];
						$peso       = $row['peso'];
						$restricoesFisicas = $row['restricoesFisicas'];
						$restricoesAlimentares = $row['restricoesAlimentares'];

									
						?>
						<div class="w3-container w3-theme">
							<h2>Altere o Treino Cód. = [<?php echo $idAluno; ?>]</h2>
						</div>
						<form class="w3-container" action="treinoAtualizar_exe.php" method="post" enctype="multipart/form-data">
							<table class='w3-table-all'>
								<tr>
									<td style="width:50%;">
										<p>
										<input type="hidden" id="idALuno" name="idAluno" value="<?php echo $idAluno; ?>">
										<p>
										<label class="w3-text-IE"><b>Nome</b></label>
										<input class="w3-input w3-border w3-light-grey " name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" title="Nome entre 10 e 100 letras." value="<?php echo $nome; ?>" readonly>
										</p>
										<p>
										<label class="w3-text-IE"><b>Data de Nascimento</b>*</label>
										<input class="w3-input w3-border w3-light-grey " name="Idade" id="idade" type="text" maxlength="15" placeholder="Anos" title="idade" value="<?php echo $dataNasc; ?>" readonly >
										</p>
										<p>
										<label class="w3-text-IE"><b>Altura</b></label>
										<input class="w3-input w3-border w3-light-grey " name="altura" type="text" placeholder="1,80m" title="altura" value="<?php echo $altura; ?>" readonly>
										</p>
										<p>
										<label class="w3-text-IE"><b>Peso</b></label>
										<input class="w3-input w3-border w3-light-grey " name="peso" type="text" placeholder="Kg" title="Peso" value="<?php echo $peso; ?>" readonly>
										</p>
										<label class="w3-text-IE"><b>Restrições Alimentares</b></label>
										<input class="w3-input w3-border w3-light-grey " name="RestAlimentar" type="text" placeholder="Nenhuma" title="RestAlimentar" value="<?php echo $restricoesAlimentares; ?>" readonly>
										</p>
										<label class="w3-text-IE"><b>Restrições Físicas</b></label>
										<input class="w3-input w3-border w3-light-grey " name="RestFisicas" type="text" placeholder="Nenhuma" title="RestFisicas" value="<?php echo $restricoesFisicas; ?>" readonly>
										</p>
										

									</td>
									<td style="text-align:center;">
										<p style="text-align:center"><label class="w3-text-IE"><b>Revise e poste aqui o treino:
												</b></label></p>
										<textarea class="w3-input w3-border w3-light-grey " name="postarTreino"
											id="postarTreino" type="text" title="postarTreino"
											style="width: 90%; height:500px;"><?php echo $response; ?></textarea>
										</p>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center">
									<p>
										<input type="submit" value="Postar Treino" class="w3-btn w3-red" onclick="window.location.href='alunoListar.php'">
										<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='alunoListar.php'">
									</p>
									</td>
								</tr>
							</table>
			
		                </form>
								<?php
					}else{?>
								<div class="w3-container w3-theme">
								<h2>Aluno inexistente</h2>
								</div>
								<br
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

	<?php require '../geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require '../geral/rodape.php';?>

</body>
</html>
