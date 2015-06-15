<?php
/**
 * Created by PhpStorm.
 * User: Delton
 * Date: 23/09/14
 * Time: 17:19
 */

require_once('config/config.cfg');
require_once('translations/pt_br.php');

class Competencia{

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
     * @var int $idProfessor ID do professor que criou competência
     */
    private  $idProfessor           = null;
    /**
     * @var int $idCompetencia ID da competência
     */
    private  $idCompetencia           = null;
    /**
     * @var string $nome nome da competência
     */
    private $nome = "";
    /**
     * @var string $descricaoCompetencia breve descrição da competência
     */
    private $descricaoNome = "";
    /**
     * @var string $atitudeDescricao breve descrição do que seria atitude para essa competência
     */
    private $atitudeDescricao = "";
    /**
     * @var string $habilidadeDescricao breve descrição do que seria atitude para essa competência
     */
    private $habilidadeDescricao = "";
    /**
     * @var string $conhecimentoDescricao breve descrição do que seria conhecimento para essa competência
     */
    private $conhecimentoDescricao = "";
    /**
     * @var string $arrayOAS array com os OAS associados ao objeto
     */
    private $arrayOAS = "";
    /**
     * @var boolean $user_is_logged_in Status para verificar se o usuário está logado
     */
    private $ultimo_ID = "";
    private $arrayOASBD = "";
    private $user_is_logged_in = false;
    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$criarCompetencia = new CriarCompetencia();"
     */
    public function __construct($donothing = null) // Essa construct tá certa, seguir modelo
    {
        if (isset($_POST["registrar_nova_competencia"])) {
            // Função para cadastro de nova competência
            //print_r($_POST);

            $this->criaCompetencia(
                $_POST['nome'],
                $_POST['descricaoNome'],
                $_POST['atitudeDescricao'], 
                $_POST['habilidadeDescricao'], 
                $_POST['conhecimentoDescricao'], 
                $_POST['user_id'],
                $_POST['arrayOAS'],
                $_POST['conhecimento'],
                $_POST['habilidade'],
                $_POST['atitude']
            );
        // Se não estiver cadastrando nova competência, no construct ele retorna valores vazios.
        }else{
            $this->idCompetencia = $this->nome = $this->descricaoNome = $this->atitudeDescricao = $this->habilidadeDescricao = $this->conhecimentoDescricao = $this->idProfessor = null;
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

    public function getID_byBD($nomeCompetencia = null){
        if($nomeCompetencia == null){
            $nomeCompetencia = $this->nome;
        }

        $query_get_id_disciplina = $this->db_connection->prepare('SELECT idcompetencia FROM competencia WHERE nome=:nome');
        $query_get_id_disciplina->bindValue(':nome', $nomeCompetencia, PDO::PARAM_STR);
        $query_get_id_disciplina->execute(array(':nome' => $nomeCompetencia));
        $result = $query_get_id_disciplina->fetchAll();
        if(count($result)>0)
            return $result[0]["idcompetencia"];
        else
            return (-1);

    }

    /**
     * Administra toda o sistema de Criação de competência
     * Verifica todos os erros possíveis e cria a competência se ela não existe
     */

    public function criaCompetencia($nome, $descricaoNome, $atitudeDescricao, $habilidadeDescricao, $conhecimentoDescricao, $idProfessor, $arrayOAS, $conhecimento, $habilidade, $atitude){
        // Remove espaços em branco em excesso das strings
        $nome = trim($nome);
        $descricaoNome = trim($descricaoNome);
        $atitudeDescricao = trim($atitudeDescricao);
        $habilidadeDescricao = trim($habilidadeDescricao);
        $conhecimentoDescricao = trim($conhecimentoDescricao);
        $arrayOAS = explode(',',$arrayOAS);
        // Atribuição das variáveis ao objeto
        $this->nome = $nome;
        $this->descricaoNome = $descricaoNome;
        $this->atitudeDescricao = $atitudeDescricao;
        $this->habilidadeDescricao = $habilidadeDescricao;
        $this->conhecimentoDescricao = $conhecimentoDescricao;
        $this->idProfessor = $idProfessor;
        $this->arrayOAS = $arrayOAS;

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
        } elseif (empty($arrayOAS)){
            $this->errors[] = MESSAGE_OAS_EMPTY;
        } elseif (strlen($nome) < 2) {
            $this->errors[] = MESSAGE_NAME_TOO_SHORT;
        }elseif ((max($conhecimento) > 5) || (min($conhecimento) < 0)) {
            $this->errors[] = MESSAGE_INVALID_CHA;
        }elseif ((max($habilidade) > 5) || (min($habilidade) < 0)) {
            $this->errors[] = MESSAGE_INVALID_CHA;
        }elseif ((max($atitude) > 5) || (min($atitude) < 0)) {
            $this->errors[] = MESSAGE_INVALID_CHA;                        
            //Fim de validações de dados de entrada
            //Inicio das validações de cadastro repitido
        } else if ($this->databaseConnection()) {
            // Verifica se a competência já existe
            // Essa query verifica se possuem nomes idênticos
            $query_check_nome_competencia = $this->db_connection->prepare('SELECT nome FROM competencia WHERE nome=:nome');
            $query_check_nome_competencia->bindValue(':nome', $nome, PDO::PARAM_STR);
            $query_check_nome_competencia->execute(array(':nome' => $nome));
            $result = $query_check_nome_competencia->fetchAll();
            // Se o nome da competência for encontrada no banco de dados
            if (count($result) > 0) {
                for ($i = 0; $i < count($result); $i++) {
                    //$this->errors[] = MESSAGE_COMPETENCIA_ALREADY_EXISTS . $nome;
                }
            } else{
                $stmt = $this->db_connection->prepare("INSERT INTO competencia(nome, descricao_nome, atitude_descricao, habilidade_descricao, conhecimento_descricao)  VALUES(:nome, :descricaoNome, :atitudeDescricao, :habilidadeDescricao, :conhecimentoDescricao)");
                $stmt->bindParam(':nome',$nome, PDO::PARAM_STR);
                $stmt->bindParam(':descricaoNome',$descricaoNome, PDO::PARAM_STR);
                $stmt->bindParam(':atitudeDescricao',$atitudeDescricao, PDO::PARAM_STR);
                $stmt->bindParam(':habilidadeDescricao',$habilidadeDescricao, PDO::PARAM_STR);
                $stmt->bindParam(':conhecimentoDescricao',$conhecimentoDescricao, PDO::PARAM_STR);
                //$stmt->bindParam(':idProfessor',$idProfessor, PDO::PARAM_INT);
                $stmt->execute();
                $this->ultimo_ID = $this->db_connection->lastInsertId();
                echo '<input type="hidden" id="competenciacadastrada" name="competenciacadastrada" value="'.$this->ultimo_ID.'" />';
                 // Cadastro na tabela Competencia_OA
                 //Associação com o banco de dados
                $count = count($arrayOAS)-1; //O explode pega um campo vazio
                //echo $count;
                //echo " ArrayOAS: ";
                //print_r($arrayOAS);
                for ($i = 0; $i < $count; $i++) {
                    $arrayOASBD = $arrayOAS[$i];
                    $c = $conhecimento[$arrayOASBD];
                    $h = $habilidade[$arrayOASBD];
                    $a = $atitude[$arrayOASBD];
                    $stmt = $this->db_connection->prepare("INSERT INTO competencia_oa(id_competencia, id_OA, conhecimento, habilidade, atitude) VALUES (:ultimo_ID, :arrayOASBD, :conhecimento, :habilidade, :atitude)");
                    $stmt->bindParam(':ultimo_ID',$this->ultimo_ID, PDO::PARAM_INT);
                    $stmt->bindParam(':arrayOASBD',$arrayOASBD, PDO::PARAM_INT);
                    $stmt->bindParam(':conhecimento',$c, PDO::PARAM_INT);
                    $stmt->bindParam(':habilidade',$h, PDO::PARAM_INT);
                    $stmt->bindParam(':atitude',$a, PDO::PARAM_INT);
                    $stmt->execute();
                }

                $this->messages[] = WORDING_COMPETENCIA. $nome . WORDING_CREATED_SUCESSFULLY;
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'index.php';
                echo "<script language='JavaScript'> setTimeout(function () {window.location='http://".$host.$uri."/".$extra."'; }, 100); </script> ";
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
//TODO SUBSTITUIR DISCIPLINA POR OA
            //Checa se já existe a relação entre essa disciplina e essa competência, para evitar de duplicar o relacionamento.
            $existeRelacao = false;
            $query_check_disc_comp = $this->db_connection->prepare('SELECT disciplina_iddisciplina FROM disciplina_competencia WHERE disciplina_iddisciplina=:idDisciplina AND competencia_idcompetencia=:idComp');
            $query_check_disc_comp->bindValue(':idDisciplina', $this->idCompetencia, PDO::PARAM_INT);
            $query_check_disc_comp->bindValue(':idComp', $idCompetencia, PDO::PARAM_INT);
            $query_check_disc_comp->execute( array(':idDisciplina' => $this->iddisciplina) );
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

    public function getArrayOfIDsById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT idcompetencia FROM competencia WHERE idCompetencia=:id");
            $stmt->bindValue(':id',$id, PDO::PARAM_INT);
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

    public function getArrayOfDescricao(){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT descricao_nome FROM competencia");
            $stmt->execute();
            $retorno = $stmt->fetchAll();
            return ($retorno);
        }
    }

    public function getArrayOfNamesById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT nome FROM competencia WHERE idCompetencia=:id");
            $stmt->bindValue(':id',$id, PDO::PARAM_INT);
            $stmt->execute();
            $retorno = $stmt->fetchAll(PDO::FETCH_NUM);
            return ($retorno);
        }
    }

    public function getNomeCompetenciaById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT nome FROM competencia WHERE idCompetencia=:id");
            //$stmt->bindParam(':nome',, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            //print_r($stmt->execute());
            return $stmt->fetchAll();
        }
    }

    public function getDescricaoConhecimentoById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT conhecimento_descricao FROM competencia WHERE idcompetencia=:id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }


    public function getDescricaoHabilidadeById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT habilidade_descricao FROM competencia WHERE idcompetencia=:id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }


        public function getDescricaoAtitudeById($id){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT atitude_descricao FROM competencia WHERE idcompetencia=:id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }


    public function associaOA($idOA){

        //TODO MODIFICAR. Está copiado do método associar competência, da classe disciplina.

        //Tratamento de ID da competência inválido
        if($this->idCompetencia <= 0 || $this->idCompetencia == null)
            $this->idCompetencia = $this->getID_byBD();

        //Validação de OA
        if($idOA <= 0 || $idOA == null || empty($idOA)){
            $this->errors[] = MESSAGE_COMPETENCIA_DOESNT_EXIST;
            //Validação da disciplina sendo editada
        }else if($this->idCompetencia <= 0 || $this->idCompetencia == null){
            $this->errors[] = MESSAGE_DISCIPLINA_DOESNT_EXIST;
        }else{

            //TODO DELT1 LEIA ISSO PELO AMOR DE GÓDI v
//PDO perde 2.5% de performance em consultas que não é preciso preparar as variáveis. Nas consultas como a de baixo, perde-se 6.5% A CADA CONSULTA.
            //TODO DELT1 LEIA ISSO PELO AMOR DE DEUS ^ Vamo parar de usar saporra
            //Sem contar que vamo sofrer sozinhos com os erros que possam vir a acontecer, ngm no NUTED usa PDO pra nos ajudar.
            //E o coitado do próximo bolsista vai ter que aprender esse traste tb. :P
            //Cláuser 26/09/14

            //Checa se já existe a relação entre esse OA e essa competência, para evitar de duplicar o relacionamento.
            $existeRelacao = false;
            $query_check_disc_comp = $this->db_connection->prepare('SELECT ID FROM competencia_oa WHERE id_competencia=:idCompetencia AND id_OA=:idOA');
            $query_check_disc_comp->bindValue(':idCompetencia', $this->idCompetencia, PDO::PARAM_INT);
            $query_check_disc_comp->bindValue(':idOA', $idOA, PDO::PARAM_INT);
            $query_check_disc_comp->execute(array(':idCompetencia' => $this->idCompetencia, ':idOA' => $idOA));
            $result = $query_check_disc_comp->fetchAll();
            if(count($result)>0){
                $existeRelacao = true;
                //$this->errors[] = MESSAGE_DISCIPLINA_COMPETENCIA_ALREADY_RELATED;
            }
            unset($query_check_disc_comp);

            if( (! $existeRelacao) && (strlen($this->errors) == 0) ){
                //Associar a competência com a OA pelo ID

                $stmt = $this->db_connection->prepare("INSERT INTO competencia_oa(id_OA,id_competencia)  VALUES(:idOA,:idComp )");
                $stmt->bindParam(':idOA',$idOA, PDO::PARAM_INT);
                $stmt->bindParam(':idComp',$this->idCompetencia, PDO::PARAM_INT);
                $stmt->execute(array(':idOA' => $idOA, ':idComp' => $this->idCompetencia));
                unset($stmt);
                return true;
            }else{
                return false;
            }
        }

    }
}
//Case de teste
$competencia = new Competencia();
$competencia->getDescricaoConhecimentoById(148);
//$competencia->criaCompetencia('nome','descricao','atitudedesc','habilidadedesc', 'conhhecimentodesc', 1);

?>

