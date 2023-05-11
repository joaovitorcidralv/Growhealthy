<html lang="pt">
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Março/2023
---------------------------------------------------------------------------------->
<!-- perfilProf.php -->

<html>
	<head>	
		<meta charset="UTF-8">
		<title>IE - Instituição de Ensino</title>
		<link rel="icon" type="image/png" href="../imagens/IE_favicon.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="../css/customize.css">
	</head>
	<body>
		
		<!-- Inclui MENU.PHP  -->
		<?php require '../geral/menuPerfilProf.php'; ?>

		<!-- Conteúdo PRINCIPAL: deslocado para direita em 270 pixels quando a sidebar é visível -->
		<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

			<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
				<h1 class="w3-jumbo">Meus Dados: Professor</h1>

				<img src="../imagens/professorDados.png" class="w3-round-xxlarge" width="70%"  style="max-width:500px">

				
			<?php require '../geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require '../geral/rodape.php';?>

	</body>
</html>