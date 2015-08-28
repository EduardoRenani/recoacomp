<?php
/*
 * Created by Delton & Clauser
 * Date: 28/08/14
 * Time: 14:40
 * Classe Registrar
 * Controla o registro dos usuarios
 */

class Registrar{
    /**
     * @var objeto $conexao_db Conexao com o banco de dados
     */
    private $db_conexao = null;
    /**
     * @var bool registro_sucedido estado do registro
     */
    public $registro_sucedido;
    /**
     * @var bool verificacao_sucedida estado da verificacao
     */
    public $verificacao_sucedida;
    /**
     * @var array $erros Coleta de mensagens de erro
     */
    public $erros = array();
    /**
     * @var array $mensagens Coleta de mensagens do sistema
     */
    public $mensagens = array();

    /**
     * Funcção "_construct()" automaticamente starta quando uma classe desse objeto é criada.
     * ex: $login = new Login();
     */

    /**
     * Checagem da conexao com o banco de dados
     * Retorna true caso conexao já está aberta, falso caso contrario
     */
    private function conexaoBancoDeDados(){
        if ($this->db_conexao != null){
            return true;
        } else {
            try {
                $this->db_conexao = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            } catch (PDOException $e) {
                $this->erros[] = MESSAGE_DATABASE_ERROR;
                return false;
            }
        }
    }
    /**
     * Controla o processo de registro e verifica os erros possiveis
     * e cria o usuario no banco de dados se tudo estiver correto
     * @param string nome_usuario Contem o nome do usuario a ser registrado
     * @param string senha_usuario Contem a senha do novo usuario
     * @param string senha_usuario_rep Contem a senha repetida (para verificação)
     * @param string captcha Contem o captcha para possiveis ataques ao sistema
     * OBS: Mensagens em português para futuras traduções
     * OBS[2]: Está sendo usado o método PDO invés de MYSQLI para conexão ao BD
     */
    private function registrarNovoUsuario($nome_usuario, $email_usuario, $senha_usuario, $senha_usuario_rep, $captcha){
        // Remoção de espaços desnecessários
        $nome_usuario = trim($nome_usuario);
        $email_usuario = trim($email_usuario);
        $acesso = 1; // Tipo de acesso para usuario comum [TO'DO NOVO USUARIO É COMUM]

        if (strtolower($captcha) != strtolower($_SESSION['captcha'])) { // Validações gerais
            $this->erros[] = MESSAGE_CAPTCHA_WRONG;
        } elseif (empty($nome_usuario)) {
            $this->erros[] = MESSAGE_USERNAME_EMPTY;
        } elseif (empty($senha_usuario) || empty($senha_usuario_rep)) {
            $this->erros[] = MESSAGE_PASSWORD_EMPTY;
        } elseif ($senha_usuario !== $senha_usuario_rep) {
            $this->erros[] = MESSAGE_PASSWORD_BAD_CONFIRM;
        } elseif (strlen($senha_usuario) < 6) {
            $this->erros[] = MESSAGE_PASSWORD_TOO_SHORT;
        } elseif (strlen($nome_usuario) > 64 || strlen($nome_usuario) < 2) {
            $this->erros[] = MESSAGE_USERNAME_BAD_LENGTH;
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $nome_usuario)) { //  PaRa 3v1tar OrkUt1sses.
            $this->erros[] = MESSAGE_USERNAME_INVALID;
        } elseif (empty($email_usuario)) {
            $this->erros[] = MESSAGE_EMAIL_EMPTY;
        } elseif (strlen($email_usuario) > 64) {
            $this->erros[] = MESSAGE_EMAIL_TOO_LONG;
        } elseif (!filter_var($email_usuario, FILTER_VALIDATE_EMAIL)) {
            $this->erros[] = MESSAGE_EMAIL_INVALID;
        } else if ($this->conexaoBancoDeDados()) { // Verificar se usuario ja está cadastrado
            $query_check_nome_usuario = $this->db_conexao->prepare('SELECT nome, email FROM usuarios WHERE nome=:nome_usuario OR email=:email_usuario');
            //Bindar variáveis para questões de segurança
            $query_check_nome_usuario->bindValue(':nome_usuario', $nome_usuario, PDO::PARAM_STR);
            $query_check_nome_usuario->bindValue(':email_usuario', $email_usuario, PDO::PARAM_STR);
            $query_check_nome_usuario->execute();
            $result = $query_check_nome_usuario->fetchAll();

            //Verifica se o usuario está no banco de dados
            if (count($result) > 0) {
                for ($i = 0; $i < count($result); $i++){
                    $this->erros[] = ($result[$i]['nome'] == $nome_usuario) ? MESSAGE_USERNAME_EXISTS : MESSAGE_EMAIL_ALREADY_EXISTS;
                }
            } else {
                // Processo de encriptação via HASH
                // Verifica em qual expoente está a quantidade de valores possiveis no config.cfg
                $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
                $user_password_hash = password_hash($senha_usuario, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
                //Gerador de hash randômico para verificação de email
                $user_activation_hash = sha1(uniqid(mt_rand(), true));

                // Insere novos usuarios no banco de dados [FINALMENTE NÉ?]
                $query_new_user_insert = $this->db_conexao->prepare('INSERT INTO usuarios (nome, senha, email, hash_ativacao, ip_registro, data_registro, acesso) VALUES(:nome_usuario, :senha_usuario, :email_usuairo, :user_activation_hash, :user_registration_ip, now(), :acesso)');
                $query_new_user_insert->bindValue(':nome', $nome_usuario, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':senha', $user_password_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':email', $email_usuario, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':hash_ativacao', $user_activation_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_registration_ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':acesso', $acesso, PDO::PARAM_STR);
                $query_new_user_insert->execute();

                // ID do novo usuario
                $user_id = $this->db_conexao->lastInsertId();

                // Email de verificação
                if ($query_new_user_insert) {
                    if($this->sendVerificationEmail($user_id, $email_usuario,$user_activation_hash)) {
                        $this->mensagens[] = MESSAGE_VERIFICATION_MAIL_SENT;
                        $this->registro_sucedido = true;
                    } else {
                        //Deleta a conta do usuario se o email nao for enviado
                        $query_delete_user = $this->db_conexao->prepare('DELETE FROM usuarios WHERE idusuario=:user_id');
                        $query_delete_user->bindValue(':idusuario', $user_id, PDO::PARAM_INT);
                        $query_delete_user->execute();

                        $this->erros[] = MESSAGE_VERIFICATION_MAIL_ERROR;
                    }
                } else {
                    $this->erros[] = MESSAGE_REGISTRATION_FAILED;
                }
            }
        }
    }


}

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

                    /*

                    // as próximas 3 linhas são responsáveis em se conectar com o banco de dados.
                    $con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
                    $select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED");
                    $senha = $this->criptografar($senha);
                    //$result = mysql_query ("INSERT INTO usuario (Name, Email, Password) VALUES (\"".$nome."\", \"".$email."\", \"".$senha."\")"); -- Metodo Antigo
                    $result = mysql_query ("INSERT INTO usuario (nome, email, senha) VALUES (\"".$nome."\", \"".$email."\", \"".$senha."\")");

                    */
                    $senha = $this->criptografar($senha);
                    $sql = new bd();
                    $sql->connect();
                    $result = $sql->execQuery("INSERT INTO usuario (nome, email, senha) VALUES (\"".$nome."\", \"".$email."\", \"".$senha."\")");
                    $sql->disconnect();

					echo "Senha Cripto: ".$senha;
                    //mysql_close($con);
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
            if($senha == crypt($senha,$this->pass) ){
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
/*
            // as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
            $con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
            $select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED.");

            $result = mysql_fetch_array (mysql_query("SELECT ID FROM usuario WHERE (nome = \"".$this->nome."\" AND email = \"".$this->email."\")"));
*/
            $con = new bd();
            $con->connect();
            $result = $con->execQuery("SELECT ID FROM usuario WHERE (nome = \"".$this->nome."\" AND email = \"".$this->email."\")");
            $result = mysql_fetch_array ($result);
            $con->disconnect();

            //mysql_close($con);

            return $result[0];

        }
        //Retorna o ID do usuário baseado no email do mesmo através do banco de dados.
        public function getID_byEmail($email){

            // as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
            $con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
            $select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED.");

            $senha = $this->criptografar($this->senha);

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