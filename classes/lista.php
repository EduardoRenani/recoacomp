<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 14/10/14
 * Time: 13:47
 */


class Lista {

    private $vector;

    function __construct($vetorInicial = null){
        if($vetorInicial != null && is_array($vetorInicial) )
            $this->vector = $vetorInicial;
        else
            $this->vector = array();
    }

    public function addMember($member,$position=null){
        //$position:
            //"begin": Membro entra na posição 0
            //"end": Membro entra na última posição
            //0,1...n: Membro entra na posição especificada e empurra o que nela estava para depois
            //Entradas inválidas ou null são consideradas "end"
        if($this->is_validMember($member)){

            //Verifica se o parâmetro $position é numérico. Se sim, verifica se é uma posição válida.
            $vec = $this->is_validPosition($position);
            $position = $vec[0];
            $posicaoValida = $vec[1];
            unset($vec);

            //Se $position == "begin", $member é add na posição 0 de $this->vector.
            if($position == "begin"){
                //Aumenta o tamanho do vetor
                array_push($this->vector,0);
                //Conta o tamanho do vetor
                $cont = count($this->vector);
                //Desloca todos os elementos 1 posição para a direita, "perde-se" o valor da última. Que sabemos ser 0.
                for($i=$cont-1;$i>0;$i--){
                    $this->vector[$i] = $this->vector[$i-1];
                }
                //Add $member na primeira posição
                $this->vector[0]=$member;
                return true;
            }else if($posicaoValida){
                //Aumenta o tamanho do vetor
                array_push($this->vector,0);
                //Conta o tamanho do vetor
                $cont = count($this->vector);

                //Desloca todos os elementos que estão no intervalo [position,tamanhodovetor -2] 1 posição para a direita.
                for($i=$cont-1;$i>$position;$i--){
                    $this->vector[$i] = $this->vector[$i-1];
                    //No final desse for, $this->vector[$position] e $this->vector[$position + 1] são iguais.
                }
                $this->vector[$position] = $member;
                return true;
            }
            else{
                array_push($vector,$member);
                return true;
            }
        }
        return false;
    }

    private function is_validPosition($position){

        $posicaoValida = false;
        if(is_numeric($position)){

            //Verifica se $position é um número em uma string. Se sim, torna-o apenas um número (sem ser mais uma string)
            if( is_string($position) )
                $position = (int)($position);

            //Verifica se $position é um número não-inteiro. Se for, é tornado inteiro.
            if( !is_int($position) )
                $position = (int)($position);

            //Verifica se o número está no intervalo [0,tamanho do vetor - 1]
            if($position >0 && $position < count($this->vector))
                $posicaoValida = true;
        }
        return (array($position,$posicaoValida));
    }

    private function is_validMember($member){
        //todo Tratar casos.
        if($member != null /* && ...*/)
            return true;
        else
            return false;
    }

    public function swapMembers($p1,$p2){
        //Valida as posições passadas.
        $is_validPosition = true;
        $vec = $this->is_validPosition($p1);
        $p1=$vec[0];
        if(!$vec[1])
            $is_validPosition = false;
        $vec = $this->is_validPosition($p2);
        $p2=$vec[0];
        if(!$vec[1])
            $is_validPosition = false;

        if($is_validPosition){
            $temp = $this->vector[$p1];
            $this->vector[$p1] = $this->vector[$p2];
            $this->vector[$p2] = $temp;
            unset($temp);
            return true;
        }
        else
            return false;
    }

    public function ordenate($from,$to){
	    //From: onde começa a ordenação
        //To: fim da ordenação

        //Exemplo: from = 2 to = 4
        $cont = count($this->vector);
		
        $matriz = array(array(),array());

        if($to > $from){

            for($i=$from;$i<=$to;$i++){
                for($j=0;$j<$cont;$j++){
                    if($this->vector[$j] == $i){
                        //Primeira coluna: valor atual. Varia de from até to.
                        array_push($matriz[0],$i);
                        //Segunda coluna: posição que o termo ocupava no vetor $this->vector
                        array_push($matriz[1],$j);
                    }
                }
            }
            return $matriz;

        }else{

            for($i=$from;$i>=$to;$i--){
                for($j=0;$j<$cont;$j++){
                    if($this->vector[$j] == $i){
                        array_push($matriz[0],$i);
                        array_push($matriz[1],$j);
                    }
                }
            }
            return $matriz;

        }

        return false;
    }
	}