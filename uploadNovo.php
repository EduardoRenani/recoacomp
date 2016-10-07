<?php
include("config/base.php");
    //chamar dentro od ordenar

    //if(array_key_exists($oa, $oas_ordenados));
    // não ordena
    function filtragemColaborativaGetVizinhos(){

        $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $temp = $this->getID(); //verificar
        $vizinhos = array();

        $sql = $this->db_connection->prepare('SELECT * FROM usuario_competencias WHERE competencia_idcompetencia=:temp AND conhecimento = :conhecimento AND habilidade = :habilidade AND atitude =  :atitude');
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

        return $vizinhos;

    }

    function filtragemColaborativaPearson($user1votos, $user2votos) {
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

    function filtragemColaborativaGetSimilaridade(){
        $dados = array();
        $similaridades = array();
        $vizinhos = filtragemColaborativaGetVizinhos();

        foreach($this->oa as $oa){

            foreach($vizinhos as $v){ // para cada ID de usuário
                //SELECT VOTO DO BANCO DE DADOS COMPARANDO O ID DO VIZINHO COM ID DO OA E DA COMPETENCIA
                $sql = $this->db_connection->prepare('SELECT * FROM avaliacoes_quanti WHERE usuario_id=:id_usuario AND oa_id = :id_oa');
                $sql->bindValue(':id_usuario', $v['usuario_idusuario'], PDO::PARAM_INT);
                $sql->bindValue(':id_oa', $oa['ID'], PDO::PARAM_INT);
		        $sql->execute();
                //array com resultado da query colocando id do vizinho e seus votos
        		$result = $sql->fetch(PDO::FETCH_NUM);
        		foreach ($result as $valor) {
        			$oa_votos[$v['usuario_idusuario']] = $result['avaliacao'];
        		}
                $dados[$oa['ID']] = $oa_votos; // $oa_votos é um array com id do vizinho com o voto que o próprio vizinho deu.
            }
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
        		arsort($similarities[$oa]);
            }
        }
        return $similarities;
    }
    ?>