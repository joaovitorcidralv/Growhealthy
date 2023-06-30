<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>GrowHealthy</title>
	<link rel="icon" type="image/png" href="../imagens/logo1.png" />
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
	<div class="w3-main w3-container" style="margin-left:270px;margin-top:150px;margin-right:270px;">
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
				$id = $_SESSION['id'];

				// Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}


				// Faz Select na Base de Dados
				$sql = "SELECT nome, celular, email, dt_nasc, login, id FROM Personal WHERE id = '$id'";

				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = $conn->query($sql)) {
					if ($result->num_rows == 1) {
						$row = $result->fetch_assoc();
						$nome       = $row['nome'];
						$celular    = $row['celular'];
						$dt_nasc    = $row['dt_nasc'];
						$login      = $row['login'];
						$email      = $row['email'];

						

				?>
						<div class="w3-container w3-cyan">
							<h2>Altere os dados do Personal</h2>
						</div>
						<form class="w3-container" action="cadPersonal_exe.php" method="post" enctype="multipart/form-data">
							<table class='w3-table-all'>
								<tr>
									<td style="width:50%;">
										<p>
											<input type="hidden" id="Id" name="Id" value="<?php echo $cref; ?>">
										<p>
											<label class="w3-text-IE"><b>Nome</b></label>
											<input class="w3-input w3-border w3-sand" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" title="Nome entre 10 e 100 letras." value="<?php echo $nome; ?>" >
										</p>
										<p>
											<label class="w3-text-IE"><b>Data de Nascimento</b></label>
											<input class="w3-input w3-border w3-sand" name="dt_nasc" type="text" pattern="^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-(19[0-9][0-9]|20(0[0-9]|1[0-2]))$" maxlength=10 minlength=10 title="dd/mm/aaaa" title="Formato: dd/mm/aaaa" value="<?php echo $dt_nasc; ?>" >
										</p>
										<p>
											<label class="w3-text-IE"><b>Celular</b></label>
											<input class="w3-input w3-border w3-sand " name="Celular" type="text" id="Celular" type="text" maxlength="15" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$" title="(XX)XXXXX-XXXX" value="<?php echo $celular; ?>" required>
										</p>
										<p>
											<label class="w3-text-IE"><b>Email</b></label>
											<input class="w3-input w3-border w3-sand" name="email" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="email" value="<?php echo $email; ?>" required>
										</p>

										<p>
											<label class="w3-text-IE"><b>Login</b></label>
											<input class="w3-input w3-border w3-sand" name="login" type="text" pattern="[a-zA-Z]{2,20}.[a-zA-Z]{2,20}" title="Formato: nome.sobrenome" value="<?php echo $login; ?>" required>
										</p>

									</td>
									<td>

										<p>
											<label class="w3-text-IE"><b>NOVA Senha</b>*</label>
											<input class="w3-input w3-border w3-sand" name="Senha" id="Senha" type="password" onchange="confirmaSenha()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" required>
										</p>
										<p>
											<label class="w3-text-IE"><b>Confirma NOVA Senha</b>*</label>
											<input class="w3-input w3-border w3-sand" name="Senha2" id="Senha2" type="password" onkeyup="confirmaSenha()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" required>
										</p>
										<p>
											<input type="checkbox" id="chkC" class="w3-btn w3-cyan" onclick="mostrarOcultarSenha(1)"> Mostrar senha
										</p>
										<p>
											<input type="button" id="excluir" value="Excluir Conta" class="w3-btn w3-red" onclick="excluirConta()" style="display: block; margin-left: 230px; margin-top:100px;"> 
											<input type="button" id="confirmar" value="Confirmar Exlusão" class="w3-btn w3-red" onclick="confirmarExclusao()" style="display: none; margin-left: 230px; margin-top:100px;"> 
											<p></p>
											<input type="button" id="cancelar" value="Cancelar Exclusão" class="w3-btn w3-green" onclick="cancelarExclusao()" style="display: none; margin-left: 230px; margin-top:10px;">
										</p>
										
									</td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center">
										<p>
											<input type="submit" value="Alterar" class="w3-btn w3-red">
											<input type="button" value="Cancelar" class="w3-btn w3-green" onclick="window.location.href='perfilNutricionista.php'">
										</p>
								</tr>
							</table>
							<br>
						</form>
					<?php
					} else { ?>
						<div class="w3-container w3-cyan">
							<h2>Personal inexistente</h2>
						</div>
						<br>
				<?php
					}
				} else {
					echo "<p style='text-align:center'>Erro executando UPDATE: " .  $conn->connect_error . "</p>";
				}
				echo "</div>"; //Fim form
				$conn->close();  //Encerra conexao com o BD
				?>
			</div>
			</p>
		</div>

	
		<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->

	<script>
		function excluirConta() {
			document.getElementById('excluir').style.display = 'none';
            document.getElementById('confirmar').style.display = 'block';
            document.getElementById('cancelar').style.display = 'block';
		}

		function confirmarExclusao(){
                window.location.href = "excluirPersonal.php";
				
            }

		function cancelarExclusao() {
			document.getElementById('excluir').style.display = 'block';
            document.getElementById('confirmar').style.display = 'none';
            document.getElementById('cancelar').style.display = 'none';
		}

		
	</script>
</body>

</html>
