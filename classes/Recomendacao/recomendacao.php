
<?php
/**
 * User: Cláuser
 * Date: 21/01/2015
 * Time: 15:55
 */
require_once("config/config.cfg");
require_once("classes/lista.php");
require_once("classes/Recomendacao/comp.php");

class Recomendacao {

	private $idDisc;
	private $competencia;
	private $user;
	private $mysqli;

    private $filtraComp;

	//disc é o ID da disciplina.
	//filtraComp é o array de IDs das competências que devem receber recomendação. Em caso de null, recomenda para todas as competências da disciplina.
	function __construct($disc, $filtraComp = null){

        $this->idDisc = $disc;
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
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
		
    $dados = array();

    // Executa uma consulta
    $sql = "SELECT `competencia_idcompetencia` FROM `disciplina_competencia` WHERE `disciplina_iddisciplina` = $this->idDisc";
    $query = $this->mysqli->query($sql);

    if($query == false)
        return false;

    do{
        $result = $query->fetch_array(MYSQLI_NUM);
        if($result != NULL)
            array_push($dados,(int)$result[0]);
    }while($result !=NULL);

    if($dados != NULL){
        return $dados;
    }
    
    return true;
	}

    private function associarCompetencias(){
        //Competências
        $listaComp = $this->getCompDisc();
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

        //Associar Objetos à Competência:
            //Receber objetos do banco de dados:
            $temp = $this->competencia[$pos]->getID();
            $objetosDaCompetencia = array();
            $sql="SELECT `id_OA` FROM `competencia_oa` WHERE `id_competencia`= $temp";
            unset ($temp);
            $query = $this->mysqli->query($sql);
            do{
                $result = $query->fetch_array(MYSQLI_NUM);
                if($result != NULL){
                    array_push($objetosDaCompetencia,(int)$result[0]);
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

    }

    private function recomenda(){

        $compAtual=0;
        $contComp=count($this->competencia);

        for($compAtual;$compAtual<$contComp;$compAtual++){

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