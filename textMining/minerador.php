<?php
	include("base.php");
	/**
	 * Classe para minerar o texto das avaliações dos OAs
	 * @category Minerador
	 * @package Avaliação
	 * @author Arthur Adolfo <arthur_adolfo@hotmail.com>
	 */

	class Minerador {
		
		
		private $textos;

		function __construct($id) {
			if(!is_null($id)) {
				$this->validaInteiro($id);
				$this->carregaDados($id);
			}
		}

		private function carregaDados($id = NULL) {
			try {
				$database = new Database;

	        	$sql = "SELECT comentario FROM avaliacoes_quali WHERE oa_id = :id";
	        	$database->query($sql);
	        	$database->bind(":id", $id);
	        	$database->execute();

	        	$this->setTextos($database->resultSet());
			}
			catch(Exception $e) {
				trigger_error("Erro ao pegar número de acessos do OA!".$e->getMessage(), $e->getCode());
			}
		}

		public function mineraTexto() {
			$this->$verNoBanco();
			$this->$pesquisarInternet();
			$this->pergunta();
		}

		public function getTextos() {
			return $this->textos;
		}

		public function setTextos($textos) {
			$this->validaArray($textos);
			$this->textos = $textos;
		}

		protected function validaInteiro($valor) {
			if(!is_int($valor)) {
				throw new Exception("Erro! Esperava receber inteiro, recebeu ".gettype($valor));
			}
		}

		protected function validaArray($valor) {
			if(!is_array($valor)) {
				throw new Exception("Erro! Esperava receber inteiro, recebeu ".gettype($valor));
			}
		}
	}

	$minerador = new Minerador(9);
	var_dump($minerador->getTextos());
?>