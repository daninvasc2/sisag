<?php
    
    include_once "ProdutoController.class.php";

    
    $produtoController = new ProdutoController();

    try {           
        //echo $produtoController->cadastrar();
        echo $produtoController->buscarTodosProdutos();

    } catch (Exception $ex) {
        echo 'Mensagem da Exceção ocorrida: '.$ex->getMessage();
    }
    
?>