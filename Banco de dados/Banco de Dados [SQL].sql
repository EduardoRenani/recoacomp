CREATE TABLE categoria_direito (
  idcategoria_direito INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  custo TINYINT UNSIGNED NULL,
  direitoAutoral TINYINT UNSIGNED NULL,
  uso LONGTEXT NULL,
  PRIMARY KEY(idcategoria_direito)
);

CREATE TABLE categoria_eduacional (
  idcategoria_eduacional INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  descricao LONGTEXT NULL,
  nivelIteratividade VARCHAR(45) NULL,
  tipoIteratividade VARCHAR(45) NULL,
  ambiente VARCHAR(100) NULL,
  faixaEtaria VARCHAR(100) NULL,
  recursoAprendizagem VARCHAR(100) NULL,
  usuarioFinal VARCHAR(100) NULL,
  PRIMARY KEY(idcategoria_eduacional)
);

CREATE TABLE categoria_tecnica (
  idcategoria_tecnica INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  tempo_video TIME NULL,
  tamanho VARCHAR(50) NULL,
  tipoTecnologia VARCHAR(50) NULL,
  tipoFormato VARCHAR(50) NULL,
  PRIMARY KEY(idcategoria_tecnica)
);

CREATE TABLE categoria_vida (
  idcategoria_vida INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  categoriaVidaData DATE NULL,
  categoriaVidaStatus VARCHAR(45) NULL,
  versao VARCHAR(45) NULL,
  entidade VARCHAR(200) NULL,
  contribuicao VARCHAR(100) NULL,
  PRIMARY KEY(idcategoria_vida)
);

CREATE TABLE cesta (
  idcesta INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idcategoria_vida INTEGER UNSIGNED NOT NULL,
  idcategoria_tecnica INTEGER UNSIGNED NOT NULL,
  idcategoria_eduacional INTEGER UNSIGNED NOT NULL,
  idusuario INTEGER UNSIGNED NOT NULL,
  idcategoria_direito INTEGER UNSIGNED NOT NULL,
  descricao LONGTEXT NULL,
  nome VARCHAR(200) NULL,
  url LONGTEXT NULL,
  palavraChave LONGTEXT NULL,
  idioma VARCHAR(200) NULL,
  PRIMARY KEY(idcesta),
  INDEX cesta_FKIndex1(idcategoria_direito),
  INDEX cesta_FKIndex2(idusuario),
  INDEX cesta_FKIndex3(idcategoria_eduacional),
  INDEX cesta_FKIndex4(idcategoria_tecnica),
  INDEX cesta_FKIndex5(idcategoria_vida)
);

CREATE TABLE competencia (
  idcompetencia INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(200) NULL,
  descricao LONGTEXT NULL,
  PRIMARY KEY(idcompetencia)
);

CREATE TABLE disciplina (
  iddisciplina INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nomeCurso VARCHAR(150) NULL,
  nomeDisciplina VARCHAR(150) NULL,
  descricao LONGTEXT NULL,
  usuarioProfessorID INTEGER UNSIGNED NULL,
  senha VARCHAR(26) NULL,
  PRIMARY KEY(iddisciplina)
);

CREATE TABLE disciplina_competencia (
  disciplina_iddisciplina INTEGER UNSIGNED NOT NULL,
  competencia_idcompetencia INTEGER UNSIGNED NOT NULL,
  conhecimento TINYINT UNSIGNED NULL,
  habilidade TINYINT UNSIGNED NULL,
  atitude TINYINT UNSIGNED NULL,
  PRIMARY KEY(disciplina_iddisciplina, competencia_idcompetencia),
  INDEX disciplina_has_competencia_FKIndex1(disciplina_iddisciplina),
  INDEX disciplina_has_competencia_FKIndex2(competencia_idcompetencia)
);

CREATE TABLE usuario (
  idusuario INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(200) NULL,
  email VARCHAR(200) NULL,
  senha VARCHAR(100) NULL,
  acesso TINYINT UNSIGNED NULL,
  ava TINYINT UNSIGNED NULL,
  capacitacaoAVA TINYINT UNSIGNED NULL,
  conhecimentoOA TINYINT UNSIGNED NULL,
  ead TINYINT UNSIGNED NULL,
  infoEdu TINYINT UNSIGNED NULL,
  monitoria TINYINT UNSIGNED NULL,
  temaCompetencia TINYINT UNSIGNED NULL,
  tutoria TINYINT UNSIGNED NULL,
  PRIMARY KEY(idusuario)
);

CREATE TABLE usuario_competencias (
  usuario_idusuario INTEGER UNSIGNED NOT NULL,
  competencia_idcompetencia INTEGER UNSIGNED NOT NULL,
  conhecimento INTEGER UNSIGNED NOT NULL,
  atitude INTEGER UNSIGNED NOT NULL,
  habilidade INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(usuario_idusuario, competencia_idcompetencia),
  INDEX usuario_has_competencias_FKIndex1(usuario_idusuario),
  INDEX usuario_has_competencias_FKIndex2(competencia_idcompetencia)
);

CREATE TABLE usuario_disciplina (
  disciplina_iddisciplina INTEGER UNSIGNED NOT NULL,
  usuario_idusuario INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(disciplina_iddisciplina, usuario_idusuario),
  INDEX disciplina_has_usuario_FKIndex1(disciplina_iddisciplina),
  INDEX disciplina_has_usuario_FKIndex2(usuario_idusuario)
);


