<?php
    
    include_once "ConexaoPDO.class.php";
    include_once 'ProdutoDao.class.php';
    include_once '../model/Produto.class.php';

    $dao = new ConexaoPDO();
    $produtoDao = new ProdutoDao();    
    try {           
        // Testes realizados com a classe produtoDao         
         //$produto = new Produto(0, 'Arroz Integral', 'ALIMENTOS', 50);        
         $produto = new Produto(0, 'Suco de Uva Integral', 'BEBIDAS', 20);        
        
        // cadastrar 
        //var_dump($produtoDao->cadastrarProduto($produto));

        // buscar todos
        //echo json_encode($produtoDao->buscarTodosProdutos());
        
        // buscar por id
        //echo json_encode($produtoDao->buscarProdutoPorId(6));
               
        // atualizar
        //var_dump($produtoDao->atualizarProduto(3, array('nome' => 'Suco de Uva Integral')));
        
        // deletar
        echo var_dump($produtoDao->deletarProduto(6));        
    } catch (Exception $ex) {
        echo 'Mensagem da Exceção ocorrida: '.$ex->getMessage();
    }
    
?>