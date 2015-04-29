<?php
/**
 * User: Cláuser
 * Date: 13/01/2015
 * Time: 17:22
 */
require_once("config/config.cfg");
require_once("lista.php");
class Aproveitabilidade {

	private $idCompetencia;
	private $classificacao;

	function __construct($comp){

		$this->idCompetencia = $comp;

		//9 posições: +1,+2,0,-1,-2,-3,-4,+3,+4
		$classificacao = array(
            'p1'=>array(),
            'p2'=>array(),
            'n' =>array(),
            'n1'=>array(),
            'n2'=>array(),
            'n3'=>array(),
            'n4'=>array(),
            'p3'=>array(),
            'p4'=>array() 
        );
	}

	public function addOA($categoria,$idOA){
		//categoria: p1, p2,n ...
		$idOA = (int)$idOA;
		if($idOA < 0 && $idOA == null)
			return false;

		array_push($this->classificacao[$categoria], $idOA);
		return true;
	}

	//Testa se o OA com id $idOA possui aproveitabilidade $categoria
	public function verificaOcorrencia($categoria,$idOA){
		$cont = count($this->classificacao[$categoria]);
		if($cont >= 1){
			for($i=0;$i<$cont;$i++){
				if($this->classificacao[$categoria][$i] == $idOA)
					return true;
			}
			return false;
		}
		else
			return false;
	}

}