<?php
/**
 * User: Arthur
 * Date: 06/08/15
 * Time: 18:03
 * Classe responsável pelo gerenciamento dos índices de avaliação dos Objetos de Aprendizagem
 */

class IndicesOA {
	/**
	 * @var string Nome do Objeto de Aprendizagem
	 */
	private $nomeOA;

	/**
	 * @var  int Id do Objeto de Aprendizagem
	 */
	private $idOA;

	/**
	 * @var  int Id da disciplina ao qual o Objeto de Aprendizagemn está associado
	 */
	private $idDisciplina;

	/**
	 * @var  float Valor do índice de rejeição do OA
	 */
	private $indiceRejeicao;

	/**
	 * @var  int Valor do índice de relevância do OA em relação à disciplina
	 */
	private $indiceRelevancia;

	/**
	 * @var  object Acessos do OA
	 */
	private $acessosOA;

	/**
	 * Quando instancia o objeto, seta as variáveis de instâncias 'acessosOA'
	 */
	function __construct($dados) {
		$this->acessosOA = new AcessosOA($dados);
		if(!is_null($dados)) {
			$this->carregaDados($dados);
		}
	}

	/**
	 * Carrega os dados nos parâmetros do objeto
	 * @param array dados['idOA', 'idDisciplina'];
	 */
	private function carregaDados($dados) {
		$this->setIdOA($dados['idOA']);
		$this->carregaNomeOA($this->getIdOA());
		$this->setIdDisciplina($dados['idDisciplina']);
		$this->calculaIndiceRejeicao();
	}

	/**
	 * Carrega o nome do OA no banco de dados com o id passado
	 * @param int Id do Objeto de Aprendizagem
	 */
	private function carregaNomeOA($idOA) {
		$database = new Database;
		$sql = "SELECT nome FROM cesta WHERE idcesta = :idOA";
    	$database->query($sql);
    	$database->bind(":idOA", $idOA);
    	$this->setNomeOA($database->single()["nome"]);
	}

	/**
	 * Calcula o índice de Rejeição do OA
	 * Cálculo do índice: AcessosInválidos/AcessosTotais
	 * @throws InvalidArgumentException Caso existam argumentos inválidos
	 */
	public function calculaIndiceRejeicao() {
		$dados = array( "idOA" => $this->getIdOA(),
						"idDisciplina" => $this->getIdDisciplina()
						);

		if($this->getAcessosOA()->getAcessosTotais() != 0) {
			$this->setIndiceRejeicao(floatval($this->getAcessosOA()->getAcessosInvalidos()/$this->getAcessosOA()->getAcessosTotais()));
		}
		else {
			$this->setIndiceRejeicao(floatval(-1));
		}
		
		
	}

	/**
	 * Calcula o índice de Relevancia
	 * Cálculo do índice: (AcessosValidos/AcessosValidosDoOAMaisAcessado + tempoMedioAcesso/tempoMedioTodosOAS)*(1-indiceRejeição)
	 * @param int Id do OA mais acessado da disciplina
	 * @throws InvalidArgumentException Caso existam argumentos inválidos
	 */
	public function calculaIndiceRelevancia($idOAMaisAcessosValidos) {
		$dados = array( "idOA" => $this->getIdOA(),
						"idDisciplina" => $this->getIdDisciplina()
						);

		$dadosOAMaisAcessosValidos = array( "idOA" => $idOAMaisAcessosValidos,
											"idDisciplina" => $this->getIdDisciplina()
											);
		if($this->getAcessosOA()->getMaisAcessosValidos($dadosOAMaisAcessosValidos) != 0 && $this->getAcessosOA()->getTempoAcessoOA()->getTempoMedioTodosOAS() != 0 && $this->getIndiceRejeicao() != 0) {
			$indiceRelevancia = $this->getAcessosOA()->getAcessosValidos()/$this->getAcessosOA()->getMaisAcessosValidos($dadosOAMaisAcessosValidos);
			$indiceRelevancia += $this->getAcessosOA()->getTempoAcessoOA()->getTempoMedioOA()/$this->getAcessosOA()->getTempoAcessoOA()->getTempoMedioTodosOAS();
			$indiceRelevancia *= (1-$this->getIndiceRejeicao());
			$this->setIndiceRelevancia(floatval($indiceRelevancia));
		}
		else {
			$this->setIndiceRelevancia(floatval(-1));
		}
	}

	/**
	 * @return string Nome do OA
	 */
	public function getNomeOA() {
		return $this->nomeOA;
	}
	
	/**
	 * @param string Nome do OA
	 */
	public function setNomeOA($nomeOA) {
		$this->validaString($nomeOA);
		$this->nomeOA = $nomeOA;
	}
	
	/**
	 * @return int id do OA
	 */
	public function getIdOA() {
		return $this->idOA;
	}
	
	/**
	 * @param int id do OA
	 */
	public function setIdOA($idOA) {
		$this->validaInteiro($idOA);
		$this->idOA = $idOA;
		$this->getAcessosOA()->setIdOA($idOA);
	}
	
	/**
	 * @return int id da disciplina do OA
	 */
	public function getIdDisciplina() {
		return $this->idDisciplina;
	}
	
	/**
	 * @param int id da disciplina do OA
	 */
	public function setIdDisciplina($idDisciplina) {
		$this->validaInteiro($idDisciplina);
		$this->idDisciplina = $idDisciplina;
		$this->getAcessosOA()->setIdDisciplina($idDisciplina);
	}
	
	/**
	 * @return float id índice de rejeição
	 */
	public function getIndiceRejeicao() {
		return $this->indiceRejeicao;
	}

	/**
	 * @param float id índice de rejeição
	 */
	public function setIndiceRejeicao($indice) {
		$this->validaFloat($indice);
		$this->indiceRejeicao = $indice;
	}

	/**
	 * @return float id índice de relevancia
	 */
	public function getIndiceRelevancia() {
		return $this->indiceRelevancia;
	}

	/**
	 * @param float id índice de relevancia
	 */
	public function setIndiceRelevancia($indice) {
		$this->validaFloat($indice);
		$this->indiceRelevancia = $indice;
	}

	/**
	 * @return object Acessos do OA
	 */
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
	 * Verifica se variável é do tipo string
	 * @throws InvalidArgumentException em caso de argumento inválido
	 */
	private function validaString($variavel) {
		if(!is_string($variavel)) {
			throw new InvalidArgumentException("Erro! Esperava receber string, recebeu ".gettype($variavel), E_USER_ERROR);
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