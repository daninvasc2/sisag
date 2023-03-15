<?php

include_once "ConexaoPDO.class.php";
include_once 'ContatoDao.class.php';
include_once '../model/Contato.class.php';

$dao = new ConexaoPDO();
$contatoDao = new ContatoDao();
try {
    // Testes realizados com a classe contatoDao
    //$contato = new Contato(0, 'Arroz Integral', 'ALIMENTOS', 50);
    //$contato = new Contato(0, 'Suco de Uva Integral', 'BEBIDAS', 20);

    // cadastrar
    //var_dump($contatoDao->cadastrarContato($contato));

    // buscar todos
    //echo json_encode($contatoDao->buscarTodosContatos());

    // buscar por id
    //echo json_encode($contatoDao->buscarContatoPorId(6));

    // atualizar
    //var_dump($contatoDao->atualizarContato(3, array('nome' => 'Suco de Uva Integral')));

    // deletar
    echo var_dump($contatoDao->deletarContato(6));
} catch (Exception $ex) {
    echo 'Mensagem da Exceção ocorrida: ' . $ex->getMessage();
}

?>