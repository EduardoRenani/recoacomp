<?php
/**
 * Created by Delton
 * Date: 28/08/14
 * Time: 14:55
 */
mb_internal_encoding('UTF-8');


	/*================================================
		Sessao at� o presente momento
	================================================
					$_SESSION['SS_usuario_id']
					$_SESSION['SS_usuario_nome']
					$_SESSION['SS_usuario_login']
					$_SESSION['SS_usuario_email']
					$_SESSION['SS_personagem_id']
					$_SESSION['SS_terreno_id']
					$_SESSION['SS_link_pai'] (cont�m o link da p�gina que chamou a aplica��o externa)
					$_SESSION['SS_nivel_ultimo']
					S_SESSION['SS_turmas'] (Array)
	================================================
	Obs.: N�o temos observa��es a serem feitas
	==============================================*/

$email_administrador = "";

$BD_host1 = "";
$BD_base1 = "";
$BD_user1 = "";
$BD_pass1 = "";

//Servidor utilizado no momento
$linkServidor = "http://143.54.95.109/Clauser";

$upload_max_filesize = ini_get('upload_max_filesize');

//constantes -- A definir
define("NL","<BR />\n");	//constante nova linha
/*
define("TIPOBLOG",1);
define("TIPOPORTFOLIO",2);
define("TIPOBIBLIOTECA",3);
define("TIPOPERGUNTA",4);
define("TIPOAULA",5);
define("TIPOCOMUNICADOR",6);
define("TIPOFORUM",7);
define("TIPOARTE",8);
define("TIPOPLAYER",10);
*/

//tipos de planetas - a ordem eh importante - na arvore de planetas, os tipos deles sao crescentes na ordem da raiz para as folhas - planeta-pai nunca pode ter tipo menor ou igual ao do filho
	define("PLANETARAIZ",0);
	define("PLANETASERIE",1);
	define("PLANETATURMA",2);
	define("PLANETADISCIPLINA",3);
	define("PLANETAALUNO",4);
	define("NUMTIPOSPLANETAS",4); //numero de tipos de planetas --- se se aumentar o numero de tipos de planetas aumentar essa variavel tambem

$debug = true;	// n�o sei se isso � usado


//nome tabelas

$tabela_avaliado                = 'avaliado';
$tabela_categoria_direito       = 'categoria_direito';
$tabela_categoria_educacional   = 'categoria_educacional';
$tabela_categoria_tecnica       = 'categoria_tecnica';
$tabela_categoria_vida          = 'categoria_vida';
$tabela_cesta                   = 'cesta';
$tabela_cesta_cha               = 'cesta_cha';
$tabela_competencia             = 'competencia';
$tabela_disciplina              = 'disciplina';
$tabela_disciplina_cha          = 'disciplina_cha';
$tabela_feedback                = 'feedback';
$tabela_participa               = 'participa';
$tabela_questionario            = 'questionario';
$tabela_recomendado             = 'recomendado';
$tabela_usuario                 = 'usuario';
$tabela_usuario_cha             = 'usuario_cha'; // Tabela a ser removida

/*
//antigas informacoes do BD
$email_administrador = "adidasministradorplaneta@gmail.com";

$BD_host1 = "localhost";
$BD_base1 = "planeta2";
$BD_user1 = "root";
$BD_pass1 = "gamma248";

//nome tabelas
$tabela_forum				= "forum";
$tabela_objetos				= "objetos";
$tabela_personagens			= "personagens";
$tabela_terrenos			= "terrenos";
$tabela_grupos				= "grupos";
$tabela_usuarios			= "usuarios";
$tabela_nivel_permissoes	= "nivel_permissoes";
$tabela_posts				= "blogposts";
$tabela_blogs				= "blogblogs";
$tabela_comentarios			= "blogcomentarios";
$tabela_arquivos			= "arquivos";
*/
//Níveis do sistema
$nivelComum			= 1;
$comum				= "comum";
$nivelProfessor 	= 2;
$professor		    = "professor";
$nivelAdmin		    = 3;
$admin			    = "admin";

define("NIVELCOMUM", 1);
define("NIVELPROFESSOR", 2);
define("NIVELADMIN", 3);

//Sistemas Básicos
$sistComum 		    = "Sistema Comum";
$sistComumId 	    = 1;
$sistProfessor 		= "Sistema dos Professor";
$sistProfessorId 	= 2;
$sistAdmin  		= "Sistema dos administradores";
$sistAdminId     	= 3;

error_reporting(E_ALL);

?>
