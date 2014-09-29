<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 04/09/14
 * Time: 14:50
 */

require_once('config/config.cfg');
require_once('classes/funcoes_aux.php');
require_once('classes/Login.php');
require_once('translations/pt_br.php');

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
     * @var array de IDs de competências. Esses ids são referentes à tabela 'competencia' do banco de dados.
     */
    private  $idCompetencias           = array();
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
     * @var Array $arrayCompetencias Array com competências
     */
    private $arrayCompetencias = "";
    private $arrayCompetenciasBD = "";
    private $ultimo_ID = "";
    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$criarDisciplina = new CriarDisciplina();"
     */
    public function __construct() // Essa construct tá certa, seguir modelo
    {
        if (isset($_POST["registrar_nova_disciplina"])) {
            // Função para cadastro de nova disciplina
            $this->criaDisc($_POST['nomeCurso'],$_POST['nomeDisciplina'],$_POST['descricao'], $_POST['user_id'], $_POST['senha'], $_POST['arrayCompetencias']);
        }
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
     * Administra toda o sistema de Criação de disciplina
     * Verifica todos os erros possíveis e cria a disciplina se ela não existe
     */
//$array_competencias
    public function criaDisc($nomeCurso, $nomeDisciplina, $descricao, $usuarioProfessorID, $senha, $arrayCompetencias){
       // Remove espaços em branco em excesso das strings
        $nomeCurso  = trim($nomeCurso);
        $nomeDisciplina = trim($nomeDisciplina);
        $descricao = trim($descricao);
        $senha = trim($senha);
        $arrayCompetencias = explode(',',$arrayCompetencias);


        $this->nomeCurso  = $nomeCurso;
        $this->nomeDisciplina = $nomeDisciplina;
        $this->descricao = $descricao;
        $this->senha = $senha;
        $this->arrayCompetencias = $arrayCompetencias;

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
            $query_check_nome_disciplina = $this->db_connection->prepare('SELECT nomedisciplina FROM disciplina WHERE nomedisciplina=:nomeDisciplina');
            $query_check_nome_disciplina->bindValue(':nomeDisciplina', $nomeDisciplina, PDO::PARAM_STR);
            $query_check_nome_disciplina->execute();
            $result = $query_check_nome_disciplina->fetchAll();
                // Se o nome da disciplina for encontrado no banco de dados
                if (count($result) > 0) {
                    for ($i = 0; $i < count($result); $i++) {
                        $this->errors[] = MESSAGE_DISCIPLINA_ALREADY_EXISTS . $nomeDisciplina;
                    }
                } else{
                    // Cadastro na tabela Disciplina
                    $stmt = $this->db_connection->prepare("INSERT INTO disciplina(nomeCurso, nomeDisciplina, descricao, usuarioProfessorID, senha)  VALUES(:nomeCurso, :nomeDisciplina, :descricao, :usuarioProfessorID, :senha)");
                    $stmt->bindParam(':nomeCurso',$nomeCurso, PDO::PARAM_STR);
                    $stmt->bindParam(':nomeDisciplina',$nomeDisciplina, PDO::PARAM_STR);
                    $stmt->bindParam(':descricao',$descricao, PDO::PARAM_STR);
                    $stmt->bindParam(':usuarioProfessorID',$usuarioProfessorID, PDO::PARAM_INT);
                    $stmt->bindParam(':senha',$senha, PDO::PARAM_STR);
                    $stmt->execute();
                    $ultimo_ID = $this->db_connection->lastInsertId();
                    $this->$ultimo_ID = $ultimo_ID;
                    // Cadastro na tabela Disciplina_Competencia
                    //Associação com o banco de dados
                    $count = count($arrayCompetencias);
                    for ($i = 0; $i < $count; $i++) {
                        $arrayCompetenciasBD = $arrayCompetencias[$i];
                        $this->arrayCompetenciasBD = $arrayCompetenciasBD;
                        $stmt = $this->db_connection->prepare("INSERT INTO disciplina_competencia(disciplina_iddisciplina, competencia_idcompetencia) VALUES (:ultimo_ID, :arrayCompetenciasBD)");
                        $stmt->bindParam(':ultimo_ID',$ultimo_ID, PDO::PARAM_INT);
                        $stmt->bindParam(':arrayCompetenciasBD',$arrayCompetenciasBD, PDO::PARAM_INT);
                        $stmt->execute();
                    }
                    $this->messages[] = WORDING_DISCIPLINA. $nomeDisciplina .WORDING_CREATED_SUCESSFULLY;
                 }
        }
    }

    public function getID_byBD($nomeDisciplina = null,$nomeCurso = null){
        if($nomeDisciplina == null || $nomeCurso == null){
            $nomeDisciplina = $this->nomeDisciplina;
            $nomeCurso = $this->nomeCurso;
        }

        $query_get_id_disciplina = $this->db_connection->prepare('SELECT iddisciplina FROM disciplina WHERE nomedisciplina=:nomeDisciplina AND nomecurso=:nomeCurso');
        $query_get_id_disciplina->bindValue(':nomedisciplina', $nomeDisciplina, PDO::PARAM_STR);
        $query_get_id_disciplina->bindValue(':nomecurso', $nomeCurso, PDO::PARAM_STR);
        $query_get_id_disciplina->execute(array(":nomeDisciplina" => $nomeDisciplina,":nomeCurso" => $nomeCurso ));
        $result = $query_get_id_disciplina->fetchAll();
        if(count($result)>0)
            return $result[0];
        else
            return 0;

    }
    /*
     * Recebe o ID da competência, se ela ainda não tiver sido relacionada para essa disciplina é relacionada utilizando a tabela
     * disciplina_completencia do banco de dados.
     * @return true se a associação funcionou e false se não.
     */
    public function associaCompetencia($idCompetencia){
        if($this->iddisciplina == 0)
            $this->iddisciplina = $this->getID_byBD();
        //Validação de Competência
        if($idCompetencia <= 0){
            $this->errors[] = MESSAGE_COMPETENCIA_DOESNT_EXIST;
        //Validação da disciplina sendo editada
        }else if($this->iddisciplina <= 0){
            $this->errors[] = MESSAGE_DISCIPLINA_DOESNT_EXIST;
        }else{

            //Checa se já existe a relação entre essa disciplina e essa competência, para evitar de duplicar o relacionamento.
            $existeRelacao = false;
            $query_check_disc_comp = $this->db_connection->prepare('SELECT disciplina_iddisciplina FROM disciplina_competencia WHERE disciplina_iddisciplina=:idDisciplina AND competencia_idcompetencia=:idComp');
            $query_check_disc_comp->bindValue(':idDisciplina', (int)$this->iddisciplina["iddisciplina"], PDO::PARAM_INT);
            $query_check_disc_comp->bindValue(':idComp', (int)$idCompetencia, PDO::PARAM_INT);
            $query_check_disc_comp->execute(array(':idDisciplina' => (int)$this->iddisciplina["iddisciplina"],':idComp' => (int)$idCompetencia));
            $result = $query_check_disc_comp->fetchAll();

            var_dump($this->iddisciplina);
            var_dump($idCompetencia);
            var_dump($result);
            /*
            if(count($result["disciplina_iddisciplina"])!=0){
                $existeRelacao = true;
                $this->errors[] = MESSAGE_DISCIPLINA_COMPETENCIA_ALREADY_RELATED;
            }*/

           if( (! $existeRelacao) /*&& (count($this->errors) == 0)*/ ){
                //Associar a competência com a disciplina pelo ID

                $stmt = $this->db_connection->prepare("INSERT INTO disciplina_competencia(disciplina_iddisciplina,competencia_idcompetencia)  VALUES(:idDisc,:idComp )");
                $stmt->bindParam(':idDisc',(int)$this->iddisciplina["iddisciplina"], PDO::PARAM_INT);
                $stmt->bindParam(':idComp',(int)$idCompetencia, PDO::PARAM_INT);
                $stmt->execute(array(":idDisc" => (int)$this->iddisciplina["iddisciplina"],":idComp" => (int)$idCompetencia));
                return true;
            }else{
                return false;
            }
        }
    }
    public function getErrors(){
        return $this->errors;
    }
}
?>