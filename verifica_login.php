<?php
    session_start();
    $url = dirname($_SERVER['SCRIPT_NAME']);                   // Obtém URL básica da aplicação Web
    $url = substr($url,strrpos($url,"\\/")+1,strlen($url));    // Retira 1o. '/'
    if (substr_count($url, '/') >= 1){                          
        $url = substr($url,strrpos($url,"\\/"),strlen($url));  // Retira 2o. '/', se ainda houver esse caracter
        $url = strstr($url, '/',true);
    }

    if(!$_SESSION['login']){                                    // Não houve login ainda
        $url = "Location: /" . $url . "/index.php";             // Monta URL para redirecionamento
        header($url);                                           // Vai para a página de login / inicial
        exit();
    }