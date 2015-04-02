<?php

/**
 * Please note: we can use unencoded characters like ö, é etc here as we use the html5 doctype with utf8 encoding
 * in the application's header (in views/_header.php). To add new languages simply copy this file,
 * and create a language switch in your root files.
 */

// login & registration classes
define("MESSAGE_ACCOUNT_NOT_ACTIVATED", "Sua conta não foi ativada ainda. Por favor confirme sua conta em seu email.");
define("MESSAGE_CAPTCHA_WRONG", "Captcha errado!");
define("MESSAGE_COOKIE_INVALID", "Cookie invalido");
define("MESSAGE_DATABASE_ERROR", "Problema com a conexao ao Banco de Dados.");
define("MESSAGE_EMAIL_ALREADY_EXISTS", "Esse email já foi registrado. Use \"Esqueci minha senha\" para recuperar sua senha.");
define("MESSAGE_EMAIL_CHANGE_FAILED", "Desculpe, a troca do email não foi bem sucedida.");
define("MESSAGE_EMAIL_CHANGED_SUCCESSFULLY", "Seu email foi trocado com sucesso. Seu novo endereço de email é ");
define("MESSAGE_EMAIL_EMPTY", "Email não pode estar vazio");
define("MESSAGE_EMAIL_INVALID", "Seu email nao está em um modelo valido");
define("MESSAGE_EMAIL_SAME_LIKE_OLD_ONE", "Desculpe, esse email é o mesmo que o atual. Por favor escolha outro.");
define("MESSAGE_EMAIL_TOO_LONG", "Email não pode ter mais de 64 caracteres");
define("MESSAGE_LINK_PARAMETER_EMPTY", "Parametro com link vazio.");
define("MESSAGE_LOGGED_OUT", "Você saiu de sua conta.");
// The "login failed"-message is a security improved feedback that doesn't show a potential attacker if the user exists or not
define("MESSAGE_LOGIN_FAILED", "Erro no login.");
define("MESSAGE_OLD_PASSWORD_WRONG", "Sua antiga senha está errada.");
define("MESSAGE_PASSWORD_BAD_CONFIRM", "As senhas não são as mesmas");
define("MESSAGE_PASSWORD_CHANGE_FAILED", "Desculpe, a troca de senha não foi bem sucedida.");
define("MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY", "Senha trocada com sucesso!");
define("MESSAGE_PASSWORD_EMPTY", "Campo senha está vazio");
define("MESSAGE_PASSWORD_RESET_MAIL_FAILED", "Email de recuperação de senha NÃO foi enviado com sucesso! Erro: ");
define("MESSAGE_PASSWORD_RESET_MAIL_SUCCESSFULLY_SENT", "Email de recuperação enviado com sucesso!");
define("MESSAGE_PASSWORD_TOO_SHORT", "A senha deve ter no minimo 6 caracteres");
define("MESSAGE_PASSWORD_WRONG", "Senha errada. Tente novamente.");
define("MESSAGE_PASSWORD_WRONG_3_TIMES", "Você errou a senha 3 vezes ou mais. Por favor espere 30 segundos para tentar novamente.");
define("MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL", "Desculpe, não há código de ID para combinação aqui...");
define("MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL", "Ativação sucedida! Agora você pode logar!");
define("MESSAGE_REGISTRATION_FAILED", "Desculpe, cadastro não realizado. Por favor volte e tente novamente.");
define("MESSAGE_RESET_LINK_HAS_EXPIRED", "Seu link de redefinição expirou. Por favor use o link de redefinição em uma hora.");
define("MESSAGE_VERIFICATION_MAIL_ERROR", "Desculpe, não conseguimos enviar email de verificação. Sua conta NÃO foi criada.");
define("MESSAGE_VERIFICATION_MAIL_NOT_SENT", "Email de verificação não enviado! Erro: ");
define("MESSAGE_VERIFICATION_MAIL_SENT", "Sua conta foi criada com sucesso e mandamos um email para ativação. Por favor clique no link de VERIFICAÇÃO nesse email.");
define("MESSAGE_USER_DOES_NOT_EXIST", "Esse usuário não existe");
define("MESSAGE_USERNAME_BAD_LENGTH", "Nome de usuário não pode ter menos de 2 caracteres e mais de 64");
define("MESSAGE_USERNAME_CHANGE_FAILED", "Desculpe, sua troca de nome de usuário não foi sucedida.");
define("MESSAGE_USERNAME_CHANGED_SUCCESSFULLY", "Seu nome de usuário foi alterada com sucesso. Seu novo nome de usuário é ");
define("MESSAGE_USERNAME_EMPTY", "Campo nome vazio");
define("MESSAGE_USERNAMEID_EMPTY", "User id desconhecido");
define("MESSAGE_COURSEID_EMPTY", "Id da disciplina desconhecido");
define("MESSAGE_USERNAME_EXISTS", "Desculpe, esse nome de usuário já está sendo utilizado. Por favor escolha outro.");
define("MESSAGE_USERNAME_INVALID", "Nome de usuário não se encaixa no modelo: somente letras a-Z e números são permitidos, de 2 a 64 caracteres");
define("MESSAGE_USERNAME_SAME_LIKE_OLD_ONE", "Desculpe, esse nome de usuário é o mesmo que o atual. Por favor escolha outro.");
define("MESSAGE_YOU_SHOULDNT_BE_HERE", "Você não devia estar aqui");

