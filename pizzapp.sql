-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Out-2018 às 18:13
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzapp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm`
--

CREATE TABLE `adm` (
  `ID` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adm`
--

INSERT INTO `adm` (`ID`, `nome`, `email`, `senha`) VALUES
(1, 'Roberto', 'roberto@adm.com', '0aa0ff9606c1226d17efe697096e870dcbd91058742309508f2ef7c8dfa0a57295928b677416b3bd003e122dd06f4af1d28fd8578a385aa79dd4d1c3e3f07da0'),
(2, 'Mateus', 'mateus@adm.com', '0aa0ff9606c1226d17efe697096e870dcbd91058742309508f2ef7c8dfa0a57295928b677416b3bd003e122dd06f4af1d28fd8578a385aa79dd4d1c3e3f07da0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho_temporario`
--

CREATE TABLE `carrinho_temporario` (
  `ID` int(11) NOT NULL,
  `ID_usuarios` int(11) NOT NULL,
  `temporario_produto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `temporario_nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `temporario_quantidade` int(10) NOT NULL,
  `temporario_preco` float NOT NULL,
  `temporario_img` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `temporario_data` datetime NOT NULL,
  `temporario_sessao` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `carrinho_temporario`
--

INSERT INTO `carrinho_temporario` (`ID`, `ID_usuarios`, `temporario_produto`, `temporario_nome`, `temporario_quantidade`, `temporario_preco`, `temporario_img`, `temporario_data`, `temporario_sessao`) VALUES
(22, 1, '0', 'Pizza 0 meia  e meia Frango', 1, 0, '', '2018-10-11 16:09:43', '51155'),
(23, 1, '6', 'Pizza GG meia Calabresa e meia Calabresa', 1, 2500, '', '2018-10-18 12:05:40', '39798'),
(24, 1, '5', 'Calabresa', 1, 700, 'calabresa.png', '2018-10-19 16:18:14', '52496'),
(25, 1, '6', 'Pizza G meia Calabresa e meia Calabresa', 2, 1800, '', '2018-10-23 12:01:08', '36066');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `ID` int(11) NOT NULL,
  `nome` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `data` datetime NOT NULL,
  `comentario` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`ID`, `nome`, `email`, `data`, `comentario`) VALUES
(7, 'Roberto', 'roberto@adm.com', '2018-06-24 00:00:00', 'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.'),
(8, 'Mateus', 'mateus@adm.com', '2018-06-24 22:42:59', 'É um fato conhecido de todos que um leitor se distrairá com o conteúdo de texto legível de uma página quando estiver examinando sua diagramação. A vantagem de usar Lorem Ipsum é que ele tem uma distribuição normal de letras, ao contrário de \"Conteúdo aqui, conteúdo aqui\", fazendo com que ele tenha uma aparência similar a de um texto legível. Muitos softwares de publicação e editores de páginas na internet agora usam Lorem Ipsum como texto-modelo padrão, e uma rápida busca por \'lorem ipsum\' mostra vários websites ainda em sua fase de construção. Várias versões novas surgiram ao longo dos anos, eventualmente por acidente, e às vezes de propósito (injetando humor, e coisas do gênero).');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `produto_id` int(10) NOT NULL,
  `cliente_nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ponto_referencia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor_total` int(10) NOT NULL,
  `hora` time NOT NULL,
  `sessao` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `produto_id`, `cliente_nome`, `endereco`, `ponto_referencia`, `descricao`, `valor_total`, `hora`, `sessao`, `status`) VALUES
