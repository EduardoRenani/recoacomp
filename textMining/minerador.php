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

		private $textosTratados;

		private $palavras;

		function __construct($id) {
			if(!is_null($id)) {
				$this->validaInteiro($id);
				$this->carregaDados($id);
			}
		}

		private function carregaDados($id = NULL) {
			try {
				$database = new Database;

	        	$sql = "SELECT comentario, id FROM avaliacoes_quali WHERE oa_id = :id";
	        	$database->query($sql);
	        	$database->bind(":id", $id);
	        	$database->execute();

	        	$this->setTextos($database->resultSet());
			}
			catch(Exception $e) {
				trigger_error("Erro ao pegar comentários do OA!".$e->getMessage(), $e->getCode());
			}
		}

		public function mineraTextos() {
			$this->trataTexto();
			foreach ($this->getTextos() as $key => $texto) {
				$this->interpretaTexto($key);
			}
		}

		private function trataTexto() {
			$this->separaFrases($this->getTextos());
		}

		private function separaFrases($textos) {
			foreach ($textos as $key=>$texto) {
				$paragrafos = explode("\n", $texto["comentario"]);
				foreach ($paragrafos as $key1 => $paragrafo) {
					$frases[$key1] = $this->multiexplode(array(".", "?", "!"), $paragrafo);
					foreach ($frases[$key1] as $key2 => $frase) {
						$virgulas[$key2] = explode(",", $frase);
						foreach ($virgulas[$key2] as $key3 => $virgula) {
							$palavras[$key3] = explode(" ", $virgula);
							foreach ($palavras[$key3] as $key4 => $palavra) {
								$palavra = $this->removeAcentos(utf8_decode($palavra));
								$palavras[$key3][$key4] = utf8_encode($palavra);
								$palavras[$key3][$key4] = str_replace("?", "", $palavras[$key3][$key4]);
								$palavrasAchadas[$key][] = $palavras[$key3][$key4];
							}
							$novosParagrafos[$key1]["frases"][$key2]["virgulas"][$key3]["palavras"] = $palavras[$key3];
						}
					}
				}
				$analise[$key]['paragrafos'] = $novosParagrafos;
			}
			$this->contaPalavras($palavrasAchadas);
			$this->setTextosTratados($analise);
		}

		private function contaPalavras($palavrasAchadas) {
			foreach($palavrasAchadas as $key => $palavras) {
				foreach ($palavras as $palavra) {
					if(!isset($quantidade[$key][$palavra])) {
					$quantidade[$key][$palavra] = 0;
					}
					$quantidade[$key][$palavra]++;
				}
				arsort($quantidade[$key]);
			}
			$this->setPalavras($quantidade);
		}

		private function interpretaTexto($key) {
			echo "<pre>";
			foreach ($this->getTextosTratados()[$key] as $textoTratado) {
				foreach ($textoTratado as $paragrafos) {
					foreach ($paragrafos as $frases) {
						foreach ($frases as $frase) {
							foreach ($frase as $virgulas) {
								foreach ($virgulas as $virgula) {
									foreach ($virgula as $palavras) {
										foreach ($palavras as $palavra) {
											var_dump($palavra);
											$sentido = NULL;
											$sentido = $this->verNoBanco($palavra);
											if(is_null($sentido)) $sentido = $this->pesquisarInternet($palavra);
											//if(is_null($sentido)) $sentido = $this->pergunta($palavra);
										}
									}
								}
							}
						}
					}
				}
			}
		}

		private function verNoBanco($palavra) {
			try {
				$database = new Database;

	        	$sql = "SELECT sentido FROM palavras_minerador WHERE palavra = :palavra";
	        	$database->query($sql);
	        	$database->bind(":palavra", $palavra);
	        	$database->execute();

	        	if($database->rowCount() != 0) {
	 	  	     	return $database->single();
	 	  	     }
	 	  	     else {
	 	  	     	return NULL;
	 	  	     }
			}
			catch(Exception $e) {
				trigger_error("Erro ao pegar número de acessos do OA!".$e->getMessage(), $e->getCode());
			}
		}

		private function pesquisarInternet($palavra) {
			$pesquisa = new Pesquisa($palavra);
			$sinonimos = $pesquisa->getResultado();
			foreach ($sinonimos as $sinonimo) {
				$this->verNoBanco($sinonimo);
			}
		}

		public function multiexplode($delimiters,$string) {
		    $ready = str_replace($delimiters, $delimiters[0], $string);
		    $launch = explode($delimiters[0], $ready);
		    return  $launch;
		}

		public function removeAcentos($string, $slug = false) {
		  $string = strtolower($string);
		  // Código ASCII das vogais
		  $ascii['a'] = range(224, 230);
		  $ascii['e'] = range(232, 235);
		  $ascii['i'] = range(236, 239);
		  $ascii['o'] = array_merge(range(242, 246), array(240, 248));
		  $ascii['u'] = range(249, 252);
		  // Código ASCII dos outros caracteres
		  $ascii['b'] = array(223);
		  $ascii['c'] = array(231);
		  $ascii['d'] = array(208);
		  $ascii['n'] = array(241);
		  $ascii['y'] = array(253, 255);
		  foreach ($ascii as $key=>$item) {
		    $acentos = '';
		    foreach ($item AS $codigo) $acentos .= chr($codigo);
		    $troca[$key] = '/['.$acentos.']/i';
		  }
		  $string = preg_replace(array_values($troca), array_keys($troca), $string);
		  // Slug?
		  if ($slug) {
		    // Troca tudo que não for letra ou número por um caractere ($slug)
		    $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
		    // Tira os caracteres ($slug) repetidos
		    $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
		    $string = trim($string, $slug);
		  }
		  return $string;
		}

		public function getTextos() {
			return $this->textos;
		}

		public function setTextos($textos) {
			$this->validaArray($textos);
			$this->textos = $textos;
		}

		public function getTextosTratados() {
			return $this->textosTratados;
		}

		public function setTextosTratados($textosTratados) {
			$this->validaArray($textosTratados);
			$this->textosTratados = $textosTratados;
		}

		public function getPalavras() {
			return $this->palavras;
		}

		public function setPalavras($palavras) {
			$this->validaArray($palavras);
			$this->palavras = $palavras;
		}

		protected function validaInteiro($valor) {
			if(!is_int($valor)) {
				throw new Exception("Erro! Esperava receber inteiro, recebeu ".gettype($valor));
			}
		}

		protected function validaArray($valor) {
			if(!is_array($valor) && !is_null($valor)) {
				throw new Exception("Erro! Esperava receber array, recebeu ".gettype($valor));
			}
		}
	}

	$minerador = new Minerador(9);
	echo "<pre>";
	var_dump($minerador->getTextos());
	echo "</pre>";
	$minerador->mineraTextos();
	echo "<pre>";
	var_dump($minerador->getTextosTratados());
	echo "</pre>";
	echo "<pre>";
	var_dump($minerador->getPalavras());
	echo "</pre>";
?>