// views
define("WORDING_BACK_TO_LOGIN", "Voltar para tela de Login");
define("WORDING_CHANGE_EMAIL", "Mudar email");
define("WORDING_CHANGE_PASSWORD", "Mudar senha");
define("WORDING_CHANGE_USERNAME", "Mudar nome de usuario");
define("WORDING_CURRENTLY", "atual");
define("WORDING_EDIT_USER_DATA", "Alterar dados do usuário");
define("WORDING_EDIT_YOUR_CREDENTIALS", "Você pode alterar seus dados aqui");
define("WORDING_FORGOT_MY_PASSWORD", "Esqueci minha senha");
define("WORDING_LOGIN", "Log in");
define("WORDING_LOGOUT", "Log out");
define("WORDING_NEW_EMAIL", "Novo email");
define("WORDING_NEW_PASSWORD", "Nova senha");
define("WORDING_NEW_PASSWORD_REPEAT", "Repita nova senha");
define("WORDING_NEW_USERNAME", "Novo nome de usuário (nome de usuário não pode ser vazio e deve ter azAZ09 e 2-64 caracteres)");
define("WORDING_OLD_PASSWORD", "Sua ANTIGA senha");
define("WORDING_PASSWORD", "Senha");
define("WORDING_PROFILE_PICTURE", "Foto do perfil (from gravatar):");
define("WORDING_REGISTER", "Registrar");
define("WORDING_REGISTER_NEW_ACCOUNT", "Registrar nova conta");
define("WORDING_REGISTRATION_CAPTCHA", "Por favor escreva os caracteres");
define("WORDING_REGISTRATION_EMAIL", "Email do Usuário (por favor preencha com email real, você receberá um emal de verificação com um link de ativação)");
define("WORDING_REGISTRATION_PASSWORD", "Senha (min. 6 caracteres!)");
define("WORDING_REGISTRATION_PASSWORD_REPEAT", "Repita a senha");
define("WORDING_REGISTRATION_USERNAME", "Nome de usuario (somente letras e numeros, de 2 a 64 caracteres)");
define("WORDING_REMEMBER_ME", "Lembre-me");
define("WORDING_REQUEST_PASSWORD_RESET", "Peça recuperação de senha use seu nome de usuário e você receberá um email com instruções:");
define("WORDING_RESET_PASSWORD", "Resetar senha");
define("WORDING_SUBMIT_NEW_PASSWORD", "Entre com nova senha");
define("WORDING_USERNAME", "Nome de usuario");
define("WORDING_YOU_ARE_LOGGED_IN_AS", "Você está logado como ");
define("WORDING_YOU_ARE_LOGGED_IN_AS_TYPE","Tipo de conta ");
define("WORDING_USER_STUDENT","Aluno");
define("WORDING_USER_PROFESSOR","Professor");
define("WORDING_USER_ADMIN","Admin");
define("WORDING_NAME", "Nome");
define("WORDING_KEYWORDS", "Palavras-chave");
define("WORDING_LANGUAGE", "Idioma");
define("WORDING_NAME_COMPETENCIA", "Nome da Competência: ");
define("WORDING_OA_LIST", "Nome dos OA separados por \";\" : ");
define("WORDING_AVAILABLE_COURSES", "Disciplinas disponíveis");
define("WORDING_REGISTER_SUCESSFULLY", "Cadastro efetuado com sucesso!");



