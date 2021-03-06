<?php
	/**
	 * Classe que contem informacoes e metodos para o upload de fotos
	 *
	 * @category Fotos
	 * @package  Usuário
	 * @author Arthur Adolfo <arthur_adolfo@hotmail.com>
	 * @version 1.0
	 * @copyright StartU
	 */

	class Foto extends Arquivo implements AcoesCadastroCarregamento {

		const TABELA_FOTOS = "fotos";

		/**
		 * Id da foto
		 * @var id da foto
		 */
		private $id;

		/**
		 * Id do usuário
		 * @var id do usuário
		 */
		private $idUsuario;

		/**
		 * Arquivo da foto a fazer upload
		 * @var file dados do arquivo da foto
		 */
		private $arquivo;

		/**
		 * Nome para a foto
		 * @var string nome da foto
		 */
		private $nome;

		/**
		 * Caminho para a foto
		 * @var string caminho da foto
		 */
		private $caminho;

		/**
		 * Descrição para a foto
		 * @var string descrição da foto
		 */
		private $descricao;

		/**
		 * Tipo de foto (Perfil, etc)
		 * @var string tipo de foto
		 */
		private $tipo;

		/**
		 * @var string data de cadastro
		 */
		private $dataCadastro;

		/**
		 * Tipos permitidos
		 * @var array tipos permitidos
		 */
		private $tiposPermitidos = array("bmp", "gif", "jpeg", "jpg", "png");

		/**
		 * Construtor da classe, se id não for nulo, carrega dados da foto de perfil
		 * @param int id do usuário que pertence a foto
	     * @throws InvalidArgumentException Uso de argumentos inválidos
	     * @throws Exception Erro ocorrido
		 */
		function __construct($idUsuario = NULL) {
			parent::__construct();
			if(!is_null($idUsuario)) {
				TratamentoErros::validaInteiro($idUsuario, "id do usuário");
				$carregamento = new Carregamento;
				if($carregamento->valoresExistenteDB(array('id_usuario' => $idUsuario), self::TABELA_FOTOS)) {
					$this->carregaInformacao(array('id_usuario' => $idUsuario));
				}
				else {
					$this->setIdUsuario($idUsuario);
				}
			}
		}

		/**
		 * Carrega informações da foto no banco de dados para preencher o objeto
		 * @param array dados do usuário para procurar na tabela
		 */
		public function carregaInformacao($dados) {
			$carregamento = new Carregamento;
			$this->setDados($carregamento->carregaDados($dados, self::TABELA_FOTOS));
		}

	    /**
	     * Define informações da foto de perfil
	     * @param array dados da foto de perfil a ser definida
	     * @throws InvalidArgumentException Uso de argumentos inválidos
	     */
		public function setDados($dados) {
			TratamentoErros::validaArray($dados, "dados da foto");
			try {
            	$this->setId($dados['id']);
		        $this->setIdUsuario($dados['id_usuario']);
		        $this->setNome($dados['nome']);
		        $this->setCaminho($dados['caminho']);
		        $this->setDescricao($dados['descricao']);
		        $this->setTipo($dados['tipo']);
		        $this->setDataCadastro($dados['data']);
		    }
		    catch(Exception $e) {
		    	trigger_error($e->getMessage(), $e->getCode());
		    }
		}

	    /**
	     * Retorna informações da foto para inserir no DB
	     * @return array dados da foto
	     */
		public function getDadosBanco() {
			$dados = array( "id"         => $this->getId(),
        					"id_usuario" => $this->getIdUsuario(),
        					"nome"       => $this->getNome(),
	        				"caminho"    => $this->getCaminho(),
	        				"descricao"  => $this->getDescricao(),
	        				"tipo"       => $this->getTipo(),
	        				"data"       => $this->getDataCadastro()
	        				);
			return $dados;
		}

	    /**
	     * Retorna informações da foto
	     * @return array dados da foto
	     */
		public function getDados($arquivo = false) {
			$dados = array( "id"         => $this->getId(),
        					"id_usuario" => $this->getIdUsuario(),
        					"nome"       => $this->getNome(),
	        				"caminho"    => $this->getCaminho(),
	        				"descricao"  => $this->getDescricao(),
	        				"arquivo"	 => $this->getArquivo(),
	        				"tipo"       => $this->getTipo(),
	        				"data"       => $this->getDataCadastro()
	        				);
			return $dados;
		}

		/**
		 * Salva dados no banco de dados (atualiza cadastro com a foto)
		 * Se id for nulo, cadastra nova foto no banco de dados
		 * Se não for nulo, atualiza banco de dados
	     * @throws Exception Ocorreu erro
		 */

		public function salvaDados() {
			$this->validaDados();
			$this->validaExtensao();
			if(is_null($this->getId())) {
				try {
					$cadastro = new Cadastro;
					$id = $cadastro->insereDadosBancoDeDados($this->getDadosBanco(), self::TABELA_FOTOS);
					$this->setId($id);
					TratamentoErros::validaInteiro($this->getId(), "id da foto");
					$this->carregaInformacao(array('id' => $id));
					parent::uploadArquivo($this->getDados());
				}
				catch(Exception $e) {
					trigger_error("Ocorreu um erro ao tentar salvar dados da foto no DB! ".$e->getMessage().Utilidades::debugBacktrace(), E_USER_ERROR);
				}
			}
			else {
				try {
					$cadastro = new Cadastro;
					$cadastro->atualizaDadosBancoDeDados($this->getDadosBanco(), self::TABELA_FOTOS);
					parent::uploadArquivo($this->getDados());
				}
				catch(Exception $e) {
					trigger_error("Ocorreu um erro ao tentar salvar dados da foto no DB! ".$e->getMessage().Utilidades::debugBacktrace(), $e->getCode());
				}
			}
		}

		/**
	     * Valida dados da foto de eprfil
	     * @throws Exception caso ocorra erro
	     */

		public function validaDados() {
			TratamentoErros::validaNulo($this->getIdUsuario(), "id do usuário da foto");
			TratamentoErros::validaNulo($this->getNome(), "nome da foto");
			TratamentoErros::validaNulo($this->getCaminho(), "caminho da foto");
			TratamentoErros::validaNulo($this->getTipo(), "tipo da foto");
			TratamentoErros::validaNulo($this->getArquivo(), "arquivo da foto");
			TratamentoErros::validaNulo($this->getDataCadastro(), "data de cadastro da foto");
		}

		/**
		 * Valida o id do usuário
	     * @throws InvalidArgumentException Uso de argumentos inválidos
		 */
		private function validaExtensao() {
			$tipoPermitido = false;
			foreach($this->getTiposPermitidos() as $tipo){
	            if(strtolower($this->getExtensao($this->getArquivo())) == strtolower($tipo)){
	                $tipoPermitido = true;
	            }
	        }
	        if(!$tipoPermitido){
	            throw new Exception("Erro! Tipo não é permitido! envie outro arquivo!".Utilidades::debugBacktrace(), E_USER_ERROR);
	        }
		}

	    /**
	     * Retorna informações da foto
	     * @return array dados da foto
	     */
		public function getExtensao($arquivo) {
			$this->validaArquivo($arquivo);
			$tipos = explode(".", $arquivo["name"]); //se arquivo.ext tipos[0] = "arquivo" e tipos[1] = "ext"
			$extensao = $tipos[count($tipos) - 1];
			return $extensao;
		}

	    /**
	     * Define id da foto
	     * @param string id da foto
	     */
		public function setId($id) {
			TratamentoErros::validaInteiro($id, "id da foto");
			$this->id = $id;
		}

		/**
	     * Retorna id do usuário
	     * @return int id do usuário
	     */
		public function getId() {
			return $this->id;
		}

	    /**
	     * Define nome do usuário da foto
	     * @param string nome do usuário da foto
	     */
		public function setIdUsuario($idUsuario) {
			TratamentoErros::validaInteiro($idUsuario, "id do usuário da foto");
			$this->idUsuario = $idUsuario;
		}

		/**
	     * Retorna id do usuário da foto
	     * @return string id do usuário da foto
	     */
		private function getIdUsuario() {
			return $this->idUsuario;
		}

	    /**
	     * Define nome da foto
	     * @param string nome da foto
	     */
		public function setNome($nome) {
			TratamentoErros::validaString($nome, "nome da foto");
			$this->nome = $nome;
		}

		/**
	     * Retorna nome da foto
	     * @return string nome da foto
	     */
		public function getNome() {
			return $this->nome;
		}

	    /**
	     * Define caminho da foto
	     * @param string caminho da foto
	     */
		public function setCaminho($caminho) {
			TratamentoErros::validaString($caminho, "caminho da foto");
			$this->caminho = $caminho;
		}

		/**
	     * Retorna caminho da foto
	     * @return string caminho da foto
	     */
		public function getCaminho() {
			return $this->caminho;
		}

	    /**
	     * Define descrição da foto
	     * @param string descrição da foto
	     */
		public function setDescricao($descricao) {
			TratamentoErros::validaString($descricao, "descrição da foto");
			$this->descricao = $descricao;
		}

		/**
	     * Retorna descrição da foto
	     * @return string descrição da foto
	     */
		public function getDescricao() {
			return $this->descricao;
		}

	    /**
	     * Define tipo de foto
	     * @param string tipo de foto
	     */
		public function setTipo($tipo) {
			TratamentoErros::validaInteiro($tipo, "tipo da foto");
			$this->tipo = $tipo;
		}

		/**
	     * Retorna tipo de foto
	     * @return string tipo de foto
	     */
		public function getTipo() {
			return $this->tipo;
		}

	    /**
	     * Define o arquivo da foto
	     * @param file foto
	     */
		public function setArquivo($arquivo) {
			$this->validaArquivo($arquivo);
			$this->arquivo = $arquivo;
		}

		/**
		 * Valida arquivo da foto
	     * @throws InvalidArgumentException Uso de argumentos inválidos
		 */
		private function validaArquivo($arquivo) {
			if(!isset($arquivo)) {
				throw new InvalidArgumentException("Erro ao definir o arquivo da foto. Esperava um arquivo, recebeu ".gettype($arquivo).Utilidades::debugBacktrace(), E_USER_ERROR);
			}
		}

		/**
	     * Retorna arquivo foto
	     * @return file foto
	     */
		public function getArquivo() {
			return $this->arquivo;
		}

	    /**
	     * Define os tipos permitidos
	     * @param array tipos permitidos
	     */
		public function setTiposPermitidos($tiposPermitidos) {
			TratamentoErros::validaArray($tiposPermitidos, "tipos permitidos da foto");
			$this->tiposPermitidos = $tiposPermitidos;
		}

		/**
	     * Retorna tiposPermitidos
	     * @return file
	     */
		public function getTiposPermitidos() {
			return $this->tiposPermitidos;
		}

	    /**
	     * Define a data de cadastro da foto
	     * @param string data de cadastro da foto a ser definido
	     */
		public function setDataCadastro($dataCadastro) {
			TratamentoErros::validaString($dataCadastro, "data de cadastro da foto");
			TratamentoErros::validaNulo($dataCadastro, "data de cadastro da foto");
			$this->dataCadastro = $dataCadastro;
		}

	    /**
	     * Return data de cadastro da foto de perfil
	     * @return string data de cadastro da foto de perfil
	     */
		private function getDataCadastro() {
			return $this->dataCadastro;
		}
	}
?>