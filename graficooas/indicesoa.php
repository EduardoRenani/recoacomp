<?php
/**
 * User: Arthur
 * Date: 06/08/15
 * Time: 18:03
 * Classe responsável pelo gerenciamento dos índices de avaliação dos Objetos de Aprendizagem
 */

class IndicesOA {
	private $idOA;

	private $idDisciplina;

	private $indiceRejeicao;

	private $acessosOA;

	function __construct() {
		$this->acessosOA = new AcessosOA;
	}

	public function calculaIndiceRejeicao() {
		$dados = array( "idOA" => $this->getIdOA(),
						"idDisciplina" => $this->getIdDisciplina()
						);
		$this->setIndiceRejeicao(floatval($this->getAcessosOA()->getAcessosInvalidos($dados)/$this->getAcessosOA()->getTotalAcessos($dados)));
	}

	public function getIdOA() {
		return $this->idOA;
	}

	public function setIdOA($idOA) {
		$this->validaInteiro($idOA);
		$this->idOA = $idOA;
	}

	public function getIdDisciplina() {
		return $this->idDisciplina;
	}

	public function setIdDisciplina($idDisciplina) {
		$this->validaInteiro($idDisciplina);
		$this->idDisciplina = $idDisciplina;
	}

	public function getIndiceRejeicao() {
		return $this->indiceRejeicao;
	}

	public function setIndiceRejeicao($indice) {
		$this->validaFloat($indice);
		$this->indiceRejeicao = $indice;
	}

	public function getAcessosOA() {
		return $this->acessosOA;
	}

	/**
	 * Verifica se variável é do tipo inteiro
	 * @throws InvalidArgumentException em caso de argumento inválido
	 */
	private function validaInteiro($variavel) {
		if(!is_int($variavel)) {
			throw new InvalidArgumentException("Erro! Esperava receber inteiro, recebeu ".gettype($variavel), E_USER_ERROR);
		}
	}

	/**
	 * Verifica se variável é do tipo float
	 * @throws InvalidArgumentException em caso de argumento inválido
	 */
	private function validaFloat($variavel) {
		if(!is_float($variavel)) {
			throw new InvalidArgumentException("Erro! Esperava receber float, recebeu ".gettype($variavel), E_USER_ERROR);
		}
	}
}

?>