//Cadastro de Disciplina Mensagens
define("MESSAGE_DISCIPLINA_ALREADY_EXISTS","A seguinte disciplina já exite: ");
define("MESSAGE_DISCIPLINA_DOESNT_EXIST","Disciplina não existe");
define("MESSAGE_COMPETENCIA_DOESNT_EXIST","Competência associada é inválida");
define("MESSAGE_DISCIPLINA_COMPETENCIA_ALREADY_RELATED","Competência já associada a essa disciplina");
define("WORDING_REGISTER_NOVA_DISCIPLINA", "Registrar Disciplina");
define("WORDING_CREATE_NEW_COURSE", "Criar novo curso");
define("WORDING_COURSE_NAME", "Nome do curso");
define("WORDING_DISCIPLINA_NAME", "Nome da disciplina");
define("WORDING_DISCIPLINA", "Disciplina ");
define("WORDING_CREATE_DISCIPLINA", "Criar Disciplina");
define("WORDING_CLEAR_CREATE_DISCIPLINA", "Limpar");
define("WORDING_DISCIPLINA_DESCRICAO", "Descrição");
define("WORDING_CREATE_NEW_COMPETENCIA", "Criar nova competência");
define("WORDING_CANT_ASSOCIATE_COMPETENCIA","A competencia citada em sequência não pode ser associada a essa disciplina ou já foi associada previamente");
define("WORDING_CREATED_SUCESSFULLY"," criada com sucesso!");
define("WORDING_FILL_NAME_DISCIPLINA","Preencha o nome da disciplina");
define("WORDING_FILL_PASSWORD","Preencha a senha");
define("WORDING_SELECT_COMPETENCIA","Selecione a(s) competências(s)");

//Cadastro de OA mensagens
define("WORDING_PORTUGUES", "Português");
define("WORDING_ENGLISH", "Inglês");
define("WORDING_SPANISH", "Espanhol");
define("WORDING_REGISTER_NOVO_OA", "Registrar Objeto de Aprendizagem");
define("MESSAGE_OA_WITH_NAME_ALREADY_EXISTS", "Objeto de Aprendizagem com nome e/ou URL já existente!");


// -- Categoria Vida mensagens
define("WORDING_LIFE_CATEGORY", "Categoria Vida");
define("WORDING_DATE", "Data");
define("WORDING_STATUS", "Status");
define("WORDING_REVISED", "Revisado");
define("WORDING_DRAFT", "Rascunho");
define("WORDING_EDITED", "Editado");
define("WORDING_UNAVAILABLE", "Indisponível");
define("WORDING_FINAL", "Final");
define("WORDING_VERSION", "Versão");
define("WORDING_ENTITY", "Entidade");
define("WORDING_CONTRIBUTION", "Contribuição");
define("WORDING_AUTHOR", "Autor");
define("WORDING_EDITOR", "Editor");
define("WORDING_UNKNOWN", "Desconhecido");
define("WORDING_INICIATOR", "Iniciador");
define("WORDING_GRAPHIC_DESIGNER", "Designer Gráfico");
define("WORDING_TECHNICAL", "Técnico");
define("WORDING_CONTENT_PROVIDER", "Provedor de Conteúdo");
define("WORDING_ROTEIRIST", "Roteirista");
define("WORDING_INSTRUCTIONAL_DESIGNER", "Designer Instrucional");
define("WORDING_CONTENT_SPECIALIST", "Especialista em Conteúdo");
define("WORDING_FILL_DATE", "Preencha a data");

// -- Categoria Técnica mensagens
define("WORDING_TECHNICAL_CATEGORY", "Categoria Técnica");
define("WORDING_VIDEO_TIME", "Tempo de video");
define("WORDING_SIZE", "Tamanho (MB)");
define("WORDING_TECHNOLOGY_TYPE", "Tipo de tecnologia");
define("WORDING_BROWSER", "Navegador");
define("WORDING_FORMAT", "Formato");
define("WORDING_OPERATIONAL_SYSTEM", "Sistema Operacional");
define("WORDING_VIDEO", "Video");
define("WORDING_IMAGE", "Imagem");
define("WORDING_AUDIO", "Audio");
define("WORDING_TEXT", "Texto");
define("WORDING_APRESENTATION", "Apresentação");
define("WORDING_PDF", "PDF");
define("WORDING_SITE", "Site");

