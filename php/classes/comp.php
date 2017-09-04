
<?php
/**
 * User: Cláuser
 */



class Comp{

    /**
     * @var object $db_connection The database connection
     */
    private $db_connection            = null;

	private $oa;

	private $idDisciplina;

	private $mysqli;

	private $idComp;

	private $nomeComp;

	private $descricaoComp;

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
		$this->idDisciplina =  $disc;
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
							<button type='button' style='background-color: #4AA1F7' class='btn-recomendacao btn-default btn-lg'>
							  <span class='glyphicon glyphicon-plus' aria-hidden='true'></span>
							</button>
						
					</li></div><div id='conteudo-expansivel'>";

			if ($cont <= 0)   
	    		echo '<h4><br>Essa competência não possui objetos a serem recomendados no momento.</h4>';
	    	else{
				for($c=0;$c<$cont;$c++){
					
					//var_dump($v);
						$cadastro = new Cadastro;
						$cadastro->insereDadosBancoDeDados(array(	"id_usuario" => $_SESSION['user_id'], 
																	"id_disciplina" => $this->idDisciplina,
																	"id_competencia" => $this->idComp,
																	"id_oa" => $v[$c]['ID'],
																	"data" => date("Y/m/d"))
															 ,"recomendacao");
						$carregamento = new Carregamento();
						$oa_info = $carregamento->carregaDados(array('idcesta' => $v[$c]['ID']), "cesta");
						$categoria_tecnica = $carregamento->carregaDados(array("idcategoria_tecnica" => $oa_info['idcategoria_tecnica']), "categoria_tecnica");
						$categoria_educacional = $carregamento->carregaDados(array("idcategoria_eduacional" => $oa_info['idcategoria_eduacional']), "categoria_eduacional");
						echo"<li class='disciplinas-item' data-category='".$oa_info['idioma']." ".$categoria_tecnica['tipoTecnologia']." ".$categoria_educacional['ambiente']." ".$categoria_educacional['grauInteratividade']." ".$categoria_educacional['recursoAprendizagem']." ".$categoria_educacional['usuarioFinal']."'  style='border-bottom: 1px solid #ddd; margin-bottom: 0; width: 95%; margin: auto;'>";
			                    echo "<div class='recomendacao-item-content'>";
			                    		echo 'Número de Objeto(s) recomendado(s): '.$cont.'<br/>';

			                    		echo "<h3>".$v[$c]['nome']."</h3>";

			                    		echo "<h6>".$v[$c]['descricao']."</h6><br/>";

			                    		echo "<a href='visualizarOA.php?url=".$v[$c]['url']."&idOA=".$v[$c]['ID']."&idDisciplina=".$this->idDisciplina."&idUsuario=".$_SESSION['user_id']."'>Acessar Objeto de Aprendizagem</a>";

		                		echo "</div>";

		                		echo "<div class='circulo-recomendacao' style='background-color:";

			                    	//Deve exibir verde!
									if($v[$c]['res'] == 1 || $v[$c]['res'] == 2){

										//echo "#C4DA5B;";

									//Deve exibir amarelo
									}else if($v[$c]['res'] < 1 && $v[$c]['res'] >=-4){

										//echo "#FCEF53;";

									//Deve exibir vermelho!
									}else{

										//echo "#ED2825;";

									}

								echo '\'">';



			                	echo "</b></div>".
			            	"</li>";
		    	}
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

		if(sizeof($this->filtragemColaborativaGetSimilaridade()) != 0) {

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

	public function filtragemColaborativaGetVizinhos(){

        $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $temp = $this->getID(); //verificar
        $vizinhos = array();

        $sql = $this->db_connection->prepare('SELECT usuario_idusuario FROM usuario_competencias WHERE competencia_idcompetencia=:temp AND ((conhecimento BETWEEN (:conhecimento-1 AND :conhecimento+1) AND habilidade BETWEEN (:habilidade-1 AND :habilidade+1)) OR (conhecimento BETWEEN (:conhecimento-1 AND :conhecimento+1) AND atitude BETWEEN (:atitude-1 AND :atitude+1)) OR (habilidade BETWEEN (:habilidade-1 AND :habilidade+1) AND atitude BETWEEN (:atitude-1 AND :atitude+1)))');
        // colocar as variáveis no CHA
        $sql->bindValue(':temp', $temp, PDO::PARAM_INT);
        $sql->bindValue(':conhecimento', $this->chaUser['C'], PDO::PARAM_INT);
        $sql->bindValue(':habilidade', $this->chaUser['H'], PDO::PARAM_INT);
        $sql->bindValue(':atitude', $this->chaUser['A'], PDO::PARAM_INT);
        $sql->execute();

        unset ($temp);
        $result = $sql->fetch(PDO::FETCH_NUM);
        if($result != NULL){
            foreach($result as $r){
                $vizinhos[] = $r;
            }
        }
        var_dump($vizinhos);
        echo "<br>";
        return $vizinhos;

    }

    public function filtragemColaborativaPearson($user1votos, $user2votos) {
        $n = $sum1 = $sum2 = $sumSq1 = $sumSq2 = $product = 0;

        foreach($user1votos as $user => $voto) {
                if(!isset($user2votos[$user])) {
                        continue;
                }
                
                $n++;
                $sum1 += $voto;
                $sum2 += $user2votos[$user];
                $sumSq1 += pow($voto, 2);
                $sumSq2 += pow($user2votos[$user], 2); 
                $product += $voto * $user2votos[$user];
        }

        // Similaridade = 0 quando os usuários não votaram nos mesmos OAs
        if($n == 0) {
                return 0;
        }

        // Quando há votos
        $num = $product - (($sum1* $sum2)/$n);
        $den = sqrt(($sumSq1-pow($sum1, 2) / $n) * ($sumSq2 - pow($sum2, 2)/$n));

        if($den == 0) {
                return 0;
        }

        return $num/$den;
    }

    public function filtragemColaborativaGetSimilaridade(){
        $dados = array();
        $similaridades = array();
        $vizinhos = $this->filtragemColaborativaGetVizinhos();
        foreach($this->oa->getVector() as $oa){
            foreach($vizinhos as $v){ // para cada ID de usuário
                //SELECT VOTO DO BANCO DE DADOS COMPARANDO O ID DO VIZINHO COM ID DO OA E DA COMPETENCIA
                $sql = $this->db_connection->prepare('SELECT * FROM avaliacoes_quanti WHERE usuario_id=:id_usuario AND oa_id = :id_oa');
                $sql->bindValue(':id_usuario', $v, PDO::PARAM_INT);
                $sql->bindValue(':id_oa', $oa['ID'], PDO::PARAM_INT);
		        $sql->execute();
                //array com resultado da query colocando id do vizinho e seus votos
        		$result = $sql->fetch();
        		if($result) {
	        		foreach ($result as $valor) {
	        			$oa_votos[$v] = $result['avaliacao'];
	        		}
	                $dados[$oa['ID']] = $oa_votos; // $oa_votos é um array com id do vizinho com o voto que o próprio vizinho deu.
	            }
            }
            var_dump($dados);
            foreach($dados as $oazao => $votos) {
                $similarities[$oazao] = array();

                foreach($dados as $oa2 => $votos2) {
                    if($oa2 == $oazao|| isset($similarities[$oazao][$oa2])) {
                            continue;
                    }

                    $sim = filtragemColaborativaPearson($votos, $votos2);
                    if($sim > 0) { // similaridade minima
                            $similarities[$oazao][$oa2] = $sim;
                            $similarities[$oa2][$oazao] = $sim;
                    }
                }
        		arsort($similarities[$oazao]);
            }
        }
        return $similarities;
    }

}


?>