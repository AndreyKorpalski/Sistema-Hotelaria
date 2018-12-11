-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Nov-2018 às 21:52
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `audit`
--

CREATE TABLE `audit` (
  `id_audit` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_quarto` int(11) NOT NULL,
  `tipo_de_quarto` int(11) NOT NULL,
  `data_entrada` date NOT NULL,
  `data_saida` date NOT NULL,
  `valor_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `cod_cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` bigint(11) NOT NULL,
  `status_cliente` char(1) NOT NULL,
  `sexo` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(80) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `forma_pagamento` varchar(40) DEFAULT NULL,
  `ultima_atualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cod_cliente`, `nome`, `cpf`, `status_cliente`, `sexo`, `email`, `telefone`, `endereco`, `forma_pagamento`, `ultima_atualizacao`) VALUES
(2, 'teste1', 3585193064, 'N', 'Masculino', 'teste@gmail.com', '51999615125', 'Rua Patria, 600', 'Dinheiro', '2018-11-25 19:06:47'),
(3, 'teste2', 3585193064, 'A', 'Feminino', 'teste@gmail.com', '51999615125', 'asdasdasdas', 'Debito', '2018-11-25 05:14:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `qtd_quartos`
--

CREATE TABLE `qtd_quartos` (
  `qtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `qtd_quartos`
--

INSERT INTO `qtd_quartos` (`qtd`) VALUES
(2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `quartos`
--

CREATE TABLE `quartos` (
  `cod_quarto` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `quartos`
--

INSERT INTO `quartos` (`cod_quarto`, `nome`) VALUES
(1, 'Quarto 01'),
(2, 'Quarto 02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `quartos_da_reserva`
--

CREATE TABLE `quartos_da_reserva` (
  `cod_reserva` int(11) NOT NULL,
  `cod_quarto` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `data_entrada` date NOT NULL,
  `data_saida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `quartos_da_reserva`
--

INSERT INTO `quartos_da_reserva` (`cod_reserva`, `cod_quarto`, `id_tipo`, `data_entrada`, `data_saida`) VALUES
(1, 1, 1, '2018-11-01', '2018-11-03'),
(2, 2, 1, '2018-11-02', '2018-11-17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

CREATE TABLE `reservas` (
  `cod_reserva` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `reservas`
--

INSERT INTO `reservas` (`cod_reserva`, `cod_cliente`, `valor_total`) VALUES
(1, 2, '100.00'),
(2, 3, '750.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_de_reserva`
--

CREATE TABLE `tipo_de_reserva` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `valor_diaria` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_de_reserva`
--

INSERT INTO `tipo_de_reserva` (`id_tipo`, `tipo`, `valor_diaria`) VALUES
(1, 'Solteiro', '50.00'),
(2, 'Casal', '80.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacoes_bancarias`
--

CREATE TABLE `transacoes_bancarias` (
  `cod_transacao` int(11) NOT NULL,
  `cod_pagseguro` varchar(100) NOT NULL,
  `cod_reserva` int(11) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `transacoes_bancarias`
--

INSERT INTO `transacoes_bancarias` (`cod_transacao`, `cod_pagseguro`, `cod_reserva`, `status`) VALUES
(1, '01EACBF1-03AF-4491-AC87-1F48A9A97A9C', 1, 'N'),
(2, 'F71FF76F-CDDF-4F7F-BC83-521DAA382957', 2, 'P');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id_audit`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Indexes for table `quartos`
--
ALTER TABLE `quartos`
  ADD PRIMARY KEY (`cod_quarto`);

--
-- Indexes for table `quartos_da_reserva`
--
ALTER TABLE `quartos_da_reserva`
  ADD KEY `cod_reserva` (`cod_reserva`),
  ADD KEY `cod_quarto` (`cod_quarto`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`cod_reserva`),
  ADD KEY `cod_cliente` (`cod_cliente`);

--
-- Indexes for table `tipo_de_reserva`
--
ALTER TABLE `tipo_de_reserva`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indexes for table `transacoes_bancarias`
--
ALTER TABLE `transacoes_bancarias`
  ADD PRIMARY KEY (`cod_transacao`),
  ADD KEY `cod_reserva` (`cod_reserva`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id_audit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quartos`
--
ALTER TABLE `quartos`
  MODIFY `cod_quarto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `cod_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_de_reserva`
--
ALTER TABLE `tipo_de_reserva`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transacoes_bancarias`
--
ALTER TABLE `transacoes_bancarias`
  MODIFY `cod_transacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `quartos_da_reserva`
--
ALTER TABLE `quartos_da_reserva`
  ADD CONSTRAINT `quartos_da_reserva_ibfk_1` FOREIGN KEY (`cod_reserva`) REFERENCES `reservas` (`cod_reserva`),
  ADD CONSTRAINT `quartos_da_reserva_ibfk_2` FOREIGN KEY (`cod_quarto`) REFERENCES `quartos` (`cod_quarto`),
  ADD CONSTRAINT `quartos_da_reserva_ibfk_3` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_de_reserva` (`id_tipo`);

--
-- Limitadores para a tabela `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`cod_cliente`) REFERENCES `clientes` (`cod_cliente`);

--
-- Limitadores para a tabela `transacoes_bancarias`
--
ALTER TABLE `transacoes_bancarias`
  ADD CONSTRAINT `transacoes_bancarias_ibfk_1` FOREIGN KEY (`cod_reserva`) REFERENCES `reservas` (`cod_reserva`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
