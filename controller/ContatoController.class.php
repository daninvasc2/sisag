<?php
// model
include_once '../model/Contato.class.php';
// dao
include_once '../dao/ContatoDao.class.php';

try {
    $contatoController = new ContatoController();
    $contatoController->handleRequest();
} catch (Exception $ex) {
    echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar realizar a requisição.<br> Mensagem: ' . $ex->getMessage(), 'status_code' => 0));
}

// declaração da classe controller do contato
class ContatoController
{
    private $daoContato;

    public function __construct()
    {
        $this->daoContato = new ContatoDao();
    }

    public function handleRequest()
    {
        //identificando o tipo de requisicao recebida
        switch ($_SERVER['REQUEST_METHOD']) {
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

    private function handlePostRequest($_acao)
    {
        switch ($_acao) {
            case 'cadastrar':
                $this->cadastrar();
                break;
            
            case 'editar':
                $this->atualizar();
                break;

            case 'deletar':
                $this->deletar();
                break;
            // poderiam existir outras ações a serem executadas com POST
            default:
                echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar a operação.<br> Ação desconhecida', 'status_code' => 0));
        }
    }

    private function handleGetRequest($_acao)
    {
        switch ($_acao) {
            case 'listar':
                $this->buscarTodosContatos();
                break;
            
            case 'getContato':
                $this->buscarPorId($_GET['id']);
                break;
            // poderiam existir outras ações a serem executadas com GET
            default:
                echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar a operação.<br> Ação desconhecida', 'status_code' => 0));
        }
    }

    public function cadastrar()
    {
        try {
            extract($_POST);

            //create folder if not exists
            if (!file_exists('../uploads')) {
                mkdir('../uploads', 0777, true);
            }

            //save image in project folder with a name based on the current timestamp
            if (isset($_FILES['foto'])) {
                $caminho_foto = 'uploads/' . time() . $_FILES['foto']['name'];
                move_uploaded_file($_FILES['foto']['tmp_name'], '../' . $caminho_foto);
            } else {
                $caminho_foto = null;
            }

            $contato = new Contato(0, $nome, $telefone, $email, $caminho_foto);
            if (!$this->daoContato->contatoExiste('nome', $contato->get('nome'))) {

                if ($this->daoContato->cadastrarContato($contato)) {
                    echo json_encode(array('message' => 'Cadastro realizado com sucesso!', 'status_code' => 1));
                } else {
                    echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar o cadastro.', 'status_code' => 0));
                }

            } else {
                echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar o cadastro.<br>Já existe um contato com o nome informado.', 'status_code' => 0));
            }
        } catch (Exception $ex) {
            echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar realizar o cadastro.<br> Mensagem: ' . $ex->getMessage(), 'status_code' => 0));
        }
    }

    public function buscarTodosContatos()
    {
        $contatos = [];
        try {
            $contatos = $this->daoContato->buscarTodosContatos();
            echo json_encode($contatos);
        } catch (Exception $ex) {
            echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar buscar os contatos.<br>Mensagem: ' . $ex->getMessage(), 'status_code' => 0));
        }
    }

    public function atualizar()
    {
        try {
            extract($_POST);
            $caminho_foto = null;
            if ($_FILES['foto']['name'] != '') {
                $caminho_foto = 'uploads/' . time() . $_FILES['foto']['name'];
                move_uploaded_file($_FILES['foto']['tmp_name'], '../' . $caminho_foto);
            }

            $fields = array('nome' => $nome, 'telefone' => $telefone, 'email' => $email);

            if ($caminho_foto != null) {
                $fields['caminho_foto'] = $caminho_foto;
            }

            $this->daoContato->atualizarContato($idContato, $fields);
            echo json_encode(array('message' => 'Contato atualizado com sucesso', 'status_code' => 1));
        } catch (Exception $ex) {
            echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar atualizar o contato.<br>Mensagem: ' . $ex->getMessage(), 'status_code' => 0));
        }
    }

    public function deletar()
    {
        try {
            $this->daoContato->deletarContato($_POST['idContato']);
            echo json_encode(array('message' => 'Contato excluído com sucesso', 'status_code' => 1));
        } catch (Exception $ex) {
            echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar excluir o contato.<br>Mensagem: ' . $ex->getMessage(), 'status_code' => 0));
        }
    }

    public function buscarPorId($id)
    {
        try {
            $contato = $this->daoContato->buscarContatoPorId($id);
            echo json_encode(array('message' => 'Contato encontrado', 'status_code' => 200, 'contato' => $contato[0]));
        } catch (Exception $ex) {
            echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar recuperar o contato.<br>Mensagem: ' . $ex->getMessage(), 'status_code' => 0));
        }
    }
}
?>