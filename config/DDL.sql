-- Criação do usuário para utilização do banco de dados taskmanager pela aplicação
CREATE USER 'sisag'@'localhost' IDENTIFIED BY 'root';

-- Criação do database e tabela contato
CREATE DATABASE sisag;
CREATE TABLE sisag.contato (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  email VARCHAR(100),
  imagem LONGBLOB, -- change to caminho_foto VARCHAR(100) NOT NULL
  PRIMARY KEY (id)
);

alter table contato add caminho_foto varchar(100) not null;
alter table contato drop column imagem;


-- Concedendo permissões ao usuário para realizar todas as operações (INSERT, UPDATE, DELETE, CREATE, etc)
--  no banco de dados sisag somente no host localhost
GRANT ALL PRIVILEGES ON sisag.* TO 'sisag'@'localhost';
-- Recarregando os dados com os novos privilégios
FLUSH PRIVILEGES;


