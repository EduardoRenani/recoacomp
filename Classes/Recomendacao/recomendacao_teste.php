
<?php
/**
 * User: Cláuser
 * Date: 21/01/2015
 * Time: 15:55
 */
require_once("config/config.cfg");
require_once("classes/lista.php");
require_once("classes/Recomendacao/comp_teste.php");

class RecomendacaoTeste {

    private $db_connection = null;
    private $idDisc;
    private $competencia;
    private $user;
    private $conhecimento;
    private $habilidade;
    private $atitude;
    private $mysqli;

    private $filtraComp;


    //disc é o ID da disciplina.
    //filtraComp é o array de IDs das competências que devem receber recomendação. Em caso de null, recomenda para todas as competências da disciplina.
    function __construct($disc, $filtraComp = null){
        $this->idDisc = $disc;
        $this->filtraComp = $filtraComp;
        if (!isset($_SESSION))
            session_start();
        $this->user = $_SESSION['user_id'];
        $this->conhecimento = $_POST['conhecimento'];
        $this->habilidade = $_POST['habilidade'];
        $this->atitude = $_POST['atitude'];
        
        $this->associarCompetencias($_POST['competencias']);
        // Atualizar dados do usuário no banco de dados
        //$this->atualizarCompetencias($this->user,$_POST['competencias'], $_POST['conhecimento'], $_POST['habilidade'], $_POST['atitude']);

        $this->recomenda();
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


    private function associarCompetencias($listaComp){
        // Indice são os numeros da competência para recomendar
        // CompTeste é uma classe que está instanciada com dados temporários
        $this->competencia = array();
        $size = count($listaComp);
        for($c=0;$c<$size;$c++){
            $indice = $listaComp[$c];
            if( is_array($this->filtraComp) ){
                if($this->deveMostrar( $listaComp[$c] ) ){
                    $comp = new CompTeste($listaComp[$c],$this->user,$this->idDisc, $this->conhecimento[$indice], $this->habilidade[$indice], $this->atitude[$indice]);
                    array_push($this->competencia, $comp);
                    unset($comp);
                }
            }else{
                $comp = new CompTeste($listaComp[$c],$this->user,$this->idDisc, $this->conhecimento[$indice], $this->habilidade[$indice], $this->atitude[$indice]); //Onde Comp é inicializado
                array_push($this->competencia, $comp);
                unset($comp);           
            }
        }
        unset ($size);
        unset ($listaComp);
    }

    private function recomendaCompAtual($pos){
    // Abre conexão com o BD
        //Associar Objetos à Competência:
            //Receber objetos do banco de dados:
            $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            $temp = $this->competencia[$pos]->getID(); // Pega o ID da competência
            $objetosDaCompetencia = array();

                // Executa uma consulta
            $sql = $this->db_connection->prepare('SELECT id_OA FROM competencia_oa WHERE id_competencia=:temp');
            $sql->bindValue(':temp', $temp, PDO::PARAM_INT);
            $sql->execute();
            //$sql="SELECT `id_OA` FROM `competencia_oa` WHERE `id_competencia`= $temp";
            unset ($temp);
            //$query = $this->mysqli->query($sql);
            do{
                $result = $sql->fetch(PDO::FETCH_NUM);
                if($result != NULL){
                    array_push($objetosDaCompetencia,(int)$result[0]);
                    //echo $result[0];
                }
            }while($result !=NULL);
            
            //print_r($objetosDaCompetencia); // Imprime os objetos da competência
            //Associar de fato:
            
            $qtdOA = count($objetosDaCompetencia);
            
            for($idOA=0;$idOA<$qtdOA;$idOA++){
                $this->competencia[$pos]->addOA( (int)$objetosDaCompetencia[ $idOA ] );
            }
            


            $this->competencia[$pos]->ordenaOAs();

            $this->competencia[$pos]->nomearOAs();

            $this->competencia[$pos]->writeOAs();
            //$this->db_connection = null;

    }

    private function recomenda(){

        $compAtual=0;
        $contComp=count($this->competencia);

        //echo $contComp;
        for($compAtual;$compAtual<$contComp;$compAtual++){
            //echo 'aqu2';
            $this->recomendaCompAtual($compAtual);

        }
    }
    //Função que verifica se o objeto deve ser mostrado na recomendação.
    private function deveMostrar($id){

        $cont = count($this->filtraComp);

        for($i=0;$i<$cont;$i++){
            if ( $this->filtraComp[$i] == $id)
                return true;
        }

        return false;

    }

    private function atualizarCompetencias($idUsuario ,$competencias, $conhecimento, $habilidade, $atitude){
        foreach ($competencias as $idCompetencia){
            if($this->databaseConnection()){
                $stmt = $this->db_connection->prepare("INSERT INTO usuario_competencias(usuario_idusuario, competencia_idcompetencia, conhecimento, atitude, habilidade)  VALUES(:idUsuario, :idCompetencia, :conhecimento, :atitude, :habilidade)");
                $stmt->bindParam(':idUsuario',$idUsario, PDO::PARAM_INT);
                
                $stmt->bindParam(':idCompetencia',$idCompetencia, PDO::PARAM_INT);
                $stmt->bindParam(':habilidade',$habilidade[$idCompetencia], PDO::PARAM_INT);
                $stmt->bindParam(':conhecimento',$conhecimento[$idCompetencia], PDO::PARAM_INT);
                $stmt->bindParam(':atitude',$atitude[$idCompetencia], PDO::PARAM_INT);
                $stmt->execute();
            }
        }            
    }


}
?>