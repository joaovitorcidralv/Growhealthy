	<?php
		require('verifica_login.php');
		$url = dirname($_SERVER['SCRIPT_NAME']);                   // Obtém URL básica da aplicação Web
		$url = substr($url,strrpos($url,"\\/")+1,strlen($url));    // Retira 1o. '/'
		if (substr_count($url, '/') >= 1){                          
			$url = substr($url,strrpos($url,"\\/"),strlen($url));  // Retira 2o. '/', se ainda houver esse caracter
			$url = strstr($url, '/',true);
		}
		session_start ();
		if ($_SESSION['tipo'] == 'personal'){
			$url = "Location: /" . $url . "/personal/perfilPersonal.php";	// Monta página para reurlecionamento
			header($url);                                         		// Vai para a página de login / inicial
			exit();
		}else if ($_SESSION['tipo'] != 'aluno'){     	// Não é Professor nem Administrador
			$url = "Location: " . $url . "/aluno.php";         			// Monta página para reurlecionamento
			header($url);												// Vai para a página de login / inicial
			exit();
		}
	?>
	<!-- Top -->
	<div class="w3-top"   > <!--id="myOverlay" -->
		<div class="w3-row w3-white w3-padding" >
			<div class="w3-half" style="margin:0 0 0 0">
				<a href="."><img src='imagens/logo.jpg' alt='  '></a>
			</div>	
			<div class="w3-half w3-margin-top w3-wide w3-hide-medium w3-hide-small">
				<div class="w3-right"><?php 
					echo $_SESSION['tipo'] . "(a):&nbsp;";
					echo $_SESSION['nome']; 
					?>&nbsp;<a href="logout.php" class="w3-red" style="text-decoration:none; letter-spacing:1px">&nbsp;Sair&nbsp;</a>
				</div >
			</div>
		</div>
		<div class="w3-bar w3-cyan w3-large" style="z-index:-1">
			<a class="w3-bar-item w3-button w3-left w3-hide-large w3-hover-light-gray w3-large w3-cyan w3-padding-16" href="javascript:void(0)" onclick="w3_open()">☰</a>
			<a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" href="personal.php" onclick="w3_show_nav('menuProf')">Personais</a>
		</div>
	</div>



	<!-- Sidebar -->
	<div class="w3-sidebar w3-bar-block w3-collapse w3-animate-left" style="z-index:3;width:270px" id="mySidebar" >
		<div class="w3-bar w3-hide-large w3-large">
			<a href="javascript:void(0)" onclick="w3_show_nav('menuProf')"
			   class="w3-bar-item w3-button w3-cyan w3-hover-light-gray w3-padding-16" style="width:50%">Personais</a>
			   
		</div>
		<a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-right w3-xlarge w3-hide-large"
		   title="Close Menu">x</a>
		<div id="menuProf" class="myMenu">
			<div class="w3-container">
				<h3>Menu Personais</h3>
			</div>
			<a class="w3-bar-item w3-button" href="profListar.php">Relação de Personais</a>
		</div>
	</div>


	<script type="text/javascript" src="js/myScript.js"></script>
