-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 08/10/2018 às 16:24
-- Versão do servidor: 5.5.61-0ubuntu0.14.04.1
-- Versão do PHP: 7.2.9-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `api.maydana`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cad_pessoa`
--

CREATE TABLE IF NOT EXISTS `cad_pessoa` (
  `pes_codigo` int(10) NOT NULL AUTO_INCREMENT,
  `pes_nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `pes_cpf` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_rg` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_sexo` smallint(10) NOT NULL,
  `pes_nascimento` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pes_telefone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_whats` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `cid_codigo` int(10) NOT NULL,
  `est_codigo` int(10) NOT NULL,
  `bai_codigo` int(10) NOT NULL,
  `pes_status` smallint(10) NOT NULL,
  `pes_atualizacao` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_criacao` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pes_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pes_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `cad_pessoa`
--

INSERT INTO `cad_pessoa` (`pes_codigo`, `pes_nome`, `pes_cpf`, `pes_rg`, `pes_sexo`, `pes_nascimento`, `pes_telefone`, `pes_whats`, `pes_email`, `cid_codigo`, `est_codigo`, `bai_codigo`, `pes_status`, `pes_atualizacao`, `pes_criacao`, `pes_ip`) VALUES
(1, 'Jesus na Heaven', '', '', 2, '', '789879798987987987', '', '', 0, 0, 0, 0, '14:15:26', '07/10/2018', '189.113.96.222'),
(2, 'Haddad', '', '', 1, '', '524557', '', '', 0, 0, 0, 0, '14:18:59', '07/10/2018', '189.113.96.222'),
(3, 'Haddad', '', '', 2, '', '4444444444', '', '', 0, 0, 0, 0, '13:15:53', '08/10/2018', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idade` int(10) NOT NULL,
  `data` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `hora` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Fazendo dump de dados para tabela `user`
--

INSERT INTO `user` (`id`, `nome`, `idade`, `data`, `hora`, `ip`) VALUES
(22, 'Matheus Maydana', 12, '04/10/2018', '15:31:09', '177.20.243.139');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_cad_pessoa`
--
CREATE TABLE IF NOT EXISTS `view_cad_pessoa` (
`pes_codigo` int(10)
,`pes_nome` varchar(150)
,`pes_nascimento` varchar(10)
,`pes_telefone` varchar(20)
,`pes_whats` varchar(20)
,`pes_cpf` varchar(20)
,`pes_rg` varchar(20)
,`pes_email` varchar(150)
,`pes_ip` varchar(20)
,`pes_atualizacao` varchar(20)
,`pes_criacao` varchar(20)
,`pes_sexo` varchar(6)
);
-- --------------------------------------------------------

--
-- Estrutura para view `view_cad_pessoa`
--
DROP TABLE IF EXISTS `view_cad_pessoa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_cad_pessoa` AS select `cad_pessoa`.`pes_codigo` AS `pes_codigo`,`cad_pessoa`.`pes_nome` AS `pes_nome`,`cad_pessoa`.`pes_nascimento` AS `pes_nascimento`,`cad_pessoa`.`pes_telefone` AS `pes_telefone`,`cad_pessoa`.`pes_whats` AS `pes_whats`,`cad_pessoa`.`pes_cpf` AS `pes_cpf`,`cad_pessoa`.`pes_rg` AS `pes_rg`,`cad_pessoa`.`pes_email` AS `pes_email`,`cad_pessoa`.`pes_ip` AS `pes_ip`,`cad_pessoa`.`pes_atualizacao` AS `pes_atualizacao`,`cad_pessoa`.`pes_criacao` AS `pes_criacao`,(case `cad_pessoa`.`pes_sexo` when (`cad_pessoa`.`pes_sexo` = 1) then 'Homem' when (`cad_pessoa`.`pes_sexo` = 2) then 'Mulher' else 'Outro' end) AS `pes_sexo` from `cad_pessoa` order by `cad_pessoa`.`pes_nome`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
