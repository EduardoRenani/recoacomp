<?php
/**
 * User: Arthur
 * Date: 06/08/15
 * Time: 18:03
 * Classe responsável pelo gerenciamento do tempo de acesso aos Objetos de Aprendizagem
 */

class TempoAcessoOA {
	const TEMPO_MINIMO = 300;

	const TEMPO_MAXIMO = 4800;

	const OA_ACESSADO = 1;

	const OA_NAO_ACESSADO = 0;

	private $tempoReal;

	private $acessoValido = OA_NAO_ACESSADO;

	public function setTempoReal($tempo) {
		$this->tempoReal = $tempo;
	}

	public function getTempoReal() {
		return $this->tempoReal;
	}

	public function validaAcesso() {
		$this->acessoValido = self::OA_ACESSADO;
	}

	public function getAcessoValido() {
		return $this->acessoValido;
	}

	public function validaTempoReal() {
		if($this->getTempoReal() < self::TEMPO_MINIMO || $this->getTempoReal() > self::TEMPO_MAXIMO) {
			return;
		}
		else {
			$this->validaAcesso();
		}
	}
}

?>