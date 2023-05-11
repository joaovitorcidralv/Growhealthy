<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Março/2023
---------------------------------------------------------------------------------->
<!-- turmaAtualizar.php --> 

<html>
	<head>
		<meta charset="UTF-8">
		<title>IE - Instituição de Ensino</title>
		<link rel="icon" type="image/png" href="imagens/IE_favicon.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="css/customize.css">
	</head>
<body onload="w3_show_nav('menuTurma')">
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
				$sql  = "SELECT t.ID_Turma, t.ID_Usuario, t.ID_Disciplina, t.ano, t.semestre FROM TB_Turma as t WHERE ID_Turma = $id ";
				$sqlD = "SELECT ID_Disciplina, NomeDisc, Ementa FROM TB_Disciplina";
				$sqlP = "SELECT ID_Usuario, Nome FROM TB_Usuario WHERE ID_TipoUsu = 2";
				
				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = $conn->query($sql)) {
					if ($result->num_rows == 1) {
						$row        = $result->fetch_assoc(); 
						$ID_Turma = $row['ID_Turma'];
						$ano      = $row['ano'];
						$sem      = $row['semestre'];
						$codProf  = $row['ID_Usuario'];
						$codDisc  = $row['ID_Disciplina'];

						$sem1Checked = "  ";
						$sem2Checked = "  ";
						if ($sem == '1') $sem1Checked = " checked ";
						if ($sem == '2') $sem2Checked = " checked ";
						$optionsDisc = array();
						$optionsProf = array();
						
						echo "<div class='w3-responsive w3-card-4'>";
						//Obtém lista de disciplinas
						if ($result = $conn->query($sqlD)) {
							while ($row = $result->fetch_assoc() ){
								$selected = "";
								if ($row['ID_Disciplina'] == $codDisc)
									$selected = "selected";
							   array_push($optionsDisc, "\t\t\t<option " . $selected . " value='". $row["ID_Disciplina"]."'>".$row["NomeDisc"]."</option>\n");
							}
						}
						//Obtém lista de professores
						if ($result = $conn->query($sqlP)) {
							while ($row = $result->fetch_assoc() ){
								$selected = "";
								if ($row['ID_Usuario'] == $codProf)
									$selected = "selected";
								array_push($optionsProf, "\t\t\t<option " . $selected . " value='". $row["ID_Usuario"]."'>".$row["Nome"]."</option>\n");
							}
						}
						echo "<div class='w3-responsive w3-card-4'>"; //Inicio form
						?>				
						<div class="w3-container w3-theme">
							<h2>Altere os dados da Turma = [<?php echo $ID_Turma; ?>]</h2>
						</div>
						<form class="w3-container" action="TurmaAtualizar_exe.php" method="post">
							<input type="hidden" id="Id" name="Id" value="<?php echo $ID_Turma; ?>">
							<p><label class="w3-text-IE"><b>Professor</b></label>
								<select name="codProf" class="w3-input w3-border" required>
									<option value=""></option>
								<?php
									foreach($optionsProf as $key => $value){
										echo $value;
									}
								?>
							</select></p>
							<p>	<label class="w3-text-IE"><b>Disciplina</b></label>
								<select name="codDisc" class="w3-input w3-border" required>
									<option value=""></option>
								<?php
									foreach($optionsDisc as $key => $value){
										echo $value;
									}
								?>
								</select></p>
							<p>
								<label class="w3-text-IE"><b>Ano</b></label>
								<input class="w3-input w3-border w3-light-grey" name="Ano" type="text" maxlength="4" size="4" pattern="(20)\d\d"
										title="Ano com 4 dígitos, a partir de 2000" value="<?php echo $ano; ?>" required></p>
							<p>
								<label class="w3-text-IE"><b>Semestre</b></label></br>
								<input class="w3-radio" type="radio" name="Semestre" value="1" required <?php echo $sem1Checked; ?> ><label class="w3-text-IE"><b>1º</b></label>
								<input class="w3-radio" type="radio" name="Semestre" value="2" required <?php echo $sem2Checked; ?> ><label class="w3-text-IE"><b>2º</b></label></p>
							<p>
							<input type="submit" value="Alterar" class="w3-btn w3-red" >
							<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='turmaListar.php'"></p>
						</form>
						<?php 

					}else{?>
						<div class="w3-container w3-theme">
						<h2>Turma inexistente</h2>
						</div>
						<br>
					<?php
					}
				}
				else {
					echo "<p style='text-align:center'>Erro executando UPDATE: " . $conn-> error . "</p>";
				}
				echo "</div>"; //Fim form
				$conn -> close();   //Encerra conexao com o BD

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
