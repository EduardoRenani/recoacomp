<?php
/**
 * User: Arthur
 * Date: 06/08/15
 * Time: 18:03
 * Classe responsável pelo gerenciamento do tempo de acesso aos Objetos de Aprendizagem
 */

class TempoAcessoOA {

	private $tempoReal;

	public function setTempoReal($tempo) {
		$this->tempoReal = $tempo;
	}

	public function getTempoReal() {
		return $this->tempoReal;
	}
}

?>