
<?php
/**
 * User: Cláuser
 */

require_once('config/config.cfg');
require_once('translations/pt_br.php');

class Comp{

	private $oa;

	private $mysqli;

	private $idComp;

	/*Essas variáveis serão mantidas em caso de, no futuro, haver modificações na recomendação e precisar de conhecimento,
	habilidade e atitude separadas. Não me agradeça, querido futuro bolsista. Apenas dê 3 pulinhos, reze um pai nosso e
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

			if($v[$c]['res'] == 1 || $v[$c]['res'] == 2)
				echo ("ID do OA: <font color='Green'><b>".$v[$c]['ID']."</b></font><br/>");
			else if($v[$c]['res'] < 1 && $v[$c]['res'] >=-4)
				echo ("ID do OA: <font color='Orange'><b>".$v[$c]['ID']."</b></font><br/>");
			else
				echo ("ID do OA: <font color='Red'><b>".$v[$c]['ID']."</b></font><br/>");
			
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

		/*Preparar vetor de resultados de OAs: vetorRes
		 * $vetorOA: 0 {ID,C,H,A,chaS,res} , 1 {ID,C,H,A,chaS,res}, ...
		 * $vetorRes: 0 {res}, 1 {res}, 2 {res}, ...
		*/
		$vetorOA = $this->oa->getVector();
		$vetorRes = array();
		$cont = count($vetorOA);
		for($c=0;$c<$cont;$c++){
			array_push($vetorRes,$vetorOA[$c]['res']);
		}

		/*Agora vamos aproveitar o método ordenate da classe Lista:
			1: Criaremos um objeto do tipo lista e iniciá-lo-emos com o vetor $vetorRes.
			2: Ordenaremos de +1 a +2.
			3: Ordenaremos de 0 a -4
			4: Ordenaremos de +3 a +4
		*/

			// (1)
		$list = new Lista($vetorRes);

			// (2)
		//$posicoes é um array com as posições do vetor $vetorRes ordenadas de forma que a recomendação fique correta.
		$posicoes=array();

		$matriz = $list->ordenate(1,2);
		$cont = count($matriz[1]);
		for($i=0;$i<$cont;$i++)
		    array_push($posicoes,$matriz[1][$i]);
		
			// (3)
		unset($matriz);

		$matriz = $list->ordenate(0,-4);
		$cont = count($matriz[1]);
		for($i=0;$i<$cont;$i++)
		    array_push($posicoes,$matriz[1][$i]);

			// (4)
		unset($matriz);

		$matriz = $list->ordenate(3,4);
		$cont = count($matriz[1]);
		for($i=0;$i<$cont;$i++)
		    array_push($posicoes,$matriz[1][$i]);

		//Agora, no vetor $posicoes devemos ter as posições de $vetorRes (consequentemente de $vetorOA e do vetor de $this->oa)
		//ordenadas na forma que deveriam estar.

		$vetorOA_temp=array();

		$cont= count($posicoes);
		for($i=0;$i<$cont;$i++)
			array_push($vetorOA_temp,$vetorOA[ $posicoes[ $i ] ]);

		unset($this->oa);
		$this->oa = new Lista();
		$cont = count($vetorOA_temp);

		for($i=0;$i<$cont;$i++){
			$this->oa->addMember( $vetorOA_temp[$i] );
		}

	}

}

?>