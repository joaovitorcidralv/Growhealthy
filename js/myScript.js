// Script para preenchimento de número de celular
function mask(o, f) {
  setTimeout(function() {
    var v = mphone(o.value);
    if (v != o.value) {
      o.value = v;
    }
  }, 1);
}

function mphone(v) {
  var r = v.replace(/\D/g, "");
  r = r.replace(/^0/, "");
  if (r.length > 10) {
    r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1)$2-$3");
  } else if (r.length > 5) {
    r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1)$2-$3");
  } else if (r.length > 2) {
    r = r.replace(/^(\d\d)(\d{0,5})/, "($1)$2");
  } else {
    r = r.replace(/^(\d*)/, "($1");
  }
  return r;
}

// Script para mostrar ou ocultar senha
function mostrarOcultarSenha(total) {
  if (total == 2){
    var senhaL  = document.getElementById("SenhaL"); // Senha do Modal Login
    var chkL    = document.getElementById("chkL");   // checkbox Mostra Senha Login
  }
  var senha  = document.getElementById("Senha");   // Senha1 do Modal Cadastro
  var senha2 = document.getElementById("Senha2");  // Senha2 do Modal Cadastro
  var chkC    = document.getElementById("chkC");   // checkbox Mostra Senha Cadastro

  if (senha.type == "password"){
    if (total == 2){
      senhaL.type  = "text";
      chkL.checked = true;
    }
    senha.type  = "text";
    senha2.type = "text";
    chkC.checked = true;
  } else {
    if (total == 2){
      senhaL.type  = "password";
      chkL.checked = false;
    }
    senha.type  = "password";
    senha2.type = "password";
    chkC.checked = false;
  }
}

// Script para validar senha e confirmação Ok
function confirmaSenha() {
  var senha  = document.getElementById("Senha");  // Senha1 do Modal Cadastro
  var senha2 = document.getElementById("Senha2"); // Senha2 do Modal Cadastro

  if (senha.value != senha2.value) {
    senha2.setCustomValidity("Senhas diferentes!");
    senha2.reportValidity();
    return false;
  } else {
    senha2.setCustomValidity("");
    return true;
  }
}

// Script para abrir e fechar o sidebar

function w3_anonymous(){
  w3_close();
  w3_show_none()
  w3_open("LoginCadastro");

}

function LF_open() {  // Aviso: Login Fail Modal
  document.getElementById("LF").style.display = "block";
}

function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  }

function w3_show_nav(name) {
  //w3_open("myOverlay");
  document.getElementById("menuProf").style.display = "none";
  document.getElementById("menuDisc").style.display = "none";
  document.getElementById("menuTurma").style.display = "none";
  document.getElementById(name).style.display = "block";
}
function w3_show_none() {
  document.getElementById("menuProf").style.display = "none";
  document.getElementById("menuDisc").style.display = "none";
  document.getElementById("menuTurma").style.display = "none";
}

function validaImagem(input) {
  var caminho = input.value;

  if (caminho) {
      var comecoCaminho = (caminho.indexOf('\\') >= 0 ? caminho.lastIndexOf('\\') : caminho.lastIndexOf('/'));
      var nomeArquivo = caminho.substring(comecoCaminho);

      if (nomeArquivo.indexOf('\\') === 0 || nomeArquivo.indexOf('/') === 0) {
          nomeArquivo = nomeArquivo.substring(1);
      }

      var extensaoArquivo = nomeArquivo.indexOf('.') < 1 ? '' : nomeArquivo.split('.').pop();

      if (extensaoArquivo != 'gif' &&
          extensaoArquivo != 'png' &&
          extensaoArquivo != 'jpg' &&
          extensaoArquivo != 'jpeg') {
          input.value = '';
          alert("É preciso selecionar um arquivo de imagem (gif, png, jpg ou jpeg)");
      }
  } else {
      input.value = '';
      alert("Selecione um caminho de arquivo válido");
  }
  if (input.files && input.files[0]) {
      var arquivoTam = input.files[0].size / 1024 / 1024;
      if (arquivoTam < 16) {
          var reader = new FileReader();
          reader.onload = function(e) {
              document.getElementById('imagemSelecionada').setAttribute('src', e.target.result);
          };
          reader.readAsDataURL(input.files[0]);
      } else {
          input.value = '';
          alert("O arquivo precisa ser uma imagem com menos de 16 MB");
      }
  } else{
      document.getElementById('imagemSelecionada').setAttribute('src', '#');
  }
}