(9, 2, 'Roberto', 'sasasasasa', 'sasasasasa', 'Coca-Cola 350ml - 1 Unidades </br>', 500, '16:40:25', '98393', 'Aguardando atendimento'),
(10, 2, 'Roberto', 'sasasasasa', 'sasasasasa', 'Coca-Cola 2L - 1 Unidades </br>Coca-Cola 350ml - 1 Unidades </br>', 500, '12:12:38', '40861', 'Aguardando atendimento'),
(11, 8, 'Roberto S.', 'sasasasasa', 'sasasasasa', 'Camarão - 1 Unidades </br>Batata Frita - 1 Unidades </br>', 3000, '14:13:24', '80984', 'Aguardando atendimento');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pizzas`
--

CREATE TABLE `pizzas` (
  `id` int(11) NOT NULL,
  `sabor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `precop` double(50,2) NOT NULL,
  `descricao` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `img_pizza` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `precom` double(50,2) NOT NULL,
  `precog` double(50,2) NOT NULL,
  `precogg` double(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pizzas`
--

INSERT INTO `pizzas` (`id`, `sabor`, `precop`, `descricao`, `img_pizza`, `precom`, `precog`, `precogg`) VALUES
(6, 'Calabresa', 800.00, 'Calabresa, queijo e cebola', 'pizzas/calabresa.png', 1200.00, 1800.00, 2500.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `prod_ID` int(11) NOT NULL,
  `prod_nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prod_descricao` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `prod_preco` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prod_img` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `prod_tipo` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`prod_ID`, `prod_nome`, `prod_descricao`, `prod_preco`, `prod_img`, `prod_tipo`) VALUES
(1, 'Coca-Cola 2L', 'Refrigerante de Cola', '800', 'bebidas/coca-cola-2l.jpg', 'Bebidas'),
(2, 'Coca-Cola 350ml', 'Refrigerante de Cola', '500', 'bebidas/coca-cola-350ml.jpg', 'Bebidas'),
(3, 'Fanta Laranja 2L', 'Refrigerante de Laranja', '500', 'bebidas/fanta-laranja-2l.jpg', 'Bebidas'),
(4, 'Fanta Laranja 350ml', 'Refrigerante de Laranja', '300', 'bebidas/fanta-laranja-350ml.jpg', 'Bebidas'),
(5, 'Calabresa', 'Porção de Calabresa', '700', 'porcoes/calabresa.png', 'Porcoes'),
(7, 'Guaraná-Lata', 'Refrigerante de guaraná', '350', 'bebidas/sprite-350ml.jpg', 'Bebidas'),
(8, 'Batata Frita', 'Porção de Batata Frita', '1000', 'porcoes/batata.png', 'Porcoes'),
(9, 'Camarão', 'Porção de Camarão', '2000', 'porcoes/camarao.png', 'Porcoes'),
(10, 'Carne de Sol', 'Porção de Carne de Sol', '1500', 'porcoes/carne-sol.png', 'Porcoes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `promocoes`
--

CREATE TABLE `promocoes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desc_promo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `preco_promo` float NOT NULL,
  `duracao_promo` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `img_promo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `data` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `promocoes`
--

INSERT INTO `promocoes` (`id`, `titulo`, `desc_promo`, `preco_promo`, `duracao_promo`, `img_promo`, `data`) VALUES
(3, 'Combo 1', 'Pizza M + Porção de Bata frita', 2500, '12', 'promocoes/promo1.png', '2018-10-26 13:09:18'),
(6, 'Combo 2', 'Pizza G + Refrigerante 2L', 6000, '7', 'promocoes/promo2.png', '2018-10-26 13:09:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `nome` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `sobrenome` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `ponto_de_referencia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nome`, `sobrenome`, `email`, `endereco`, `ponto_de_referencia`, `senha`) VALUES
(1, 'Roberto', 'S.', 'roberto@pizzapp.com', 'sasasasasa', 'sasasasasa', '0aa0ff9606c1226d17efe697096e870dcbd91058742309508f2ef7c8dfa0a57295928b677416b3bd003e122dd06f4af1d28fd8578a385aa79dd4d1c3e3f07da0'),
(2, 'Mateus', 'Silva', 'mateus@pizzapp.com', 'sdsdsdsd', 'sdsdsdsd2223', '0aa0ff9606c1226d17efe697096e870dcbd91058742309508f2ef7c8dfa0a57295928b677416b3bd003e122dd06f4af1d28fd8578a385aa79dd4d1c3e3f07da0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `carrinho_temporario`
--
ALTER TABLE `carrinho_temporario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_usuarios` (`ID_usuarios`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`prod_ID`);

--
-- Indexes for table `promocoes`
--
ALTER TABLE `promocoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adm`
--
ALTER TABLE `adm`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `carrinho_temporario`
--
ALTER TABLE `carrinho_temporario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `prod_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `promocoes`
--
ALTER TABLE `promocoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
