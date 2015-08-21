<?php
/**
 * User: Arthur
 * Date: 06/08/15
 * Time: 18:03
 * Classe responsável pelo gerenciamento do tempo de acesso aos Objetos de Aprendizagem
 */

class TempoAcessoOA {

	private $tempoReal;

	private $tempoMedioOA;

	private $tempoMedioTodosOAS;

	function __construct($dados) {
		if(!is_null($dados)) {
			$this->carregaDados($dados);
		}
	}

	protected function carregaDados($dados) {
		$this->calculaTempoMedioOA($dados);
		$this->calculaTempoMedioTodosOAS($dados['idDisciplina']);
		echo "<pre>";
		var_dump($this->getTempoMedioOA());
		echo "</pre>";
		echo "<pre>";
		var_dump($this->getTempoMedioTodosOAS());
		echo "</pre>";
	}

	public function setTempoReal($tempo) {
		$this->tempoReal = $tempo;
	}

	public function getTempoReal() {
		return $this->tempoReal;
	}

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
		$this->setTempoMedioOA($tempoMedio/$database->rowCount());
	}

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
		$this->setTempoMedioTodosOAS($tempoMedio/$database->rowCount());
	}

	public function setTempoMedioOA($tempo) {
		$this->tempoMedioOA = $tempo;
	}

	public function getTempoMedioOA() {
		return $this->tempoMedioOA;
	}

	public function setTempoMedioTodosOAS($tempo) {
		$this->tempoMedioTodosOAS = $tempo;
	}

	public function getTempoMedioTodosOAS() {
		return $this->tempoMedioTodosOAS;
	}
}

?>