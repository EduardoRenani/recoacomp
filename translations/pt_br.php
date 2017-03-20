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
define("MESSAGE_OLD_PASSWORD_WRONG", "Senha antiga está errada.");
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
define("WORDING_BACK_TO_LOGIN", "Voltar Home");
define("WORDING_CHANGE_EMAIL", "Mudar email");
define("WORDING_CHANGE_PASSWORD", "Mudar senha");
define("WORDING_CHANGE_USERNAME", "Mudar nome de usuario");
define("WORDING_CURRENTLY", "Atual");
define("WORDING_EDIT_USER_DATA", "Alterar dados do usuário");
define("WORDING_EDIT_YOUR_CREDENTIALS", "Alteração de Dados");
define("WORDING_FORGOT_MY_PASSWORD", "Esqueci minha senha");
define("WORDING_LOGIN", "Entrar");
define("WORDING_LOGOUT", "Sair");
define("WORDING_NEW_EMAIL", "Novo email");
define("WORDING_NEW_PASSWORD", "Nova senha");
define("WORDING_NEW_PASSWORD_REPEAT", "Repita nova senha");
define("WORDING_NEW_USERNAME", "Novo nome de usuário");
define("WORDING_OLD_PASSWORD", "Sua ANTIGA senha");
define("WORDING_PASSWORD", "Senha");
define("WORDING_PROFILE_PICTURE", "Foto do perfil (from gravatar):");
define("WORDING_REGISTER", "Cadastrar");
define("WORDING_REGISTER_NEW_ACCOUNT", "Cadastrar nova conta");
define("WORDING_REGISTRATION_CAPTCHA", "Por favor escreva os caracteres");
define("WORDING_REGISTRATION_EMAIL", "Email do Usuário");
define("WORDING_REGISTRATION_PASSWORD", "Senha");
define("WORDING_REGISTRATION_PASSWORD_REPEAT", "Repita a senha");
define("WORDING_REGISTRATION_USERNAME", "Nome de usuario");
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
define("WORDING_AVAILABLE_COURSES", "Atividades disponíveis");
define("WORDING_REGISTER_SUCESSFULLY", "Cadastro efetuado com sucesso!");
define("WORDING_EDIT_SUCESSFULLY", "Edição efetuada com sucesso!");
define("WORDING_TEAM", "Equipe");
define("ADMIN_ACCESS", "2");
define("VISAO_ALUNO", "1");
define("VISAO_PROFESSOR", "2");

// Página editar disciplina
define("WORDING_EDIT_DESCRIPTION", "Alterar descrição");
define("WORDING_NEW_DESCRIPTION", "Nova descrição");
define("HINT_INTERATIVITY_DESCRIPTION", "De forma simplificada, o nível de interatividade de um objeto de aprendizagem (OA) define-se de acordo com as condições ou as possibilidades de intervenção e resposta que o OA permite ao estudante, podendo ser de nível baixo (pouca ou nenhuma possibilidade de intervenção/resposta, como em um texto estático) a nível alto (grande possibilidade de intervenção/resposta, como em um jogo)");



//Cadastro de Disciplina Mensagens
define("MESSAGE_DISCIPLINA_ALREADY_EXISTS","A seguinte atividade de ensino já existe: ");
define("MESSAGE_DISCIPLINA_DOESNT_EXIST","Atividade de ensino não existe");
define("MESSAGE_COMPETENCIA_DOESNT_EXIST","Competência associada é inválida");
define("MESSAGE_DISCIPLINA_COMPETENCIA_ALREADY_RELATED","Competência já associada a essa disciplina");
define("WORDING_REGISTER_NOVA_DISCIPLINA", "Cadastrar Atividade de Ensino");
define("WORDING_REGISTER_NOVO_CURSO", "Cadastrar Curso");
define("WORDING_REGISTER_NOVO_PROJETO", "Cadastrar Projeto");
define("WORDING_REGISTER_NOVO_OUTROS", "Cadastrar Outros");

