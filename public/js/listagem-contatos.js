$(document).ready(listarContatos);

const listaContatos = document.querySelector("#lista-contatos");

function listarContatos() {
    const controllerURL =
        "../controller/ContatoController.class.php?_acao=listar";

    $.ajax({
        url: controllerURL,
        type: "GET",
        dataType: "JSON",
        beforeSend: showModalAguardar,
        complete: closeModalAguardar,
        success: successfullRequest,
        error: errorListRequest
    });
}

function showModalAguardar() {
    $("#modal-aguardar").modal({ backdrop: "static", keyboard: false });
}

function closeModalAguardar() {
    $("#modal-aguardar").modal("hide");
}

/**
 *
 * @param {Array of objects} response - handles success request
 */
function successfullRequest(response) {
    try {
        // array of objects
        if (Array.isArray(response)) {
            const size = response.length;

            if (size > 0) {
                //contatos = response; // set objects globally
                // show table
                $("#table-contatos").attr("hidden", false);
                loadContatos(response); // carrega os contatos na tabela
            } else {
                showWarningMessage("Opss! Não existem contatos cadastrados");
            }
        } else {
            if (response.status_code == 0) {
                showErrorMessage(
                    "Ocorreu um erro ao tentar recuperar os contatos.<br>Mensagem: " +
                        response.message
                );
            }
        }
    } catch (e) {
        showWarningMessage(
            "Ocorreu um erro ao tentar listar os contatos.<br>Mensagem: " +
                e.message
        );
    }
}

// handles error request
function errorListRequest(xhr, status, error) {
    showErrorMessage(
        "Ocorreu um erro ao tentar recuperar os contatos.<br>Mensagem: " +
            error +
            "<br>Status " +
            xhr.status +
            ": " +
            xhr.statusText
    );
}

/**
 * Carrega os contatos na tabela
 */
function loadContatos(contatos) {
    let objHtml = "";
    for (let i = 0; i < contatos.length; i++) {
        objHtml += "<tr>";
        objHtml += `<td><img src="../${contatos[i].caminho_foto}" alt="Foto do contato" class='img-perfil'></td>`;
        objHtml += "<td>" + contatos[i].nome + "</td>";
        objHtml += "<td>" + contatos[i].telefone + "</td>";
        objHtml += "<td>" + contatos[i].email + "</td>";
        objHtml +=
            '<td><span onclick="excluir(' +
            contatos[i].idContato +
            ')" class="btn btn-danger p-2" role="button"><i class="fas fa-trash-alt text-white" data-toggle="tooltip" data-placement="top" title="Excluir contato"></i></span></td>';
        objHtml +=
            '<td><span onclick="editar(' +
            contatos[i].idContato +
            ')" class="btn btn-success p-2" role="button"><i class="fas fa-edit text-white" data-toggle="tooltip" data-placement="top" title="Editar contato"></i></span></td>                    ';
        objHtml += "</tr>";
        $("table tbody").append(objHtml);
        objHtml = "";
    }
}

function showWarningMessage(msg) {
    $("#main-container").append(
        '<h5 class= "text-danger mt-3"><i class="fa fa-warning text-warning"></i> ' +
            msg +
            "</h5>"
    );
}

function showErrorMessage(msg) {
    $("#main-container").append(
        '<h6 class= "text-danger mt-3"><i class="fa fa-warning"></i> ' +
            msg +
            "</h6>"
    );
}

function excluir(idContato) {
    alert("Excluir contato com o id = " + idContato);

    $.ajax({
        url: "../controller/ContatoController.class.php",
        type: "POST",
        data: { idContato, '_acao': 'deletar' },
        dataType: "JSON",
        beforeSend: showModalAguardar,
        complete: closeModalAguardar,
        success: successfullRequest,
        error: errorListRequest
    });

    window.location.reload();
}

function editar(idContato) {
    alert("Editar contato com o id = " + idContato);
    window.location.href = "form-cad.php?id=" + idContato;
}
