-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Mar-2022 às 21:44
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `diario`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_rows_links` ()  BEGIN
       DELETE FROM troca_de_senha WHERE DATA < DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL -6 HOUR);
     END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nivel` int(1) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id`, `nome`, `usuario`, `senha`, `email`, `nivel`, `ativo`) VALUES
(1, 'Rafael de Oliveira Sigolo', 'RafaelOliveira', 'teste321', 'rafaeloliveirasigolo@gmail.com', 1, 1),
(2, 'Robert Costa Fernandes Pinto', 'RobertCosta', 'teste321', 'RobertCosta@gmail.com', 2, 1),
(3, 'Demitido de fazertanta merda', 'Demitido', 'teste333', 'Demitidodefazertantamerda@gmail.com', 2, 0),
(4, 'Vinicius Machado', 'vini', 'vini123', 'machadodasilvavinicius599@gmail.com', 2, 1),
(5, 'teste', 'teste', '/teste', 'teste@gmail.com', 2, 1),
(6, 'sla', 'sla', 'Á-!^~][+{-.?ç^´´]', 'sla@gmail.com', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `troca_de_senha`
--

CREATE TABLE `troca_de_senha` (
  `email` varchar(50) NOT NULL,
  `codigo` varchar(40) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Índices para tabela `troca_de_senha`
--
ALTER TABLE `troca_de_senha`
  ADD UNIQUE KEY `emailuk` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `myevent` ON SCHEDULE EVERY 5 SECOND STARTS '2022-03-12 18:04:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL delete_rows_links()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