define("WORDING_EDIT_COURSE", "Editar Atividade de Ensino");
define("WORDING_GLOBAL_COURSE", "Visão geral");
define("WORDING_EDIT_COURSE_FINAL", "Finalizar edição da Atividade de Ensino");
define("WORDING_CREATE_NEW_COURSE", "Criar novo curso");
define("WORDING_INSTITUTIONAL_NAME", "Nome da unidade");
define("WORDING_COURSE_NAME", "Nome do curso");
define("WORDING_DISCIPLINA_NAME", "Nome da Atividade de Ensino");
define("WORDING_PROJETO_NAME", "Nome da projeto");
define("WORDING_OUTROS_NAME", "Nome de outros");
define("WORDING_DISCIPLINA", "Atividade de Ensino ");
define("WORDING_CREATE_DISCIPLINA", "Concluir cadastro");
define("WORDING_CREATE_COURSE", "Concluir cadastro");
define("WORDING_CREATE_PROJETO", "Concluir cadastro");
define("WORDING_CREATE_OUTROS", "Concluir cadastro");
define("WORDING_CLEAR_CREATE_DISCIPLINA", "Limpar");
define("WORDING_DISCIPLINA_DESCRICAO", "Descrição");
define("WORDING_AREA_CONHECIMENTO", "Área de conhecimento");
define("WORDING_CREATE_NEW_COMPETENCIA", "Criar nova competência");
define("WORDING_CANT_ASSOCIATE_COMPETENCIA","A competencia citada em sequência não pode ser associada a essa atividade de ensino ou já foi associada previamente");
define("WORDING_CREATED_SUCESSFULLY"," criada com sucesso!");
define("WORDING_CREATE_SUCESSFULLY"," criado com sucesso!");
define("WORDING_FILL_NAME_DISCIPLINA","Preencha o nome da atividade de ensino");
define("WORDING_FILL_PASSWORD","Preencha a senha");
define("WORDING_SELECT_COMPETENCIA","Selecione a(s) competências(s)");
define("WORDING_FILL_YOUR_CHA","Preencha seu CHA");
define("WORDING_FILL_TEST_CHA","Preencha o seu perfil");
define("WORDING_FINALIZE","Finalizar");
define("WORDING_TEST_REC","Testar recomendação");
define("WORDING_REGISTER_CHA","Cadastrar Perfil");
define("WORDING_NULL_COMPETENCE","Nenhuma competência foi selecionada");
define("WORDING_NEW_DISCIPLINA_NAME","Novo nome para a atividade de ensino");
define("WORDING_NEW_COURSE_NAME","Novo nome para curso");
define("WORDING_CHANGE_DISCIPLINA_NAME","Alterar nome da atividade de ensino");
define("WORDING_CHANGE_COURSE_NAME","Alterar nome do curso");
define("MESSAGE_DISCIPLINA_NAME_INVALID", "Nome da atividade de ensino inválido.");
define("MESSAGE_COURSE_NAME_INVALID", "Nome do curso inválido.");


//Cadastro de OA mensagens
define("MESSAGE_OA_NAME_INVALID", "Nome do Objeto de Aprendizagem inválido");
define("MESSAGE_OA_DESCRIPTION_INVALID", "Descrição do Objeto de Aprendizagem inválido");
define("MESSAGE_OA_UTILITY_TYPE_INVALID", "Forma de utilização do Objeto de Aprendizagem inválida");
define("WORDING_PORTUGUES", "Português");
define("WORDING_ENGLISH", "Inglês");
define("WORDING_SPANISH", "Espanhol");
define("WORDING_REGISTER_NOVO_OA", "Cadastrar Objeto de Aprendizagem");
define("MESSAGE_OA_WITH_NAME_ALREADY_EXISTS", "Objeto de Aprendizagem com nome e/ou URL já existente!");
define("WORDING_ASSOCIATE_COMPETENCE", "Associar Competências");
define("WORDING_OA", "Objeto de Aprendizagem");
define("WORDING_NEW_OA_NAME","Novo nome para Objeto de Aprendizagem");
define("WORDING_NEW_OA_DATE","Nova data para Objeto de Aprendizagem");
define("WORDING_NEW_OA_UTILITY_TYPE","Nova forma de utilização para Objeto de Aprendizagem");
define("WORDING_NEW_OA_TYPE","Novo tipo para Objeto de Aprendizagem");
define("WORDING_NEW_OA_AGE_GROUP","Nova faixa etária para Objeto de Aprendizagem");
define("WORDING_NEW_OA_LEARNING_RESOURCE","Novo recurso de aprendizagem para Objeto de Aprendizagem");
define("WORDING_NEW_OA_DESCRIPTION","Nova descrição para Objeto de Aprendizagem");
define("WORDING_NEW_OA_KEYWORD","Nova(s) palavra(s) chave para Objeto de Aprendizagem");
define("WORDING_NEW_OA_LANGUAGE","Novo idioma para Objeto de Aprendizagem");
define("WORDING_NEW_OA_URL","Novo URL para Objeto de Aprendizagem");
define("WORDING_NEW_OA_KNOWLEDGE_AREA","Nova área de conhecimento para Objeto de Aprendizagem");
define("WORDING_CHANGE_OA_DESCRIPTION","Alterar descrição Objeto de Aprendizagem");
define("WORDING_CHANGE_OA_NAME","Alterar nome Objeto de Aprendizagem");
define("WORDING_CHANGE_OA_KEYWORD","Alterar palavra chave Objeto de Aprendizagem");
define("WORDING_CHANGE_OA_LANGUAGE","Alterar idioma Objeto de Aprendizagem");
define("WORDING_CHANGE_OA_URL","Alterar URL Objeto de Aprendizagem");
define("WORDING_CHANGE_OA_KNOWLEDGE_AREA","Alterar área de conhecimento Objeto de Aprendizagem");
define("WORDING_CHANGE_OA_DATE","Alterar data Objeto de Aprendizagem");
define("WORDING_CHANGE_OA_UTILITY_TYPE","Alterar forma de utilização Objeto de Aprendizagem");
define("WORDING_CHANGE_OA_TYPE","Alterar tipo de Objeto de Aprendizagem");
define("WORDING_CHANGE_OA_AGE_GROUP","Alterar faixa etária do Objeto de Aprendizagem");
define("WORDING_CHANGE_OA_LEARNING_RESOURCE","Alterar recurso aprendizagem do Objeto de Aprendizagem");


