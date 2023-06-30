<?php require('../verifica_login.php'); ?>

<html lang="pt">
<html>
	<head>	
		<meta charset="UTF-8">
		<title>GrowHealthy</title>
		<link rel="icon" type="image/png" href="../imagens/logo1.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="../css/customize.css">
	</head>
	<body>
	
		<!-- Inclui MENU.PHP  -->
		<?php require '../geral/menuPerfilPersonal.php'; ?>

		<!-- Conteúdo PRINCIPAL: deslocado para direita em 270 pixels quando a sidebar é visível -->
		<div class="w3-main w3-container" style="margin-left:270px;margin-top:200px;margin-right:270px;">

			<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
				<h1 class="w3-jumbo">Olá <?php echo $_SESSION['nome']; ?>!</h1>
				<div style="overflow:auto">
                <img src="../imagens/personal.png" class="w3-round-xxlarge" width="70%"  style="max-width:500px; float:left; margin-right:20px;">
                <p style="font-size: 20px; text-align:justify;">Para acessar seu perfil e fazer alterações, vá para a aba 'Dados pessoais'. Lá, você poderá atualizar suas informações pessoais conforme necessário.<br><br>
					Se você deseja consultar os alunos associados à sua conta e utilizar nossa ferramenta de geração de treino auxiliado por chatIA, vá para a aba 'Meus alunos' e clique no botão 'Montar treino' do respectivo aluno que deseja atender. Ao fazer isso, você será redirecionado para uma página que exibirá os dados do seu aluno, incluindo o treino já gerado. Fique à vontade para editar o treino conforme necessário antes de compartilhá-lo com seu aluno."
				</p>
                </div>
                <div style="clear:both;"></div>
            </div>             
				
			<?php require '../geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require '../geral/sobrepersonal.php';?>

	</body>
</html>
