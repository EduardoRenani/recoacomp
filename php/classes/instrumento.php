<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 04/09/14
 * Time: 14:50
 */



class Instrumento {
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
    private  $idCompetencia           = null;
    /**
     * @var int $iddisciplina ID da disciplina
     */
    private $idDisciplina = null;
    /**
     * @var string $nomeCurso nome do curso
     */
    private $problemaUm = "";
    /**
     * @var string $nomeDisciplina nome da disciplina
     */
    private $problemaDois = "";
    /**
     * @var string $descricao descrição da disciplina
     */
    private $problemaTres = "";

    private $ultimo_ID;
    
    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$criarDisciplina = new CriarDisciplina();"
     */
    public function __construct() // Essa construct tá certa, seguir modelo
    {
        if (isset($_POST["registrar_novo_instrumento"])) {
            // Função para primeira parte do cadastro de disciplina
            //print_r($_POST);
            foreach ($_POST['idCompetencias'] as $key => $idCompetencia) {
                $this->criaInstrumento( $_POST['iddisciplina'],
                                        $idCompetencia,
                                        $_POST['problemasUm'][$key], 
                                        $_POST['problemasDois'][$key], 
                                        $_POST['problemasTres'][$key]);
            }
        }
        if (isset($_POST["editar_instrumento"])) {
            // Função para primeira parte do cadastro de disciplina
            //print_r($_POST);
            foreach ($_POST['idinstrumentos'] as $key => $idinstrumento) {
				$this->editaInstrumento( $idinstrumento,
									$_POST['problemasUm'][$key], 
									$_POST['problemasDois'][$key], 
									$_POST['problemasTres'][$key]);
			}
        }
        if(isset($_POST["responder_instrumento"])) {
            foreach($_POST['idinstrumentos'] as $key => $idinstrumento) {
                $this->respondeInstrumento(intval($idinstrumento), intval($_POST["resposta".$idinstrumento]));
            }
        }
        if(isset($_POST["verifica_senha"])) {
            foreach($_POST['competencias'] as $idcompetecia) {
                $this->respondeInstrumento(intval($idcompetecia), $_POST['conhecimento'][$idcompetecia], $_POST['habilidade'][$idcompetecia], $_POST['atitude'][$idcompetecia], $_POST['num_problema']);
            }
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
    public function criaInstrumento($idDisciplina, $idCompetencia, $problemaUm, $problemaDois, $problemaTres){
        $this->idDisciplina  = $idDisciplina;
        $this->idCompetencia = $idCompetencia;
        $this->problemaUm = $problemaUm;
        $this->problemaDois = $problemaDois;
        $this->problemaTres = $problemaTres;
		
        //Validação de dados
        if (empty($problemaUm)) {
            $this->errors[] = "Problema um vazio.";
        } elseif (empty($problemaDois)){
            $this->errors[] = "Problema dois vazio.";
        } elseif (empty($problemaTres)){
            $this->errors[] = "Problema três vazio.";
            //Fim de validações de dados de entrada
        //Inicio das validações de cadastro repitido
        } else if ($this->databaseConnection()) {
                // Cadastro na tabela Disciplina
                $stmt = $this->db_connection->prepare("INSERT INTO instrumento_disciplina(iddisciplina, idcompetencia, problema_um, problema_dois, problema_tres)  VALUES(:idDisciplina, :idCompetencia, :problemaUm, :problemaDois, :problemaTres)");
                $stmt->bindParam(':idDisciplina',$idDisciplina, PDO::PARAM_INT);
                $stmt->bindParam(':idCompetencia',$idCompetencia, PDO::PARAM_INT);
                $stmt->bindParam(':problemaUm',$problemaUm, PDO::PARAM_STR);
                $stmt->bindParam(':problemaDois',$problemaDois, PDO::PARAM_STR);
                $stmt->bindParam(':problemaTres',$problemaTres, PDO::PARAM_STR);
                $stmt->execute();
                $ultimo_ID = $this->db_connection->lastInsertId();
                $this->$ultimo_ID = $ultimo_ID;
                $this->messages[] = WORDING_REGISTER_SUCESSFULLY;


           
                $this->messages[] = WORDING_DISCIPLINA. $nomeDisciplina .WORDING_CREATED_SUCESSFULLY;
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'index.php';
                echo "<script language='JavaScript'> setTimeout(function () {window.location='http://".$host.$uri."/".$extra."';}, 100); </script> ";
        }
    }
	
	public function editaInstrumento($idInstrumento, $problemaUm, $problemaDois, $problemaTres){
        $this->problemaUm = $problemaUm;
        $this->problemaDois = $problemaDois;
        $this->problemaTres = $problemaTres;
        //Validação de dados
        if (empty($problemaUm)) {
            $this->errors[] = "Problema um vazio.";
        } elseif (empty($problemaDois)){
            $this->errors[] = "Problema dois vazio.";
        } elseif (empty($problemaTres)){
            $this->errors[] = "Problema três vazio.";
            //Fim de validações de dados de entrada
        //Inicio das validações de cadastro repitido
        } else if ($this->databaseConnection()) {
		
                // Cadastro na tabela Disciplina
                $stmt = $this->db_connection->prepare("UPDATE instrumento_disciplina  SET  problema_um=:problemaUm, problema_dois=:problemaDois, problema_tres=:problemaTres WHERE id = :idInstrumento");
                $stmt->bindParam(':idInstrumento',$idInstrumento, PDO::PARAM_INT);
                $stmt->bindParam(':problemaUm',$problemaUm, PDO::PARAM_STR);
                $stmt->bindParam(':problemaDois',$problemaDois, PDO::PARAM_STR);
                $stmt->bindParam(':problemaTres',$problemaTres, PDO::PARAM_STR);
                $stmt->execute();
                $ultimo_ID = $this->db_connection->lastInsertId();
                $this->$ultimo_ID = $ultimo_ID;
                $this->messages[] = WORDING_REGISTER_SUCESSFULLY;


           
                $this->messages[] = WORDING_CREATED_SUCESSFULLY;
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'index.php';
                echo "<script language='JavaScript'> alert('".WORDING_CREATED_SUCESSFULLY."'); setTimeout(function () {window.location='http://".$host.$uri."/".$extra."';}, 100); </script> ";
        }
    }

    public function respondeInstrumento($idcompetencia, $conhecimento, $habilidade, $atitude, $num_problema){
        //Validação de dados
        if (empty($idcompetencia)) {
            $this->errors[] = "id da competencia vazio.";
        } elseif (empty($conhecimento)){
            $this->errors[] = "conehcimento vazio.";
        } elseif (empty($habilidade)){
            $this->errors[] = "habilidade vazio.";
        } elseif (empty($atitude)){
            $this->errors[] = "atitude vazio.";
        } else if ($this->databaseConnection()) {
                $instrumento_comp = $this->getInstrumentoByCompetencia($idcompetencia);
                $resposta_instr = $this->getRespostaByInstrumentoAndUsuario($instrumento_comp['id'], $_SESSION['user_id']);
                if($num_problema == 1) {
                    $respostaUm = $this->calculaResposta($conhecimento, $habilidade, $atitude);
                    $respostaDois = (isset($resposta_instr['respsota2'])) ? $resposta_instr['resposta2'] : NULL;
                    $respostaTres = (isset($resposta_instr['resposta3'])) ? $resposta_instr['resposta3'] : NULL;
                }
                else if($num_problema == 2) {
                    $respostaUm = (isset($resposta_instr['resposta1'])) ? $resposta_instr['resposta1'] : NULL;;
                    $respostaDois = $this->calculaResposta($conhecimento, $habilidade, $atitude);
                    $respostaTres = (isset($resposta_instr['resposta3'])) ? $resposta_instr['resposta3'] : NULL;;   
                }
                else if($num_problema == 3) {
                    $respostaUm = (isset($resposta_instr['resposta1'])) ? $resposta_instr['resposta1'] : NULL;;
                    $respostaDois = (isset($resposta_instr['resposta2'])) ? $resposta_instr['resposta2'] : NULL;;
                    $respostaTres = $this->calculaResposta($conhecimento, $habilidade, $atitude);   
                }
                $loading = new Carregamento();
                if($loading->carregaDados(array('id_instrumento' => $instrumento_comp['id'], 'id_usuario' => $_SESSION['user_id']), "instrumento_usuario")) {
                    // Cadastro na tabela Disciplina
                    $stmt = $this->db_connection->prepare("UPDATE instrumento_usuario SET id_instrumento = :idInstrumento, id_usuario = :idUsuario, resposta1 = :respostaUm, resposta2 = :respostaDois, resposta3 = :respostaTres WHERE id_instrumento = :idInstrumento AND id_usuario = :idUsuario");
                    $stmt->bindParam(':idInstrumento',$instrumento_comp['id'], PDO::PARAM_INT);
                    $stmt->bindParam(':idUsuario', $_SESSION['user_id'], PDO::PARAM_INT);
                    $stmt->bindParam(':respostaUm',$respostaUm, PDO::PARAM_INT);
                    $stmt->bindParam(':respostaDois',$respostaDois, PDO::PARAM_INT);
                    $stmt->bindParam(':respostaTres',$respostaTres, PDO::PARAM_INT);
                    $stmt->execute();
                    $ultimo_ID = $this->db_connection->lastInsertId();
                    $this->$ultimo_ID = $ultimo_ID;
                    $this->messages[] = WORDING_REGISTER_SUCESSFULLY;


               
                    $this->messages[] = WORDING_DISCIPLINA.WORDING_CREATED_SUCESSFULLY;
                    $host  = $_SERVER['HTTP_HOST'];
                    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    $extra = 'index.php';
                    //echo "<script language='JavaScript'> setTimeout(function () {window.location='http://".$host.$uri."/".$extra."';}, 100); </script> ";    
                }
                else {
                    // Cadastro na tabela Disciplina
                    $stmt = $this->db_connection->prepare("INSERT INTO instrumento_usuario(id_instrumento, id_usuario, resposta1, resposta2, resposta3)  VALUES(:idInstrumento, :idUsuario, :respostaUm, :respostaDois, :respostaTres)");
                    $stmt->bindParam(':idInstrumento',$instrumento_comp['id'], PDO::PARAM_INT);
                    $stmt->bindParam(':idUsuario', $_SESSION['user_id'], PDO::PARAM_INT);
                    $stmt->bindParam(':respostaUm',$respostaUm, PDO::PARAM_INT);
                    $stmt->bindParam(':respostaDois',$respostaDois, PDO::PARAM_INT);
                    $stmt->bindParam(':respostaTres',$respostaTres, PDO::PARAM_INT);
                    $stmt->execute();
                    $ultimo_ID = $this->db_connection->lastInsertId();
                    $this->$ultimo_ID = $ultimo_ID;
                    $this->messages[] = WORDING_REGISTER_SUCESSFULLY;


               
                    $this->messages[] = WORDING_DISCIPLINA.WORDING_CREATED_SUCESSFULLY;
                    $host  = $_SERVER['HTTP_HOST'];
                    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    $extra = 'index.php';
                    //echo "<script language='JavaScript'> setTimeout(function () {window.location='http://".$host.$uri."/".$extra."';}, 100); </script> ";
                }
        }
    }
    
    public function calculaResposta($conhecimento, $habilidade, $atitude) {
        return $conhecimento+(10*$habilidade)+(100*$atitude);
    }
    
    public function decodeResposta($resposta) {
        $nova_resposta['atitude'] = $resposta%10;
        $nova_resposta['habilidade']   = ($resposta%100-$nova_resposta['atitude'])/10;
        $nova_resposta['conhecimento']      = ($resposta-(10*$nova_resposta['habilidade'])-$nova_resposta['atitude'])/100;
        return $nova_resposta;
    }

    public function getInstrumentoByCompetencia($id_competencia) {
        $carregameto = new Carregamento();
        return $carregameto->carregaDados(array("idcompetencia" => $id_competencia), "instrumento_disciplina");
    }

    public function getRespostaByInstrumentoAndUsuario($id_instrumento, $id_usuario) {
        $carregameto = new Carregamento();
        return $carregameto->carregaDados(array("id_instrumento" => $id_instrumento, "id_usuario" => $id_usuario), "instrumento_usuario");
    }
	
	public function getInstrumento($id) {
		$carregameto = new Carregamento();
		return $carregameto->carregaDados(array("id" => $id), "instrumento_disciplina");
	}
    
    public function getErrors(){
        return $this->errors;
    }
	
	public function getMessages(){
        return $this->messages;
    }



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