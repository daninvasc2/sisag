<?php

include_once 'ConexaoPDO.class.php';

class UsuarioDao {
    private $conexao;

    public function __construct() {
        $this->conexao = new ConexaoPDO();
    }

    public function buscarUsuario($login, $senha) {
        $sql = "SELECT * FROM usuario WHERE login = :login AND senha = :senha";
        $fields = array(':login' => $login, ':senha' => $senha);
        $this->conexao->connect();
        $stmt = $this->conexao->prepareQuery($sql, $fields);
        $result = $this->conexao->executeQuerySelect($stmt);
        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function cadastrarUsuario(string $nome, string $login, string $senha, string $foto) {
        $sql = "INSERT INTO usuario (nome, login, senha, caminho_foto) VALUES (:nome, :login, :senha, :caminho_foto)";
        $fields = array(':nome' => $nome, ':login' => $login, ':senha' => $senha, ':caminho_foto' => $foto);
        $this->conexao->connect();
        $stmt = $this->conexao->prepareQuery($sql, $fields);
        $result = $this->conexao->executeQuery($stmt);

        return $result > 0;
    }
}