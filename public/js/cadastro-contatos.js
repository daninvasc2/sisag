// registrando o listener do evento submit no form de cadastro
formCadastrar = $("#form-cad-prod").on("submit", formValidate);

const controllerURL = "../controller/ContatoController.class.php";

// função básica de validação do campo select
function formValidate(evt) {
    // necessário selecionar pelo menos uma categoria
    evt.preventDefault();
    formSubmit(evt);
}

const idContato = $("#idContato").val();
if (idContato != null && idContato != "") {
    $.ajax({
        type: "GET",
        url: controllerURL + "?_acao=getContato&id=" + idContato,
        success: function (data) {
            const retorno = JSON.parse(data);
            if (retorno.status_code == 200) {
                const contato = retorno.contato;
                $("#input-name").val(contato.nome);
                $("#input-phone").val(contato.telefone);
                $("#input-email").val(contato.email);
                $("#input-image").attr("required", false);
                const img = document.createElement("img");
                img.src = '../' + contato.caminho_foto;
                img.alt = 'Foto de ' + contato.nome;
                img.classList.add('img-perfil');

                const divImage = $("#div-image");
                divImage.append(img);

                $("#acao").val("editar");
                $("#btn-submit").html("Editar");
            } else {
                alert("Erro ao carregar contato!");
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}

// realizando a requisição AJAX
function formSubmit(evt) {
    evt.preventDefault();

    let form = document.getElementById("form-cad-prod");

    let formData = new FormData(form);
    //formData.append("_acao", "cadastrar");
    // formData.append("nome", $("#input-name").val());
    // formData.append("telefone", $("#input-phone").val());
    // formData.append("email", $("#input-email").val());
    let foto = $("#input-image")[0].files[0];
    formData.append("foto", foto);

    $.ajax({
        type: "POST",
        url: controllerURL,
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: showModalAguardar,
        complete: closeModalAguardar,
        success: successfullRequest,
        error: errorRequest
    });
}

function showModalAguardar() {
    $("#modal-aguardar").modal({ backdrop: "static", keyboard: false });
}

function closeModalAguardar() {
    $("#modal-aguardar").modal("hide");
}

// exibe o modal result
function showModalResult() {
    $("#modal-result").modal({
        show: true,
        backdrop: "static",
        keyboard: false
    });

    // window.location.href = "listing.php";
}

// handles success request
function successfullRequest(response) {
    try {
        // try to parse JSON response
        const objResult = JSON.parse(response);
        preparaModalResult(objResult);
        // exibe modal
        showModalResult();
    } catch (e) {
        const msg =
            "Ocorreu um erro ao tentar cadastrar o contato (JSON PARSE ERROR).<br>Mensagem: " +
            e.message;
        preparaModalResult({ message: msg, status_code: 0 });
        // exibe modal
        showModalResult();
    }
}

// prepara para a exibição dos dados
function preparaModalResult(objResult) {
    const status_code = parseInt(objResult.status_code);
    // registra o listener no modal e coloca informações pertinentes
    $("#modal-result").on("show.bs.modal", function (event) {
        switch (status_code) {
            case 1: // success
                $(this).find(".modal-header").addClass("bg-success text-white");
                $(this).find(".modal-body").html(objResult.message);
                break;
            case 0: // error
                $(this).find(".modal-header").addClass("bg-danger text-white");
                $(this).find(".modal-body").html(objResult.message);
                break;
            default: // default message
                $(this).find(".modal-header").addClass("bg-danger text-white");
                $(this)
                    .find(".modal-body")
                    .html(
                        "Ooopss, um erro ocorreu ao tentar realizar o cadastro."
                    );
        }
    });

    // registra o listener para o evento 'hidden.bs.modal'
    $("#modal-result").on("hidden.bs.modal", function (event) {
        resetFormFields();
    });
}

// handles error request
function errorRequest(xhr, status, error) {
    const msg =
        "Ocorreu um erro com a requisição.<br> Mensagem: Status " +
        xhr.status +
        ": " +
        xhr.statusText;
    preparaModalResult({ message: msg, status_code: 0 });
    showModalResult();
}

// modal close button listener
$("#btn-close").on("click", function () {
    resetFormFields();
});

function resetFormFields() {
    $("#input-name").val("");
    $("#select-category").prop("selectedIndex", 0);
    $("#input-quantity").val("");
}

// funcao para tratar a entrada de dados no campo quantidade
function isNumber(evt) {
    let charCode = evt.charCode;
    if (charCode < 48 || charCode > 57) {
        return false;
    }
    return true;
}
