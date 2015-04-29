-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 15-Set-2014 às 16:38
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `competencia`
--

INSERT INTO `competencia` (`idcompetencia`, `nome`, `descricao_nome`, `atitude_descricao`, `habilidade_descricao`, `conhecimento_descricao`) VALUES
(1, 'Fluência Digital', 'Está ligada a utilização da tecnologia de modo que o sujeito sinta-se digitalmente ativo/participante dos avanços tecnológicos. A fluência possibilita não só o uso, mas também a criação e produção de conteúdos/materiais.', 'Iniciativa para buscar inovações e sempre se manter atualizado.', 'Mexer, buscar, selecionar, produzir.', 'Conhecimento teórico/tecnológico sobre as ferramentas.'),
(2, 'Relacionamento Interpessoal', 'É fundamentada na empatia, na mediação pedagógica, na facilitação nos processos de ensino e de aprendizagem, na cooperação, na transparência, no foco ao ser humano, além de adequado relacionamento com os parceiros.', 'Aberto a trocas, empático, receptivo, colocar-se no lugar do outro.', 'Comportar-se, como agir dentro das normas.', 'Como se comportar, regras de etiquetas, normas sociais.'),
(3, 'Organização', 'Relaciona-se com a ordenação, estruturação e sistematização de atividades, materiais e grupos.', 'Engajamento, envolvimento, proatividade, tomada de decisões, persistência.', 'Criar estratégias, sistematizar, ordenar e classificar.', 'Ter autoconhecimento, planejar, conhecer os prazos.'),
(4, 'Planejamento', 'Baseada no estabelecimento de prioridades, metas e objetivos. Em educaçăo, considera-se também as condiçőes necessárias para criar situaçőes e aplicar estratégias de aprendizagem.', 'Proatividade, objetividade, metódica.', 'Sistematizar, avaliar, analisar.', 'Tipos de planejamento, contexto, potencialidades, fragilidades, público (se houver).'),
(5, 'Administraçăo do Tempo', 'É pautada no cumprimento da agenda, conciliar atividades de compromissos para a gestão das atividades, atingindo as prioridades, metas e objetivos.\r\n', 'Proatividade, objetividade, focado.', 'Utilizar o tempo de forma eficiente, dar limites, estabelecer prazos, delimitar prioridades, ordenar as ações, identificar objetivos.\r\n', 'Prazos, formas de organização, autoconhecimento.'),
(6, 'Capacidade de Motivar Outro e a Si', 'Estabelece as condições para manter a motivação entre pares e consigo mesmo, sendo um facilitador dos processos. Da mesma forma, ser capaz de acolher as dificuldades do outro incentivando-o a permanecer e concluir uma atividade, sendo ativo e participativo. Ser capaz de lidar com as próprias dificuldades.\r\n', 'Autoestima, autoconfiança, disposição, participativo, engajamento, acolhimento.', 'Discernir, criticar, analisar, enfrentar obstáculos.', 'Autoconhecimento, conhecimento sobre o outro, mecanismos motivacionais.'),
(7, 'Avaliaçăo da Apredizagem', 'É focada nas condições para compreender o desenvolvimento do processo de aprendizagem do aluno, a fim de colaborar ou avaliar as atividades propostas.\r\n', 'Autocontrole, criticidade, atualizar-se, acolhimento.', 'Analisar o processo de aprendizagem, sistematizar atividades, mediar, levar em consideração as particularidades.\r\n', 'Conhecer as necessidades de aprendizagem, conhecer o processo de aprendizagem, formas de avaliação, público/grupo de alunos.\r\n'),
(8, 'Comunicação', 'Está fundamentada na clareza e na objetividade da expressão oral, gestual e escrita.\r\n', 'Expressivo, empático, cauteloso, articulado.', 'Escrita de forma clara, objetiva e coerente, interpretar mensagens recebidas, como impostar a voz, articular as palavras, usar vocabulário adequado.\r\n', 'Norma culta da língua, compreender regras de comportamento, formas de comunicação, público/receptores.\r\n'),
(9, 'Reflexão', 'Está baseada na abstração para refletir e analisar criticamente situações, atividades, modos de agir.\r\n', 'Proativo, crítico, ponderado, ser autodidata, ter autocontrole.', 'Analisar, interpretar dados/fatos/situações.', 'Conhecer o objeto em questão.'),
(10, 'Didática', 'Revela-se na ação dos professores. Considera-se como a reflexão sistemática da prática pedagógica. Pressupõe a ação educativa numa sociedade historicamente determinada; Capacidade de seleção e aplicação de procedimentos, métodos, técnicas e recursos aos conteúdos, através da determinação de objetivos e finalidades pedagógicas.\r\n', 'Reflexivo, Proativo, crítico, responsável, autônomo, acolhedor, mobilizador.', 'Fazer e refazer sua prática de modo crítico e criativo; Estabelecer a relação entre experiência do aluno e conhecimento teórico/científico; Planejar as atividades docentes, levando com consideração o perfil e os estilos de aprendizagem dos alunos; Interpretar dados e informações buscando mediar o processo de ensino e aprendizagem, Dominar a sala de aula.\r\n', 'Conhecimentos científicos e metodologias de ensino diversificadas; aplicação de tecnologias na educação e saber como aplicar com finalidade pedagógica; bem como conhecer os diferentes contextos educacionais, estrutura educacional.\r\n'),
(11, 'Trabalho em Equipe', 'O trabalho em equipe contempla as relações intra e interpessoal, as quais permitem ao sujeito expressar e comunicar, de modo adequado, seus sentimentos, desejos, opiniões e expectativas. Além disso, evidenciam condutas interpessoais, destreza para interagir com outras pessoas de forma socialmente aceitável e valorizada, podendo, assim, trazer benefícios aos participantes nos momentos de interação. Esses elementos podem, ainda, ser complementados sob a ótica afetiva. Isso porque a complexidade das relações sociais também requer a capacidade de perceber e fazer distinções no humor, nas intenções, nas motivações e nos sentimentos de outras pessoas.\r\n', 'Preocupar-se em alcançar os objetivos comuns a equipe, flexível, aberto a críticas e sugestões, ouvir o outro, colaborativo, cooperativo.\r\n', 'Adequar ações intra e interpessoal, criar estratégias, articular a comunicação com os sujeitos. Identificar perfil e necessidades da equipe em que está inserido, saber trabalhar em clima de equidade, articular conflitos, negociar, comunicar, colaborar, cooperar, ser capaz de se adaptar a situações novas, conduzir diferentes situações.\r\n', 'Tipos de equipes, saber parcial das áreas que compõe a equipe.'),
(12, 'Dar e Receber Feedback', 'Leitura e compreensão da(s) ação(ões) ou da(s) mensagem(ns) emitida(s) por outro, dando retorno ao emissor de forma respeitosa e adequada ao contexto da ação ou mensagem, como também compreender e aceitar o retorno de outro sobre sua(s) ação(ões) ou mensagem(ns). No caso do contexto educacional, trata-se da leitura e compreensão do trabalho do aluno apresentado presencialmente ou a distância, de postagens de mensagens nas ferramentas de interação dos recursos digitais, entre outras possibilidades, dando retorno de forma acolhedora e respeitosa diante do processo de aprendizagem, bem como alunos, monitores/tutores e professores recebendo o feedback de modo a compreender e aceitar o retorno do outro sobre sua atuação. \r\n', 'Acolhedor, aberto, respeitoso, responsável.', 'Como realizar o feedback  (ex.:  uso  da  técnica  do "sanduíche"), usar o vocabulário adequadamente.\r\n', 'Sobre processo de aprendizagem, contexto de ação/conhecimentos envolvidos, público, conhecimentos científicos, normas de escrita, regras de etiqueta.\r\n'),
(13, 'Mediação Pedagógica', 'Condições para incentivar e mobilizar as trocas entre os alunos, organizar grupos, orientar ações, problematizar posicionamentos e entendimentos sobre o conteúdo em questão, administrar conflitos, realizar negociações, tendo por objetivo aproximar os alunos do conteúdo de forma ativa e coletiva, visando a construção de conhecimentos.\r\n', 'Respeitoso, acolhedor, responsável, atento, pró-ativo, flexível.', 'Como realizar as intervenções descritas na competência.', 'Processo de aprendizagem/construção de conhecimento, dinâmicas dos grupos, didática, pedagogia da pergunta. \r\n'),
(14, 'Autonomia', 'Para Piaget autonomia significa ser governado por si mesmo. É o oposto de heteronomia, que significa que uma pessoa é governada por outra pessoa.\r\n', 'Autocontrole, responsável, autocrítico, proativo, compromissado e ético.', 'autonomia_habilidade=Analisar, interpretar dados e situações, realizar escolhas complexas, antecipar situações, selecionar, sistematizar, relacionar, interpretar dados e informações, tomar decisões.\r\n', 'Normas sociais e culturais, valores morais, conhecimentos sobre ética.');

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
