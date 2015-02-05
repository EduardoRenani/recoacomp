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

	/*Essas variáveis serão mantidas em caso de, no futuro, haver modificações na recomendação e precisar de conhecimento,
	habilidade e atitude separadas. Não me agradeça, querido futuro bolsista. Apenas dê 3 pulinhos e reze um pai nosso e
	32 ave marias.
	Cláuser, 04/02/15*/
	private $chaUser;
	private $chaDisc;

	private $chaUserS;
	private $chaDiscS;

	function __construct($idComp,$user,$disc){
		$this->oa = new lista();
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$this->idComp = $idComp;
		$this->getCHAuser($user);
		$this->getCHAdisc($disc);
	}

	//Verifica se $num é numérico maior que zero.
	private function isValid($num){
		if($num == null/* || !is_numeric($num)*/){
			return false;
		}else
			return true;
	}

	public function addOA($idOA){

		//if($this->isValid($idOA)){

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
                    $OA['chaS']=$OA['C']+$OA['H']+$OA['A'];
                    //No .doc é relativo ao VC + VH + VA. Ver pg. 3.
                    $OA['res'] = $OA['chaS'] - $this->chaUserS;
                    //var_dump($OA);
                }
            }while($result !=NULL);
            //CHA ^

			$this->oa->addMember($OA);
			/*
		}
		else
			echo "OA invalida";*/
	}

	public function removeOA($idOA){
		if($this->isValid($idOA)){
			$this->oa->removeMember($idOA);
		}
	}

	public function writeOAs(){

		echo "<hr/>";


		echo ("ID da Competencia: <b>".$this->idComp."</b><br/>");
		echo("CHA Usuario: ".$this->chaUser['C']." ".$this->chaUser['H']." ".$this->chaUser['A']."<br/>");
		echo("Soma CHA Usuario: ".$this->chaUserS."<br/>");
		echo("CHA Disciplina: ".$this->chaDisc['C']." ".$this->chaDisc['H']." ".$this->chaDisc['A']."<br/>");
		echo("Soma CHA Disciplina: ".$this->chaDiscS."<br/><br/>");

		$cont = $this->oa->getSize();
		$v=array();
		$v=$this->oa->getVector();
		for($c=0;$c<$cont;$c++){
			echo"<ul><li>";
			echo ("ID do OA: ".$v[$c]['ID']."<br/>");
			
			//	conhecimento = $v[$c]['C'];
			//	habilidade = $v[$c]['H'];
			//	atitude = $v[$c]['A'];

			echo ("CHA do OA: ".$v[$c]['C']." ".$v[$c]['H']." ".$v[$c]['A']."<br/>");
			echo "Soma CHA do OA: ".$v[$c]['chaS']."<br/>";
			echo "Resultado: ".$v[$c]['res']."<br/><br/>";

			echo"</li></ul>";
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

            $this->chaUserS = $this->chaUser['C'] + $this->chaUser['H'] + $this->chaUser['A'];
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

        $this->chaDiscS = $this->chaDisc['C'] + $this->chaDisc['H'] + $this->chaDisc['A'];
	}

	public function getID(){return $this->idComp;}

	public function ordenaOAs(){

		//Preparar vetor de resultados de OAs
		$v = $this->oa->getVector();
		$listaOA = new Lista();
		$cont = $this->oa->getSize();
		$vet = array();
		for($c=0;$c<$cont;$c++){
			array_push($vet,$v[$c]['res']);
		}

		//Ordenar:
			//1 a 2
		$matriz = $listaOA->ordenate(1,2);

		$cont = count($matriz[1]);
		for($i=0;$i<$cont;$i++){
			$oa3[$i] = $this->oa[ $matriz[1][$i] ];
		}
			//0 a -4
		$matriz=null;
		$matriz = $listaOA->ordenate(0,-4);

		$cont = count($matriz[1]);
		for($i=0;$i<$cont;$i++){
			array_push($oa3, $this->oa[ $matriz[1][$i] ]);
		}

			//3 a 4
		$matriz=null;
		$matriz = $listaOA->ordenate(3,4);

		$cont = count($matriz[1]);
		for($i=0;$i<$cont;$i++){
			array_push($oa3, $this->oa[ $matriz[1][$i] ]);
		}

		$this->oa=null;
		$this->oa=array();
		$cont = count($oa3);
		for($i=0;$i<$cont;$i++)
			array_push($this->oa, $oa3[$i]);

	}

}

?>