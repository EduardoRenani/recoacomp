<?php
/**
 * User: Arthur
 * Date: 06/08/15
 * Time: 18:03
 * Classe responsável pelo gerenciamento do tempo de acesso aos Objetos de Aprendizagem
 */

class TempoAcessoOA {
	private $tempoTotal;

	private $tempoOcioso;

	private $tempoReal;

	const TEMPO_MINIMO = 300;

	const TEMPO_MAXIMO = 4800;

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

	public function validaTempoReal() {
		if($this->getTempoReal() < self::TEMPO_MINIMO || $this->getTempoReal() > self::TEMPO_MAXIMO) {
			return false;
		}
		else {
			return true;
		}
	}
}

?>