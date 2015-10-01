<?php
	/**
	 * Classe para minerar o texto das avaliações dos OAs
	 * @category Minerador
	 * @package Avaliação
	 * @author Arthur Adolfo <arthur_adolfo@hotmail.com>
	 */

	class Minerador {
		
		
		private $texto;

		function __construct($id) {
			$this->validaId($id);
			$this->carregaDados($id);
		}

		private function carregaDados($id) {

		}

		protected function validaId($id) {
			if(!is_int($id)) {
				throw new Exception("Erro! Esperava receber inteiro, recebeu ".gettype($id));
			}
		}
	}
?>