<?php
/**
 * User: Arthur
 * Date: 06/08/15
 * Time: 18:03
 * Classe responsável pelo gerenciamento dos índices de avaliação dos Objetos de Aprendizagem
 */

class IndicesOA {
	private $idOA;

	private $indiceRejeicao;

	private $acessosOA;

	function __construct() {
		$this->acessosOA = new AcessosOA;
		$this->calculaIndiceRejeicao();
	}

	public function calculaIndiceRejeicao() {
		setIndiceRejeicao($this->getAcessosOA()->getAcessosInvalidos()/$this->getAcessosOA()->getTotalAcessos());
	}

	public function getIdOA() {
		return $this->idOA;
	}

	public function setIdOA($idOA) {
		$this->validaInteiro($idOA);
		$this->idOA = $idOA;
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
	private validaInteiro($variavel) {
		if(!is_float($variavel)) {
			throw new InvalidArgumentException("Erro! Esperava receber inteiro, recebeu ".gettype($variavel), E_USER_ERROR);
		}
	}

	/**
	 * Verifica se variável é do tipo float
	 * @throws InvalidArgumentException em caso de argumento inválido
	 */
	private validaFloat($variavel) {
		if(!is_float($variavel)) {
			throw new InvalidArgumentException("Erro! Esperava receber float, recebeu ".gettype($variavel), E_USER_ERROR);
		}
	}
}

?>