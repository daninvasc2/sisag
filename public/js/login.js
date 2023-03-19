let urlLoginController = '../controller/LoginController.class.php';

const estaNaIndex = window.location.pathname.includes('index.php');
const estaNaTelaDeLogin = window.location.pathname.includes('login.php');

if (estaNaIndex) {
    urlLoginController = 'controller/LoginController.class.php';
}

document.addEventListener('DOMContentLoaded', function () {
    verificarLogin();
}, false);

function verificarLogin() {
    if (estaNaTelaDeLogin) {
        return;
    }

    $.ajax({
        url: urlLoginController + '?_acao=verificarLogin',
        type: 'get',
        success: function (data) {
            const retorno = JSON.parse(data);
            if (retorno.status_code == 200) {
                if (estaNaIndex) {
                    window.location.href = "view/listing.php";
                }
            } else {
                if (estaNaIndex) {
                    window.location.href = "view/login.php";
                } else {
                    window.location.href = "login.php";
                }
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function sairDoSistema() {
    $.ajax({
        url: urlLoginController + '?_acao=logout',
        type: 'get',
        success: function (data) {
            window.location.href = "login.php";
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function fazerLogin() {
    $.ajax({
        url: urlLoginController,
        type: 'post',
        data: {
            login: $('#login').val(),
            senha: $('#senha').val(),
            _acao: 'login'
        },
        success: function (data) {
            const retorno = JSON.parse(data);
            if (retorno.status_code == 200) {
                window.location.href = "listing.php";
            } else {
                alert('Login ou senha inválidos!');
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function fazerCadastro() {
    let form = document.getElementById("formCadastro");
    let formData = new FormData(form);
    const nome = $('#nomeCadastro').val();
    const login = $('#loginCadastro').val();
    const senha = $('#senhaCadastro').val();
    const confirmarSenha = $('#confirmarSenha').val();
    const caminhoFoto = $('#fotoCadastro').val();
    const foto = $("#fotoCadastro")[0].files[0];
    formData.append("foto", foto);

    if (nome == '' || login == '' || senha == '' || confirmarSenha == '' || caminhoFoto == '') {
        alert('Preencha todos os campos!');
        return;
    }

    if (senha != confirmarSenha) {
        alert('As senhas não são iguais!');
        return;
    }

    $.ajax({
        url: urlLoginController,
        type: 'post',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (data) {
            const retorno = JSON.parse(data);
            if (retorno.status_code == 200) {
                window.location.href = "listing.php";
                alert('Login efetuado com sucesso!');
            } else {
                alert('Login ou senha inválidos!');
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function preparaCadastro() {
    window.location.href = "cadastro.php";
}