define("ATIVIDADE_OUTROS", "3");
define("ATIVIDADE_PROJETO", "2");
define("ATIVIDADE_CURSO", "1");
define("ATIVIDADE_DISCIPLINA", "0");


// -- Categoria Vida mensagens
define("WORDING_LIFE_CATEGORY", "Categoria Vida");
define("WORDING_DATE", "Ano de elaboração");
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
define("WORDING_CONTENT_THEORY", "Animação");
define("WORDING_FILL_DATE", "Preencha a data");

// -- Categoria Técnica mensagens
define("WORDING_TECHNICAL_CATEGORY", "Categoria Técnica");
define("WORDING_OA_TYPE", "Tipo de Objeto de Aprendizagem");
define("WORDING_VIDEO_TIME", "Tempo de video");
define("WORDING_SIZE", "Tamanho (MB)");
define("WORDING_UTILITY_TYPE", "Forma de Utilização");
define("WORDING_THROUGH_BROWSER", "Através do Navegador");
define("WORDING_THROUGH_DOWNLOAD", "Através de Download");
define("WORDING_FORMAT", "Formato");
define("WORDING_OPERATIONAL_SYSTEM", "Sistema Operacional");
define("WORDING_VIDEO", "Video");
define("WORDING_IMAGE", "Imagem");
define("WORDING_AUDIO", "Audio");
define("WORDING_TEXT", "Texto");
define("WORDING_APRESENTATION", "Apresentação");
define("WORDING_PDF", "PDF");
define("WORDING_SITE", "Site");
define("WORDING_MULTIMIDIA_MATERIAL", "Material Multimídia");
define("WORDING_ANIMATION", "Animação");
define("WORDING_DIGITAL_BOOK", "Livro Digital");
define("WORDING_GAME", "Jogo");
define("WORDING_DOCUMENT", "Documento (PDF, Texto, Planilha)");
define("WORDING_WEB_PAGE", "Página da WEB");


