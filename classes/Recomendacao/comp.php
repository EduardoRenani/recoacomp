
<?php
/**
 * User: Cláuser
 */

require_once('config/config.cfg');
require_once('translations/pt_br.php');
require_once('classes/Competencia.php');


class Comp{

    /**
     * @var object $db_connection The database connection
     */
    private $db_connection            = null;

	private $oa;

	private $mysqli;

	private $idComp;

	private $nomeComp;

	private $descricaoComp;
	/*Essas variáveis serão mantidas em caso de, no futuro, haver modificações na recomendação e precisar de conhecimento,
	habilidade e atitude separadas. Não me agradeça, querido futuro bolsista. Apenas dê 3 pulinhos, reze um pai nosso e
	32 ave marias.
	Cláuser, 04/02/15*/
	private $chaUser;
	private $chaDisc;

	private $chaUserS;
	private $chaDiscS;


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

	function __construct($idComp,$user,$disc){
		$this->oa = new lista();
		$this->databaseConnection();
		//$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$this->idComp = $idComp;
		$this->getCHAuser($user);
		$this->getCHAdisc($disc);
		$this->setNome();
		$this->setDescricao();
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

			$sql_PDO = $this->db_connection->prepare('SELECT conhecimento, habilidade, atitude FROM competencia_oa WHERE id_competencia=:idComp AND id_OA=:idOA');
			$sql_PDO->bindValue(':idComp', $this->idComp, PDO::PARAM_INT);
        	$sql_PDO->bindValue(':idOA', $idOA, PDO::PARAM_INT);
         	$sql_PDO->execute();
            do{
                //$result = $query->fetch_assoc();
                $result = $sql_PDO->fetch(PDO::FETCH_ASSOC);
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

	public function old_writeOAs(){

		//echo "<hr/>";


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


	// Função que imprime a recomendação
	public function writeOAs(){

		$cont = $this->oa->getSize();
		$v=array();
		$v=$this->oa->getVector();

		
		echo "<div class='recomendacao-content'>";

			echo "<ul class='disciplinas-list'>";

			echo "<div id='conteudo' class='conteudo clearfix'><li class='recomendacao-item' style='margin-bottom: 0;'>
						<div class='recomendacao-item-content'> 
							<h3>Competência: ".$this->nomeComp."</h3>
							<p>".$this->descricaoComp."</p>
						</div>
							<button type='button' class='btn-recomendacao btn-default btn-lg'>
							  <span class='glyphicon glyphicon-plus' aria-hidden='true'></span>
							</button>
						
					</li></div><div id='conteudo-expansivel'>";

			for($c=0;$c<$cont;$c++){

				//var_dump($v);

				echo"<li class='disciplinas-item'  style='border-bottom: 1px solid #ddd; margin-bottom: 0; width: 95%; margin: auto;'>";

	                    echo "<div class='recomendacao-item-content'>";

	                    		echo "<h3>".$v[$c]['nome']."</h3>";

	                    		echo "<h6>".$v[$c]['descricao']."</h6><br/>";

	                    		echo "<a href='".$v[$c]['url']."'>Acessar Objeto de Aprendizagem</a><b>";

                		echo "</div>";

                		echo "<div class='circulo-recomendacao' style='background-color:";

	                    	//Deve exibir verde!
							if($v[$c]['res'] == 1 || $v[$c]['res'] == 2){

								echo "#C4DA5B;";

							//Deve exibir amarelo
							}else if($v[$c]['res'] < 1 && $v[$c]['res'] >=-4){

								echo "#FCEF53;";

							//Deve exibir vermelho!
							}else{

								echo "#ED2825;";

							}

						echo '\'">';



	                	echo "</b></div>".
	            	"</li>";

	    	}

	    	echo "</div></ul>".
    	"</div>";

	}

	private function getCHAuser($user){
			$sql_PDO = $this->db_connection->prepare('SELECT conhecimento, habilidade, atitude FROM usuario_competencias WHERE usuario_idusuario=:user AND competencia_idcompetencia=:idComp');
			$sql_PDO->bindValue(':user', $user, PDO::PARAM_INT);
        	$sql_PDO->bindValue(':idComp', $this->idComp, PDO::PARAM_INT);
         	$sql_PDO->execute();
           	do{
                $result = $sql_PDO->fetch(PDO::FETCH_ASSOC);
                //$result = $query->fetch_array(MYSQLI_ASSOC);
                if($result != NULL){

                    $this->chaUser['C']=(int)$result['conhecimento'];
                    $this->chaUser['H']=(int)$result['habilidade'];
                    $this->chaUser['A']=(int)$result['atitude'];
                }
            }while($result !=NULL);

            $this->chaUserS = $this->chaUser['C'] + $this->chaUser['H'] + $this->chaUser['A'];

	}

	private function getCHAdisc($disc){

		$sql_PDO = $this->db_connection->prepare('SELECT conhecimento, habilidade, atitude FROM disciplina_competencia WHERE disciplina_iddisciplina=:disc AND competencia_idcompetencia=:idComp');
		$sql_PDO->bindValue(':disc', $disc, PDO::PARAM_INT);
    	$sql_PDO->bindValue(':idComp', $this->idComp, PDO::PARAM_INT);
     	$sql_PDO->execute();
        do{
        //$dados = $query->fetch_array(MYSQLI_ASSOC);
        $dados = $sql_PDO->fetch(PDO::FETCH_ASSOC);
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

	public function nomearOAs(){

		$cont = $this->oa->getSize();
		$v=array();
		$v=$this->oa->getVector();

		$result=array();

		for($c=0;$c<$cont;$c++){

     //if($stmt = $this->mysqli -> prepare("SELECT `nome`, `descricao`, `url` FROM  `cesta` WHERE `idcesta` = ?")) {

	        /* Create a prepared statement */
	        if($sql_PDO = $this->db_connection->prepare('SELECT nome, descricao, url FROM cesta WHERE idcesta=:idCesta')) {

	            /* Bind parameters
	            s - string, b - blob, i - int, etc */
	            $sql_PDO->bindValue(':idCesta', $v[$c]['ID'], PDO::PARAM_INT);
	            //$stmt -> bind_param("i", $v[$c]['ID'] ); //ID do objeto atual.

	            /* Execute it */
	    		$sql_PDO->execute();

	            /* Bind results */
				//$stmt -> bind_result($v[$c]['nome'],$v[$c]['descricao'],$v[$c]['url']);
				$sql_PDO->bindColumn('nome', $v[$c]['nome']);
				$sql_PDO->bindColumn('descricao', $v[$c]['descricao']);
				$sql_PDO->bindColumn('url', $v[$c]['url']);


	            /* Fetch the value */
	            while ($sql_PDO->fetchAll()){
	                
	            }

	            /* Close statement */
	            //$stmt -> close();
	        }

	    }

        /* Close connection */
        //$this->mysqli -> close();

        unset($this->oa);
        $this->oa = new lista($v);

	}

	private function setNome(){

		/* Create a prepared statement */
		if($sql_PDO = $this->db_connection->prepare('SELECT nome FROM competencia WHERE idcompetencia=:idCompetencia')) {
        //if($stmt = $this->mysqli -> prepare("SELECT `nome` FROM `competencia` WHERE `idcompetencia`=?")) {

            /* Bind parameters
            s - string, b - blob, i - int, etc */
            //$stmt -> bind_param("i", $this->idComp); //ID do objeto atual.
			$sql_PDO->bindValue(':idCompetencia', $this->idComp, PDO::PARAM_INT);

            /* Execute it */
            $sql_PDO->execute();

            /* Bind results */
            //$stmt -> bind_result($this->nomeComp);
            $sql_PDO->bindColumn('nome', $this->nomeComp);

            /* Fetch the value */
            while ($sql_PDO->fetchAll()){
                
            }

            /* Close statement */
            //$stmt -> close();
        }

	}


	private function setDescricao(){

		/* Create a prepared statement */
		if($sql_PDO = $this->db_connection->prepare('SELECT descricao_nome FROM competencia WHERE idcompetencia=:idCompetencia')) {
        //if($stmt = $this->mysqli -> prepare("SELECT `nome` FROM `competencia` WHERE `idcompetencia`=?")) {

            /* Bind parameters
            s - string, b - blob, i - int, etc */
            //$stmt -> bind_param("i", $this->idComp); //ID do objeto atual.
			$sql_PDO->bindValue(':idCompetencia', $this->idComp, PDO::PARAM_INT);

            /* Execute it */
            $sql_PDO->execute();

            /* Bind results */
            //$stmt -> bind_result($this->nomeComp);
            $sql_PDO->bindColumn('descricao_nome', $this->descricaoComp);

            /* Fetch the value */
            while ($sql_PDO->fetchAll()){
                
            }

            /* Close statement */
            //$stmt -> close();
        }

	}

	public function getNome(){
		return $this->nomeComp;
	}

}


?>