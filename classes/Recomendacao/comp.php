<?php
/**
 * Created by PhpStorm.
 * User: Delton
 * Date: 23/09/14
 * Time: 17:19
 */

require_once('config/config.cfg');
require_once('translations/pt_br.php');

class Comp{

	private $oa;

	private $mysqli;

	private $idComp;

	private $chaUser;

	private $chaDisc;

	function __construct($idComp,$user,$disc){
		$this->oa = new lista();
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$this->idComp = $idComp;
		$this->getCHAuser($user);
		$this->getCHAdisc($disc);
	}

	//Verifica se $num é numérico maior que zero.
	private function isValid($num){
		if($num == null || !is_numeric($num)){
			return false;
		}else
			return true;
	}

	public function addOA($idOA){

		if($this->isValid($idOA)){

			$OA = array();
			$OA['ID'] = $idOA;			

			//Pegar CHA
			$sql="SELECT `conhecimento`, `habilidade`, `atitude` FROM `competencia_oa` WHERE `id_competencia`=$this->idComp AND `id_OA`=$idOA";
            $query = $this->mysqli->query($sql);
            do{
                $result = $query->fetch_assoc();
                if($result != NULL){
                    $OA['C']=(int)$result['conhecimento'];
                    $OA['H']=(int)$result['habilidade'];
                    $OA['A']=(int)$result['atitude'];
                }
            }while($result !=NULL);
            //CHA ^

			$this->oa->addMember($OA);

		}
		else
			echo "OA invalida";
	}

	public function removeOA($idOA){
		if($this->isValid($idOA)){
			$this->oa->removeMember($idOA);
		}
	}

	public function writeOAs(){

		echo("CHA Usuario: ".$this->chaUser['C']." ".$this->chaUser['H']." ".$this->chaUser['A']."<br/>");
		echo("CHA Disciplina: ".$this->chaDisc['C']." ".$this->chaDisc['H']." ".$this->chaDisc['A']."<br/>");

		echo ("Competencia: ".$this->idComp."<br/>");

		for($c=0;$c<$this->oa->getSize();$c++){

			$v=array();
			$v=$this->oa->getVector();
			//var_dump($v);


			echo ("ID: ".$v[$c]['ID']."<br/>");
			$conhecimento = $v[$c]['C'];
			$habilidade = $v[$c]['H'];
			$atitude = $v[$c]['A'];
			echo ("CHA: ".$v[$c]['C']." ".$v[$c]['H']." ".$v[$c]['A']);
		}
	}

	private function getCHAuser($user){
            $sql="SELECT `conhecimento`,`habilidade`, `atitude` FROM `usuario_competencias` WHERE `usuario_idusuario`=$user AND `competencia_idcompetencia`=$this->idComp";
            $query = $this->mysqli->query($sql);
            do{
                $result = $query->fetch_array(MYSQLI_ASSOC);
                if($result != NULL){

                    $this->chaUser['C']=(int)$result['conhecimento'];
                    $this->chaUser['H']=(int)$result['habilidade'];
                    $this->chaUser['A']=(int)$result['atitude'];
                }
            }while($result !=NULL);
	}

	private function getCHAdisc($disc){

        $sql="SELECT `conhecimento`,`habilidade`, `atitude` FROM `disciplina_competencia` WHERE `disciplina_iddisciplina`=$disc AND `competencia_idcompetencia`=$this->idComp";
        $query = $this->mysqli->query($sql);
        do{
        $dados = $query->fetch_array(MYSQLI_ASSOC);
            if($dados != NULL){
                $this->chaDisc['C']=(int)$dados['conhecimento'];
                $this->chaDisc['H']=(int)$dados['habilidade'];
                $this->chaDisc['A']=(int)$dados['atitude'];
            }
        }while($dados !=NULL);
	}

	public function getID(){return $this->idComp;}

}

?>