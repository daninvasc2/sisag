    $(document).ready(listarProdutos);

    function listarProdutos() {            
        const controllerURL = "../controller/ProdutoController.class.php?_acao=listar";       

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
        $("#modal-aguardar").modal({backdrop: 'static', keyboard: false});        
    }

    function closeModalAguardar() {
        $("#modal-aguardar").modal('hide');
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
                    //produtos = response; // set objects globally
                    // show table
                    $('#table-products').attr('hidden', false);
                    loadProdutos(response); // carrega os produtos na tabela
                } else {
                    showWarningMessage('Opss! Não existem produtos cadastrados');
                }                

            } else {
                showErrorMessage('Ocorreu um erro ao tentar recuperar os produtos.<br>Mensagem: ' + response.message);
            }

        } catch(e) {                    
            showWarningMessage('Ocorreu um erro ao tentar listar os produtos.<br>Mensagem: ' + e.message);    
        }    
    }

    // handles error request
    function errorListRequest(xhr, status, error) {                                
        showErrorMessage('Ocorreu um erro ao tentar recuperar os produtos.<br>Mensagem: ' + error + '<br>Status ' + xhr.status + ': ' + xhr.statusText);                
    }  

    /**
     * Carrega os produtos na tabela
    */
    function loadProdutos(produtos) {
        let objHtml = '';        
        for (let i = 0; i < produtos.length; i++) {
            
            objHtml += '<tr>';
            objHtml += '<td>'+ produtos[i].nome +'</td>';
            objHtml += '<td>'+ produtos[i].categoria +'</td>';
            objHtml += '<td>'+ produtos[i].quantidade +'</td>';
            objHtml += '<td><span onclick="excluir('+ produtos[i].idProduto +')" class="pl-3" role="button"><i class="fas fa-trash-alt text-danger" data-toggle="tooltip" data-placement="top" title="Excluir produto"></i></span></td>';
            objHtml += '<td><span onclick="editar('+ produtos[i].idProduto + ')" class="pl-3" role="button"><i class="fas fa-edit text-success" data-toggle="tooltip" data-placement="top" title="Editar produto"></i></span></td>                    ';
            objHtml += '</tr>';
            $('table tbody').append(objHtml);
            objHtml = '';            
        }                
    }

    function showWarningMessage(msg) {
        $('#main-container').append('<h5 class= "text-danger mt-3"><i class="fa fa-warning text-warning"></i> ' + msg + '</h5>');
    }

    function showErrorMessage(msg) {
        $('#main-container').append('<h6 class= "text-danger mt-3"><i class="fa fa-warning"></i> ' + msg + '</h6>');
    }

    function excluir(idProduto) {
        alert('Excluir produto com o id = ' + idProduto);
    }

    function editar(idProduto) {
        alert('Editar produto com o id = ' + idProduto);
    }
        