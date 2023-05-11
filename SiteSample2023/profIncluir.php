<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Março/2023
---------------------------------------------------------------------------------->
<!-- profIncluir.php -->

<html>
<head>

    <title>IE - Instituição de Ensino</title>
    <link rel="icon" type="image/png" href="imagens/IE_favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
	
</head>
<body  onload="w3_show_nav('menuProf')">

<!-- Inclui MENU.PHP  -->
<?php require 'geral/menu.php';?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado paa direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <!-- h1 class="w3-xxlarge">Contratação de Professor</h1 -->
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

				// Faz Select na Base de Dados
				$sqlG = "SELECT ID_Genero, Nome FROM TB_Genero";
				
				$optionsGenero = array();
				
				if ($result = $conn->query($sqlG)) {
					while ($row        = $result->fetch_assoc()) {
                       array_push($optionsGenero, "\t\t\t<option value='". $row["ID_Genero"]."'>".$row["Nome"]."</option>\n");
					}
				}
				else{
					echo "<p style='text-align:center'>Erro executando UPDATE: " . $conn-> error . "</p>";
				}
				$conn->close();
				?>

                <div class="w3-responsive w3-card-4">
                    <div class="w3-container w3-theme">
                        <h2>Informe os dados do novo do Professor</h2>
                    </div>
                    <form class="w3-container" action="ProfIncluir_exe.php" method="post" enctype="multipart/form-data">
					<table class='w3-table-all'>
					<tr>
                        <td style="width:50%;">
						<p>
						<label class="w3-text-IE"><b>Nome</b>*</label>
						<input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$"
							   title="Nome entre 10 e 100 letras." required></p>
						<p>
						<label class="w3-text-IE"><b>Celular</b>*</label>
						<input class="w3-input w3-border w3-light-grey " name="Celular" id="Celular"  type="text" maxlength="15"
						       placeholder="(XX)XXXXX-XXXX" title="(XX)XXXXX-XXXX"  pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$" required
							   onkeypress="mask(this, mphone);" onblur="mask(this, mphone);"></p>
						<p>
						<label class="w3-text-IE"><b>Data de Nascimento</b></label>
						<input class="w3-input w3-border w3-light-grey" name="DataNasc" type="date"
							   placeholder="dd/mm/aaaa" title="dd/mm/aaaa" max="<?= date('Y-m-d'); ?>" required></p>
						<p>
						<p><label class="w3-text-IE"><b>Gênero</b>*</label>
								<select name="Genero" id="Genero" class="w3-input w3-border w3-light-grey" required>
									<option value=""></option>
								<?php
									foreach($optionsGenero as $key => $value){
										echo $value;
									}
								?>
								</select>
						</p>
						<label class="w3-text-IE"><b>Login</b>*</label>
						<input class="w3-input w3-border w3-light-grey" name="Login" type="text"
							   pattern="[a-zA-Z]{2,20}\.[a-zA-Z]{2,20}" placeholder="nome.sobrenome" title="nome.sobrenome" required></p>
						
						</td>
						<td>
						<p>
						<label class="w3-text-IE"><b>Senha Inicial</b>*</label>
						<input class="w3-input w3-border w3-light-grey" name="Senha" id="Senha" type="password" onchange="validarSenha()"
							   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}"
							   title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
							   required></p>
						<p>
						<label class="w3-text-IE"><b>Confirma Senha Inicial</b>*</label>
						<input class="w3-input w3-border w3-light-grey" name="Senha2" id="Senha2"type="password" onkeyup="validarSenha()"
							   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}"
							   title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
							   required> </p> 
						<p>
						<input type="checkbox" class="w3-btn w3-theme"  onclick="mostrarOcultarSenha()"> Mostrar senha
						</p>
						<p style="text-align:center"><label class="w3-text-IE"><b>Minha Imagem para Identificação: </b></label></p>
						<p style="text-align:center"><img id="imagemSelecionada" src="imagens/pessoa.jpg"    /></p>
						<p style="text-align:center"><label class="w3-btn w3-theme">Selecione uma Imagem 
							<input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
							<input type="file" id="Imagem" name="Imagem" accept="imagem/*" onchange="validaImagem(this);"></label>
						</p>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center">
						<p>
						<input type="submit" value="Salvar" class="w3-btn w3-theme" >
						<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='profListar.php'">
						</p>
						</td>
					</tr>
					</table>	
					</form>
					<br>
				</div>
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
