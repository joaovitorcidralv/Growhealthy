<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>GrowHealthy</title>
		<link rel="icon" type="image/png" href="imagens/logo1.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="css/customize.css">
	</head>
<body onload="w3_show_nav('menuProf')" >
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
				$cref = $_GET['CREF'];

				// Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}

				// Faz Select na Base de Dados
				$sql = "SELECT Nome, Genero, celular, dt_nasc, login  FROM Personal WHERE CREF = $cref";

				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = $conn->query($sql)) {
					if ($result->num_rows == 1) {
						$row        = $result->fetch_assoc(); 
						$nome       = $row['Nome'];
                        $genero     = $row['Genero'];
						$celular    = $row['celular'];
						$dataNasc   = $row['dt_nasc'];
						$login      = $row['login'];
									
						// Faz Select na Base de Dados
						$sqlG = "SELECT Genero, Nome FROM Personal";
							
						$optionsGenero = array();
						
						if ($result = $conn->query($sqlG)) {
							while ($row        = $result->fetch_assoc()) {
								$selected = "";
								if ($row['Genero'] == $genero)
									$selected = "selected";
								array_push($optionsGenero, "\t\t\t<option " . $selected . " value='". $row["Genero"]."'>".$row["Nome"]."</option>\n");
							}
						}

						?>
						<div class="w3-container w3-cyan">
							<h2>Alterar Personal</h2>
						</div>
						<form class="w3-container" action="ProfAtualizar_exe.php" method="post" enctype="multipart/form-data">
						<table class='w3-table-all'>
						<tr>
							<td style="width:50%;">
							<p>
							<input type="hidden" id="Id" name="Id" value="<?php echo $cref; ?>">
							<p>
							<label class="w3-text-cyan"><b>Nome</b></label>
							<input class="w3-input w3-border w3-sand" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$"
									title="Nome entre 10 e 100 letras." value="<?php echo $nome; ?>" required></p>
							<p>
							<label class="w3-text-cyan"><b>Celular</b></label>
							<input class="w3-input w3-border w3-sand " name="Celular" type="text" id="Celular"  type="text" maxlength="15"
									pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$" title="(XX)XXXXX-XXXX" value="<?php echo $celular; ?>" required></p>
							<p>
							<label class="w3-text-cyan"><b>Data de Nascimento</b></label>
							<input class="w3-input w3-border w3-sand" name="dt_nasc" type="date"
									pattern="((0[1-9])|([1-2][0-9])|(3[0-1]))\/((0[1-9])|(1[0-2]))\/((19|20)[0-9][0-9])"
									placeholder="dd/mm/aaaa" title="dd/mm/aaaa" max="<?= date('Y-m-d'); ?>" required
									title="Formato: dd/mm/aaaa" value="<?php echo $dataNasc; ?>"></p>
							
							<p><label class="w3-text-cyan"><b>Gênero</b>*</label>
							<select name="Genero" id="Genero" class="w3-input w3-border w3-sand" required>

							<?php
								foreach($optionsGenero as $key => $value){
									echo $value;
								}
							?>
							</select>
							</p>
							
							<p>
							<label class="w3-text-cyan"><b>Login</b></label>
							<input class="w3-input w3-border w3-sand" name="login" type="text"
									pattern="[a-zA-Z]{2,20}.[a-zA-Z]{2,20}" title="Formato: nome.sobrenome" value="<?php echo $login; ?>" required></p>
							
							</td>
							<td>
							
							<p>
							<label class="w3-text-cyan"><b>NOVA Senha</b>*</label>
							<input class="w3-input w3-border w3-sand" name="Senha" id="Senha" type="password" onchange="validarSenha()"
									pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}"
									title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
									required></p>
							<p>
							<label class="w3-text-cyan"><b>Confirma NOVA Senha</b>*</label>
							<input class="w3-input w3-border w3-sand" name="Senha2" id="Senha2" type="password" onkeyup="validarSenha()"
									pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}"
									title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
									required> </p> 
							<p>
							<input type="checkbox" class="w3-btn w3-cyan"  onclick="mostrarOcultarSenha()"> Mostrar senha
							</p>						
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
							<p>
							<input type="submit" value="Alterar" class="w3-btn w3-red" >
							<input type="button" value="Cancelar" class="w3-btn w3-cyan" onclick="window.location.href='profListar.php'"></p>
						</tr>
						</table>
						<br>
						</form>
								<?php
					}else{?>
								<div class="w3-container w3-cyan">
								<h2>Personal inexistente</h2>
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

	<?php require 'geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'geral/rodape.php';?>

</body>
</html>
