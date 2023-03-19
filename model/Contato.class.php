<?php
class Contato
{
    private $idContato;
    private $nome;

    private $telefone;

    private $email;

    private $foto;

    private $usuarioId;

    public function __construct($pIdContato, $pNome, $pTelefone, $pEmail, $pFoto)
    {
        $this->idContato = $pIdContato;
        $this->nome = $pNome;
        $this->telefone = $pTelefone;
        $this->email = $pEmail;
        $this->foto = $pFoto;

        session_start();
        $this->usuarioId = $_SESSION['usuario']['id'];
    }

    // getters
    public function get($atributo)
    {
        switch ($atributo) {
            case "idContato":
                return $this->idContato;

            case "nome":
                return $this->nome;

            case "telefone":
                return $this->telefone;

            case "email":
                return $this->email;

            case "foto":
                return $this->foto;

            case "usuarioId":
                return $this->usuarioId;

            default:
                return "Atributo inválido";
        }
    }

    // setters
    public function set($atributo, $valor)
    {
        switch ($atributo) {
            case "idContato":
                return $this->idContato = $valor;

            case "nome":
                return $this->nome = $valor;

            case "telefone":
                return $this->telefone = $valor;

            case "email":
                return $this->email = $valor;

            case "foto":
                return $this->foto = $valor;
            
            case "usuarioId":
                return $this->usuarioId = $valor;

            default:
                return "Atributo inválido";
        }
    }

    public function __toString()
    {
        return "<b> Id: </b>" . $this->idContato . "<br>" .
            "<b> Nome: </b>" . $this->nome . "<br>" .
            "<b> Telefone: </b>" . $this->telefone . "<br>" .
            "<b> Email: </b>" . $this->email . "<br>" //.
            /*"<b> Foto: </b>" . $this->foto . "<br>"*/
        ;
    }
}
?>