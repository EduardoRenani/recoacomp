<?php
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
	 * Id dos usuários que acessaram a página do objeto de aprendizagem
	 * @var array id dos usuários
	 */
	private $idUsuarios;

	/**
	 * Id do usuário cujo acesso será cadastrado
	 * @var int id dos usuário
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

	private $acessosTotais;

	private $acessosValidos;

	private $acessosInvalidos;

	/**
	 * Objeto que possui métodos e parâmetros para tratar o tempo de acesso do objeto de aprendizagem
	 * @var object tempo de acesso do objeto de aprendizagem
	 */
	private $tempoAcessoOA;

	/**
	 * Quando instancia o objeto, seta as variáveis de instâncias 'tempoAcessoOA' e 'indicesOA'
	 */
	function __construct($dados = NULL) {
		$this->tempoAcessoOA = new TempoAcessoOA($dados);
		if(!is_null($dados)) {
			$this->carregaDados($dados);
		}
	}

	/**
	 * Carrega os dados do OA pelo banco de dados
	 * @param int Id do usuário
	 * @throws Exception Em caso de erro
	 */
	public function carregaDados($dados) {
		try {
			$this->setIdOA($dados['idOA']);
			$this->setIdDisciplina($dados['idDisciplina']);
			$this->calculaTotalAcessos($dados);
			$this->calculaAcessosValidos($dados);
			$this->calculaAcessosInvalidos($dados);
		}
		catch(Exception $e) {
			trigger_error("Erro ao carregar dados do banco!".$e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Insere os dados de acesso do objeto de aprendizagem no banco de dados
	 * @throws Exception Em caso de erro
	 */
	public function salvaDados() {
		try {
			$this->validaDados();
			$dados = $this->getDados();
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
	 * Retorna dados para inserir no banco de dados
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
	 * @param array idUsuarios
	 */
	public function setIdUsuarios($idUsuarios) {
		$this->validaArray($idUsuarios);
		$this->idUsuarios = $idUsuarios;
	}

	/**
	 * @return array idUsuarios
	 */
	public function getIdUsuarios() {
		return $this->idUsuarios;
	}

	/**
	 * @param int idUsuario
	 */
	public function setIdUsuario($idUsuario) {
		$this->validaInteiro($idUsuario);
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
		$this->validaInteiro($idDisciplina);
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
		$this->validaInteiro($idOA);
		$this->idOA = $idOA;
	}

	/**
	 * @return int idOA
	 */
	public function getIdOA() {
		return $this->idOA;
	}

	/**
	 * @param int idOA
	 */
	public function setAcessosTotais($acessos) {
		$this->validaInteiro($acessos);
		$this->acessosTotais = $acessos;
	}

	/**
	 * @return int idOA
	 */
	public function getAcessosTotais() {
		return $this->acessosTotais;
	}

	/**
	 * @param int idOA
	 */
	public function setAcessosValidos($acessos) {
		$this->validaInteiro($acessos);
		$this->acessosValidos = $acessos;
	}

	/**
	 * @return int idOA
	 */
	public function getAcessosValidos() {
		return $this->acessosValidos;
	}

	/**
	 * @param int idOA
	 */
	public function setAcessosInvalidos($acessos) {
		$this->validaInteiro($acessos);
		$this->acessosInvalidos = $acessos;
	}

	/**
	 * @return int idOA
	 */
	public function getAcessosInvalidos() {
		return $this->acessosInvalidos;
	}

	/**
	 * Verifica se variável é do tipo inteiro
	 * @throws InvalidArgumentException em caso de argumento inválido
	 */
	private function validaInteiro($var) {
		if(!is_int($var)) {
			throw new InvalidArgumentException("Erro! Esperava receber inteiro, recebeu ".gettype($var), E_USER_ERROR);
		}
	}

	/**
	 * Verifica se variável é do tipo array
	 * @throws InvalidArgumentException em caso de argumento inválido
	 */
	private function validaArray($var) {
		if(!is_array($var)) {
			throw new InvalidArgumentException("Erro! Esperava receber array, recebeu ".gettype($var), E_USER_ERROR);
		}
	}

	/**
	 * @return object tempoAcessoOA
	 */
	public function getTempoAcessoOA() {
		return $this->tempoAcessoOA;
	}

	public function getMaisAcessosValidos($dados) {
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

	public function calculaAcessosInvalidos($dados) {
		try {
			$database = new Database;

        	$sql = "SELECT * FROM acessos_oa WHERE id_oa = :idOA AND id_disciplina = :idDisciplina AND (tempo_acesso <= :tempoMinimo OR tempo_acesso >= :tempoMaximo)";
        	$database->query($sql);
        	$database->bind(":idOA", $dados['idOA']);
        	$database->bind(":idDisciplina", $dados['idDisciplina']);
        	$database->bind(":tempoMinimo", self::TEMPO_MINIMO);
        	$database->bind(":tempoMaximo", self::TEMPO_MAXIMO);
        	$database->execute();

        	$this->setAcessosInvalidos($database->rowCount());
		}
		catch(Exception $e) {
			trigger_error("Erro ao pegar número de acessos inválidos do OA!".$e->getMessage(), $e->getCode());
		}
	}

	public function calculaTotalAcessos($dados) {
		try {
			$database = new Database;

        	$sql = "SELECT * FROM acessos_oa WHERE id_oa = :idOA AND id_disciplina = :idDisciplina";
        	$database->query($sql);
        	$database->bind(":idOA", $dados['idOA']);
        	$database->bind(":idDisciplina", $dados['idDisciplina']);
        	$database->execute();

        	$this->setAcessosTotais($database->rowCount());
		}
		catch(Exception $e) {
			trigger_error("Erro ao pegar número de acessos do OA!".$e->getMessage(), $e->getCode());
		}
	}

	public function calculaAcessosValidos($dados) {
		try {
			$database = new Database;

        	$sql = "SELECT * FROM acessos_oa WHERE id_oa = :idOA AND id_disciplina = :idDisciplina AND tempo_acesso >= :tempoMinimo AND tempo_acesso <= :tempoMaximo";
        	$database->query($sql);
        	$database->bind(":idOA", $dados['idOA']);
        	$database->bind(":idDisciplina", $dados['idDisciplina']);
        	$database->bind(":tempoMinimo", self::TEMPO_MINIMO);
        	$database->bind(":tempoMaximo", self::TEMPO_MAXIMO);
        	$database->execute();

        	$this->setAcessosValidos($database->rowCount());
		}
		catch(Exception $e) {
			trigger_error("Erro ao pegar número de acessos do OA!".$e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Verifica se OA teve algum acesso
	 * @return boolean true - se tiver acessos, false - se não tiver acessos
	 */
	public function temAcessos($dados) {
		if(($this->getTotalAcessos($dados) == 0)) {
			return false;
		}
		else {
			return true;
		}
	}
}

?>