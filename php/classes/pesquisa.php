<?php
/**
 * Classe para fazer pesquisas na internet pelo php
 * Usado pelo minerador dee textos dos OAs
 * @category pesquisa
 * @package Mineração
 */
	class Pesquisa {
		const SINONIMOS = 1;

		const DEFINICAO = 2;

		private $pesquisa;

		private $resultado;

		function __construct($pesquisa = NULL) {
			if(!is_null($pesquisa) || $pesquisa != "") {
				$this->setPesquisa($pesquisa);
				$this->fazPesquisa(self::SINONIMOS);
				//$this->fazPesquisa(self::DEFINICAO);
			}
		}

		public function fazPesquisa($tipo = NULL) {
			$cURL = curl_init('http://www.sinonimos.com.br/'.$this->getPesquisa().'/');
			curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
			$resultado = curl_exec($cURL);
			curl_close($cURL);
			if($tipo == self::SINONIMOS) {
				$this->trataSinonimos($resultado);
			}
			else if($tipo == self::DEFINICAO) {
				//$this->trataDefinicao($resultado);
			}
			else {
				$this->setResultado($resultado);
			}
		}

		private function trataSinonimos($string) {
			preg_match_all('/<p class="sinonimos">(.*?)<\/p>/s', $string, $string, PREG_PATTERN_ORDER);
			//var_dump($string[1]);
			foreach($string[1] as $sinonimos) {
				preg_match_all('/[^>]class="sinonimo">(.*?)<\/a>/s', $sinonimos, $sinonimos, PREG_PATTERN_ORDER);
				//var_dump($sinonimos[1]);
				if($sinonimos[1]) {
					$this->setResultado($sinonimos[1]);
				}
			}
		}

		public function setPesquisa($pesquisa) {
			$this->validaString($pesquisa);
			$this->pesquisa = $pesquisa;
		}

		public function getPesquisa() {
			return $this->pesquisa;
		}

		public function setResultado($resultado) {
			$this->validaArray($resultado);
			$this->resultado = $resultado;
		}

		public function getResultado() {
			return $this->resultado;
		}

		private function validaString($valor) {
			if(!is_string($valor)) {
				throw new Exception("Erro! Esperava receber string, recebeu ".gettype($valor));
			}
		}

		private function validaArray($valor) {
			if(!is_array($valor)) {
				throw new Exception("Erro! Esperava receber array, recebeu ".gettype($valor));
			}
		}
	}
?>