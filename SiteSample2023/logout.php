<!DOCTYPE html>
<html lang="pt">
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Março/2023
---------------------------------------------------------------------------------->
<!-- Logout.php --> 

<html>
	<head>	
		<title>IE - Instituição de Ensino</title>
		<link rel="icon" type="image/png" href="imagens/IE_favicon.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="css/customize.css">
        <script type="text/javascript" src="js/myScript.js"></script>
	</head>
	<body >  
        <?php
            session_start();
        ?>
        <div class="w3-main w3-container w3-center" style="margin-left:270px;margin-top:117px;">

                <div id="iOut" class="w3-modal w3-center" style="display:none">
                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">
                        <div class="w3-center"> 
                            <h2 class="w3-center">Fechando a sessão ...</h2>
                            <img src="imagens/processando.gif" class="w3-round-xxlarge"  style="max-width:300px">
                        </div>
                    </div>
                </div>
                
                <?php
                    session_destroy();                     // Destrói todas as variáveis de sessão
                    $url = "Location: index.php";         // URL para redirecionamento
                    header($url);                    // Vai para a página de login / inicial
                    exit();
                ?>
        </div>
	</body>
</html>