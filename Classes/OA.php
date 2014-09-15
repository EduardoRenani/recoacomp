<?php
/**
 * User: Cláuser
 * Date: 02/09/14
 * Time: 09:39
 */
if(class_exists('OA') != true){
class OA {
    private $id;
    private $nome;
    private $descricao;
    private $url;
    private $palavrachave;
    private $idioma;
    private $db_connection = null;
        //GETTERS AND SETTERS

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
     /**
     * @return mixed $descricao
     */
    public function getDescricao()
    {
        return $this->descricao;
    }
    /**
     * @param mixed $id
     */
    public function setID($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed $id
     */
    public function getID()
    {
        return $this->id;
    }
    /**
     * @param mixed $idioma
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;
    }
     /**
     * @return mixed $idioma
     */
    public function getIdioma()
    {
        return $this->idioma;
    }
     /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
     /**
     * @return mixed $nome
     */
    public function getNome()
    {
        return $this->nome;
    }
    /**
     * @param mixed $palavrachave
     */
    public function setPalavrachave($palavrachave)
    {
        $this->palavrachave = $palavrachave;
    }
    /**
     * @return mixed $palavrachave
     */
    public function getPalavrachave()
    {
        return $this->palavrachave;
    }
    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
    /**
     * @return mixed $url
     */
    public function getUrl()
    {
        return $this->url;
    }


    // CONSTRUTOR

    function __construct(){
        $id = 0;
        $nome = $descricao = $url = $palavrachave = $idioma = $competencia = '';
    }

    public function criaOA($nome,$descricao,$url,$palavrachave,$idioma){

        if($this->databaseConnection()){

            $this->nome = trim($nome);
            $this->descricao = trim($descricao);
            $this->url = trim($url);
            $this->palavrachave = trim($palavrachave);
            $this->idioma = trim($idioma);

            $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

            $stmt = $this->db_connection->prepare("INSERT INTO disciplina(nome, descricao, url, palavrachave, idioma)  VALUES(:nome, :descricao, :url, :palavrachave, :idioma)");
            $stmt->bindParam(':nome',$this->nome, PDO::PARAM_STR);
            $stmt->bindParam(':descricao',$this->descricao, PDO::PARAM_STR);
            $stmt->bindParam(':url',$this->url, PDO::PARAM_STR);
            $stmt->bindParam(':palavrachave',$this->palavrachave, PDO::PARAM_STR);
            $stmt->bindParam(':idioma',$this->idioma, PDO::PARAM_STR);
            $stmt->execute();


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

    public static function getID_byName($nome){

        // connection already opened
        if ($db_connection != null) {

        } else {
            // create a database connection, using the constants from config/config.php
            try {
                $db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                // If an error is catched, database connection failed
            } catch (PDOException $e) {
                $errors[] = MESSAGE_DATABASE_ERROR;

            }
        }

        $nome = trim($nome);
        $db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $stmt = $db_connection->prepare("SELECT FROM cesta (idcesta)  WHERE nome = :nome");
        $stmt->bindParam(':nome',$nome, PDO::PARAM_STR);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        if(count($stmt) > 0)
            return $stmt[0];
        else
            return -1;
    }

}
}