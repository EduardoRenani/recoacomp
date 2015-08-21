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

	private $indiceRelevancia;

	private $acessosOA;

	function __construct($dados) {
		$this->acessosOA = new AcessosOA($dados);
		if(!is_null($dados)) {
			$this->carregaDados($dados);
		}
	}

	private function carregaDados($dados) {
		$this->setIdOA($dados['idOA']);
		$this->setIdDisciplina($dados['idDisciplina']);
		$this->calculaIndiceRejeicao();
	}

	public function calculaIndiceRejeicao() {
		$dados = array( "idOA" => $this->getIdOA(),
						"idDisciplina" => $this->getIdDisciplina()
						);

		$indiceRejeicao = $this->getAcessosOA()->getAcessosInvalidos()/$this->getAcessosOA()->getAcessosTotais();
		
		$this->setIndiceRejeicao(floatval($indiceRejeicao));
	}

	public function calculaIndiceRelevancia($idOAMaisAcessosValidos) {
		$dados = array( "idOA" => $this->getIdOA(),
						"idDisciplina" => $this->getIdDisciplina()
						);

		$dadosOAMaisAcessosValidos = array( "idOA" => $idOAMaisAcessosValidos,
											"idDisciplina" => $this->getIdDisciplina()
											);

		echo $dadosOAMaisAcessosValidos['idOA'];
		echo "<pre>";
		var_dump($this->getAcessosOA()->getMaisAcessosValidos($dadosOAMaisAcessosValidos));
		echo "</pre>";

		$indiceRelevancia = $this->getAcessosOA()->getAcessosValidos()/$this->getAcessosOA()->getMaisAcessosValidos($dadosOAMaisAcessosValidos);
		$indiceRelevancia += $this->getAcessosOA()->getTempoAcessoOA()->getTempoMedioOA()/$this->getAcessosOA()->getTempoAcessoOA()->getTempoMedioTodosOAS();
		$indiceRelevancia *= (1-$this->getIndiceRejeicao());

		$this->setIndiceRelevancia(floatval($indiceRelevancia));
	}

	public function getIdOA() {
		return $this->idOA;
	}

	public function setIdOA($idOA) {
		$this->validaInteiro($idOA);
		$this->idOA = $idOA;
		$this->getAcessosOA()->setIdOA($idOA);
	}

	public function getIdDisciplina() {
		return $this->idDisciplina;
	}

	public function setIdDisciplina($idDisciplina) {
		$this->validaInteiro($idDisciplina);
		$this->idDisciplina = $idDisciplina;
		$this->getAcessosOA()->setIdDisciplina($idDisciplina);
	}

	public function getIndiceRejeicao() {
		return $this->indiceRejeicao;
	}

	public function setIndiceRejeicao($indice) {
		$this->validaFloat($indice);
		$this->indiceRejeicao = $indice;
	}

	public function getIndiceRelevancia() {
		return $this->indiceRelevancia;
	}

	public function setIndiceRelevancia($indice) {
		$this->validaFloat($indice);
		$this->indiceRelevancia = $indice;
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