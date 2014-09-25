<?php
/**
 * User: Delton
 * Date: 24/09/14
 * Time: 18:25
 * Classe responsável pelo gerenciamento de Objetos de Aprendizagem (OA/Cesta)
 */
if(class_exists('OA') != true){
class OA{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection            = null;
    /**
     * @var bool estado do sucesso do registro de nova disciplina
     */
    public  $registration_successful    = false;
    /**
     * @var array collection of error messages
     */
    public  $errors                     = array();
    /**
     * @var array collection of success / neutral messages
     */
    public  $messages                   = array();
    /**
     * @var int $idCesta ID do OA
     */
    private  $idCesta                   = null;
    /**
     * @var int $idCategoriaVida ID da categoria vida
     */
    private   $idCategoriaVida          = null;
    /**
     * @var int $idCategoriaTecnica ID da categoria técnica
     */
    private   $idCategoriaTecnica       = null;
    /**
     * @var int $idCategoriaEduacional ID da categoria educacional
     */
    private   $idCategoriaEduacional    = null;
    /**
     * @var int $idUsuario ID do usuário que criou o OA
     */
    private   $idUsuario                = null;
    /**
     * @var int $idCategoriaDireito ID da categoria direito
     */
    private   $idCategoriaDireito       = null;
    /**
     * @var string $descricao descrição do OA
     */
    private $descricao                  = "";
    /**
     * @var string $nome nome do OA
     */
    private $nome                       = "";
    /**
     * @var string $url URL do OA
     */
    private $url                        = "";
    /**
     * @var array $palavraChave array de palavras chaves do OA
     */
    private $palavraChave               = [];
    /**
     * @var string $idioma idioma do OA
     */
    private $idioma                     = "";
    /**
     * @var boolean $user_is_logged_in Status para verificar se o usuário está logado
     */
    private $user_is_logged_in = false;
    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$criarCompetencia = new CriarCompetencia();"
     */
    public function __construct() // Essa construct tá certa, seguir modelo
    {
        if (isset($_POST["registrar_nova_competencia"])) {
            // Função para cadastro de novo Objeto de Aprendizagem
            //$this->criaOA($_POST['nome'],$_POST['descricaoNome'],$_POST['atitudeDescricao'], $_POST['habilidadeDescricao'], $_POST['conhecimentoDescricao'], $_POST['user_id']);
        }
        // Se não estiver cadastrando nova competência, no construct ele retorna valores vazios.
        else{
            //$this->idCompetencia = $this->nome = $this->descricaoNome = $this->atitudeDescricao = $this->habilidadeDescricao = $this->conhecimentoDescricao = $this->idProfessor = null;
        }
    }
    /**
     * Função que verifica se a conexão com o BD existe, se nao existir é aberta
     */
    private function databaseConnection(){
        if ($this->db_connection != null) {
            return true;
        } else {
            try {
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR;
                print_r($this);
                return false;
            }
        }
    }
    /**
     * Administra tod@ o sistema de Criação de Objetos de Aprendizagem
     * Verifica todos os erros possíveis e cria o OA se ele não existe
     */

    public function criaOA($idcategoria_vida, $descricaoNome, $atitudeDescricao, $habilidadeDescricao, $conhecimentoDescricao, $idProfessor){
        // Remove espaços em branco em excesso das strings
        $nome = trim($this->nome);
        $descricaoNome = trim($descricaoNome);
        $atitudeDescricao = trim($atitudeDescricao);
        $habilidadeDescricao = trim($habilidadeDescricao);
        $conhecimentoDescricao = trim($conhecimentoDescricao);

        // Atribuição das variáveis ao objeto
        $this->nome = $nome;
        $this->descricaoNome = $descricaoNome;
        $this->atitudeDescricao = $atitudeDescricao;
        $this->habilidadeDescricao = $habilidadeDescricao;
        $this->conhecimentoDescricao = $conhecimentoDescricao;
        $this->idProfessor = $idProfessor;

        //Validação de dados
        if (empty($nome)) {
            $this->errors[] = MESSAGE_NAME_EMPTY;
        } elseif (empty($descricaoNome)){
            $this->errors[] = MESSAGE_DESCRICAO_EMPTY;
        } elseif (empty($atitudeDescricao)){
            $this->errors[] = MESSAGE_DESCRICAO_ATITUDE_EMPTY;
        } elseif (empty($habilidadeDescricao)){
            $this->errors[] = MESSAGE_DESCRICAO_HABILIDADE_EMPTY;
        } elseif (empty($conhecimentoDescricao)){
            $this->errors[] = MESSAGE_DESCRICAO_CONHECIMENTO_EMPTY;
        } elseif (strlen($nome) < 2) {
            $this->errors[] = MESSAGE_NAME_TOO_SHORT;
            //Fim de validações de dados de entrada
            //Inicio das validações de cadastro repitido
        } else if ($this->databaseConnection()) {
            // Verifica se a competência já existe
            // Essa query verifica se possuem nomes idênticos
            $query_check_nome_competencia = $this->db_connection->prepare('SELECT nome FROM competencia WHERE nome=:nome');
            $query_check_nome_competencia->bindValue(':nome', $nome, PDO::PARAM_STR);
            $query_check_nome_competencia->execute();
            $result = $query_check_nome_competencia->fetchAll();
            // Se o nome da competência for encontrada no banco de dados
            if (count($result) > 0) {
                for ($i = 0; $i < count($result); $i++) {
                    $this->errors[] = MESSAGE_COMPETENCIA_ALREADY_EXISTS . $nome;
                }
            } else{
                $stmt = $this->db_connection->prepare("INSERT INTO competencia(nome, descricao_nome, atitude_descricao, habilidade_descricao, conhecimento_descricao, id_professor)  VALUES(:nome, :descricaoNome, :atitudeDescricao, :habilidadeDescricao, :conhecimentoDescricao, :idProfessor)");
                $stmt->bindParam(':nome',$nome, PDO::PARAM_STR);
                $stmt->bindParam(':descricaoNome',$descricaoNome, PDO::PARAM_STR);
                $stmt->bindParam(':atitudeDescricao',$atitudeDescricao, PDO::PARAM_STR);
                $stmt->bindParam(':habilidadeDescricao',$habilidadeDescricao, PDO::PARAM_STR);
                $stmt->bindParam(':conhecimentoDescricao',$conhecimentoDescricao, PDO::PARAM_STR);
                $stmt->bindParam(':idProfessor',$idProfessor, PDO::PARAM_INT);
                $stmt->execute();
                $this->messages[] = WORDING_COMPETENCIA. $nome .WORDING_CREATED_SUCESSFULLY;
            }
        }
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
            $query_check_disc_comp->bindValue(':idDisciplina', $this->iddisciplina, PDO::PARAM_INT);
            $query_check_disc_comp->bindValue(':idComp', $idCompetencia, PDO::PARAM_INT);
            $query_check_disc_comp->execute();
            $result = $query_check_disc_comp->fetchAll();
            if(count($result)>0){
                $existeRelacao = true;
                $this->errors[] = MESSAGE_DISCIPLINA_COMPETENCIA_ALREADY_RELATED;
            }

            if( (! $existeRelacao) && (strlen($this->errors) == 0) ){
                //Associar a competência com a disciplina pelo ID

                $stmt = $this->db_connection->prepare("INSERT INTO disciplina_competencia(disciplina_iddisciplina,competencia_idcompetencia)  VALUES(:idDisc,:idComp )");
                $stmt->bindParam(':idDisc',$this->iddisciplina, PDO::PARAM_INT);
                $stmt->bindParam(':idComp',$idCompetencia, PDO::PARAM_INT);
                $stmt->execute();
                return true;
            }else{
                return false;
            }
        }
    }
    public function getErrors(){
        return $this->errors;
    }

    public function getListaCompetencia(){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT nome, idcompetencia FROM competencia");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    public function getArrayOfIDs(){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT idcompetencia FROM competencia");
            $stmt->execute();
            $retorno = $stmt->fetchAll();
            return ($retorno);
        }
    }

    public function getArrayOfNames(){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT nome FROM competencia");
            $stmt->execute();
            $retorno = $stmt->fetchAll();
            return ($retorno);
        }
    }
}


//Case de teste
//$competencia = new Competencia();
//$competencia->criaCompetencia('nome','descricao','atitudedesc','habilidadedesc', 'conhhecimentodesc', 1);



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

            //INSERT INTO competencia(nome,descricao,url,palavrachave,idioma) VALUES ('".$nome."','".$descricao."','".$url."','".$palavrachave."','".$idioma."'
            $stmt = $this->db_connection->prepare("INSERT INTO cesta(nome, descricao, url, palavrachave, idioma)  VALUES(:nome, :descricao, :url, :palavrachave, :idioma)");
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
?>