// -- Categoria Educacional mensagens
define("WORDING_EDUCATIONAL_CATEGORY", "Categoria Educacional");
define("WORDING_EDUCATIONAL_DESCRIPTION", "Uso Pedagógico na categoria Educacional");
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
define("WORDING_AGE_GROUP", "Público Alvo");
define("WORDING_CHILD", "Criança");
define("WORDING_ADULT", "Adulto");
define("WORDING_ELDERLY", "Idoso");
define("WORDING_ALL_AGES", "Todas as idades");
define("WORDING_EXERCISE", "Exercício");
define("WORDING_SIMULATION", "Simulação");
define("WORDING_QUESTIONNAIRE", "Questionário");
define("WORDING_DIAGRAM", "Diagrama");
define("WORDING_FIGURE", "Apresentação");
define("WORDING_GRAPHIC", "Gráfico");
define("WORDING_INDICE", "Planilha");
define("WORDING_SLIDE", "Pagina da Web");
define("WORDING_TABLE", "Tabela");
define("WORDING_TEST", "Teste");
define("WORDING_EXPERIENCE", "Imagem");
define("WORDING_PROBLEM", "Áudio");
define("WORDING_AUTO_AVALIATION", "Jogo");
define("WORDING_LECTURE", "Palestra");
define("WORDING_MULTIM", "Livro Digital");
define("WORDING_LEARNING_RESOURCE", "Recursos Educacionais do Objeto de Aprendizagem");
define("WORDING_FINAL_USER", "Usuário Final");
define("WORDING_PROFESSOR", "Professor");
define("WORDING_STUDENT", "Aluno");
define("WORDING_ADMIN", "Admin");
define("WORDING_SCHOOL", "Escola");
define("WORDING_TRAINING", "Treinamento");
define("WORDING_OTHER", "Outro");
define("WORDING_AMBIENT", "Ambiente");
define("WORDING_FILL_EDUCACIONAL_DESCRIPTION", "Preencha a descrição educacional");
define("WORDING_CHILD_EDUCATION", "Educação de jovens e adultos");
define("WORDING_OLD_EDUCATION", "Educação de idosos");
define("WORDING_BASIC_EDUCATION", "Ensino Fundamental");
define("WORDING_HIGHSCOOL", "Ensino Médio");
define("WORDING_PROFESSIONAL_EDUCATION", "Ensino Profissionalizante");
define("WORDING_COLLEGE", "Ensino Superior");

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
define("WORDING_KNOWLEDGE_AREA","Área de conhecimento");
define("WORDING_FILL_DESCRIPTION","Preencha a descrição");
define("WORDING_FILL_NAME","Preencha o nome");
define("WORDING_FILL_URL","URL inválido");
define("WORDING_FILL_KEYWORD","Preencha palavra-chave");
define("WORDING_URL","URL");
define("WORDING_KEYWORD","Palavra-chave");
define("WORDING_CREATE_OA","Criar Objeto de Aprendizagem");
define("WORDING_REGISTER_OA","Cadastrar Objeto de Aprendizagem");
define("WORDING_OA_ALREADY_EXISTS","OA já cadastrado");

//Cadastro de Competências Mensagens
define("WORDING_REGISTER_NOVA_COMPETENCIA", "Cadastrar Competência");
define("WORDING_COMPETENCIA", "Competência ");
define("WORDING_CHA", "CHA ");
define("WORDING_CREATE_COMPETENCA", "Criar Nova Competência");
define("WORDING_ASSOCIATE_OA", "Associar OAS para nova competência");
define("WORDING_ASSOCIATE_COMP", "Associar à disciplina as competências que serão abordadas por ela.");
define("WORDING_ASSOCIATE_COMP_OA", "Associar uma ou mais competências abordadas por este objeto de aprendizagem.");
define("WORDING_ASSOCIATE_OA_COMP", "Associar um ou mais objetos de aprendizagem que apóiem o desenvolvimento desta nova competência.");
define("WORDING_ASSOCIATE_COMP_EDIT", "Editar competências");
define("MESSAGE_NAME_EMPTY", "Nome vazio");
define("MESSAGE_DESCRICAO_EMPTY", "Descrição vazia");
define("MESSAGE_DESCRICAO_HABILIDADE_EMPTY", "Descrição da habilidade vazia");
define("MESSAGE_DESCRICAO_CONHECIMENTO_EMPTY", "Descrição do conhecimento vazio");
define("MESSAGE_DESCRICAO_ATITUDE_EMPTY", "Descrição da atitude vazia");
define("MESSAGE_NAME_TOO_SHORT", "Nome muito pequeno");
define("MESSAGE_COMPETENCIA_ALREADY_EXISTS", "A seguinte competência já existe: ");
define("WORDING_COMPETENCIA_DESCRICAO", "Descrição da Competência");
define("WORDING_ATITUDE_DESCRICAO", "Lista das Atitudes");
define("WORDING_HABILIDADE_DESCRICAO", "Lista das Habilidades");
define("WORDING_CONHECIMENTO_DESCRICAO", "Lista dos Conhecimentos");
define("WORDING_CLEAN", "Limpar");
define("MESSAGE_OAS_EMPTY", "Nenhum OA selecionado");
define("MESSAGE_INVALID_CHA", "CHA inválido!");
define("WORDING_OA_CHA", "CHA do OA");

