<?php
/**
 * Created by PhpStorm.
 * User: Delton
 * Date: 02/06/15
 * Time: 18:29
 */

require_once('config/config.cfg');

/**
 * Class Database
 */
class Database {

    /**
     * @var object $db_connection The database connection
     */
    private $db_connection            = null;
    /**
     * @var Host do banco de dados
     */
    private $host      = DB_HOST;
    /**
     * @var Nome de Usuario do Banco de dados, DB_USER está definido no config.cfg
     */
    private $user      = DB_USER;
    /**
     * @var Senha do banco de dados
     */
    private $pass      = DB_PASS;
    /**
     * @var Nome do banco de dados
     */
    private $dbname    = DB_NAME;

    /**
     * @var PDO
     */
    private $dbh;
    /**
     * @var string
     */
    private $error;

    /**
     * @var Query
     */
    private $stmt;

    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8';
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
            // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    /**
     * @return retorna um array associativo com todos os dados
     */
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return um único valor
     */
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @return Número de linhas
     */
    public function rowCount(){
        return $this->stmt->rowCount();
    }

    /**
     * @return int do último ID
     */
    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction(){
        return $this->dbh->beginTransaction();
    }

    public function endTransaction(){
        return $this->dbh->commit();
    }

    public function cancelTransaction(){
        return $this->dbh->rollBack();
    }

    /**
     * Faz um dump na prepared statment
     * @return mixed
     */
    public function debugDumpParams(){
        return $this->stmt->debugDumpParams();
    }

    /**
     *
     * Função que verifica a existência de elementos (ex: nome ja existe, etc.)
     *
     * @param $nomeCampoId, NOME do campo do ID a ser comparado
     * @param $id, id a ser comparado
     * @param $nomeTabela, NOME da tabela onde será buscado os dados
     * @param $paramToCompare, parametro que será comparado
     * @param $columnName, NOME da coluna em que se pretende verificar se existe o dado
     */
    public function exists($nomeCampoId, $id, $nomeTabela, $paramToCompare, $columnName){
        $database = new Database();

        $sql = "SELECT $columnName FROM $nomeTabela WHERE $columnName = '$paramToCompare' AND $nomeCampoId = $id";
        $database->query($sql);
        $database->execute();
        if (($database->rowCount()) >= 1) // Se encontrado
            return true;
        else return false;
    }
}
//$database = new Database();
//$database->exists('iddisciplina',133,'disciplina','xxxx');
//$existe = $database->exists('iddisciplina', 133, 'disciplina', 'ahhahhhahhahahhahahahha', 'senha');
//print_r($existe);
?>