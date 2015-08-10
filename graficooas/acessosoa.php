<?php
require_once("../Classes/conexao.php");
// include the config
require_once('../config/config.cfg');
/**
 * User: Arthur
 * Date: 06/08/15
 * Time: 18:03
 * Classe responsável pelo gerenciamento do acesso aos Objetos de Aprendizagem
 */

class AcessoOA {
	private $idUsuario;

	private $idDisciplina;
	
	private $idOA;

	private $tempoAcessoOA;

	private $indicesOA;

	function __construct() {
		$this->tempoAcessoOA = new TempoAcessoOA;
		$this->indicesOA = new indicesOA;
	}

	public setIdUsuario($idUsuario) {
		$this->validaId($idUsuario);
		$this->idUsuario = $idUsuario;
	}

	public getIdUsuario() {
		return $this->idUsuario;
	}

	public setIdDisciplina($idDisciplina) {
		$this->validaId($idDisciplina);
		$this->idDisciplina = $idDisciplina;
	}

	public getIdDisciplina() {
		return $this->idDisciplina;
	}

	public setIdOA($idOA) {
		$this->validaId($idOA);
		$this->idOA = $idOA;
	}

	public getIdOA() {
		return $this->idOA;
	}

	private validaId($id) {
		if(!is_int($id)) {
			throw new InvalidArgumentException("Erro! Esperava receber inteiro, recebeu ".gettype($idUsuario), E_USER_ERROR);
		}
	}

	public salvaDados() {
		try {
			$this->validaDados();
			if($this->getTempoAcessoOA()->validaTempoReal()) {
				$dados = $this->getDados();
				$query = new conexao(DB_HOST, DB_NAME, DB_USER, DB_PASS);
				$query->inserir($dados, "acessosoa");
			}
		}
		catch(Exception $e) {
			trigger_error("Erro ao cadastrar no banco de dados!".$e->getMessage(), $e->getCode());
		}
	}

	private validaDados() {
		if(is_null($this->getIdUsuario())) {
			throw new InvalidArgumentException("Erro! Id usuário nulo!");
		}
		if(is_null($this->getIdDisciplina())) {
			throw new InvalidArgumentException("Erro! Id disciplina nulo!");
		}
		if(is_null($this->getIdOA())) {
			throw new InvalidArgumentException("Erro! Id objeto de aprendizagem nulo!");
		}
		if(is_null($this->getTempoAcessoOA())) {
			throw new InvalidArgumentException("Erro! Objeto tempo de acesso nulo!");
		}
		if(is_null($this->getIndicesOA())) {
			throw new InvalidArgumentException("Erro! Objeto indices do oa nulo!");
		}
	}

	public getTempoAcessoOA() {
		return $this->tempoAcessoOA;
	}

	public getIndicesOA() {
		return $this->indicesOA;
	}
}

?>