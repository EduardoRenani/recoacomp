<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 04/09/14
 * Time: 14:50
 */

require_once('../config/config.cfg');
require_once('../translations/pt_br.php');
require_once('../classes/funcoes_aux.php');

class Disciplina {
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection            = null;
    /**
     * @var bool estado do sucesso do registro de nova disciplina
     */
    public  $registration_successful  = false;
    /**
     * @var array collection of error messages
     */
    public  $errors                   = array();
    /**
     * @var array collection of success / neutral messages
     */
    public  $messages                 = array();
    /**
     * @var int $iddisciplina ID da disciplina
     */
    private $iddisciplina = null;
    /**
     * @var string $nomeCurso nome do curso
     */
    private $nomeCurso = "";
    /**
     * @var string $nomeDisciplina nome da disciplina
     */
    private $nomeDisciplina = "";
    /**
     * @var string $descricao descrição da disciplina
     */
    private $descricao = null;
    /**
     * @var int $usuarioProfessorID ID do criador (professor)
     */
    private $usuarioProfessorID = null;
    /**
     * @var string $senha senha para entrar na disciplina
     */
    private $senha = null;
    /**
     * @var boolean $user_is_logged_in The user's login status
     */
    private $user_is_logged_in = false;
    /**
    private $nomeCurso;
    private $nomeDisciplina;
    private $descricao;
    private $usuarioProfessorID;
    private $senha;

    private $db_connection = null;

   public function __construct()
    {
        session_start();
        if (!empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1) && ($_SESSION['acesso'] == 2)) { //  Se o usuario estiver efetivamente logado e for professor
               $this->loginWithSessionData();
        // if we have such a POST request, call the registerNewUser() method
        if (isset($_POST["acesso"])) {
            $this->registerNewUser($_POST['user_name'], $_POST['user_email'], $_POST['user_password_new'], $_POST['user_password_repeat'], $_POST["captcha"]);
            // if we have such a GET request, call the verifyNewUser() method
        } else if (isset($_GET["id"]) && isset($_GET["verification_code"])) {
            $this->verifyNewUser($_GET["id"], $_GET["verification_code"]);
        }
    }
     **/

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$criarDisciplina = new CriarDisciplina();"
     */

    function __construct(){
        //$this->nomeCurso = $this->nomeDisciplina = $this->descricao = $this->senha = '';
        //$this->usuarioProfessorID = 0;
    }


    // GETTERS E SETTERS

    /**
     * @param null $db_connection
     */
    public function setDbConnection($db_connection)
    {
        $this->db_connection = $db_connection;
    }

    /**
     * @return null
     */
    public function getDbConnection()
    {
        return $this->db_connection;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $nomeCurso
     */
    public function setNomeCurso($nomeCurso)
    {
        $this->nomeCurso = $nomeCurso;
    }

    /**
     * @return string
     */
    public function getNomeCurso()
    {
        return $this->nomeCurso;
    }

    /**
     * @param string $nomeDisciplina
     */
    public function setNomeDisciplina($nomeDisciplina)
    {
        $this->nomeDisciplina = $nomeDisciplina;
    }

    /**
     * @return string
     */
    public function getNomeDisciplina()
    {
        return $this->nomeDisciplina;
    }

    /**
     * @param int $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return int
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param int $usuarioProfessorID
     */
    public function setUsuarioProfessorID($usuarioProfessorID)
    {
        $this->usuarioProfessorID = $usuarioProfessorID;
    }

    /**
     * @return int
     */
    public function getUsuarioProfessorID()
    {
        return $this->usuarioProfessorID;
    }


    /**
     * Checks if database connection is opened and open it if not
     */
    private function databaseConnection(){
        // connection already opened
        if ($this->db_connection != null) {
            return true;

        } else {
            // create a database connection, using the constants from config/config.php
            try {
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
                // If an error is catched, database connection failed
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR;
                print_r($this);
                return false;

            }
        }
    }

    /**
     * Admnistra toda o sistema de Criação de disciplina
     * Verifica todos os erros possíveis e cria a disciplina se ela não existe
     */

    public function criaDisc($nomeCurso, $nomeDisciplina, $descricao, $usuarioProfessorID, $senha){
       // Remove espaços em branco em excesso das strings
        $nomeCurso  = trim($nomeCurso);
        $nomeDisciplina = trim($nomeDisciplina);
        $descricao = trim($descricao);
        $senha = trim($senha);

        //Validação de dados
        if (empty($nomeCurso)) {
            $this->errors[] = MESSAGE_USERNAME_EMPTY;
        } elseif (empty($nomeDisciplina)){
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;
        } elseif (empty($descricao)){
            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;
        } elseif (empty($senha)){
            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;
        } elseif (strlen($senha) < 6) {
            $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;
        } elseif (strlen($nomeCurso) > 64 || strlen($nomeDisciplina) < 2) {
            $this->errors[] = MESSAGE_USERNAME_BAD_LENGTH;
        } elseif (strlen($nomeCurso) > 64 || strlen($nomeCurso) < 2) {
            $this->errors[] = MESSAGE_USERNAME_BAD_LENGTH;
            //Fim de validações de dados de entrada
        //Inicio das validações de cadastro repitido
        } else if ($this->databaseConnection()) {
            // Verifica se a disciplina já existe ou curso já existe
            $query_check_nome_disciplina = $this->db_connection->prepare('SELECT nomedisciplina, nomecurso FROM disciplina WHERE nomedisciplina=:nomeDisciplina OR nomecurso=:nomeCurso');
            $query_check_nome_disciplina->bindValue(':nomedisciplina', $nomeDisciplina, PDO::PARAM_STR);
            $query_check_nome_disciplina->bindValue(':nomecurso', $nomeCurso, PDO::PARAM_STR);
            $query_check_nome_disciplina->execute();
            $result = $query_check_nome_disciplina->fetchAll();
                // Se o nome da disciplina for encontrado no banco de dados
                if (count($result) > 0) {
                    for ($i = 0; $i < count($result); $i++) {
                        $this->errors[] = ($result[$i]['nomedisciplina'] == $nomeDisciplina) ? MESSAGE_DISCIPLINA_ALREADY_EXISTS : MESSAGE_EMAIL_ALREADY_EXISTS;
                    }
                } else{

                    $stmt = $this->db_connection->prepare("INSERT INTO disciplina(nomeCurso, nomeDisciplina, descricao, usuarioProfessorID, senha)  VALUES(:nomeCurso, :nomeDisciplina, :descricao, :usuarioProfessorID, :senha)");
                    $stmt->bindParam(':nomeCurso',$nomeCurso, PDO::PARAM_STR);
                    $stmt->bindParam(':nomeDisciplina',$nomeDisciplina, PDO::PARAM_STR);
                    $stmt->bindParam(':descricao',$descricao, PDO::PARAM_STR);
                    $stmt->bindParam(':usuarioProfessorID',$usuarioProfessorID, PDO::PARAM_INT);
                    $stmt->bindParam(':senha',$senha, PDO::PARAM_STR);
                    $stmt->execute();
                 }
        }
    }

}

$coco= new Disciplina();
/**
$coco->setDescricao("desc");
$coco->setNomeCurso("nome");
$coco->setNomeDisciplina("someo");
$coco->setSenha("ásdofiu");
$coco->setUsuarioProfessorID(12);
**/
$coco->criaDisc('oioi','nladj','ddesc',12,'ssaee');

?>