<?php
/**
 * User: Cláuser
 * Date: 21/01/2015
 * Time: 15:55
 */
require_once("config/config.cfg");
require_once("classes/lista.php");
class Recomendacao2 {

	private $idDisc;
	private $competencia;
	private $user;
	private $mysqli;

	function __construct($disc){

        $this->idDisc=$disc;
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		session_start();
		$this->user = $_SESSION['user_id'];
		echo("Usuario: ".$_SESSION['user_id']);

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
        //$cont = count($dados);
        //for($i=0;$i<$cont;$i++){
        //    array_push($id_competencias_disciplina,(int)$dados[$i]);
        //}
        return $dados;
    }
    //var_dump($this->id_competencias_disciplina);
    return true;
	}

    private function associarCompetencias(){
        //Competências
        $listaComp = $this->getCompDisc();
        $this->competencia = array();
        $size = count($listaComp);
        for($c=0;$c<$size;$c++){
            $comp = new Comp($listaComp[0],$this->user,$this->idDisc);
            array_push($this->competencia, $comp);
            unset($comp);
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
                $this->competencia[$pos]->addOA((int)$idOA);
            }

             $this->competencia[$pos]->writeOAs();

    }

    private function recomenda(){

        $compAtual=0;
        $contComp=count($this->competencia);

        for($compAtual;$compAtual<$contComp;$compAtual++){

            $this->recomendaCompAtual($compAtual);

        }
    }

}