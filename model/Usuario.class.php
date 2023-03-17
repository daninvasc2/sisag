<?php

class Usuario {
    private $id;
    private $nome;
    private $login;
    private $senha;
    private $foto;

    public function __construct($pId, $pNome, $pLogin, $pSenha, $pFoto) {
        $this->id = $pId;
        $this->nome = $pNome;
        $this->login = $pLogin;
        $this->senha = $pSenha;
        $this->foto = $pFoto;
    }

    public function get($ttribute) {
        switch ($ttribute) {
            case "id":
                return $this->id;

            case "nome":
                return $this->nome;

            case "login":
                return $this->login;

            case "senha":
                return $this->senha;

            case "foto":
                return $this->foto;

            default:
                return "Atributo inválido";
        }
    }

    public function set($ttribute, $value) {
        switch ($ttribute) {
            case "id":
                return $this->id = $value;

            case "nome":
                return $this->nome = $value;

            case "login":
                return $this->login = $value;

            case "senha":
                return $this->senha = $value;

            case "foto":
                return $this->foto = $value;

            default:
                return "Atributo inválido";
        }
    }
}