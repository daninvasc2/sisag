<?php 
    // model
    include_once '../model/Produto.class.php';    
    // dao
    include_once '../dao/ProdutoDao.class.php';

   try {
        $produtoController = new ProdutoController();
        $produtoController->handleRequest();
   } catch (Exception $ex) {
        echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar realizar a requisição.<br> Mensagem: '.$ex->getMessage(), 'status_code' => 0));
   }

    // declaração da classe controller do produto
    class ProdutoController {
        private $daoProduto;

        public function __construct() {
            $this->daoProduto = new ProdutoDao();
        }

        public function handleRequest() {            
            //identificando o tipo de requisicao recebida            
            switch ($_SERVER['REQUEST_METHOD']) 
            {
                case 'POST':                    
                    if (isset($_POST['_acao'])) {
                        $this->handlePostRequest($_POST['_acao']);                        
                    } else {
                        echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar a operação.<br> Ação não informada', 'status_code' => 0));     
                    }                     
                break;

                case 'GET':
                    if (isset($_GET['_acao'])) {
                        $this->handleGetRequest($_GET['_acao']);                        
                    } else {
                        echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar a operação.<br> Ação não informada', 'status_code' => 0));     
                    }                      
                break;

                default:
                    echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar a operação.<br> Requisição desconhecida', 'status_code' => 0)); 
            }
        }

        private function handlePostRequest($_acao) {
            switch($_acao) {
                case 'cadastrar':
                    $this->cadastrar();
                break;
                // poderiam existir outras ações a serem executadas com POST
                default:
                    echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar a operação.<br> Ação desconhecida', 'status_code' => 0)); 
            }            
        }

        private function handleGetRequest($_acao) {
            switch($_acao) {
                case 'listar':
                    $this->buscarTodosProdutos();
                break;
                // poderiam existir outras ações a serem executadas com GET
                default:
                    echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar a operação.<br> Ação desconhecida', 'status_code' => 0)); 
            }
        }

        public function cadastrar() {
            try {
                 extract($_POST);
                // variaveis $_acao, $nome, $categoria e $quantidade
                $produto = new Produto(0, $nome, $categoria, $quantidade);
                if (!$this->daoProduto->produtoExiste('nome', $produto->get('nome'))) {

                    if($this->daoProduto->cadastrarProduto($produto)) {
                        echo json_encode(array('message' => 'Cadastro realizado com sucesso!', 'status_code' => 1));
                    } else {
                        echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar o cadastro.', 'status_code' => 0));
                    }

                } else {
                    echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar o cadastro.<br>Já existe um produto com o nome informado.', 'status_code' => 0));
                }                
            } catch (Exception $ex) {
                echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar realizar o cadastro.<br> Mensagem: '.$ex->getMessage(), 'status_code' => 0));
            }
        }

        public function buscarTodosProdutos() {
            $produtos = [];
            try {
                $produtos = $this->daoProduto->buscarTodosProdutos();
                echo json_encode($produtos);
            } catch (Exception $ex) {
                echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar buscar os produtos.<br>Mensagem: '.$ex->getMessage(), 'status_code' => 0));
            }
        }

        public function atualizar() {
            try {
                echo json_encode(array('message' => 'Produto atualizado com sucesso', 'status_code' => 1));
            } catch (Exception $ex) {
                echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar atualizar o produto.<br>Mensagem: '.$ex->getMessage(), 'status_code' => 0));
            }
        }    
        
        public function deletar() {
            try {
                echo json_encode(array('message' => 'Produto excluído com sucesso', 'status_code' => 1));
            } catch (Exception $ex) {
                echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar excluir o produto.<br>Mensagem: '.$ex->getMessage(), 'status_code' => 0));
            }
        }

        public function buscarPorId() {
            try {
                echo json_encode(array('message' => 'Produto encontrado', 'status_code' => 1));
            } catch (Exception $ex) {
                echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar recuperar o produto.<br>Mensagem: '.$ex->getMessage(), 'status_code' => 0));
            }
        }
    }
?>