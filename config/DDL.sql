-- Criação do usuário para utilização do banco de dados taskmanager pela aplicação
CREATE USER 'usercadprod'@'localhost' IDENTIFIED BY '#user-cad-prod';

-- Criação do database e tabela produto
CREATE DATABASE cadprod;
CREATE TABLE cadprod.produto(
			idProduto INT NOT NULL AUTO_INCREMENT, 
			nome VARCHAR(255) NOT NULL, 
			categoria enum('ALIMENTOS', 'BEBIDAS', 'HIGIENE', 'LIMPEZA', 'OUTROS') default 'OUTROS',
			quantidade INT NOT NULL default 0,
			PRIMARY KEY(idProduto));


-- Concedendo permissões ao usuário para realizar todas as operações (INSERT, UPDATE, DELETE, CREATE, etc)
--  no banco de dados cadprod somente no host localhost
GRANT ALL PRIVILEGES ON cadprod.* TO 'usercadprod'@'localhost';
-- Recarregando os dados com os novos privilégios
FLUSH PRIVILEGES;


