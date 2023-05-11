<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Março/2023
---------------------------------------------------------------------------------->
<!-- menuPerfilProf.php -->

<?php
	require('../verifica_login.php');
	
	$url = dirname($_SERVER['SCRIPT_NAME']);                   // Obtém URL básica da aplicação Web
	$url = substr($url,strrpos($url,"\\/")+1,strlen($url));    // Retira 1o. '/'
	if (substr_count($url, '/') >= 1){                          
		$url = substr($url,strrpos($url,"\\/"),strlen($url));  // Retira 2o. '/', se ainda houver esse caracter
		$url = strstr($url, '/',true);
	}
	if ($_SESSION['nomeTipoUsu'] == 'Administrador'){
		$url = "Location: /" . $url . "/professor.php";	// Monta URL para redirecionamento
		header($url);                               	 
		exit();
	}else if($_SESSION['nomeTipoUsu'] != 'Professor' && $_SESSION['nomeTipoUsu'] != 'Administrador'){
		$url = "Location: /" . $url . "/logout.php";	// Monta URL para redirecionamento
		header($url);									 
		exit();
	}
?>
	
<!-- Top -->
<div class="w3-top"   >  
	<div class="w3-row w3-white w3-padding" >
		<div class="w3-half" style="margin:0 0 0 0"><a href="../">
			<img src='../imagens/logo.jpg' alt=' IE Exemplo '></a>
		</div>
		<div class="w3-half w3-margin-top w3-wide w3-hide-medium w3-hide-small">
			<div class="w3-right"><?php 
				echo $_SESSION['nomeTipoUsu'] . "(a):&nbsp;";
				echo $_SESSION['nome']; 
				?>&nbsp;<a href="../logout.php" class="w3-red" style="text-decoration:none; letter-spacing:1px">&nbsp;Sair&nbsp;</a>
			</div >
		</div>
		<div class="w3-bar w3-theme w3-large" style="z-index:-1">
			<a class="w3-bar-item w3-button w3-left w3-hide-large w3-hover-light-gray w3-large w3-theme w3-padding-16" href="javascript:void(0)" onclick="w3_open()">☰</a>
			<a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" href="cadProf.php">Dados Pessoais</a>
			<a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" href="turmasProfListar.php">Meus alunos</a>
		</div>
	</div>

	<!-- profSidebar -->
	<div class="w3-sidebar w3-bar-block w3-collapse w3-animate-left" style="z-index:3;width:270px" id="mySidebar" >
		<div class="w3-bar w3-hide-large w3-large">
			<a href="cadProf.php"  
			class="w3-bar-item w3-button w3-theme w3-hover-light-gray w3-padding-16" style="width:50%">Dados Pessoais</a>
			<a href="turmasProfListar.php"  
			class="w3-bar-item w3-button w3-theme w3-hover-light-gray w3-padding-16" style="width:50%">Meus alunos</a>		   
		</div>
		<a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-right w3-xlarge w3-hide-large"
		title="Close Menu">x</a>
	</div>
</div>

<script type="text/javascript" src="../js/myScript.js"></script>
