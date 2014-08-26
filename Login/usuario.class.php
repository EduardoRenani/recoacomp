<?php

require_once("bd.class.php");
include("funcoes_aux.php");

if(class_exists('Usuario') != true){
class Usuario {

	// DADOS DA TABELA USUARIO
	private $id;
	private $nome;
	private $email;
	private $pass;

	// DADOS DO QUESTIONARIO (Um por usuario)
	private $ava;					// (int[0,1])		Conhecimento sobre Ambientes Virtuais de Aprendizagem
	private $capacitacaoAVA;		// (int[0,1]) 		Realizou capacitação sobre Ambientes Virtuais de Aprendizagem
	private $conhecimentoOA;		// (int[0,1]) 		Conhecimento sobre objetos de aprendizagem
	private $ead;					// (int[0,1]) 		Experiência prévia em docência em EAD	
	private $infoEdu;				// (int[0,1])		Experiência em Informática na Educação
	private $monitoria;				// (int[0,1])		Experiência prévia em Monitoria
	private $temaCompetencia;		// (int[0,1])		Conhecimento sobre o Tema de Competências
	private $tutoria;				// (int[0,1])		Experiência prévia em Tutoria
	

	function __construct(){
		$id=-1;
		$nome='';
		$email='';
		$pass='';
	}
	
	//Cria usuário no BD
	function criaUsuario($nome,$email,$senha,$senha2){
	
		if( validEmail($email) && validFullName($nome) ){ // ONDE ESTÃO DEFINIDAS AS FUNÇÕES validEmail e validFullName? 
			if($senha == $senha2){
		
			// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
			$con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
			$select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED");
			$senha = $this->criptografar($senha);
			$result = mysql_query ("INSERT INTO usuario (Name, Email, Password) VALUES (\"".$nome."\", \"".$email."\", \"".$senha."\")");
			mysql_close($con);
			$this->nome = $nome;
			$this->email = $email;
			$this->setPass($senha);
			$this->id = $this->getID_byBD();
			
				if($result != false)
					echo "Usuario cadastrado com sucesso!";
				else
					echo "Ops! Algum erro ocorreu, tente novamente mais tarde!";
					
			}else{
				echo "Senhas não conferem!";
			}

		}else{
			echo "Impossível cadastrar esse usuario. Insira um nome e email valido.";
		}
	}
	//Carrega usuário do BD
	function carregaUsuario($id){
		$this->id = $id;
		// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
		$con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
		$select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED.");
		$result = mysql_fetch_array ($con,mysql_query("SELECT (Name, Email) FROM usuario WHERE (ID = \"".$id."\")"));
		$this->nome = $result[0];
		$this->email = $result[1];
		
		mysql_close($con);
		
												// FAZ LOGIN COM SESSION
		
		// session_start inicia a sessão
		session_start();

		// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
		$con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
		$select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com NUTED");

		// A vriavel $result pega as variaveis $email e $senha, faz uma pesquisa na tabela de usuarios
		$result = mysql_query("SELECT * FROM usuario WHERE Email = \"".$email."\n AND Senha= \"".$senha."\"");
		echo ($result);
		/* Logo abaixo temos um bloco com if e else, verificando se a variável $result foi bem sucedida,
		ou seja se ela estiver encontrado algum registro idêntico o seu valor será igual a 1, se não,
		se não tiver registros seu valor será 0. Dependendo do resultado ele redirecionará para a pagina
		site.php ou retornara para a pagina do formulário inicial para que se possa tentar novamente realizar o email */

		if(mysql_num_rows ($result) != '0' ){
			$_SESSION['email'] = $email;
			$_SESSION['senha'] = $senha;
			header('location:logado.php');
		} else{
			unset ($_SESSION['email']);
			unset ($_SESSION['senha']);
			header('location:login.html');
		}
		
												//FIM DA PARTE QUE FAZ LOGIN COM SESSION
		
	}
	
	//Getters e Setters
	public function getID(){return $this->id;}
	public function getNome(){return $this->nome;}
	public function getEmail(){return $this->email;}
	public function getPass(){return $this->pass;}
	
	public function setName($newName){$this->nome = $newName;}
	public function setEmail($newEmail){$this->email = $newEmail;}
	public function setPass ($newPass){
		$newPass = $this->criptografar($newPass);
		
		if($newPass != null){
			$this->pass = $newPass;
			return true;
		}
		else
			return false;
	}
	
	private function criptografar($password = ' '){
		/*INÍCIO DO CÓDIGO RETIRADO DO PLANETA*/
		
		// tentando blowfish mais recente (PHP >= 5.3.7)
		$salt = "$2y$07$".gen_salt(22);
		$passCompare = $password;
		$password = crypt($password,$salt);
		
																			
		// caso não der certo:
		if (/*!$this->checkPassword($this->pass)*/ $password == $passCompare) {
			// FALLBACK: blowfish antigo (PHP 4)
			$salt = "$2a$07$".gen_salt(22);
			$password = crypt($this->pass, $salt);

			if (/*!$this->checkPassword($this->pass)*/ $password == $passCompare) {
				// FALLBACK: md5 (PHP 4)                                     				      ARRUMAR DEPOIS!
				$salt = "$1$".gen_salt(12);
				$password = crypt($this->pass, $salt);

				if (/*!$this->checkPassword($this->pass)*/ $password == $passCompare) {
					// FALLBACK: md5 unsalted
					$password = md5($this->pass);
				}
			}
		}																	
		
		/*FIM DO CÓDIGO RETIRADO DO PLANETA*/
		
		return $password;
	}
	
	public function verificaSenha($senha){
		if($senha == crypt($senha,$this->senha) ){
			return true;
			
		}
		else	
			return false;
	}
	public function getPassEncrypt($pass,$salva){
		return crypt($pass,$salva);
	}
	
	//Atualiza o usuário no banco de dados usando o ID do mesmo.
	public function updateUser(){
		
		// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
		$con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
		$select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED.");

		$result = mysql_query("UPDATE usuario SET (Name=\"".$this->nome."\", Email=\"".$this->email."\", Password=\"".$this->pass."\") WHERE ID=\"".$this->id."\"");
		
		mysql_close($con);
		
	}
	
	//Retorna o ID do usuário baseado no nome e no email do mesmo através do banco de dados.
	private function getID_byBD(){
	
		// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
		$con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
		$select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED.");

		$result = mysql_fetch_array (mysql_query("SELECT ID FROM usuario WHERE (Name = \"".$this->nome."\" AND Email = \"".$this->email."\")"));
		
		mysql_close($con);
		
		return $result[0];
	
	}
	//Retorna o ID do usuário baseado no email do mesmo através do banco de dados.
	public function getID_byEmail($email){
	
		// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
		$con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
		$select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED.");
		
		$senha = $this->criptografar($senha);

		$result = mysql_fetch_array (mysql_query("SELECT ID FROM usuario WHERE (Email = \"".$email."\")"));
		
		if(count($result) <= 0)
			return false;
		
		mysql_close($con);
		
		return $result[0];
	
	}
	//Retorna o Senha do usuário baseado no email do mesmo através do banco de dados.
	public function getSenha_byEmail($email){
	
		// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
		$con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
		$select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED.");

		$result = mysql_fetch_array (mysql_query("SELECT Password FROM usuario WHERE (Email = \"".$email."\")"));
		
		if(count($result) <= 0)
			return false;
		
		mysql_close($con);
		
		return $result[0];
	
	}
	
}

}

if(class_exists('Usuario_cha') != true){

// EXTENSÃO DA CLASSE USÁRIO PARA O CHA DE SUAS COMPETÊNCIAS (UM USUARIO DEVE TER PELO MENOS UMA COMPETÊNCIA ATÉ N COMPETÊNCIAS)
class Usuario_cha extends Usuario {	
	// Tabela Usuario_Cha
	private $atitude;				// (int)		VALOR DE 1 A 5
	private $conhecimento;			// (int)		VALOR DE 1 A 5
	private $habilidade;			// (int)		VALOR DE 1 A 5
	private $id_usuario;			// (int)		CHAVE ESTRANGEIRA PARA DADOS DO USUARIO
	private $id_competencia			// (int)		ID DA COMPETÊNCIA REFERENCIADA A  ESTE CHA

	/*
	AO IMPLEMENTAR no banco de dados com SQL, usar tipo tinyint para poupar espaço, pois os valores
	desses atributos são naturais que variam dentro do intervalo [0,255] e precisam de só 1 byte para
	serem armazenados
	*/

}	

}




?>