// -- Categoria Educacional mensagens
define("WORDING_EDUCATIONAL_CATEGORY", "Categoria Educacional");
define("WORDING_EDUCATIONAL_DESCRIPTION", "Descrição Educacional");
define("WORDING_ITERABILITY_NIVEL", "Nível Iteratividade");
define("WORDING_ITERABILITY_TYPE", "Tipo Iteratividade");
define("WORDING_VERY_LOW", "Muito Baixa");
define("WORDING_LOW", "Baixa");
define("WORDING_MIDDLE", "Médio");
define("WORDING_HIGH", "Alto");
define("WORDING_VERY_HIGH", "Muito Alto");
define("WORDING_ACTIVE", "Ativa");
define("WORDING_EXPOSITORY", "Expositiva");
define("WORDING_MIXED", "Mista");
define("WORDING_AGE_GROUP", "Faixa Etária");
define("WORDING_CHILD", "Criança");
define("WORDING_ADULT", "Adulto");
define("WORDING_ELDERLY", "Idoso");
define("WORDING_ALL_AGES", "Todas as idades");
define("WORDING_EXERCISE", "Exercício");
define("WORDING_SIMULATION", "Simulação");
define("WORDING_QUESTIONNAIRE", "Questionário");
define("WORDING_DIAGRAM", "Diagrama");
define("WORDING_FIGURE", "Figura");
define("WORDING_GRAPHIC", "Gráfico");
define("WORDING_INDICE", "Índice");
define("WORDING_SLIDE", "Slide");
define("WORDING_TABLE", "Tabela");
define("WORDING_TEST", "Teste");
define("WORDING_EXPERIENCE", "Experiência");
define("WORDING_PROBLEM", "Problema");
define("WORDING_AUTO_AVALIATION", "Auto Avaliação");
define("WORDING_LECTURE", "Palestra");
define("WORDING_LEARNING_RESOURCE", "Recurso Aprendizagem");
define("WORDING_FINAL_USER", "Usuário Final");
define("WORDING_PROFESSOR", "Professor");
define("WORDING_STUDENT", "Aluno");
define("WORDING_ADMIN", "Admin");
define("WORDING_SCHOOL", "Escola");
define("WORDING_COLLEGE", "Faculdade");
define("WORDING_TRAINING", "Treinamento");
define("WORDING_OTHER", "Outro");
define("WORDING_AMBIENT", "Ambiente");
define("WORDING_FILL_EDUCACIONAL_DESCRIPTION", "Preencha a descrição educacional");

// -- Categoria Direito mensagens
define("WORDING_RIGHT_CATEGORY", "Categoria Direito");
define("WORDING_COST", "Custo");
define("WORDING_YES", "Sim");
define("WORDING_NO", "Não");
define("WORDING_COPYRIGHT", "Direito Autoral");
define("WORDING_USE", "Uso");

// -- Categoria Geral mensagens
define("WORDING_GENERAL_INFORMATION","Dados Gerais");
define("WORDING_DESCRIPTION","Descrição");
define("WORDING_FILL_DESCRIPTION","Preencha a descrição");
define("WORDING_FILL_NAME","Preencha o nome");
define("WORDING_FILL_URL","URL inválido");
define("WORDING_FILL_KEYWORD","Preencha palavra-chave");
define("WORDING_URL","URL");
define("WORDING_KEYWORD","Palavra-chave");
define("WORDING_CREATE_OA","Criar Objeto de Aprendizagem");

//Cadastro de Competências Mensagens
define("WORDING_REGISTER_NOVA_COMPETENCIA", "Registrar Competência");
define("WORDING_COMPETENCIA", "Competência ");
define("WORDING_CHA", "CHA ");
define("WORDING_CREATE_COMPETENCA", "Criar Nova Competência");
define("WORDING_ASSOCIATE_OA", "Associar OA's para nova competência");
define("MESSAGE_NAME_EMPTY", "Nome vazio");
define("MESSAGE_DESCRICAO_EMPTY", "Descrição vazia");
define("MESSAGE_DESCRICAO_HABILIDADE_EMPTY", "Descrição da habilidade vazia");
define("MESSAGE_DESCRICAO_CONHECIMENTO_EMPTY", "Descrição do conhecimento vazio");
define("MESSAGE_DESCRICAO_ATITUDE_EMPTY", "Descrição da atitude vazia");
define("MESSAGE_NAME_TOO_SHORT", "Nome muito pequeno");
define("MESSAGE_COMPETENCIA_ALREADY_EXISTS", "A seguinte competência já existe: ");
define("WORDING_COMPETENCIA_DESCRICAO", "Descrição da Competência");
define("WORDING_ATITUDE_DESCRICAO", "Descrição da Atitude");
define("WORDING_HABILIDADE_DESCRICAO", "Descrição da Habilidade");
define("WORDING_CONHECIMENTO_DESCRICAO", "Descrição do Conhecimento");
define("WORDING_CLEAN", "Limpar");
define("MESSAGE_OAS_EMPTY", "Nenhum OA selecionado");