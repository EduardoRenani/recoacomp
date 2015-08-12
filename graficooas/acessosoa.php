<?php
require_once("Database.php");
// include the config
require_once('config.cfg');
/**
 * User: Arthur
 * Date: 06/08/15
 * Time: 18:03
 * Classe responsável pelo gerenciamento do acesso aos Objetos de Aprendizagem
 */

class AcessosOA {
	const TEMPO_MINIMO = 120;

	const TEMPO_MAXIMO = 4800;

	/**
	 * Id do usuário que acessou a página do objeto de aprendizagem
	 * @var int id do usuário
	 */
	private $idUsuario;

	/**
	 * Id da disciplina a qual o objeto de aprendizagem está associado
	 * @var int id da disciplina
	 */
	private $idDisciplina;

	/**
	 * Id do objeto de aprendizagem acessado
	 * @var int id do objeto de aprendizagem
	 */
	private $idOA;

	/**
	 * Objeto que possui métodos e parâmetros para tratar o tempo de acesso do objeto de aprendizagem
	 * @var object tempo de acesso do objeto de aprendizagem
	 */
	private $tempoAcessoOA;

	/**
	 * Quando instancia o objeto, seta as variáveis de instâncias 'tempoAcessoOA' e 'indicesOA'
	 */
	function __construct() {
		$this->tempoAcessoOA = new TempoAcessoOA;
	}

	/**
	 * Insere os dados de acesso do objeto de aprendizagem no banco de dados
	 * @throws Exception Em caso de erro
	 */
	public function salvaDados() {
		try {
			$this->validaDados();
			$this->getTempoAcessoOA()->validaTempoReal();
			$dados = $this->getDados();
			var_dump($dados);
			$database = new Database();
    		$sql = "INSERT INTO acessos_oa (id, id_usuario, id_disciplina, id_oa, tempo_acesso) 
    		VALUES (:id, :idUsuario, :idDisciplina, :idOA, :tempoReal)";
	        $database->query($sql);
	        $database->bind(":id", NULL);
	        $database->bind(":idUsuario", $dados['idUsuario']);
	        $database->bind(":idDisciplina", $dados['idDisciplina']);
	        $database->bind(":idOA", $dados['idOA']);
	        $database->bind(":tempoReal", $dados['tempoReal']);
	        var_dump($database->execute());
		}
		catch(Exception $e) {
			trigger_error("Erro ao cadastrar no banco de dados!".$e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Retorna dados para inserir no0 banco de dados
	 * @return array $dados = array("idUsuario"    => $idUsuario,
	 *								"idDisciplina" => $idDisciplina,
	 *								"idOA"         => $idOA,
	 *								"tempoReal"    => $tempoReal
	 *								);
	 */
	private function getDados() {
		$dados['idUsuario'] = $this->getIdUsuario();
		$dados['idDisciplina'] = $this->getIdDisciplina();
		$dados['idOA'] = $this->getIdOA();
		$dados['tempoReal'] = $this->getTempoAcessoOA()->getTempoReal();
		return $dados;
	}

	/**
	 * Insere os dados de acesso do objeto de aprendizagem no banco de dados
	 * @throws InvalidArgumentException Em caso de argumento inválido
	 */
	private function validaDados() {
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
	}

	/**
	 * @param int idUsuario
	 */
	public function setIdUsuario($idUsuario) {
		$this->validaId($idUsuario);
		$this->idUsuario = $idUsuario;
	}

	/**
	 * @return int idUsuario
	 */
	public function getIdUsuario() {
		return $this->idUsuario;
	}

	/**
	 * @param int idDisciplina
	 */
	public function setIdDisciplina($idDisciplina) {
		$this->validaId($idDisciplina);
		$this->idDisciplina = $idDisciplina;
	}

	/**
	 * @return int idDisciplina
	 */
	public function getIdDisciplina() {
		return $this->idDisciplina;
	}

	/**
	 * @param int idOA
	 */
	public function setIdOA($idOA) {
		$this->validaId($idOA);
		$this->idOA = $idOA;
	}

	/**
	 * @return int idOA
	 */
	public function getIdOA() {
		return $this->idOA;
	}

	/**
	 * Verifica se variável é do tipo inteiro
	 * @throws InvalidArgumentException em caso de argumento inválido
	 */
	private function validaId($id) {
		if(!is_int($id)) {
			throw new InvalidArgumentException("Erro! Esperava receber inteiro, recebeu ".gettype($id), E_USER_ERROR);
		}
	}

	/**
	 * @return object tempoAcessoOA
	 */
	public function getTempoAcessoOA() {
		return $this->tempoAcessoOA;
	}

	public function getAcessosInvalidos($dados) {
		try {
			$database = new Database;
        	$sql = "SELECT * FROM acessos_oa WHERE id_oa = :idOA AND id_disciplina = :idDisciplina AND tempo_acesso >= :tempoMinimo AND tempo_acesso <= :tempoMaximo";
        	$database->query($sql);
        	$database->bind(":idOA", $dados['idOA']);
        	$database->bind(":idDisciplina", $dados['idDisciplina']);
        	$database->bind(":tempoMinimo", self::TEMPO_MINIMO);
        	$database->bind(":tempoMaximo", self::TEMPO_MAXIMO);
        	$database->execute();
        	return $database->rowCount();
		}
		catch(Exception $e) {
			trigger_error("Erro ao pegar número de acessos inválidos do OA!".$e->getMessage(), $e->getCode());
		}
	}

	public function getTotalAcessos($dados) {
		try {
			$database = new Database;
        	$sql = "SELECT * FROM acessos_oa WHERE id_oa = :idOA AND id_disciplina = :idDisciplina";
        	$database->query($sql);
        	$database->bind(":idOA", $dados['idOA']);
        	$database->bind(":idDisciplina", $dados['idDisciplina']);
        	$database->execute();
        	return $database->rowCount();
		}
		catch(Exception $e) {
			trigger_error("Erro ao pegar número de acessos do OA!".$e->getMessage(), $e->getCode());
		}
	}

	public function getAcessosValidos($dados) {
		try {
			$database = new Database;
        	$sql = "SELECT * FROM acessos_oa WHERE id_oa = :idOA AND id_disciplina = :idDisciplina AND tempo_acesso >= :tempoMinimo AND tempo_acesso <= :tempoMaximo";
        	$database->query($sql);
        	$database->bind(":idOA", $dados['idOA']);
        	$database->bind(":idDisciplina", $dados['idDisciplina']);
        	$database->bind(":tempoMinimo", self::TEMPO_MINIMO);
        	$database->bind(":tempoMaximo", self::TEMPO_MAXIMO);
        	$database->execute();
        	return $database->rowCount();
		}
		catch(Exception $e) {
			trigger_error("Erro ao pegar número de acessos do OA!".$e->getMessage(), $e->getCode());
		}
	}
}

?>