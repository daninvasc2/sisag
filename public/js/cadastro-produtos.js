
    // registrando o listener do evento submit no form de cadastro
    formCadastrar = $('#form-cad-prod').on('submit', formValidate);

    // função básica de validação do campo select
    function formValidate(evt) {
        // necessário selecionar pelo menos uma categoria
        if($('#select-category')[0].selectedIndex == 0) {
            alert('Selecione uma categoria válida!');
            evt.preventDefault(); 
            return;
        }        
        formSubmit(evt);
    }

    // realizando a requisição AJAX
    function formSubmit(evt) {    
        const controllerURL = "../controller/ProdutoController.class.php";    
        evt.preventDefault();     
        $.ajax({
            type: "POST",
            url: controllerURL,
            data: $(formCadastrar).serialize(),
            beforeSend: showModalAguardar,
            complete: closeModalAguardar,
            success: successfullRequest,
            error: errorRequest
        });    
    }

    function showModalAguardar() {
        $("#modal-aguardar").modal({backdrop: 'static', keyboard: false});        
    }

    function closeModalAguardar() {
        $("#modal-aguardar").modal('hide');
    }

    // exibe o modal result
    function showModalResult() {                
        $("#modal-result").modal({show: true, backdrop: 'static', keyboard: false});
    }

    // handles success request
    function successfullRequest(response) {          
        try {             
            // try to parse JSON response      
            const objResult = JSON.parse(response);            
            preparaModalResult(objResult);
            // exibe modal
            showModalResult();                       

        } catch(e) {                    
            const msg = 'Ocorreu um erro ao tentar cadastrar o produto (JSON PARSE ERROR).<br>Mensagem: ' + e.message;    
            preparaModalResult({message: msg, status_code: 0});
            // exibe modal
            showModalResult();            
        }    
    }

    // prepara para a exibição dos dados 
    function preparaModalResult(objResult) {
        const status_code = parseInt(objResult.status_code);
        // registra o listener no modal e coloca informações pertinentes
        $('#modal-result').on('show.bs.modal', function (event) {
            switch(status_code) {
                case 1: // success
                    $(this).find('.modal-header').addClass('bg-success text-white');
                    $(this).find('.modal-body').html(objResult.message);                                    
                break;
                case 0: // error
                    $(this).find('.modal-header').addClass('bg-danger text-white');
                    $(this).find('.modal-body').html(objResult.message);                    
                break;            
                default: // default message                    
                    $(this).find('.modal-header').addClass('bg-danger text-white');
                    $(this).find('.modal-body').html('Ooopss, um erro ocorreu ao tentar realizar o cadastro.');                    
            }
        });     

        // registra o listener para o evento 'hidden.bs.modal' 
        $('#modal-result').on('hidden.bs.modal', function(event) {
            resetFormFields();
        });
    }

    // handles error request
    function errorRequest(xhr, status, error) {                                
        const msg = 'Ocorreu um erro com a requisição.<br> Mensagem: Status ' + xhr.status + ': ' + xhr.statusText;        
        preparaModalResult({message: msg, status_code: 0});        
        showModalResult();
    }

    // modal close button listener
    $("#btn-close").on('click', function () {
        resetFormFields();
    });   

    function resetFormFields() {
        $("#input-name").val('');
        $('#select-category').prop('selectedIndex', 0);
        $("#input-quantity").val('');
    }

    // funcao para tratar a entrada de dados no campo quantidade
    function isNumber(evt)
    {    
        let charCode = evt.charCode;    
        if (charCode < 48 || charCode > 57)
        {
            return false;
        }
        return true;    
    }