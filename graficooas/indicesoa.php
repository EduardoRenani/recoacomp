<?php
/**
 * User: Arthur
 * Date: 06/08/15
 * Time: 18:03
 * Classe responsável pelo gerenciamento dos índices de avaliação dos Objetos de Aprendizagem
 */

class IndicesOA {
	private $indiceRejeicao;

	private $indiceRelevancia;

	/**
	 * Calculo do tempo real: Tempo Total - Tempo Ocioso
	 */
	public function calculaTempoReal() {
		$this->setTempoReal($this->getTempoTotal()-$this->getTempoOcioso());
	}

	public function setTempoTotal($tempo) {
		$tempoTotal = $tempo;
	}

	public function getTempoTotal() {
		return $tempoTotal;
	}

	public function setTempoOcioso($tempo) {
		$tempoOcioso = $tempo;
	}

	public function getTempoOcioso() {
		return $tempoOcioso;
	}

	public function setTempoReal($tempo) {
		$tempoReal = $tempo;
	}

	public function getTempoReal() {
		return $tempoReal;
	}
}

?>