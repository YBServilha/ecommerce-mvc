CREATE DATABASE mercadoavaliacao;

use mercadoavaliacao;

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(300) NOT NULL COMMENT 'E-mail do administrador',
  `senha` varchar(64) NOT NULL COMMENT 'Senha em sha256',
  `datahora` datetime NOT NULL COMMENT 'Registro: YYY-MM-DD HH:MM:SS',
  `status` int(1) NOT NULL COMMENT '1-ativo; 0-inativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `administrador` (`id`, `email`, `senha`, `datahora`, `status`) VALUES
(1, 'adm@aval.com.br', 'a0a31be02e3d4af7cecbc3ab32b048a68b837b2250f61dc1ce8cb2972e5d66b8', '2023-06-11 11:02:48', 1);


CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `cod` varchar(4) NOT NULL COMMENT 'Código do produto',
  `imgpq` varchar(15) NOT NULL COMMENT 'Nome da imagem pequena 80x80px',
  `imggd` varchar(15) NOT NULL COMMENT 'Nome da imagem grande 460x460px',
  `classe` varchar(1) NOT NULL COMMENT 'código temático do produto L ou S',
  `marca` varchar(200) NOT NULL COMMENT 'marca do produto',
  `peso` int(4) NOT NULL COMMENT 'peso em miligramas de cada unidade do produto',
  `qtd` varchar(200) NOT NULL COMMENT 'quantidade de unidades do produto',
  `preco` decimal(5,2) NOT NULL COMMENT 'preço de cada unidade do produto',
  `titulo` varchar(80) NOT NULL COMMENT 'titulo do produto',
  `texto` varchar(150) NOT NULL COMMENT 'texto do produto',
  `datahora` datetime NOT NULL COMMENT 'Registro: YYY-MM-DD HH:MM:SS',
  `status` int(1) NOT NULL COMMENT '1-ativo; 0-inativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `cod` int(11) NOT NULL COMMENT 'cod do produto comprado',
  `imgpq` varchar(15) NOT NULL COMMENT 'Nome da imagem pequena 80x80px',
  `imggd` varchar(15) NOT NULL COMMENT 'Nome da imagem grande 460x460px',
  `classe` varchar(1) NOT NULL COMMENT 'código temático do produto L ou S',
  `marca` varchar(200) NOT NULL COMMENT 'marca do produto',
  `peso` int(4) NOT NULL COMMENT 'peso em miligramas de cada unidade do produto',
  `qtd` int(11) NOT NULL COMMENT 'Quantidade comprada',
  `preco` decimal(5,2) NOT NULL COMMENT 'Preco do produto',
  `titulo` varchar(80) NOT NULL COMMENT 'titulo do produto',
  `texto` varchar(150) NOT NULL COMMENT 'texto do produto',
  `datahora` datetime NOT NULL COMMENT 'Data e hora da compra',
  `status` int(1) NOT NULL COMMENT '1 - Compra concluída; 0 - Compra em andamento ou cancelada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE carrinho
MODIFY COLUMN cod varchar(4) NOT NULL COMMENT 'cod do produto comprado';

