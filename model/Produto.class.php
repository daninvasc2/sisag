<?php
    class Produto {
        private $idProduto;
        private $nome;
        private $categoria;
        private $quantidade;

        public function __construct($pIdProduto, $pNome, $pCategoria, $pQuantidade) {
            $this->idProduto = $pIdProduto;
            $this->nome = $pNome;
            $this->categoria = $pCategoria;
            $this->quantidade = $pQuantidade;
        }

        // getters
        public function get($atributo) {
            switch ($atributo) {
                case "idProduto":
                    return $this->idProduto;
                break;

                case "nome":
                    return $this->nome;
                break;

                case "categoria":
                    return $this->categoria;
                break;

                case "quantidade":
                    return $this->quantidade;
                break;

                default:
                    return "Atributo inválido";
            }
        }

        // setters
        public function set($atributo, $valor) {
            switch($atributo) {
                case "idProduto":
                    return $this->idProduto = $valor;
                break;

                case "nome":
                    return $this->nome = $valor;
                break;

                case "categoria":
                    return $this->categoria = $valor;
                break;

                case "quantidade":
                    return $this->quantidade = $valor;
                break;

                default:
                    return "Atributo inválido";
            }
        }

        public function __toString() {
            return "<b> Id: </b>". $this->idProduto."<br>".
                    "<b> Nome: </b>". $this->nome."<br>".
                    "<b> Categoria: </b>". $this->categoria."<br>".
                    "<b> Quantidade: </b>". $this->quantidade."<br>";
        }
    }
?>