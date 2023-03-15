<?php

include_once "ContatoController.class.php";


$contatoController = new ContatoController();

try {
    //echo $contatoController->cadastrar();
    echo $contatoController->buscarTodosContatos();

} catch (Exception $ex) {
    echo 'Mensagem da Exceção ocorrida: ' . $ex->getMessage();
}

?>