-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 15-Set-2014 às 15:42
-- Versão do servidor: 5.5.38-0ubuntu0.14.04.1
-- versão do PHP: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `recomendador-test`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_direito`
--

CREATE TABLE IF NOT EXISTS `categoria_direito` (
  `idcategoria_direito` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `custo` tinyint(3) unsigned DEFAULT NULL,
  `direitoAutoral` tinyint(3) unsigned DEFAULT NULL,
  `uso` longtext,
  PRIMARY KEY (`idcategoria_direito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_eduacional`
--

CREATE TABLE IF NOT EXISTS `categoria_eduacional` (
  `idcategoria_eduacional` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` longtext,
  `nivelIteratividade` varchar(45) DEFAULT NULL,
  `tipoIteratividade` varchar(45) DEFAULT NULL,
  `ambiente` varchar(100) DEFAULT NULL,
  `faixaEtaria` varchar(100) DEFAULT NULL,
  `recursoAprendizagem` varchar(100) DEFAULT NULL,
  `usuarioFinal` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idcategoria_eduacional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_tecnica`
--

CREATE TABLE IF NOT EXISTS `categoria_tecnica` (
  `idcategoria_tecnica` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tempo_video` time DEFAULT NULL,
  `tamanho` varchar(50) DEFAULT NULL,
  `tipoTecnologia` varchar(50) DEFAULT NULL,
  `tipoFormato` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idcategoria_tecnica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_vida`
--

CREATE TABLE IF NOT EXISTS `categoria_vida` (
  `idcategoria_vida` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_2` date DEFAULT NULL,
  `status_2` varchar(45) DEFAULT NULL,
  `versao` varchar(45) DEFAULT NULL,
  `entidade` varchar(200) DEFAULT NULL,
  `contribuicao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idcategoria_vida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cesta`
--

CREATE TABLE IF NOT EXISTS `cesta` (
  `idcesta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcategoria_vida` int(10) unsigned NOT NULL,
  `idcategoria_tecnica` int(10) unsigned NOT NULL,
  `idcategoria_eduacional` int(10) unsigned NOT NULL,
  `idusuario` int(10) unsigned NOT NULL,
  `idcategoria_direito` int(10) unsigned NOT NULL,
  `descricao` longtext,
  `nome` varchar(200) DEFAULT NULL,
  `url` longtext,
  `palavraChave` varchar(200) DEFAULT NULL,
  `idioma` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idcesta`),
  KEY `cesta_FKIndex1` (`idcategoria_direito`),
  KEY `cesta_FKIndex2` (`idusuario`),
  KEY `cesta_FKIndex3` (`idcategoria_eduacional`),
  KEY `cesta_FKIndex4` (`idcategoria_tecnica`),
  KEY `cesta_FKIndex5` (`idcategoria_vida`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `competencia`
--

CREATE TABLE IF NOT EXISTS `competencia` (
  `idcompetencia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `descricao_nome` longtext NOT NULL,
  `atitude_descricao` longtext NOT NULL,
  `habilidade_descricao` longtext NOT NULL,
  `conhecimento_descricao` longtext NOT NULL,
  PRIMARY KEY (`idcompetencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `competencia_oa`
--

CREATE TABLE IF NOT EXISTS `competencia_oa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_competencia` int(11) NOT NULL,
  `id_OA` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `iddisciplina` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomeCurso` varchar(150) DEFAULT NULL,
  `nomeDisciplina` varchar(150) DEFAULT NULL,
  `descricao` longtext,
  `usuarioProfessorID` int(10) unsigned DEFAULT NULL,
  `senha` varchar(26) DEFAULT NULL,
  PRIMARY KEY (`iddisciplina`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_competencia`
--

CREATE TABLE IF NOT EXISTS `disciplina_competencia` (
  `disciplina_iddisciplina` int(10) unsigned NOT NULL,
  `competencia_idcompetencia` int(10) unsigned NOT NULL,
  `conhecimento` tinyint(3) unsigned DEFAULT NULL,
  `habilidade` tinyint(3) unsigned DEFAULT NULL,
  `atitude` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`disciplina_iddisciplina`,`competencia_idcompetencia`),
  KEY `disciplina_has_competencia_FKIndex1` (`disciplina_iddisciplina`),
  KEY `disciplina_has_competencia_FKIndex2` (`competencia_idcompetencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attemps',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_registration_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `acesso` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'tipo de acesso do usuario',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data' AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `acesso` int(10) unsigned DEFAULT NULL,
  `ativo` tinyint(3) unsigned DEFAULT NULL,
  `hash_ativacao` varchar(40) DEFAULT NULL,
  `senha_reset_hash` char(40) DEFAULT NULL,
  `reset_timestamp` bigint(20) DEFAULT NULL,
  `lembreme_token` varchar(64) DEFAULT NULL,
  `failed_login` tinyint(3) unsigned DEFAULT NULL,
  `ultimos_failed_login` int(10) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL,
  `ip_registro` varchar(39) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_competencias`
--

CREATE TABLE IF NOT EXISTS `usuario_competencias` (
  `usuario_idusuario` int(10) unsigned NOT NULL,
  `competencia_idcompetencia` int(10) unsigned NOT NULL,
  `conhecimento` tinyint(3) unsigned NOT NULL,
  `atitude` tinyint(3) unsigned NOT NULL,
  `habilidade` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`usuario_idusuario`,`competencia_idcompetencia`),
  KEY `usuario_has_competencias_FKIndex1` (`usuario_idusuario`),
  KEY `usuario_has_competencias_FKIndex2` (`competencia_idcompetencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_disciplina`
--

CREATE TABLE IF NOT EXISTS `usuario_disciplina` (
  `disciplina_iddisciplina` int(10) unsigned NOT NULL,
  `usuario_idusuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`disciplina_iddisciplina`,`usuario_idusuario`),
  KEY `disciplina_has_usuario_FKIndex1` (`disciplina_iddisciplina`),
  KEY `disciplina_has_usuario_FKIndex2` (`usuario_idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
