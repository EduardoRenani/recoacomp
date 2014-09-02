<?php
/*
 * Created by Delton & Clauser
 * Date: 28/08/14
 * Time: 14:40
 */


require_once("../Classes/funcoes_aux.php");
require_once("../Classes/conexao.php");
require_once("../cfg.php");
require_once("bd.class.php");

if(class_exists('Usuario') != true){
    class Usuario {

        // DADOS DA TABELA USUARIO
        private $id;
        private $nome;
        private $email;
        private $pass;

        function __construct(){
            $id=-1;
            $nome='';
            $email='';
            $pass='';
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

        //Cria usuário no BD
        function criaUsuario($nome,$email,$senha,$senha2){

            if( validEmail($email) && validFullName($nome) ){ // As funções validEmail e validFullName estão definidas no arquivo email.php na pasta Email
                if($senha == $senha2){

                    // as próximas 3 linhas são responsáveis em se conectar com o banco de dados.
                    $con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
                    $select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED");
                    $senha = $this->criptografar($senha);
                    //$result = mysql_query ("INSERT INTO usuario (Name, Email, Password) VALUES (\"".$nome."\", \"".$email."\", \"".$senha."\")"); -- Metodo Antigo
                    $result = mysql_query ("INSERT INTO usuario (nome, email, senha) VALUES (\"".$nome."\", \"".$email."\", \"".$senha."\")");
					echo "Senha Cripto: ".$senha;
                    mysql_close($con);
                    $this->nome = $nome;
                    $this->email = $email;
                    $this->setPass($senha);
                    $this->id = $this->getID_byBD();


                    if($result != false){
                        echo "Usuario cadastrado com sucesso!";
                        $this->logaSession();
                    }
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

            //TODO
            // as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
            $con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
            $select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED.");
            //Carrega primeiro formulário
            $result = mysql_fetch_array (mysql_query("SELECT (Name, Email,Password) FROM usuario WHERE (ID = \"".$id."\")"));
            $this->nome = $result[0];
            $this->email = $result[1];
            $this->pass = $result[2];

            mysql_close($con);

            //FAZ LOGIN
            $this->logaSession();
        }

        private function logaSession(){
            // session_start inicia a sessão
            session_start();

            $_SESSION["usuario"] = serialize($this);
            $_SESSION['dt_hora_logon'] = date('d/m/y h:i:s');

        }

        public static function isLogado(){
            if(!isset( $_SESSION["usuario"])){
                unset($_SESSION["usuario"]);
                $logado = false;
            }else{
                $logado = true;
            }
            return $logado;
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

            $result = mysql_fetch_array (mysql_query("SELECT ID FROM usuario WHERE (nome = \"".$this->nome."\" AND email = \"".$this->email."\")"));

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

            $result = mysql_fetch_array (mysql_query("SELECT senha FROM usuario WHERE (email = \"".$email."\")"));

            if(count($result) <= 0)
                return false;

            mysql_close($con);

            return $result[0];

        }

        public function cadastraSegundoQuestionario($id,$vetor){
            /*
            $vetor[0] = $_POST['tutoria'];
            $vetor[1] = $_POST['ava'];
            $vetor[2] = $_POST['capacitacaoAVA'];
            $vetor[3] = $_POST['conhecimentoOA'];
            $vetor[4] = $_POST['ead'];
            $vetor[5] = $_POST['infoEdu'];
            $vetor[6] = $_POST['temaCompetencia'];
            $vetor[7] = $_POST['monitoria'];
            */

            $con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
            $select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED.");
            /*, Email=\"".$this->email."\"*/
            echo $vetor[1];
            echo "UPDATE usuario SET (tutoria=\"".$vetor[0]."\", ava=\"".$vetor[1]."\", capacitacaoAVA=\"".$vetor[2]."\", conhecimentoOA=\"".$vetor[3]."\", ead=\"".$vetor[4]."\", infoEdu=\"".$vetor[5]."\", temaCompetencia=\"".$vetor[6]."\", monitoria=\"".$vetor[7]."\") WHERE ID=\"".$id."\";";
            $result = mysql_query("UPDATE usuario SET (tutoria=\"".$vetor[0]."\", ava=\"".$vetor[1]."\", capacitacaoAVA=\"".$vetor[2]."\", conhecimentoOA=\"".$vetor[3]."\", ead=\"".$vetor[4]."\", infoEdu=\"".$vetor[5]."\", temaCompetencia=\"".$vetor[6]."\", monitoria=\"".$vetor[7]."\") WHERE ID=\"".$id."\";");

            mysql_close($con);

        }

    }

}
/*
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
	*//*

}

}*/