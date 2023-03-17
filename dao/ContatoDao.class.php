<?php
include_once 'ConexaoPDO.class.php';

class ContatoDao
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new ConexaoPDO();
    }

    /**
     * Summary:
     * Método que tem por objetivo cadastrar um novo contato no banco de dados
     * @param $contato: Objeto da classe Contato a ser cadastrado
     * @param boolean: Retorna true se o contato foi inserido com sucesso
     * ou false caso contrário
     */
    public function cadastrarContato($contato)
    {
        $retorno = false;
        try {

            /*CREATE TABLE sisag.contato (
            id INT NOT NULL AUTO_INCREMENT,
            nome VARCHAR(100) NOT NULL,
            telefone VARCHAR(20) NOT NULL,
            email VARCHAR(100),
            caminho_foto LONGBLOB,
            PRIMARY KEY (id)
            );*/

            $query = "INSERT INTO contato (nome, telefone, email, caminho_foto) VALUES (:nome, :telefone, :email, :caminho_foto)";

            // fields to bind
            $fields = array(
                ':nome' => $contato->get('nome'),
                ':telefone' => $contato->get('telefone'),
                ':email' => $contato->get('email'),
                ':caminho_foto' => $contato->get('foto')
            );

            $this->conexao->connect();
            $stmt = $this->conexao->prepareQuery($query, $fields);
            $result = $this->conexao->executeQuery($stmt);
            if ($result > 0) {
                $retorno = true;
            }

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        return $retorno;
    }

    /**
     * Método que tem por objetivo deletar um contato com o id passado por parâmetro
     * @param $idContato: Id do contato a ser deletado
     * @return boolean: Retorna true se o contato foi excluído com sucesso or false caso contrário.
     * Variável $result guarda o número de linhas afetadas pela consulta
     */
    public function deletarContato($idContato)
    {
        $retorno = false;
        $query = "DELETE FROM contato WHERE idContato = :idContato";

        // fields to bind
        $fields = array(':idContato' => $idContato);

        try {
            $this->conexao->connect();
            $stmt = $this->conexao->prepareQuery($query, $fields);
            $result = $this->conexao->executeQuery($stmt);
            if ($result > 0) {
                $retorno = true;
            }

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        return $retorno;
    }

    /**
     * Método que tem por objetivo realizar a atualização de um contato.
     * @param $idContato: Id do contato a ser atualizado
     * @param $fields: Array associativo contendo os campos e os novos valores a serem atualizados
     * Ex.: array('nome' => 'novoNome', 'categoria' => novaCategoria);
     * @return boolean: Retorna true se o contato pôde ser atualizado com sucesso e false caso contrário
     */
    public function atualizarContato($idContato, $fields)
    {
        $retorno = false;
        $query = "UPDATE contato SET ";

        // construindo a query dinamicamente
        foreach ($fields as $field => $newValue) {

            // single quotes for string types
            gettype($newValue) === 'string' ? $query .= $field . " = '" . $newValue . "'" : $query .= $field . " = " . $newValue;

            // Se não for o último campo, então coloca vírgula
            if ($field !== array_key_last($fields))
                $query .= ", ";
        }

        $query .= " WHERE idContato = :idContato";

        // fields to bind
        $fields = array(':idContato' => $idContato);

        try {
            $this->conexao->connect();
            $stmt = $this->conexao->prepareQuery($query, $fields);
            $result = $this->conexao->executeQuery($stmt);
            if ($result > 0) {
                $retorno = true;
            }

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        return $retorno;
    }

    /**
     * Summary: Método que tem por objetivo verificar se um determinado
     * contato existe com base no campo e valor passados por parâmetro
     * @param $field: campo
     * @param $value: valor
     * @return boolean: Retorna true se o objeto com o valor equivalente ao campo existe, false caso contrário
     */
    public function contatoExiste($field, $value)
    {
        $arr = [];
        $retorno = false;

        try {
            // query
            $query = "SELECT nome FROM contato WHERE " . $field . " = :" . $field;
            // fields to bind
            $fields = array(':' . $field => $value);

            $this->conexao->connect();
            $stmt = $this->conexao->prepareQuery($query, $fields);
            $arr = $this->conexao->executeQuerySelect($stmt);
            if (count($arr) > 0) {
                $retorno = true;
            }

        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        return $retorno;
    }


    /**
     * Summary:
     * Método que busca todos os contatos cadastrados na base de dados.
     * 
     * @return array: Retorna uma array associativo do tipo arr(key -> value) com os
     * dados do contato, ou um array vazio caso nenhum contato seja encontrado
     */
    public function buscarTodosContatos()
    {
        $query = "SELECT * FROM contato ORDER BY idContato ASC";
        // fields to bind
        $fields = [];
        // array return
        $arr = [];
        try {
            $this->conexao->connect();
            $stmt = $this->conexao->prepareQuery($query, $fields);
            $arr = $this->conexao->executeQuerySelect($stmt);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        return $arr;
    }

    /**
     * Buscar um contato por id passado como parâmetro
     * @param $idContato: Id a ser procurado
     * @return array: Array Associativo contendo o contato buscado ou uma array vazio caso contrário
     */
    public function buscarContatoPorId($idContato)
    {
        $query = "SELECT * FROM contato WHERE idContato = :idContato";
        // fields to bind
        $fields = array(':idContato' => $idContato);
        // array return
        $arr = [];
        try {
            $this->conexao->connect();
            $stmt = $this->conexao->prepareQuery($query, $fields);
            $arr = $this->conexao->executeQuerySelect($stmt);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        return $arr;
    }
}

?>