//Sidebar
define("WORDING_ACTIVE_COURSES", "Minhas atividades de ensino ativas");
define("WORDING_CLOSED_COURSES", "Minhas atividades de ensino encerradas");
define("WORDING_MY_COURSES", "Minhas atividades de ensino");
define("WORDING_MY_PROFILE", "Meu perfil");

//Hints dos metadados dos OAS
//Categoria Geral 
define("HINT_NAME", "Nome do objeto"); 
define("HINT_IDIOMA", "Idioma do objeto"); 
define("HINT_DESCRIPTION", "Descrição textual do conteúdo do objeto"); 
define("HINT_KNOWLEDGE_AREA", "Área de conhecimento em que o Objeto de Aprendizagem se enquadra"); 
define("HINT_KEYWORD", "Palavras principais ou termos que remetem ao conteúdo abordado pelo OA."); 

//Categoria ciclo de vida
define("HINT_VERSION", "A versão/edição do objeto");
define("HINT_STATUS", "Estado atual do objeto");
define("HINT_CONTRIBUTION", "");
define("HINT_ENTITY", "Pessoas e/ou organizações que contribuiram na evolução do objeto");
define("HINT_DATA", "No caso de não haver informação sobre  o ano de elaboração do objeto de aprendizagem pode ser informado  o ano de acesso.");

//Categoria Técnica
define("HINT_FORMAT", "Formato de todos os componentes do objeto (MIME types), este atributo pode ser usado para identificar o programa necessário para acessar o objeto");
define("HINT_SIZE", "Tamanho do objeto em Megabytes");
define("HINT_LOCATION", "");
define("HINT_TECHONOLOGY_TYPE", "");
define("HINT_TECHONOLOGY_NAME", "");
define("HINT_DURATION", "Tempo de duração (utilizado para sons, vídeos, animações)");

//Categoria Educacional
define("HINT_EDUCACIONAL_DESCRIPTION", "Possíveis formas de uso pedagógico deste Objeto de Aprendizagem.");
define("HINT_INTERACTIVITY_TYPE", "Qual modo de aprendizagem é possibilitado a partir da interatividade usuário-OA.");
define("HINT_INTERACTIVITY_NIVEL", "O nível de comunicação deste OA com o usuário.");
define("HINT_FINAL_USER", "Tipo de usuário para o qual foi desenvolvido o objeto");

//Categoria Direito
define("HINT_COST", "Se a utilização do objeto requer pagamento");
define("HINT_AUTHORAL_LEGAL", "se há restrições de direito autoral para o uso do objeto");
define("HINT_USE", "comentários sobre as condições de uso do objeto");

//Competência
define("HINT_COMPETENCY", "Este metadado define os tipos de competências que um objeto de aprendizagem tem potencial para desenvolver através do conteúdo e atividades propostas neste recurso. Parte-se da definição que competência é formada por conhecimentos, habilidades e atitudes (CHA) aplicada em um determinado contexto com o objetivo de resolver problemas ou lidar com novidades e imprevistos");

//Textos de ajuda CHA
define("TEXT_CHA", "Indicar um valor de 0 a 5");
define("HINT_CHA", "Indicar um valor de 0 a 4, que expresse o quanto você considera possuir desenvolvido os conhecimentos, habilidades e atitudes de cada competência abordada por esta disciplina:");
define("HINT_CHA_OA", "Indicar um valor de 0 a 4, que expresse o quanto este objeto de aprendizagem  apóia o desenvolvimento dos conhecimentos, habilidades e atitudes de cada competência abordada por esta disciplina:");
define("HINT_CHA_DISCI", "Indicar um valor de 0 a 4, que expresse o quanto esta atividade de ensino apóia o desenvolvimento dos conhecimentos, habilidades e atitudes de cada  competência vinculada:");
define("HINT_CHA_0", "0. Não desenvolvi");
define("HINT_CHA_1", "1. Desenvolvi em nível inicial");
define("HINT_CHA_2", "2. Desenvolvi em nível básico");
define("HINT_CHA_3", "3. Desenvolvi em nível intermediário");
define("HINT_CHA_4", "4. Desenvolvi em nível avançado");
define("HINT_CHA_0_DISCI", "0. Não aborda");
define("HINT_CHA_1_DISCI", "1. Aborda em nível inicial");
define("HINT_CHA_2_DISCI", "2. Aborda em nível básico");
define("HINT_CHA_3_DISCI", "3. Aborda em nível intermediário");
define("HINT_CHA_4_DISCI", "4. Aborda em nível avançado");