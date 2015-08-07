<?php
/**
 * User: Arthur
 * Date: 06/08/15
 * Time: 18:03
 * Classe responsável pelo gerenciamento do acesso aos Objetos de Aprendizagem
 */

class AcessoOA extends TempoAcessoOA {
	private $idUsuario;

	private $idDisciplina;
	
	private $idOA;

	/**
	 * Método que coloca as informações nas variáveis respectivas da classe
	 * @param array dados do acesso array(  "idUsuario"    => $idUsuario,
	 * 										"idDisciplina" => $idDisciplina,
	 * 										"idOA"         => $idOA,
	 * 										"tempoTotal"   => $tempoTotal,
	 * 										"tempoOcioso"  => $tempoOcioso,
	 * 										"tempoReal"    => $tempoReal
	 * 										)
	 */
	public function setDados($dados) {
		if(!is_array($dados)) {
			throw new InvalidArgumentException("Erro! Espera array, recebeu ".gettype($dados), E_USER_ERROR);
		}
		setIdUsuario($dados['']);
	}
}

?>