<!DOCTYPE html>
<html lang="pt">
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Agosto/2022
---------------------------------------------------------------------------------->
<!-- Index.php --> 

<html>
	<head>	
        <meta charset="UTF-8">
		<title>Clínica Médica ABC</title>
		<link rel="icon" type="image/png" href="imagens/favicon.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="css/customize.css">
        <script type="text/javascript" src="js/myScriptClinic.js"></script>
	</head>
	<body >  
        <?php
            session_start(); // Cria uma sessão ou retoma a sessão atual 
            if (isset($_SESSION ['login'])) {                               // Verifica se existe usuário logado 
                header("location: /ConsultorioLogin/medlistar.php");  // Vai para as funcionalidades do site
                exit();
            }
        ?>
        <!-- Não encontrou usuário logado, então mostra página inicial -->
        <!-- Menu Superior -->
        <div class="w3-top" id="LoginCadastro" >
            <div class="w3-row w3-white w3-padding" >
                <div class="w3-half" style="margin:0 0 0 0"><a href="."><img src='imagens/logo.jpg' alt='  Clínica Médica ABC '></a></div>
                <div class="w3-half w3-margin-top w3-wide w3-hide-medium w3-hide-small">
                </div>
            </div>
            <div class="w3-bar w3-theme w3-large" style="z-index:-1">
            <a class="w3-bar-item w3-button w3-left w3-hide-large w3-hover-light-gray w3-large w3-theme w3-padding-16" href="javascript:void(0)" onclick="w3_open('LoginCadastro')">☰</a>
                <a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" onclick="document.getElementById('id0L').style.display='block'" >Login</a>
                <a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" onclick="document.getElementById('id0C').style.display='block'">Cadastro</a>
            </div>
	    </div>
        <!-- Logo da página -->
        <div class="w3-top">
            <div class="w3-row w3-white w3-padding">
                <div class="w3-half" style="margin:0 0 0 0">
                    <a href="."><img src='imagens/logo.jpg' alt=' Clínica ABC '></a>
                </div>
            </div>
        </div>

        <!-- Sidebar (menu lateral) -->
        <div class="w3-sidebar w3-bar-block w3-collapse w3-animate-left" style="z-index:3;width:270px" id="mySidebar" >
            <div class="w3-bar w3-hide-large w3-large">
                <a href="javascript:void(0)"  onclick="document.getElementById('id0L').style.display='block'" href="javascript:void(0)"
                class="w3-bar-item w3-button w3-theme w3-hover-light-gray w3-padding-16" style="width:50%">Login</a>
                <a href="javascript:void(0)"  onclick="document.getElementById('id0C').style.display='block'" href="javascript:void(0)"
                class="w3-bar-item w3-button w3-theme w3-hover-light-gray w3-padding-16" style="width:50%">Cadastro</a>
                
                
            </div>
            <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-right w3-xlarge w3-hide-large" title="Close Menu">x</a>
        </div>

        <!-- Conteúdo PRINCIPAL: deslocado para direita em 270 pixels quando a sidebar é visível -->
		<div class="w3-main w3-container" style="margin-left:270px;margin-top:130px;">

            <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey" >
                <h1 class="w3-jumbo">Consultório</h1>

                <img src="imagens/quadro.jpg" class="w3-round-xxlarge" style="max-width:800px">
                                
                <?php
                $msg        = "";
                $msg_header = "";
                if(isset($_SESSION['nao_autenticado'])){ 
                    // Houve falha(login incorreto ou cadastro incorreto)
                    $msg        = $_SESSION['mensagem'];
                    $msg_header = $_SESSION['mensagem_header'];
                    $style      = "display:block"; // div aparece 
                }else{
                    unset($_SESSION['nao_autenticado']);
                    $style      = "display:none"; // div não aparece 
                }
                ?>
                <!-- MODAL FAIL: Houve falha(login incorreto ou cadastro incorreto) ou não  --> 
                <div id="LF" class="w3-modal " style="<?php echo $style;?>">  
                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">
                        <div class="w3-center"> 
                            <span onclick="document.getElementById('LF').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
                        
                        <h2 class="w3-center w3-xxlarge "><?php echo $msg_header; ?></h2>
                        <p class="w3-container w3-card-4 w3-light-grey w3-text-IE w3-margin"><?php echo $msg; ?></p>
                        </div>
                        <br>
                    </div>
                </div>
            
                <!-- MODAL LOGIN: pop up para realizar Login --> 
                <div id="id0L" class="w3-modal ">
                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">

                        <div class="w3-center"> 
                            <span onclick="document.getElementById('id0L').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
                        </div>
                        <h2 class="w3-center w3-xxlarge">Login</h2>
                        <form action="login.php" method="POST" class="w3-container w3-card-4 w3-light-grey w3-margin">
                            <div class="w3-section">
                            <label class="w3-text-IE"><b>Login do usuário</b></label>
                            <input class="w3-input w3-border w3-margin-bottom" type="text" name="Login" placeholder="nome.sobrenome" required>
                            <label class="w3-text-IE"><b>Senha</b></label>
                            <input class="w3-input w3-border" name="Senha" id="Senha" type="password"  
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" placeholder="sua senha" 
                            title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
                            required>
                            <p>
                            <input type="checkbox" class="w3-btn w3-theme"  onclick="mostrarOcultarSenhaLogin()"> <b>Mostrar senha</b>
                            </p>
                            <button class="w3-button w3-block w3-theme w3-section w3-padding" type="submit">Login</button>
                            </div>
                        </form>

                        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                            <button onclick="document.getElementById('id0L').style.display='none'" type="button" class="w3-button w3-red">Cancelar</button>
                            <span class="w3-right w3-padding w3-hide-small"><a href="#">Esqueceu a senha?</a></span>
                        </div>

                    </div>
                </div>
                <!-- MODAL CADASTRO: pop up para realizar Cadastro - --> 
                <div id="id0C" class="w3-modal">
                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">
                        <div class="w3-center"> 
                            <span onclick="document.getElementById('id0C').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
                        </div>
                        <h2 class="w3-center w3-xxlarge">Cadastrar</h2>
                        <form action="cadastro.php" method="POST" class="w3-container w3-card-4 w3-light-grey w3-margin">
                            <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                                <div class="w3-rest">
                                <label class="w3-text-IE"><b>Nome de usuário</b>*</label>
                                <input class="w3-input w3-border" name="nome" type="text" placeholder="Nome">
                                </div>
                            </div>
                            <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                                <div class="w3-rest">
                                <label class="w3-text-IE"><b>Login</b>*</label>                        
                                <input class="w3-input w3-border" name="Login" type="text"
                                    pattern="[a-zA-Z]{2,20}\.[a-zA-Z]{2,20}" placeholder="nome.sobrenome" title="nome.sobrenome" required>
                                </div>
                            </div>
                            <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
                                <div class="w3-rest">
                                <label class="w3-text-IE"><b>Celular</b>*</label> 
                                <input class="w3-input w3-border " name="Celular" id="Celular"  type="text" maxlength="15"
                                    placeholder="(XX)XXXXX-XXXX" title="(XX)XXXXX-XXXX"  pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$" required
                                    onkeypress="mask(this, mphone);" onblur="mask(this, mphone);"> 
                                </div>
                            </div>
                            <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px"></div>
                                <div class="w3-rest">
                                <label class="w3-text-IE"><b>Senha</b>*</label> 
                                <input class="w3-input w3-border " name="Senha1" id="Senha1" type="password" 
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}"
                                    title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
                                    required> 
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                            <div class="w3-col" style="width:50px"></div>
                                <div class="w3-rest">
                                <label class="w3-text-IE"><b>Confirma Senha</b>*</label> 
                                <input class="w3-input w3-border" name="Senha2" id="Senha2" type="password" onkeyup="validarSenha()"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}"
                                    title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
                                    required> 
                                </div>
                            </div>
                            <p>
                                <input type="checkbox" class="w3-btn w3-theme"  onclick="mostrarOcultarSenhaCadastro()"> <b>Mostrar senha</b>
                            </p>
                            <p class="w3-center">
                            <button class="w3-button w3-block w3-theme w3-section w3-padding" type="submit"> Enviar </button>
                            </p>
                        </form>

                        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                            <button onclick="document.getElementById('id0C').style.display='none'" type="button" class="w3-button w3-red">Cancelar</button>
                        </div>

                    </div>
                </div>

                <?php require 'geral/sobre.php';?>
                <!-- FIM PRINCIPAL -->
                </div>
                <!-- Inclui RODAPE.PHP  -->
                <?php require 'geral/rodape.php';?>
	</body>
</html>