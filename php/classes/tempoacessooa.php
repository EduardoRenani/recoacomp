<?php
/**
 * User: Arthur
 * Date: 06/08/15
 * Time: 18:03
 * Classe responsável pelo gerenciamento do tempo de acesso aos Objetos de Aprendizagem
 */

class TempoAcessoOA {

	/**
	 * @var int tempo real de acesso do OA
	 */
	private $tempoReal;

	/**
	 * @var int tempo médio de acesso do OA
	 */
	private $tempoMedioOA;

	/**
	 * @var int tempo medio de acesso de todos os OA
	 */
	private $tempoMedioTodosOAS;

	function __construct($dados) {
		if(!is_null($dados)) {
			$this->carregaDados($dados);
		}
	}

	/**
	 * @param array dados['idOA', 'idDisciplina']
	 */
	protected function carregaDados($dados) {
		$this->calculaTempoMedioOA($dados);
		$this->calculaTempoMedioTodosOAS($dados['idDisciplina']);
	}

	/**
	 * @param int tempo real de acesso do OA
	 */
	public function setTempoReal($tempo) {
		$this->tempoReal = $tempo;
	}

	/**
	 * @return int tempo real de acesso do OA
	 */
	public function getTempoReal() {
		return $this->tempoReal;
	}

	/**
	 * Calcula o tempo Medio do OA
	 * @param array dados['idOA', 'idDisciplina']
	 */
	public function calculaTempoMedioOA($dados) {
		$tempoMedio = 0;
		$database = new Database;
		$sql = "SELECT * FROM acessos_oa WHERE id_oa = :idOA AND id_disciplina = :idDisciplina";
		$database->query($sql);
		$database->bind(":idDisciplina", $dados['idDisciplina']);
		$database->bind(":idOA", $dados['idOA']);
		$oas = $database->resultSet();
		foreach($oas as $index => $oa) {
			$tempoMedio+=$oa["tempo_acesso"];
		}
		if($database->rowCount() != 0) {
			$this->setTempoMedioOA($tempoMedio/$database->rowCount());
		}
		else {
			$this->setTempoMedioOA(-1);
		}
	}

	/**
	 * Calcula o tempo Medio de todos os OAS da disciplinas
	 * @param int id da Disciplina do OA
	 */
	public function calculaTempoMedioTodosOAS($idDisciplina) {
		$tempoMedio = 0;
		$database = new Database;
		$sql = "SELECT * FROM acessos_oa WHERE id_disciplina = :idDisciplina";
		$database->query($sql);
		$database->bind(":idDisciplina", $idDisciplina);
		$oas = $database->resultSet();
		foreach($oas as $index => $oa) {
			$tempoMedio+=$oa["tempo_acesso"];
		}
		if($database->rowCount() != 0) {
			$this->setTempoMedioTodosOAS($tempoMedio/$database->rowCount());
		}
		else {
			$this->setTempoMedioTodosOAS(-1);
		}
	}

	/**
	 * @param float tempo medio de acesso do OA
	 */
	public function setTempoMedioOA($tempo) {
		$this->tempoMedioOA = $tempo;
	}

	/**
	 * @return float tempo medio de acesso do OA
	 */
	public function getTempoMedioOA() {
		return $this->tempoMedioOA;
	}

	/**
	 * @param float tempo medio de acesso de todos os OAS
	 */
	public function setTempoMedioTodosOAS($tempo) {
		$this->tempoMedioTodosOAS = $tempo;
	}

	/**
	 * @return float tempo medio de acesso de todos os OAS
	 */
	public function getTempoMedioTodosOAS() {
		return $this->tempoMedioTodosOAS;
	}
}

?>