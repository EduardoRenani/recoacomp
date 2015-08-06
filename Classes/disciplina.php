<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 04/09/14
 * Time: 14:50
 */

require_once('config/config.cfg');
require_once('classes/Login.php');
require_once('translations/pt_br.php');
require_once('classes/Database.php');

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
    private $idDisciplina = null;
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

    private $conhecimento = array();
    private $habilidade = array();
    private $atitude = array();
    private $competencias = array();
    
    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$criarDisciplina = new CriarDisciplina();"
     */
    public function __construct() // Essa construct tá certa, seguir modelo
    {
        if (isset($_POST["registrar_nova_disciplina"])) {
            // Função para primeira parte do cadastro de disciplina
            //print_r($_POST);
            $this->criaDisc(
            $_POST['nomeCurso'],
            $_POST['nomeDisciplina'],
            $_POST['descricao'], 
            $_POST['user_id'], 
            $_POST['senha'], 
            $_POST['arrayCompetencias'],
            $_POST['conhecimento'],
            $_POST['habilidade'],
            $_POST['atitude']);
            // Professor cria disciplina e entra nela
        }elseif(isset($_POST["verifica_senha"])){
            if (($this->checkPassword($_POST['senha'], $_POST['idDisciplina']))){
                if(($_POST['okay']) == 'okay'){
                $this->entrarDisciplina(
                $_POST['idUsuario'],
                $_POST['idDisciplina'],
                $_POST['senha'],
                $_POST['conhecimento'],
                $_POST['habilidade'],
                $_POST['atitude'],
                $_POST['competencias']);
                }
            }
            else{
                $_SESSION['cadastro_disciplina_cha'] = true;
                header('location: ' .$_POST['link']);
                /*
                $this->errors[] = MESSAGE_PASSWORD_WRONG;
                */             
            }
        }elseif(isset($_POST["editar_disciplina"])){
            $this->editarDisciplina(            
            $_POST['nomeCurso'],
            $_POST['nomeDisciplina'],
            $_POST['descricao'], 
            $_POST['user_id'], 
            $_POST['senha'], 
            $_POST['arrayCompetencias'],
            $_POST['conhecimento'],
            $_POST['habilidade'],
            $_POST['atitude'],
            $_POST['idDisciplina']);
        }elseif(isset($_POST["editar_nome_disciplina"])){
            $this->editDisciplinaName($_POST['disciplina_name'],$_POST['idDisciplina']);
        }elseif(isset($_POST["editar_nome_curso"])){
            $this->editCursoName($_POST['curso_name'],$_POST['idDisciplina']);
        }elseif(isset($_POST["editar_senha"])){
            $this->editDisciplinaSenha($_POST['senha_antiga'],$_POST['senha_nova'],$_POST['idDisciplina']);
        }elseif(isset($_POST["editar_descricao"])){
            $this->editDisciplinaDescricao($_POST['descricao'],$_POST['idDisciplina']);
        }else{
            return null;
        }
    }

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
    public function criaDisc($nomeCurso, $nomeDisciplina, $descricao, $usuarioProfessorID, $senha, $arrayCompetencias, $conhecimento, $habilidade, $atitude){
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
        }elseif ((max($conhecimento) > 5) || (min($conhecimento) < 0)) {
            $this->errors[] = MESSAGE_INVALID_CHA;
        }elseif ((max($habilidade) > 5) || (min($habilidade) < 0)) {
            $this->errors[] = MESSAGE_INVALID_CHA;
        }elseif ((max($atitude) > 5) || (min($atitude) < 0)) {
            $this->errors[] = MESSAGE_INVALID_CHA;
        }elseif (empty($arrayCompetencias)){
            $this->errors[] = WORDING_NULL_COMPETENCE;

            //Fim de validações de dados de entrada
        //Inicio das validações de cadastro repitido
        } else if ($this->databaseConnection()) {
            // Verifica se a disciplina já existe ou curso já existe
            $query_check_nome_disciplina = $this->db_connection->prepare('SELECT nomedisciplina FROM disciplina WHERE nomedisciplina=:nomeDisciplina');
            $query_check_nome_disciplina->bindValue(':nomeDisciplina', $nomeDisciplina, PDO::PARAM_STR);
            $query_check_nome_disciplina->execute();
            $result = $query_check_nome_disciplina->fetchAll();
                // Se o nome de outra disciplina for encontrado no banco de dados
                if (count($result) > 0) {
                    for ($i = 0; $i < count($result); $i++) {
                        $this->errors[] = MESSAGE_DISCIPLINA_ALREADY_EXISTS . $nomeDisciplina;
                        //echo 'aqui';
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
                    $count = count($arrayCompetencias)-1;
                    for ($i = 0; $i < $count; $i++) {
                        $arrayCompetenciasBD = $arrayCompetencias[$i]; // ID das competências, serialização
                        $this->arrayCompetenciasBD = $arrayCompetenciasBD;
                        $c = $conhecimento[$arrayCompetenciasBD];
                        $h = $habilidade[$arrayCompetenciasBD];
                        $a = $atitude[$arrayCompetenciasBD];
                        // Cadastro dos CHA's das competências da disciplina criada
                        $stmt = $this->db_connection->prepare("INSERT INTO disciplina_competencia(disciplina_iddisciplina, competencia_idcompetencia, conhecimento, habilidade, atitude) VALUES (:ultimo_ID, :arrayCompetenciasBD, :conhecimento, :habilidade, :atitude)");
                        $stmt->bindParam(':ultimo_ID',$ultimo_ID, PDO::PARAM_INT);
                        $stmt->bindParam(':arrayCompetenciasBD',$arrayCompetenciasBD, PDO::PARAM_INT);
                        $stmt->bindParam(':conhecimento',$c, PDO::PARAM_INT);
                        $stmt->bindParam(':habilidade',$h, PDO::PARAM_INT);
                        $stmt->bindParam(':atitude',$a, PDO::PARAM_INT);
                        $stmt->execute();
                        // Cadastro do professor na tabela usuario competencias
                        $stmt = $this->db_connection->prepare("INSERT INTO usuario_competencias(usuario_idusuario, competencia_idcompetencia, conhecimento, atitude, habilidade)  VALUES(:idUsuario, :idCompetencia, 5, 5, 5)");
                        $stmt->bindParam(':idUsuario',$this->idUsuario, PDO::PARAM_INT);
                        $stmt->bindParam(':idCompetencia',$arrayCompetenciasBD, PDO::PARAM_INT);
                        //$stmt->bindParam(':habilidade','5', PDO::PARAM_INT);
                        //$stmt->bindParam(':conhecimento','5', PDO::PARAM_INT);
                        //$stmt->bindParam(':atitude','5', PDO::PARAM_INT);
                        $stmt->execute();
                    }
                    // Cadastro do professor na disciplina que ele criou            
                    //print_r($ultimo_ID);
                    $stmt = $this->db_connection->prepare("INSERT INTO usuario_disciplina(disciplina_iddisciplina, usuario_idusuario)  VALUES(:idDisciplina, :idUsuario)");
                    $stmt->bindParam(':idDisciplina',$ultimo_ID, PDO::PARAM_INT);
                    $stmt->bindParam(':idUsuario',$usuarioProfessorID, PDO::PARAM_INT);
                    $stmt->execute();
                    $this->messages[] = WORDING_REGISTER_SUCESSFULLY;


               
                    //$this->messages[] = WORDING_DISCIPLINA. $nomeDisciplina .WORDING_CREATED_SUCESSFULLY;
                    $host  = $_SERVER['HTTP_HOST'];
                    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    $extra = 'index.php';
                    echo "<script language='JavaScript'> setTimeout(function () {window.location='http://".$host.$uri."/".$extra."';}, 100); </script> ";
                 }
        }
    }


    // Função que pega retorna o ID da disciplina
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

    // Função que edita disciplina
    public function editarDisciplina($nomeCurso, $nomeDisciplina, $descricao, $usuarioProfessorID, $senha, $arrayCompetencias, $conhecimento, $habilidade, $atitude, $idDisciplina){
       // Remove espaços em branco em excesso das strings
        print_r($conhecimento);

        $nomeCurso  = trim($nomeCurso);
        $nomeDisciplina = trim($nomeDisciplina);
        $descricao = trim($descricao);
        $senha = trim($senha);
        $arrayCompetencias = explode(',',$arrayCompetencias);

        $this->iddisciplina = $idDisciplina;
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
        }elseif ((max($conhecimento) > 5) || (min($conhecimento) < 0)) {
            $this->errors[] = MESSAGE_INVALID_CHA;
        }elseif ((max($habilidade) > 5) || (min($habilidade) < 0)) {
            $this->errors[] = MESSAGE_INVALID_CHA;
        }elseif ((max($atitude) > 5) || (min($atitude) < 0)) {
            $this->errors[] = MESSAGE_INVALID_CHA;
        }elseif (empty($idDisciplina)){
            $this->errors[] = MESSAGE_COURSEID_EMPTY;
        }elseif (empty($arrayCompetencias)){
            $this->errors[] = WORDING_NULL_COMPETENCE;

            //Fim de validações de dados de entrada
        //Inicio das validações de cadastro repitido
        } else if ($this->databaseConnection()) {
            // Verifica se a disciplina já existe ou curso já existe
            $query_check_nome_disciplina = $this->db_connection->prepare('SELECT nomedisciplina FROM disciplina WHERE nomedisciplina=:nomeDisciplina');
            $query_check_nome_disciplina->bindValue(':nomeDisciplina', $nomeDisciplina, PDO::PARAM_STR);
            $query_check_nome_disciplina->execute();
            $result = $query_check_nome_disciplina->fetchAll();
                // Se o nome da disciplina for encontrado no banco de dados, aceitar no max 1
                if (count($result) > 1) {
                    for ($i = 0; $i < count($result); $i++) {
                        $this->errors[] = MESSAGE_DISCIPLINA_ALREADY_EXISTS . $nomeDisciplina;
                        //echo 'aqui';
                    }
                } else{
                    // Update na tabela Disciplina
                    $stmt = $this->db_connection->prepare(
                        "UPDATE disciplina
                        SET nomeCurso = :nomeCurso, nomeDisciplina = :nomeDisciplina, descricao = :descricao, usuarioProfessorID = :usuarioProfessorID, senha = :senha 
                        WHERE iddisciplina = :idDisciplina");
                    $stmt->bindParam(':nomeCurso',$nomeCurso, PDO::PARAM_STR);
                    $stmt->bindParam(':nomeDisciplina',$nomeDisciplina, PDO::PARAM_STR);
                    $stmt->bindParam(':descricao',$descricao, PDO::PARAM_STR);
                    $stmt->bindParam(':usuarioProfessorID',$usuarioProfessorID, PDO::PARAM_INT);
                    $stmt->bindParam(':senha',$senha, PDO::PARAM_STR);
                    $stmt->bindParam(':idDisciplina',$idDisciplina, PDO::PARAM_INT);
                    $stmt->execute();
                    // Atualização dos CHAs da disciplina editada
                    // Primeiro deleta o que hava antigamente
                    $stmt = $this->db_connection->prepare("DELETE FROM disciplina_competencia WHERE disciplina_iddisciplina = :idDisciplina");
                    $stmt->bindParam(':idDisciplina',$idDisciplina, PDO::PARAM_INT);
                    $stmt->execute();
                    $count = count($arrayCompetencias)-1;
                    for ($i = 0; $i < $count; $i++) {
                        $arrayCompetenciasBD = $arrayCompetencias[$i]; // ID das competências, serialização
                        $this->arrayCompetenciasBD = $arrayCompetenciasBD;
                        $c = $conhecimento[$arrayCompetenciasBD];
                        $h = $habilidade[$arrayCompetenciasBD];
                        $a = $atitude[$arrayCompetenciasBD];
                        // Depois cria uma nova instância
                        $stmt = $this->db_connection->prepare("INSERT INTO disciplina_competencia(disciplina_iddisciplina, competencia_idcompetencia, conhecimento, habilidade, atitude) VALUES (:idDisciplina, :arrayCompetenciasBD, :conhecimento, :habilidade, :atitude)");
                        $stmt->bindParam(':idDisciplina',$idDisciplina, PDO::PARAM_INT);
                        $stmt->bindParam(':arrayCompetenciasBD',$arrayCompetenciasBD, PDO::PARAM_INT);
                        $stmt->bindParam(':conhecimento',$c, PDO::PARAM_INT);
                        $stmt->bindParam(':habilidade',$h, PDO::PARAM_INT);
                        $stmt->bindParam(':atitude',$a, PDO::PARAM_INT);
                        $stmt->execute();
                    }

                    $this->messages[] = WORDING_EDIT_SUCESSFULLY;


             
                    //$this->messages[] = WORDING_DISCIPLINA. $nomeDisciplina .WORDING_CREATED_SUCESSFULLY;
                    $host  = $_SERVER['HTTP_HOST'];
                    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    $extra = 'disciplinas.php';
                    echo "<script language='JavaScript'> setTimeout(function () {window.location='http://".$host.$uri."/".$extra."';}, 10000); </script> ";
                }
        }
    }

    /**
     * Edita o nome da disciplina
     */
    public function editDisciplinaName($nomeDisciplina, $idDiscplina){
        if (empty($nomeDisciplina)) {
            $this->errors[] = MESSAGE_DISCIPLINA_NAME_INVALID;

        } elseif($this->databaseConnection()) {
            // write user's new data into database
            $editarNomeDisciplina = $this->db_connection->prepare("UPDATE disciplina SET nomeDisciplina = :nomeDisciplina WHERE iddisciplina = :idDisciplina");
            $editarNomeDisciplina->bindValue(':nomeDisciplina', $nomeDisciplina, PDO::PARAM_STR);
            $editarNomeDisciplina->bindValue(':idDisciplina', $idDiscplina, PDO::PARAM_INT);
            $editarNomeDisciplina->execute();
            $this->messages[] = WORDING_EDIT_SUCESSFULLY;
        }
    }

    public function editCursoName($nomeCurso, $idDiscplina)
    {
        if (empty($nomeCurso)) {
            $this->errors[] = MESSAGE_COURSE_NAME_INVALID;

        }elseif($this->databaseConnection()) {
            // write user's new data into database
            $editarCursoName = $this->db_connection->prepare("UPDATE disciplina SET nomeCurso = :nomeCurso WHERE iddisciplina = :idDisciplina");
            $editarCursoName->bindValue(':nomeCurso', $nomeCurso, PDO::PARAM_STR);
            $editarCursoName->bindValue(':idDisciplina', $idDiscplina, PDO::PARAM_INT);
            $editarCursoName->execute();
            $this->messages[] = WORDING_EDIT_SUCESSFULLY;
        }
    }

    public function editDisciplinaSenha($senhaAntiga, $senhaNova, $idDiscplina)
    {
        $database = new Database();
        
        if (empty($senhaNova)) {
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;
        }elseif(strlen($senhaNova) < 6){
            $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;
        }elseif($database->exists('iddisciplina', $idDiscplina, 'disciplina', $senhaAntiga, 'senha')) { // Verifica se a senha está certa
            // write user's new data into database
            if ($this->databaseConnection()){
                $editarDisciplinaSenha = $this->db_connection->prepare("UPDATE disciplina SET senha = :senha WHERE iddisciplina = :idDisciplina");
                $editarDisciplinaSenha->bindValue(':senha', $senhaNova, PDO::PARAM_STR);
                $editarDisciplinaSenha->bindValue(':idDisciplina', $idDiscplina, PDO::PARAM_INT);
                $editarDisciplinaSenha->execute();
                $this->messages[] = WORDING_EDIT_SUCESSFULLY;
            }else 
                $this->errors[]=MESSAGE_DATABASE_ERROR;
        }else
            $this->errors[] = MESSAGE_OLD_PASSWORD_WRONG;
    }


    /**
     * Altera a descrição da disciplina pelo ID
     * @param $descricao
     * @param $idDiscplina
     */
    public function editDisciplinaDescricao($descricao, $idDiscplina)
    {
        if (empty($descricao) or (empty($idDiscplina))) {
            $this->errors[] = MESSAGE_DESCRICAO_EMPTY;
        } elseif($this->databaseConnection()) {
            // write user's new data into database
            $editarDisciplinaDescricao = $this->db_connection->prepare("UPDATE disciplina SET descricao = :descricao WHERE iddisciplina = :idDisciplina");
            $editarDisciplinaDescricao->bindValue(':descricao', $descricao, PDO::PARAM_STR);
            $editarDisciplinaDescricao->bindValue(':idDisciplina', $idDiscplina, PDO::PARAM_INT);
            $editarDisciplinaDescricao->execute();
            $this->messages[] = WORDING_EDIT_SUCESSFULLY;
        } else
            $this->errors[]=MESSAGE_DATABASE_ERROR;
    }
    
    public function getErrors(){
        return $this->errors;
    }
	
	public function getMessages(){
        return $this->messages;
    }
	
    // Retorna o ID de todas as disciplinas em que o aluno NÃO está matriculado
    public function getIdDisciplinasNaoMatriculadas($userID){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT iddisciplina FROM disciplina WHERE iddisciplina NOT IN (SELECT disciplina_iddisciplina FROM usuario_disciplina WHERE usuario_idusuario=:userID)");
            $stmt->bindParam(':userID',$userID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    // Retorna o ID de todas as disciplinas em que o aluno está matriculado
    public function getIdDisciplinasMatriculadas($userID){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT iddisciplina FROM disciplina WHERE iddisciplina IN (SELECT disciplina_iddisciplina FROM usuario_disciplina WHERE usuario_idusuario=:userID)");
            $stmt->bindParam(':userID',$userID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    /**
     * Retorna os seguintes dados (via param) da disciplina
     * idCompetencia associados a disciplina
     * conhecimento
     * habilidade
     * atitude
     * Retorna esses respectivos valores das disciplinas
     * @param $disciplinaId
     * @param $param
     * @return mixed
     */
    public function getCompetenciasDisciplina($disciplinaId, $param){
        if($this->databaseConnection()){
            if ($param == 'idDisciplina'){
                $stmt = $this->db_connection->prepare("SELECT competencia_idcompetencia FROM disciplina_competencia WHERE disciplina_iddisciplina=:disciplinaId");
            }else if ($param == 'conhecimento'){
                $stmt = $this->db_connection->prepare("SELECT conhecimento FROM disciplina_competencia WHERE disciplina_iddisciplina=:disciplinaId");
            }else if ($param == 'habilidade'){
                $stmt = $this->db_connection->prepare("SELECT habilidade FROM disciplina_competencia WHERE disciplina_iddisciplina=:disciplinaId");
            }else if ($param == 'atitude'){
                $stmt = $this->db_connection->prepare("SELECT atitude FROM disciplina_competencia WHERE disciplina_iddisciplina=:disciplinaId");
            }
            $stmt->bindValue(':disciplinaId', $disciplinaId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }



    // Retorna o Nome de todas as disciplinas em que o aluno NÃO está matriculado
    public function getNomeDisciplinasNaoMatriculadas($userID){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT nomeDisciplina FROM disciplina WHERE iddisciplina NOT IN (SELECT disciplina_iddisciplina FROM usuario_disciplina WHERE usuario_idusuario=:userID)");
            $stmt->bindParam(':userID',$userID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    // Retorna o Nome de todas as disciplinas em que o aluno está matriculado
    public function getNomeDisciplinasMatriculadas($userID){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT nomeDisciplina FROM disciplina WHERE iddisciplina IN (SELECT disciplina_iddisciplina FROM usuario_disciplina WHERE usuario_idusuario=:userID)");
            $stmt->bindParam(':userID',$userID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }


    // Retorna o Nome de todos os cursos em que o aluno NÃO está matriculado
    public function getNomeCursosNaoMatriculados($userID){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT nomeCurso FROM disciplina WHERE iddisciplina NOT IN (SELECT disciplina_iddisciplina FROM usuario_disciplina WHERE usuario_idusuario=:userID)");
            $stmt->bindParam(':userID',$userID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_NUM);
        }
    }

    // Retorna o Nome de todos os cursos em que o aluno NÃO está matriculado
    public function getDescricaoDisciplinasNaoMatriculadas($userID){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT descricao FROM disciplina WHERE iddisciplina NOT IN (SELECT disciplina_iddisciplina FROM usuario_disciplina WHERE usuario_idusuario=:userID)");
            $stmt->bindParam(':userID',$userID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }


	// Retorna o nome de todas as disciplinas
	public function getNomesDisciplinas(){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT nomeDisciplina FROM disciplina");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }
	}

    // Retorna o nome da disciplina pelo id
    public function getNomeDisciplinaById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT nomeDisciplina FROM disciplina WHERE iddisciplina=:id");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            //print_r($stmt->execute());
            return $stmt->fetchAll();
        }
    }

    // Retorna o id professor da disciplina pelo id da disciplina
    public function getProfessorDisciplinaById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT usuarioProfessorID FROM disciplina WHERE iddisciplina=:id");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            //print_r($stmt->execute());
            return $stmt->fetchAll();
        }
    }

    // Retorna o nome professor da disciplina pelo id
    public function getProfessorNomeById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT user_name FROM users WHERE user_id=:id");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            //print_r($stmt->execute());
            return $stmt->fetchAll();
        }
    }


    // Retorna o nome de todos os cursos
    public function getNomesCursos(){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT nomeCurso FROM disciplina");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    // Retorna o nome do curso pelo id
    public function getNomeCursoById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT nomeCurso FROM disciplina WHERE iddisciplina=:id");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            //print_r($stmt->execute());
            return $stmt->fetchAll();
        }
    }
	
    // Retorna a descrição das disciplinas
    public function getDescricaoDisciplinas(){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT descricao FROM disciplina");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
    
    // Retorna a descrição da disciplina pelo id
    public function getDescricaoDisciplinaById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT descricao FROM disciplina WHERE iddisciplina=:id");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    // Retorna a senha da disciplina pelo id
    public function getSenhaDisciplinaById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT senha FROM disciplina WHERE iddisciplina=:id");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    // Retorna o ID dos Cursos
    public function getIdCursos(){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT iddisciplina FROM disciplina");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }


    // Retorna o ID dos criador da disciplina pelo ID
    public function getDisciplinaCreatorIdByID($idDisciplina){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT usuarioProfessorID FROM disciplina WHERE iddisciplina=:idDisciplina");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->bindValue(':idDisciplina', $idDisciplina, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    public function getCompetenciaFromDisciplinaById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT competencia_idcompetencia FROM disciplina_competencia WHERE disciplina_iddisciplina=:id");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            //print_r($stmt->execute());
            return $stmt->fetchAll();
            //return $stmt->fetchAll();
        }
    }

    public function getCompetenciaNameFromDisciplinaById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT competencia_idcompetencia FROM disciplina_competencia WHERE disciplina_iddisciplina=:id");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            //print_r($stmt->execute());
            return $stmt->fetchAll();
            //return $stmt->fetchAll();
        }
    }

    public function getCHAFromDisciplinaByIdCompetencia($id,$iddisciplina){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT conhecimento, habilidade, atitude FROM disciplina_competencia WHERE competencia_idcompetencia=:id AND disciplina_iddisciplina=:iddisciplina");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':iddisciplina', $iddisciplina, PDO::PARAM_INT);
            $stmt->execute();
            //print_r($stmt->execute());
            return $stmt->fetchAll();
            //return $stmt->fetchAll();
        }
    }
    /*
        $param pode ser do tipo:
            - id (retorna o id da disciplina)
            - nomeDisciplina (retorna o nome da Disciplina)
            - nomeCurso (retorna o nome do Curso)
            - descricao (retorna a descricao da disciplina)
    */
    public function getUserDisciplinas($userId, $param){
        if($this->databaseConnection()){
            if ($param == 'id'){
                $stmt = $this->db_connection->prepare("SELECT iddisciplina FROM disciplina WHERE usuarioProfessorID=:userId");
            }else if ($param == 'nomeDisciplina'){
                $stmt = $this->db_connection->prepare("SELECT nomeDisciplina FROM disciplina WHERE usuarioProfessorID=:userId");
            }else if ($param == 'nomeCurso'){
                $stmt = $this->db_connection->prepare("SELECT nomeCurso FROM disciplina WHERE usuarioProfessorID=:userId");
            }else if ($param == 'descricao'){
                $stmt = $this->db_connection->prepare("SELECT descricao FROM disciplina WHERE usuarioProfessorID=:userId");
            }
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    /**
     * @param $id
     * @return competências da disciplina selecionada
     */
    public function getIdCompetenciaById($idDisciplina){
        $database = new Database();
        $sql = "SELECT competencia_idcompetencia FROM disciplina_competencia WHERE disciplina_iddisciplina = :idDisciplina";
        $database->query($sql);
        $database->bind(":idDisciplina", $idDisciplina);
        return $database->resultSet();
    }

    /**
     * @param $idDisciplina
     * @return bool se a disciplina está com a flag de excluida ou não
     */
    public function isExcluida($idDisciplina){
        $database = new Database();
        $sql = "SELECT excluida FROM disciplina WHERE iddisciplina = :idDisciplina";
        $database->query($sql);
        $database->bind(":idDisciplina", $idDisciplina);
        $temp = $database->resultSet();
        //echo '<pre>';
        //echo $temp[0]['excluida'];
        //print_r($database->resultSet());
        if ($temp[0]['excluida'] == 1){
            return true;
            
        }
        else{
            return false;
        }

            
    }


    /**
     * Função que lista os alunos matriculados na disciplina
     * @param $idDisciplina
     */
    public function listaAlunosMatriculados($idDisciplina){
        $database = new Database();
        $sql = "SELECT usuario_idusuario FROM usuario_disciplina WHERE disciplina_iddisciplina = :idDisciplina";
        $database->query($sql);
        $database->bind(":idDisciplina", $idDisciplina);
        return $database->resultSet();
    }

    /**
     * Função que retorna uma lista de OAS associados as competências das disciplina
     * @param $idDisciplina
     */
    public function listaObjetosDisciplina($idDisciplina){
        $competencias_disciplina = $this->getCompetenciasDisciplina($idDisciplina, 'idDisciplina');
        $database = new Database();
        $arrayIdCompetencias = array();
        foreach ($competencias_disciplina as $idCompetencia) {
            $sql = "SELECT id_OA FROM competencia_oa WHERE id_competencia = :idCompetencia";
            $database->query($sql);
            $param = $idCompetencia[0];
            $database->bind(":idCompetencia", $param);
            // Popula array
            array_push($arrayIdCompetencias, $database->resultSet());
        }
        return $arrayIdCompetencias;
    }

    public function getUserData($userId){
        $database = new Database();
        $sql = "SELECT user_name, user_email, acesso FROM users WHERE user_id = :idUser";
        $database->query($sql);
        $database->bind(":idUser", $userId);
        return $database->resultSet();
    }
    

    // Função que cria a relação usuario com disciplina
    public function entrarDisciplina($idUsuario, $idDisciplina, $senha, $conhecimento, $habilidade, $atitude, $competencias){
        // Remove espaços em branco em excesso das strings
        $senha = trim($senha);

        $this->idUsuario  = $idUsuario;
        $this->idDisciplina = $idDisciplina;
        $this->senha = $senha;
        $this->conhecimento = $conhecimento;
        $this->habilidade = $habilidade;
        $this->atitude = $atitude;
        $this->competencias = $competencias;

        
        //Validação de dados
        if (empty($idUsuario)) {
            $this->errors[] = MESSAGE_USERNAMEID_EMPTY;
        } elseif (empty($idDisciplina)){
            $this->errors[] = MESSAGE_COURSEID_EMPTY;
        } elseif (empty($senha)){
            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;
        //Fim de validações de dados de entrada
        //Inicio do cadastro no banco de dados
        } else if ($this->databaseConnection()) {
            // Verifica se a senha está certa
            $query_check_senha_disciplina = $this->db_connection->prepare('SELECT senha FROM disciplina WHERE senha=:senha AND iddisciplina=:idDisciplina');
            $query_check_senha_disciplina->bindValue(':senha', $senha, PDO::PARAM_STR);
            $query_check_senha_disciplina->bindValue(':idDisciplina', $idDisciplina, PDO::PARAM_INT);
            $query_check_senha_disciplina->execute();
            $result = $query_check_senha_disciplina->fetchAll();
                // Se a senha estiver errada retorna erro
                if (!count($result)) {
                    $this->errors[] = MESSAGE_PASSWORD_WRONG;
                } else{
                    // Cadastro na tabela usuario_disciplina
                    foreach ($this->competencias as $idCompetencia){
                        //echo $idCompetencia.",";
                        $stmt = $this->db_connection->prepare("INSERT INTO usuario_competencias(usuario_idusuario, competencia_idcompetencia, conhecimento, atitude, habilidade)  VALUES(:idUsuario, :idCompetencia, :conhecimento, :atitude, :habilidade)");
                        $stmt->bindParam(':idUsuario',$this->idUsuario, PDO::PARAM_INT);
                        $stmt->bindParam(':idCompetencia',$idCompetencia, PDO::PARAM_INT);
                        $stmt->bindParam(':habilidade',$this->habilidade[$idCompetencia], PDO::PARAM_INT);
                        $stmt->bindParam(':conhecimento',$this->conhecimento[$idCompetencia], PDO::PARAM_INT);
                        $stmt->bindParam(':atitude',$this->atitude[$idCompetencia], PDO::PARAM_INT);
                        $stmt->execute();
                    }
                    $stmt = $this->db_connection->prepare("INSERT INTO usuario_disciplina(disciplina_iddisciplina, usuario_idusuario)  VALUES(:idDisciplina, :idUsuario)");
                    $stmt->bindParam(':idDisciplina',$this->idDisciplina, PDO::PARAM_INT);
                    $stmt->bindParam(':idUsuario',$this->idUsuario, PDO::PARAM_INT);
                    $stmt->execute();
                    $this->messages[] = WORDING_REGISTER_SUCESSFULLY;
            }
        } // End verificações
    } // End Função


    // verifica se a senha está correta
    public function checkPassword($senha, $idDisciplina){
        $senha = trim($senha);
        if($this->databaseConnection()){
            $query_check_senha_disciplina = $this->db_connection->prepare('SELECT senha FROM disciplina WHERE senha=:senha AND iddisciplina=:idDisciplina');
            $query_check_senha_disciplina->bindValue(':senha', $senha, PDO::PARAM_STR);
            $query_check_senha_disciplina->bindValue(':idDisciplina', $idDisciplina, PDO::PARAM_INT);
            $query_check_senha_disciplina->execute();
            $result = $query_check_senha_disciplina->fetchAll();
            // Se a senha estiver errada retorna erro
            if (!count($result)){
                return false;
            }
            else{
                return true;
            }
        }
    } //End Função



} // End Classe

//Case de teste
//$coisa = new Disciplina();
//$coisa->listaAlunosMatriculados(44);
//print_r($coisa->getUserData(5));
//print_r($coisa->getNomeDisciplinaById(78));
//$coisa->getNomesDisciplinas();
//$coisa->entrarDisciplina(1,2,'aaaaaaaa');
//entrarDisciplina('1','2','aaaaa');


?>