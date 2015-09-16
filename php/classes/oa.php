<?php
/**
 * User: Delton
 * Date: 24/09/14
 * Time: 18:25
 * Classe responsável pelo gerenciamento de Objetos de Aprendizagem (OA/Cesta)
 */

//if(class_exists('OA') != true){
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
    // Variáveis responsáveis pela categoria vida no banco de dados
    // -----------------------------INICIO CATEGORIA VIDA-----------------------------
    /**
     * @var date $time data em que OA foi cadastrado
     */
    private  $date                   = null;
    // -----------------------------FIM CATEGORIA VIDA--------------------------------
    // Variáveis responsáveis pela categoria técnica no banco de dados
    // -----------------------------INICIO CATEGORIA TÉCNICA-----------------------------
    /**
     * @var string $formaUtilizacao forma de utilizacão do OA:
     * Através de Browser
     * Através de Download
     */
    private   $formaUtilizacao       = "";
    /**
     * @var string $tipoFormato formato do OA [checkbox]:
     * Material multimídia
     * Video
     * Animação
     * Livro Digital
     * Jogo
     * Documento (PDF, Texto, Planilha)
     * Página da WEB
     */
    private   $tipoOA       = ""; //$tipoFormato
    // -----------------------------FIM CATEGORIA TÉCNICA--------------------------------
    // Variáveis responsáveis pela categoria eduacional no banco de dados
    // -----------------------------INICIO CATEGORIA EDUACIONAL-----------------------------
    /**
     * @var string $descricao_educacional breve descrição do OA
     */
    private   $descricao_educacional       = "";
     /**
     * @var string $faixaEtaria faixa etaria recomendada do OA
     * Educação Infantil
     * Ensino Fundamental
     * Ensino Médio
     * Ensino Profissionalizante
     * Ensino Superior
     */
     private   $faixaEtaria       = "";
    /**
     * @var string $recursoAprendizagem recurso de aprendizagem utilizado no OA
     * Exercício
     * Simulação
     * Questionário
     * Diagrama
     * Figura
     * Gráfico
     * Video
     * Indice
     * Slide
     * Tabela
     * Teste
     * Experiência
     * Texto
     * Problema
     * Auto Avaliação
     * Palestra
     */
    private   $recursoAprendizagem       = "";
    // -----------------------------FIM CATEGORIA EDUACIONAL--------------------------------
    // Variáveis responsáveis pela categoria direito no banco de dados
    // -----------------------------INICIO CATEGORIA DIREITO-----------------------------
    /**
     * @var boolean $custo se o OA teve custo (sim ou não)
     */
    private   $custo            = null;
    /**
     * @var boolean $direitoAutoral se o OA possui direito autoral (Sim ou não)
     */
    private   $direitoAutoral   = null;
    /**
     * @var string $uso descrição do uso do OA
     */
    private   $uso              = "";

    // -----------------------------FIM CATEGORIA DIREITO--------------------------------
    /**
     * @var int $idCategoriaVida ID da categoria vida
     */
    private   $idCategoriaVida    = null;
    /**
     * @var int $idCategoriaEduacional ID da categoria educacional
     */
    private   $idCategoriaEduacional    = null;
    /**
     * @var int $idCategoriaTecnica ID da categoria tecnica
     */
    private   $idCategoriaTecnica    = null;
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
     * @var array $arrayCompetencias Competências as quais esse objeto pode pertencer.
     */
    private $arrayCompetencias = array();
    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$criarCompetencia = new CriarCompetencia();"
     */
    public function __construct() // Essa construct tá certa, seguir modelo
    {
        if (isset($_POST["registrar_novo_OA"])) {
            // Função para cadastro de novo Objeto de Aprendizagem
            //print_r($_POST);
            //echo "</pre>";
            $this->criaOA(
                //Categoria vida:
                $_POST['date'],
                // Categoria Técnica
                $_POST['formaUtilizacao'],
                $_POST['tipoOA'],
                // Categoria Educacional
                $_POST['descricao_educacional'],
                $_POST['faixaEtaria'],
                $_POST['recursoAprendizagem'],
                // Categoria Direito
                $_POST['custo'],
                $_POST['direitoAutoral'],
                $_POST['uso'],
                // Dados Gerais
                $_POST['idusuario'],
                $_POST['descricao'],
                $_POST['nome'],
                $_POST['url'],
                $_POST['palavrachave'],
                $_POST['idioma'],
                // Dados da Competencia
                $_POST['arrayCompetencias'],
                $_POST['conhecimento'],
                $_POST['habilidade'],
                $_POST['atitude']
                );

        } elseif (isset($_POST["registrar_novo_OA_modal"])) {
                $this->criaOA(
                //Categoria vida:
                $_POST['date'],
                // Categoria Técnica
                $_POST['formaUtilizacao'],
                $_POST['tipoOA'],
                // Categoria Educacional
                $_POST['descricao_educacional'],
                $_POST['faixaEtaria'],
                $_POST['recursoAprendizagem'],
                // Categoria Direito
                $_POST['custo'],
                $_POST['direitoAutoral'],
                $_POST['uso'],
                // Dados Gerais
                $_POST['idusuario'],
                $_POST['descricao'],
                $_POST['nome'],
                $_POST['url'],
                $_POST['palavrachave'],
                $_POST['idioma'],
                // Dados da Competencia
                $_POST['arrayCompetencias'],
                0,
                0,
                0);               
        } elseif (isset($_POST["cadastro_OA"])) {
            foreach ($_POST as $key => $value)
                echo $key.'='.$value.'<br />';
            //$this->loginWithPostData($_POST['user_name'], $_POST['user_password'], $_POST['user_rememberme']);
        } // Se não estiver cadastrando nova competência, no construct ele retorna valores vazios.
        else{
            $this->this = null;
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
    public function criaOA(
        //O cadastro necessita ser nessa ordem!
        // Alterações realizadas no cadastro de OA após reunião 04/09 - Delton Vaz
        //Categoria vida:
        $date,
        //Categoria Técnica
        $formaUtilizacao,
        $tipoOA,
        //Categoria Educacional
        $descricao_eduacional,
        $faixaEtaria, // Pode ser mais de uma
        $recursoAprendizagem,
        //Categoria Direito
        $custo,
        $direitoAutoral,
        $uso,
        //Dados gerais
        $idusuario,
        $descricao,
        $nome,
        $url,
        $palavrachave,
        $idioma,
        // Dados da competência
        $arrayCompetencias,
        $conhecimento,
        $habilidade,
        $atitude){

        // -------------------------------------------/
        // Remover espaços em branco em excesso das strings
        $formaUtilizacao = trim($formaUtilizacao);
        $tipoOA = trim($tipoOA);

        // Categoria Educacional
        $descricao_eduacional = trim($descricao_eduacional);
        $faixaEtaria =  trim($faixaEtaria);
        $recursoAprendizagem = trim($recursoAprendizagem);

        // Categoria Direito
        $uso = trim($uso);

        // Categoria Geral
        $descricao= trim($descricao);
        $nome = trim($nome);
        $url = trim($url);
        $palavrachave = trim($palavrachave);
        $idioma =  trim($idioma);

        $arrayCompetencias = explode(',',$arrayCompetencias);

        // Atribuições das variáveis ao objeto

        // Categoria Vida
        $this->date = $date;

        // Categoria Técnica
        $this->formaUtilizacao = $formaUtilizacao;
        $this->tipoOA = $tipoOA;

        //Categoria Educacional
        $this->descricao_educacional = $descricao_eduacional;
        $this->faixaEtaria= $faixaEtaria;
        $this->recursoAprendizagem= $recursoAprendizagem;

        // Categoria Direito
        $this->custo = $custo;
        $this->direitoAutoral = $direitoAutoral;
        $this->uso = $uso;

        // Dados Gerais
        $this->descricao = $descricao;
        $this->nome = $nome;
        $this->url = $url;
        $this->palavraChave= $palavrachave;
        $this->idioma= $idioma;

        //echo 'chegou na validação de dados <br>';
        //TODO Validação de dados
        /*if (empty($nome)) {
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
        } else */
            if ($this->databaseConnection()) {
            // Verifica se o OA já existe
            // Essa query verifica se possuem URL's idênticos
            $query_check_OA = $this->db_connection->prepare('SELECT url, nome FROM cesta WHERE url=:url or nome=:nome');
            $query_check_OA->bindValue(':url', $url, PDO::PARAM_STR);
            $query_check_OA->bindValue(':nome', $nome, PDO::PARAM_STR);
            $query_check_OA->execute();
            $resultado = $query_check_OA->fetchAll();
            // Se a URL do OA ou Nome do OA for encontrado no banco de dados, quer dizer que já existe no banco de dados
            if (count($resultado) > 0) {
                for ($i = 0; $i < count($resultado); $i++) {
                    $this->errors[] = MESSAGE_OA_WITH_NAME_ALREADY_EXISTS;
                }

            } else{
                // Insert na categoria_direito
                $stmt = $this->db_connection->prepare("
                        INSERT INTO
                        categoria_direito(
                            custo,
                            direitoAutoral,
                            uso)
                        VALUES(
                            :custo,
                            :direitoAutoral,
                            :uso)");
                $stmt->bindParam(':custo',$custo, PDO::PARAM_INT);
                $stmt->bindParam(':direitoAutoral',$direitoAutoral, PDO::PARAM_INT);
                $stmt->bindParam(':uso',$uso, PDO::PARAM_STR);
                $stmt->execute();
                $rss = $stmt->fetchAll();
                $ultimoID = count($rss);
                //echo $ultimoID;
                //echo 'insert da categoria direito <br>';
                // Id categoria direito pega o last insert
                $this->idCategoriaDireito = $this->db_connection->lastInsertId();

                $this->db_connection = null; // Fechar a última conexão
                $this->databaseConnection(); // Abre Nova conexão

                // Insert na categoria educacional
                // TODO ARRUMAR NO BANCO DE DADOS PARA CATEGORIA_EDUCACIONAL
                $stmt = $this->db_connection->prepare("
                        INSERT INTO
                        categoria_eduacional(
                            descricao,
                            faixaEtaria,
                            recursoAprendizagem)
                        VALUES(
                            :descricao_educacional,
                            :faixaEtaria,
                            :recursoAprendizagem)");
                $stmt->bindParam(':descricao_educacional',$descricao_eduacional, PDO::PARAM_STR);
                $stmt->bindParam(':faixaEtaria',$faixaEtaria, PDO::PARAM_STR);
                $stmt->bindParam(':recursoAprendizagem',$recursoAprendizagem, PDO::PARAM_STR);
                $stmt->execute();
                // Id categoria educacional pega o last insert
                $this->idCategoriaEduacional = $this->db_connection->lastInsertId();
                //echo 'id categoria educacional: '. $this->db_connection->lastInsertId() . '<br>';
                $this->db_connection = null; // Fechar a última conexão
                $this->databaseConnection(); // Abre Nova conexão

                // Insert na categoria técnica
                // Delton Vaz - 14/09 - Alterações Reunião 04/09 
                // 'formaUtilizacao' é a nova variável para 'tipoTecnologia'
                // 'tipoOA' é a nova variável para 'formato'
                $stmt = $this->db_connection->prepare("
                        INSERT INTO
                        categoria_tecnica(
                            tipoTecnologia,
                            tipoFormato)
                        VALUES(
                            :formaUtilizacao,
                            :tipoOA)");
                $stmt->bindParam(':formaUtilizacao',$formaUtilizacao, PDO::PARAM_STR);
                $stmt->bindParam(':tipoOA',$tipoOA, PDO::PARAM_STR);
                $stmt->execute();
                // Id categoria técnica
                $this->idCategoriaTecnica = $this->db_connection->lastInsertId();
                $this->db_connection = null; // Fechar a última conexão
                $this->databaseConnection(); // Abre Nova conexão
                // Insert na categoria vida
                $stmt = $this->db_connection->prepare("
                        INSERT INTO
                        categoria_vida(
                            data_2)
                        VALUES(
                            :date)");
                $stmt->bindParam(':date',$date, PDO::PARAM_STR);
                $stmt->execute();
                // Id categoria vida
                $this->idCategoriaVida = $this->db_connection->lastInsertId();
                $this->db_connection = null; // Fechar a última conexão
                $this->databaseConnection(); // Abre Nova conexão
                // Insert na CESTA
                $stmt = $this->db_connection->prepare("
                        INSERT INTO
                        cesta(
                            idcategoria_vida,
                            idcategoria_tecnica,
                            idcategoria_eduacional,
                            idusuario,
                            idcategoria_direito,
                            descricao,
                            nome,
                            url,
                            palavraChave,
                            idioma)
                        VALUES(
                            :idcategoria_vida,
                            :idcategoria_tecnica,
                            :idcategoria_educacional,
                            :idusuario,
                            :idcategoria_direito,
                            :descricao,
                            :nome,
                            :url,
                            :palavraChave,
                            :idioma)");
                $stmt->bindParam(':idcategoria_vida',$this->idCategoriaVida, PDO::PARAM_INT);
                $stmt->bindParam(':idcategoria_tecnica',$this->idCategoriaTecnica, PDO::PARAM_INT);
                $stmt->bindParam(':idcategoria_educacional',$this->idCategoriaEduacional, PDO::PARAM_INT);
                $stmt->bindParam(':idusuario',$idusuario, PDO::PARAM_INT);
                $stmt->bindParam(':idcategoria_direito',$this->idCategoriaDireito, PDO::PARAM_INT);
                $stmt->bindParam(':descricao',$descricao, PDO::PARAM_STR);
                $stmt->bindParam(':nome',$nome, PDO::PARAM_STR);
                $stmt->bindParam(':url',$url, PDO::PARAM_STR);
                $stmt->bindParam(':palavraChave',$palavrachave, PDO::PARAM_STR);
                $stmt->bindParam(':idioma',$idioma, PDO::PARAM_STR);
                $stmt->execute();

                $lastID = $this->db_connection->lastInsertId();
                echo '<input type="hidden" id="oacadastrado" name="oacadastrado" value="'.$lastID.'" />';
                $count = count($arrayCompetencias)-1;
                for ($i = 0; $i < $count; $i++) {
                    $arrayCompBD = $arrayCompetencias[$i];
                    $c = $conhecimento[$arrayCompBD];
                    $h = $habilidade[$arrayCompBD];
                    $a = $atitude[$arrayCompBD];
                    $stmt = $this->db_connection->prepare("INSERT INTO competencia_oa(id_competencia, id_OA, conhecimento, habilidade, atitude) VALUES (:arrayCompBD, :ultimo_ID_OA, :conhecimento, :habilidade, :atitude)");
                    $stmt->bindParam(':arrayCompBD',$arrayCompBD, PDO::PARAM_INT);
                    $stmt->bindParam(':ultimo_ID_OA',$lastID, PDO::PARAM_INT);
                    $stmt->bindParam(':conhecimento',$c, PDO::PARAM_INT);
                    $stmt->bindParam(':habilidade',$h, PDO::PARAM_INT);
                    $stmt->bindParam(':atitude',$a, PDO::PARAM_INT);
                    $stmt->execute();
                }


                //echo 'aqui2';
                $this->messages[] = WORDING_OA. ' ' .$nome.WORDING_CREATE_SUCESSFULLY;
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'index.php';
                echo "<script language='JavaScript'> setTimeout(function () {window.location='http://".$host.$uri."/".$extra."';}, 100); </script> ";
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

    public function getArrayOfId_OA(){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT idcesta FROM cesta");
            $stmt->execute();
            $retorno = $stmt->fetchAll();
            return ($retorno);
        }
    }

    public function getArrayOfName_OA(){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT nome FROM cesta");
            $stmt->execute();
            $retorno = $stmt->fetchAll();
            return ($retorno);
        }
    }

    public function getArrayOfDescricao_OA(){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT descricao FROM cesta");
            $stmt->execute();
            $retorno = $stmt->fetchAll();
            return ($retorno);
        }
    }

    public function getArrayOfUrl_OA(){
        if($this->databaseConnection()){
            $stmt = $this->db_connection->prepare("SELECT url FROM cesta");
            $stmt->execute();
            $retorno = $stmt->fetchAll();
            return ($retorno);
        }
    }

    /**
     * Função que retorna dados de um OA
     * @param $idOA
     */
    public function getDadosOA($idOA){
        $database = new Database();
        $sql = "SELECT * FROM cesta WHERE idcesta = :idOA";
        $database->query($sql);
        $database->bind(":idOA", $idOA);
        return $database->resultSet();
    }

    /**
     * Função que retorna dados da categoria vida de um OA
     * @param $idCategoriaVida
     */
    public function getDadosCategoriaVidaOA($idCategoriaVida){
        $database = new Database();
        $sql = "SELECT * FROM categoria_vida WHERE idcategoria_vida = :idCategoriaVida";
        $database->query($sql);
        $database->bind(":idCategoriaVida", $idCategoriaVida);
        return $database->resultSet();
    }
    
} // Fecha CLass


//Case de teste
/*
$OA = new OA();
$OA->criaOA(time(), 'status', 'versao', 'entidade', 'contribuicao', 'tempo_video',
    'tamanho',
    'tipoTecnologia',
    'tipoFormato',
    'descricaoeducacional',
    'niveliteratividade',
    'tipoiteratividade',
    'faixaetaria',
    'recursoaprendizagem',
    'usuariofinal',
    'ambiente',
    1,
    1,
    'uso',
     1,
    'descricao',
    'nomedfgdfghfhfg234',
    'url3dfgdffghfghfgg45435',
    'palavrachave',
    'idioma');
?>
*/