
<?php
/**
 * User: Cláuser
 * Date: 21/01/2015
 * Time: 15:55
 */

class Recomendacao {

    private $db_connection = null;
    private $idDisc;
    private $competencia;
    private $user;
    private $mysqli;

    private $filtraComp;


    //disc é o ID da disciplina.
    //filtraComp é o array de IDs das competências que devem receber recomendação. Em caso de null, recomenda para todas as competências da disciplina.
    function __construct($disc, $filtraComp = null){

        $this->idDisc = $disc;
        //$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->filtraComp = $filtraComp;

        if (!isset($_SESSION))
          session_start();

        $this->user = $_SESSION['user_id'];
        //echo("ID Usuario: ".$_SESSION['user_id']."<br/>");
        //echo("Nome do Usuario: ".$_SESSION['user_name']);

        $this->associarCompetencias();
        $this->recomenda();
    }

    private function getCompDisc(){
    // Abre a conexão com o BD
    $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $dados = array();

    // Executa uma consulta
    $sql = $this->db_connection->prepare('SELECT competencia_idcompetencia FROM disciplina_competencia WHERE disciplina_iddisciplina=:idDisc');
    $sql->bindValue(':idDisc', $this->idDisc, PDO::PARAM_INT);
    $sql->execute();
    //$sql = "SELECT `competencia_idcompetencia` FROM `disciplina_competencia` WHERE `disciplina_iddisciplina` = $this->idDisc";
    //$query = $this->mysqli->query($sql);
    if($sql == false)
        return false;
    do{
        $result = $sql->fetch(PDO::FETCH_NUM);
        //$result = $query->fetch_array(MYSQLI_NUM);
        //echo 'Resultado: ';
        //print_r($result);
        if($result != NULL)
            array_push($dados,(int)$result[0]);
    }while($result !=NULL);

    if($dados != NULL){
        return $dados;
    }
    //$this->db_connection = null;
    return true;
    }

    private function associarCompetencias(){
        //Competências
        $listaComp = $this->getCompDisc();
        //print_r($listaComp);
        $this->competencia = array();
        $size = count($listaComp);
        for($c=0;$c<$size;$c++){

            if( is_array($this->filtraComp) ){
                if($this->deveMostrar( $listaComp[$c] ) ){
                    $comp = new Comp($listaComp[$c],$this->user,$this->idDisc);
                    array_push($this->competencia, $comp);
                    unset($comp);
                }
            }else{
                $comp = new Comp($listaComp[$c],$this->user,$this->idDisc);
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
            $temp = $this->competencia[$pos]->getID();
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


}
?>