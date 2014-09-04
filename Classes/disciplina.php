<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 04/09/14
 * Time: 14:50
 */

require_once('../config/config.cfg');
require_once('../translations/pt_br.php');

define("_SERVER", "localhost");
define("_USUARIO", "clauser");
define("_SENHA", "root");
define("_BD", "recoacomp");

class Disciplina {
    private $nomeCurso = 'alface';
    private $nomeDisciplina = 'tomate';
    private $descricao = 'Oii';
    private $usuarioProfessorID = 13;
    private $senha = 1234;

    private $db_connection            = null;

    function __construct(){
        $this->nomeCurso = $this->nomeDisciplina = $this->descricao = $this->senha = '';
        $this->usuarioProfessorID = 0;
    }

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
        echo "1000";
        // connection already opened
        if ($this->db_connection != null) {
            echo "10";
            return true;

        } else {
            // create a database connection, using the constants from config/config.php
            try {
                $this->db_connection = new PDO('mysql:host='. _SERVER .';dbname='. _BD . ';charset=utf8', _USUARIO, _SENHA);
                echo "20";
                return true;
                // If an error is catched, database connection failed
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR;
                print_r($this);
                echo "30";
                return false;

            }
        }
    }

    public function criaDisc(){
        echo "-1";
        if($this->databaseConnection()){
            echo "0";
            $stmt = $this->db_connection->prepare("INSERT INTO disciplina(nomeCurso, nomeDisciplina, descricao, usuarioProfessorID, senha) VALUES(?, ?, ?, ?, ?)");
            echo "1";
            $stmt->bindParam(1,$this->nomeCurso);
            $stmt->bindParam(2,$this->nomeDisciplina);
            $stmt->bindParam(3,$this->descricao);
            $stmt->bindParam(4,$this->usuarioProfessorID);
            $stmt->bindParam(5,$this->senha);
            $stmt->execute();
        }
    }


}
$coco= new Disciplina();
$coco->setDescricao("desc");
$coco->setNomeCurso("nome");
$coco->setNomeDisciplina("someo");
$coco->setSenha("ásdofiu");
$coco->setUsuarioProfessorID(12);
$coco->criaDisc();

?>