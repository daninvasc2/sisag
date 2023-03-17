<?php

include_once '../dao/UsuarioDao.class.php';

include_once '../model/Usuario.class.php';

try {
    $loginController = new LoginController();
    $loginController->handleRequest();
} catch (Exception $ex) {
    echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar realizar a requisição.<br> Mensagem: ' . $ex->getMessage(), 'status_code' => 0));
}

Class LoginController {
    private $daoUsuario;

    public function __construct()
    {
        $this->daoUsuario = new UsuarioDao();
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

    function handlePostRequest($_acao) {
        switch ($_acao) {
            case 'login':
                $this->logar();
                break;
            case 'cadastrar':
                $this->cadastrar();
                break;
            default:
                echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar a operação.<br> Ação desconhecida', 'status_code' => 0));
        }
    }

    function handleGetRequest($_acao) {
        switch ($_acao) {
            case 'logout':
                break;
            // poderiam existir outras ações a serem executadas com GET
            default:
                echo json_encode(array('message' => 'Ocorreu um erro ao tentar realizar a operação.<br> Ação desconhecida', 'status_code' => 0));
        }
    }

    function deslogar() {
        session_start();
        session_destroy();
        header('Location: ../index.php');
    }

    function logar() {
        try {
            session_start();
            extract($_POST);
            $usuarioDao = new UsuarioDao();
            $usuario = $usuarioDao->buscarUsuario($login, sha1($senha));
            if ($usuario) {
                $_SESSION['usuario'] = $usuario;
                // header('Location: ../view/listing.php');
                echo json_encode(array('message' => 'Login realizado com sucesso', 'status_code' => 200));
            } else {
                header('Location: ../index.php?erro=1');
            }
        } catch (Exception $ex) {
            echo json_encode(array('message' => 'Uma exceção ocorreu ao tentar realizar a requisição.<br> Mensagem: ' . $ex->getMessage(), 'status_code' => 0));
        }
    }

    function cadastrar() {
        $usuarioDao = new UsuarioDao();
        extract($_POST);
        $senhaCadastro = sha1($senhaCadastro);

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

        $result = $usuarioDao->cadastrarUsuario($nomeCadastro, $loginCadastro, $senhaCadastro, $caminho_foto);
        if ($result) {
            $_SESSION['usuario'] =  $usuarioDao->buscarUsuario($loginCadastro, $senhaCadastro);
            echo json_encode(array('message' => 'Cadastro realizado com sucesso', 'status_code' => 200));
        } else {
            header('Location: ../index.php?erro=1');
        }
    }
}