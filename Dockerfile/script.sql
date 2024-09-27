-- Remove o banco de dados se existir
DROP DATABASE IF EXISTS loja404;

-- Cria o banco de dados se não existir
CREATE DATABASE IF NOT EXISTS loja404;
USE loja404;

-- Define o modo SQL para não permitir valores automáticos em colunas de chave primária que são zero
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

-- Inicia uma transação para garantir que todas as operações sejam executadas como uma única unidade
START TRANSACTION;

-- Define o fuso horário para +00:00 (UTC)
SET time_zone = "+00:00";

-- Cria a tabela tb_categoria_produto
-- Esta tabela armazena as categorias dos produtos
CREATE TABLE IF NOT EXISTS `tb_categoria_produto` (
                                                      `id_categoria_planejamento` int(11) NOT NULL AUTO_INCREMENT,
                                                      `nome_categoria` varchar(150) NOT NULL,
                                                      PRIMARY KEY (`id_categoria_planejamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Cria a tabela tb_produto
-- Esta tabela armazena informações sobre os produtos
CREATE TABLE IF NOT EXISTS `tb_produto` (
                                            `id_produto` int(11) NOT NULL AUTO_INCREMENT,
                                            `id_categoria_produto` int(11) DEFAULT NULL,
                                            `data_cadastro` datetime NOT NULL,
                                            `nome_produto` varchar(150) NOT NULL,
                                            `valor_produto` float(10,2) NOT NULL,
                                            PRIMARY KEY (`id_produto`),
                                            KEY `IXFK_tb_produto_tb_categoria_produto` (`id_categoria_produto`),
                                            CONSTRAINT `tb_produto_ibfk_1` FOREIGN KEY (`id_categoria_produto`)
                                                REFERENCES `tb_categoria_produto` (`id_categoria_planejamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Finaliza a transação, aplicando todas as alterações
COMMIT;


-- Inserção de categorias
INSERT INTO `tb_categoria_produto` (`id_categoria_planejamento`, `nome_categoria`)
VALUES
    (1, 'Eletrônicos'),
    (2, 'Roupas'),
    (3, 'Alimentos'),
    (4, 'Móveis'),
    (5, 'Livros');

-- Inserção de produtos
INSERT INTO `tb_produto` (`id_produto`, `id_categoria_produto`, `data_cadastro`, `nome_produto`, `valor_produto`)
VALUES
    (1, 1, '2024-09-09 10:00:00', 'Smartphone XYZ', 599.99),
    (2, 2, '2024-09-09 11:00:00', 'Camisa Polo', 29.90),
    (3, 3, '2024-09-09 12:00:00', 'Cereal Integral', 7.50),
    (4, 4, '2024-09-09 13:00:00', 'Sofá 3 Lugares', 899.00),
    (5, 5, '2024-09-09 14:00:00', 'Livro de Programação', 49.90);
