<!DOCTYPE html>
<html lang="pt">


<html>
	<head>	
        <meta charset="UTF-8">
		<title>GrowHealthy</title>
		<link rel="icon" type="image/png" href="imagens/logo1.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="css/customize.css">
        <script type="text/javascript" src="js/myScript.js"></script>
	</head>
	<body >  
        <?php
            session_start();
            if (isset($_SESSION['tipo'])) {                                  // Se existe usuário logado, verifica o tipo
                if ($_SESSION['tipo'] == 'aluno'){
                    $url = 'location: /repaginado/aluno.php';	             
                    header($url);                                         	  // Vai para a página inicial de Aluno
                    exit();
                }elseif ($_SESSION['tipo'] == 'personal'){
                    $url = 'location: /repaginado/personal/perfilPersonal.php';	 
                    header($url);                                         	  // Vai para a página inicial de Professor
                    exit();
                }
            }
        ?>
        <!-- Não encontrou usuário logado, então mostra página inicial -->
        <!-- Menu Superior -->
        <div class="w3-top" id="LoginCadastro" >
            <div class="w3-row w3-white w3-padding" >
                <div class="w3-half" style="margin:0 0 0 0"><a href="."><img src='imagens/logo1.png' alt=' ' width="50" height="40"></a></div>
                <div class="w3-half w3-margin-top w3-wide w3-hide-medium w3-hide-small">
                </div>
            </div>
            <div class="w3-bar w3-cyan w3-large" style="z-index:-1">
            <a class="w3-bar-item w3-button w3-left w3-hide-large w3-hover-light-gray w3-large w3-cyan w3-padding-16" href="javascript:void(0)" onclick="w3_open('LoginCadadstro')">☰</a>
                <a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" onclick="document.getElementById('id0L').style.display='block'" href="javascript:void(0)" >Login</a>
                <a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" onclick="document.getElementById('id0C').style.display='block'"href="javascript:void(0)" ">Cadastro</a>
            </div>
	    </div>
        <!-- Logo da página -->
        <div class="w3-top">
            <div class="w3-row w3-white w3-padding">
                <div class="w3-half" style="margin:0 0 0 0">
                    <a href="."><img src='imagens/logo1.png' alt='  ' width="50" height="50"></a>
                    <b style="font-size:20px">GrowHealthy</b>
                </div>
            </div>
        </div>

        <!-- Sidebar (menu lateral) -->
        <div class="w3-sidebar w3-bar-block w3-collapse w3-animate-left" style="z-index:3;width:270px" id="mySidebar" >
            <div class="w3-bar w3-hide-large w3-large">
                <a href="javascript:void(0)"  onclick="document.getElementById('id0L').style.display='block'" href="javascript:void(0)"
                class="w3-bar-item w3-button w3-cyan w3-hover-light-gray w3-padding-16" style="width:50%">Login</a>
                <a href="javascript:void(0)"  onclick="document.getElementById('id0C').style.display='block'" href="javascript:void(0)"
                class="w3-bar-item w3-button w3-cyan w3-hover-light-gray w3-padding-16" style="width:50%">Cadastro</a> 
            </div>
            <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-right w3-xlarge w3-hide-large" title="Close Menu">x</a>
        </div>

        <!-- Conteúdo PRINCIPAL: deslocado para direita em 270 pixels quando a sidebar é visível -->
		<div class="w3-main w3-container" style="margin-left:270px;margin-top:200px;margin-right:270px;">
            <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey" >
                <h1 class="w3-jumbo">Como Funciona o Nosso Sistema</h1>
                <div style="overflow:auto">
                <img src="imagens/fit1.png" class="w3-round-xxlarge" width="70%" style="max-width:500px; float:left; margin-right:20px;">
                <p style="font-size: 20px; text-align:justify;">A aplicação web “GrowHealthy” está sendo desenvolvida com foco no segmento de saúde e área fitness. O objetivo é permitir que academias de pequeno e médio porte gerenciem seus alunos com mais facilidade e eficiência, além de fornecer aos personal trainers e nutricionistas uma ferramenta com auxílio de inteligência artificial para desenvolverem treinos e dietas personalizadas para seus alunos</p>
                </div>
                <div style="clear:both;"></div>
            </div>             
                <!-- Login Fail Modal --> 
                <!-- -->
                <?php
                $msg        = "";
                $msg_header = "";
                if(isset($_SESSION['nao_autenticado'])){ 
                    // Houve falha(login incorreto ou cadastro incorreto)
                    $msg        = $_SESSION['mensagem'];
                    $msg_header = $_SESSION['mensagem_header'];
                    $style      = "display:block"; // div da msg aparece 
                }else{
                    // Usuário já autenticado
                    unset($_SESSION['nao_autenticado']);
                    $style      = "display:none"; // div da msg não aparece 
                }
                ?>
                <!-- MODAL FAIL: Houve falha(login incorreto ou cadastro incorreto) ou não  --> 
                <div id="LF" class="w3-modal " style="<?php echo $style;?>">  
                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">
                        <div class="w3-center"> 
                            <span onclick="document.getElementById('LF').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
                        
                        <h2 class="w3-center w3-xxlarge "><?php echo $msg_header; ?></h2>
                        <p class="w3-container w3-card-4 w3-light-grey w3-text-cyan w3-margin"><?php echo $msg; ?></p>
                        <?php 
                        session_destroy(); // Após msg de erro, destrói elementos de sessão para limpar mgs se nova carga de página
                        ?>
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
                        <form action="login.php" method="POST" class="w3-container w3-card-4 w3-light-grey w3-text-cyan w3-margin">
                            
                            <label class="w3-text-cyan"><b>Login do usuário</b>*</label>
                            <input class="w3-input w3-border w3-margin-bottom" type="text" name="Login" placeholder="nome.sobrenome">
                            <label class="w3-text-cyan"><b>Senha</b>*</label>
                            <input class="w3-input w3-border" name="SenhaL" id="SenhaL" type="password"  
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" placeholder="sua senha" 
                            title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
                           >
                            <p>
                            <input type="checkbox" id="chkL" class="w3-btn w3-cyan"  onclick="mostrarOcultarSenha(2)"> <b>Mostrar senha</b>
                            </p>
                            <div class="w3-section">
                            <label class="w3-text-cyan"><b>Você é: </b>*</label> <br>
                            <span class="w3-text-cyan">
                            <label>Aluno </label>
                            <input type="radio" id="aluno" name="tipo" value="aluno" required>
                            <label>Nutricionista </label>
                            <input type="radio" id="nutricionista" name="tipo" value="nutricionista" required>
                            <label>Personal </label>
                            <input type="radio" id="personal" name="tipo" value="personal" required>
                            

                                
                            

                            <button class="w3-button w3-block w3-cyan w3-section w3-padding" type="submit">Login</button>
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
                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px">
                        <div class="w3-center"> 
                            <span onclick="document.getElementById('id0C').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
                        </div>
                        <h2 class="w3-center w3-xxlarge">Cadastrar</h2>
                        <form action="cadastro.php" method="POST" class="w3-container w3-card-4 w3-light-grey w3-margin" >
                            <div class="w3-row w3-section">
                                <div class="w3-rest">
                                <label class="w3-text-cyan"><b>Nome de usuário</b>*</label>
                                <input class="w3-input w3-border" name="nome" type="text" placeholder="Nome Sobrenome" required>
                                </div>
                            </div>
                            <div class="w3-row w3-section">
                                <div class="w3-rest">
                                <label class="w3-text-cyan"><b>Login</b>*</label>                        
                                <input class="w3-input w3-border" name="Login" id="Login" type="text"
                                    pattern="[a-zA-Z]{2,20}\.[a-zA-Z]{2,20}" placeholder="nome.sobrenome" title="nome.sobrenome" required>
                                </div>
                            </div>
                            <div class="w3-row w3-section">
                                <div class="w3-rest">
                                <label class="w3-text-cyan"><b>Celular</b>*</label> 
                                <input class="w3-input w3-border " name="Celular" id="Celular"  type="text" maxlength="15"
                                    placeholder="(XX)XXXXX-XXXX" title="(XX)XXXXX-XXXX"  pattern="^\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$" required
                                    onkeypress="mask(this, mphone);" onblur="mask(this, mphone);"> 
                                </div>
                            </div>
                            <div class="w3-row w3-section">
                                <div class="w3-rest">
                                <label class="w3-text-cyan"><b>Email</b>*</label> 
                                <input class="w3-input w3-border" name="Email" type="text" placeholder="exemplo@gmail.com"
                                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"> 
                                </div>
                            </div>
                            <div class="w3-row w3-section" onclick="openPopup()">
                                <div class="w3-rest">
                                    <label class="w3-text-cyan"><b>CPF</b>*</label> 
                                    <input class="w3-input w3-border" name="cpf" type="text" placeholder="000.000.000-00"
                                    pattern="^\d{3}\.\d{3}\.\d{3}-\d{2}$|^\d{11}$" oninput="this.value=this.value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/,'$1.$2.$3-$4').replace(/\D/g,'')" maxlength="11"> 
                                </div>
                              </div>

                            <div class="w3-row w3-section">
                                <div class="w3-rest">
                                    <label class="w3-text-cyan"><b>Data de nascimento</b>*</label> 
                                    <input class="w3-input w3-border" type="dt_nasc" name="dt_nasc" id="dt_nasc" 
                                    placeholder="EX: 18-04-2000"
                                    pattern="^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-(19[0-9][0-9]|20(0[0-9]|1[0-2]))$" maxlength=10 minlength=10>

                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-rest ">
                                <label class="w3-text-cyan"><b>Gênero</b>*</label> <br>
                                <span class="w3-text-cyan">Feminino <input type="radio" id="Feminino" name="genero" value="Feminino">  
                                Masculino <input type="radio" id="Masculino" name="genero" value="masculino"> </span> 
                                </div>
                            </div>
                            <div class="w3-row w3-section">
                                <div class="w3-rest ">
                                <label class="w3-text-cyan"><b>tipo</b>*</label> <br>
                                <span class="w3-text-cyan">
                                
                                <label>Nutricionista </label>
                                <input onchange="exibir_ocultar(this)" type="radio" id="nutricionista" name="tipo" value="nutricionista" required>

                                <label>Personal </label>
                                <input onchange="exibir_ocultar(this)" type="radio" id="personal" name="tipo" value="personal" required>

                                <label>Aluno </label>
                                <input onchange="exibir_ocultar(this)" type="radio" id="aluno" name="tipo" value="aluno" required>
                                <!-- <a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" onclick="document.getElementById('id0C').style.display='block'"href="javascript:void(0)" ">Cadastro</a> -->

                                </span> 
                                </div>
                            </div>

                            <div class="w3-row w3-section" id="cref" style="display: none;">
                                <div class="w3-rest">
                                <label class="w3-text-cyan"><b>CREF</b>*</label>
                                <input pattern='^[0-9]{6}-[A-Z]/[A-Z]{2}$'
                                maxlength="11"
                                class="w3-input w3-border"  name="cref" type="text" placeholder=" " >
                                </div>
                            </div>

                            <div class="w3-row w3-section" id="crn" style="display: none;">
                                <div class="w3-rest">
                                <label class="w3-text-cyan"><b>CRN</b>*</label>
                                <input pattern='^[0-9]{6}-[A-Z]/[A-Z]{2}$'
                                maxlength="11"
                                class="w3-input w3-border"  name="crn" type="text" placeholder=" " >
                                </div>
                            </div>

                            <div class="w3-row w3-section" id="peso" style="display: none;">
                                <div class="w3-rest"> 
                                <label class="w3-text-cyan"><b>Peso</b>*</label>
                                <input pattern="(\s)?\d+([.,])?\d+(\s)?" class="w3-input w3-border" type="text" id="peso" name="peso" placeholder="EX: 68,90" oninput="this.value = this.value.replace(/[^0-9.,]/g, '')" maxlength="6"  min="20" max="300">

                                </div>
                            </div>

                            <div class="w3-row w3-section" id="altura" style="display: none;">
                                <div class="w3-rest">
                                <label class="w3-text-cyan"><b>Altura em cm</b>*</label>
                                <input class="w3-input w3-border" type="text" id="altura" name="altura"   placeholder="EX:171" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  min="60" max="230">

                                </div>
                            </div>


 
                            <div class="w3-row w3-section">
                                <div class="w3-rest">
                                <label class="w3-text-cyan"><b>Senha</b>*</label> 
                                <input class="w3-input w3-border " name="Senha" id="Senha" type="password" onchange="confirmaSenha()"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}"
                                    title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
                                    > 
                                </div>
                            </div>
                            <div class="w3-row w3-section">
                                <div class="w3-rest">
                                <label class="w3-text-cyan"><b>Confirma Senha</b>*</label> 
                                <input class="w3-input w3-border" name="Senha2" id="Senha2"type="password" onkeyup="confirmaSenha()"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}"
                                    title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" 
                                   > 
                                </div>
                            </div>
                            <p>
                                <input type="checkbox" id="chkC" class="w3-btn w3-cyan"  onclick="mostrarOcultarSenha(2)"> <b>Mostrar senha</b>
                            </p>
                            <p class="w3-center">
                            <button class="w3-button w3-block w3-cyan w3-section w3-padding" type="submit"> Enviar </button>
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

                <script>
                function exibir_ocultar(val){
                    console.log(val)
                    
                    if(val.value == 'nutricionista'){
                        document.getElementById('crn').style.display = 'block';
                        document.getElementById('cref').style.display = 'none';
                        document.getElementById('peso').style.display = 'none';
                        document.getElementById('altura').style.display = 'none';

                    } else if(val.value == 'personal'){
                        document.getElementById('cref').style.display = 'block';
                        document.getElementById('crn').style.display = 'none';
                        document.getElementById('peso').style.display = 'none';
                        document.getElementById('altura').style.display = 'none';

                    } else if(val.value == 'aluno'){
                        document.getElementById('cref').style.display = 'none';
                        document.getElementById('crn').style.display = 'none';
                        document.getElementById('peso').style.display = 'block';
                        document.getElementById('altura').style.display = 'block';

                    } 
                }

                function formatCpf(cpfInput) {
                let cpf = cpfInput.value.replace(/\D/g, '');
                cpf = cpf.padStart(11, '0');
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                cpfInput.value = cpf;
                }
                </script>
            </div>
        </div>
	</body>
</html>
