<?php
	include("base.php");
	/**
	 * Classe para minerar o texto das avaliações dos OAs
	 * @category Minerador
	 * @package Avaliação
	 * @author Arthur Adolfo <arthur_adolfo@hotmail.com>
	 */

	class Minerador {
		const PESQUISADO = 1;

		private $textos;

		private $textosTratados;

		private $palavras;

		private $sentidos;

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
			var_dump($this->getSentidos());
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
			$sentido[$key] = 0;
			foreach ($this->getTextosTratados()[$key] as $textoTratado) {
				foreach ($textoTratado as $paragrafos) {
					foreach ($paragrafos as $frases) {
						foreach ($frases as $frase) {
							foreach ($frase as $virgulas) {
								foreach ($virgulas as $key1 => $virgula) {
									foreach ($virgula as $palavras) {
									$sentidoVirgula[$key1] = NULL;
										foreach ($palavras as $palavra) {
											var_dump($palavra);
											if(!$this->isStopWord($palavra) && !$this->isAdverbio($palavra) && !$this->isInterjeicao($palavra)) {
												if(is_null($sentidoVirgula[$key1])) {
													$sentidoVirgula[$key1] = $this->verNoBanco($palavra);
													if(is_null($sentidoVirgula[$key1])) $sentidoVirgula[$key1] = $this->pesquisarInternetSentido($palavra);
													//if(is_null($sentidoVirgula[$key])) $sentidoVirgula[$key] = $this->pergunta($palavra);
												}
												else {
													$sentidoAux = $this->verNoBanco($palavra);
													if(is_null($sentidoAux)) $sentidoAux = $this->pesquisarInternetSentido($palavra);
													//if(is_null($sentidoAux)) $sentidoAux = $this->pergunta($palavra);
													if(!is_null($sentidoAux)) $sentidoVirgula[$key1] = $sentidoVirgula[$key1]*$sentidoAux;
												}
											}
											//var_dump($sentidoVirgula);
										}
									}
									$sentido[$key]+=$sentidoVirgula[$key1];
									var_dump($sentido);
								}
							}
						}
					}
				}
			}
			$this->setSentidos($sentido);
		}

		private function isStopWord($palavra) {
			try {
				$database = new Database;

	        	$sql = "SELECT * FROM raf_stopwords WHERE stopword = :palavra";
	        	$database->query($sql);
	        	$database->bind(":palavra", $palavra);
	        	$database->execute();

	        	if($database->rowCount() != 0) {
	 	  	     	return true;
	 	  	     }
	 	  	     else {
	 	  	     	return false;
	 	  	     }
			}
			catch(Exception $e) {
				trigger_error("Erro ao pegar stopword no banco!".$e->getMessage(), $e->getCode());
			}
		}

		private function isAdverbio($palavra) {
			try {
				$database = new Database;

	        	$sql = "SELECT * FROM raf_adverbios WHERE adverbio = :palavra";
	        	$database->query($sql);
	        	$database->bind(":palavra", $palavra);
	        	$database->execute();

	        	if($database->rowCount() != 0) {
	 	  	     	return true;
	 	  	     }
	 	  	     else {
	 	  	     	return false;
	 	  	     }
			}
			catch(Exception $e) {
				trigger_error("Erro ao pegar adverbio no banco!".$e->getMessage(), $e->getCode());
			}
		}

		private function isInterjeicao($palavra) {
			try {
				$database = new Database;

	        	$sql = "SELECT * FROM raf_interjeicoes WHERE interj = :palavra";
	        	$database->query($sql);
	        	$database->bind(":palavra", $palavra);
	        	$database->execute();

	        	if($database->rowCount() != 0) {
	 	  	     	return true;
	 	  	     }
	 	  	     else {
	 	  	     	return false;
	 	  	     }
			}
			catch(Exception $e) {
				trigger_error("Erro ao pegar interjeicao no banco!".$e->getMessage(), $e->getCode());
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
	 	  	     	return (int) $database->single()["sentido"];
	 	  	     }
	 	  	     else {
	 	  	     	return NULL;
	 	  	     }
			}
			catch(Exception $e) {
				trigger_error("Erro ao pegar sentido de palavra no banco!".$e->getMessage(), $e->getCode());
			}
		}

		private function pesquisarInternetSentido($palavra) {
			$sentido = NULL;
			$pesquisa = new Pesquisa($palavra);
			$sinonimos = $pesquisa->getResultado();
			if(!is_null($sinonimos)) {
				foreach($sinonimos as $sinonimos1) {
					if(!is_null($sinonimos1)) {
						foreach ($sinonimos1 as $sinonimo) {
							$sinonimo = $this->removeAcentos($sinonimo);
							$sentido = $this->verNoBanco($sinonimo);
							if(!is_null($sentido)) return $sentido;
						}
					}
				}
			}
			return $sentido;
		}

		public function aprenderPalavras() {
			try {
				$database = new Database;

	        	$sql = "SELECT * FROM palavras_minerador WHERE sinonimo_pesquisado != :pesquisado LIMIT 500";
	        	$database->query($sql);
	        	$database->bind(":pesquisado", self::PESQUISADO);
	        	$database->execute();

	        	if($database->rowCount() != 0) {
	        		$palavras = $database->resultSet();
	        		//echo "<pre>";
	        		//var_dump($palavras);
	        		foreach ($palavras as $palavra) {
	        			$this->pesquisarInternetSinonimos($palavra);
						$database = new Database;
		        		$sql = "UPDATE palavras_minerador SET sinonimo_pesquisado = :pesquisado WHERE palavra = :palavra";
		        		$database->query($sql);
			        	$database->bind(":pesquisado", self::PESQUISADO);
			        	$database->bind(":palavra", $palavra['palavra']);
			        	$database->execute();
	        		}
	        	}
	        }
			catch(Exception $e) {
				trigger_error("Erro ao pegar palavras no banco!".$e->getMessage(), $e->getCode());
			}
		}

		public function aprenderStopWords() {
			try {
				$database = new Database;

	        	$sql = "SELECT * FROM raf_stopwords WHERE sinonimo_pesquisado != :pesquisado LIMIT 500";
	        	$database->query($sql);
	        	$database->bind(":pesquisado", self::PESQUISADO);
	        	$database->execute();

	        	if($database->rowCount() != 0) {
	        		$palavras = $database->resultSet();
	        		//echo "<pre>";
	        		//var_dump($palavras);
	        		foreach ($palavras as $palavra) {
	        			$this->pesquisarInternetSinonimosStopWords($palavra);
						$database = new Database;
		        		$sql = "UPDATE raf_stopwords SET sinonimo_pesquisado = :pesquisado WHERE stopword = :palavra";
		        		$database->query($sql);
			        	$database->bind(":pesquisado", self::PESQUISADO);
			        	$database->bind(":palavra", $palavra['stopword']);
			        	$database->execute();
	        		}
	        	}
	        }
			catch(Exception $e) {
				trigger_error("Erro ao pegar palavras no banco!".$e->getMessage(), $e->getCode());
			}
		}

		public function aprenderAdverbios() {
			try {
				$database = new Database;

	        	$sql = "SELECT * FROM raf_adverbios WHERE sinonimo_pesquisado != :pesquisado LIMIT 500";
	        	$database->query($sql);
	        	$database->bind(":pesquisado", self::PESQUISADO);
	        	$database->execute();

	        	if($database->rowCount() != 0) {
	        		$palavras = $database->resultSet();
	        		//echo "<pre>";
	        		//var_dump($palavras);
	        		foreach ($palavras as $palavra) {
	        			$this->pesquisarInternetSinonimosAdverbio($palavra);
						$database = new Database;
		        		$sql = "UPDATE raf_adverbios SET sinonimo_pesquisado = :pesquisado WHERE adverbio = :palavra";
		        		$database->query($sql);
			        	$database->bind(":pesquisado", self::PESQUISADO);
			        	$database->bind(":palavra", $palavra['adverbio']);
			        	$database->execute();
	        		}
	        	}
	        }
			catch(Exception $e) {
				trigger_error("Erro ao pegar palavras no banco!".$e->getMessage(), $e->getCode());
			}
		}

		private function pesquisarInternetSinonimos($dados) {
			$pesquisa = new Pesquisa($dados['palavra']);
			$sinonimos = $pesquisa->getResultado();
			//var_dump($sinonimos);
			foreach ($sinonimos as $sinonimos1) {
				if(!is_null($sinonimos1)) {
					foreach ($sinonimos1 as $sinonimo) {
						$sinonimo = $this->removeAcentos($sinonimo);
						var_dump($sinonimo);
						$dados['sinonimo'] = $sinonimo;
						$this->registrarPalavra($dados);
					}
				}
			}
		}

		private function pesquisarInternetSinonimosStopWords($dados) {
			$pesquisa = new Pesquisa($dados['stopword']);
			$sinonimos = $pesquisa->getResultado();
			//var_dump($sinonimos);
			foreach ($sinonimos as $sinonimos1) {
				if(!is_null($sinonimos1)) {
					foreach ($sinonimos1 as $sinonimo) {
						$sinonimo = $this->removeAcentos($sinonimo);
						var_dump($sinonimo);
						$dados['sinonimo'] = $sinonimo;
						$this->registrarStopWord($dados);
					}
				}
			}
		}

		private function registrarStopWord($dados) {
			try {
				$database = new Database;

	        	$sql = "INSERT INTO raf_stopwords VALUES (NULL, :sinonimo, 0)";
	        	$database->query($sql);
	        	$database->bind(":sinonimo", $dados['sinonimo']);
	        	$database->execute();
			}
			catch(Exception $e) {
				trigger_error("Erro ao registrar palavra no banco!".$e->getMessage(), $e->getCode());
			}
		}

		private function pesquisarInternetSinonimosAdverbio($dados) {
			$pesquisa = new Pesquisa($dados['adverbio']);
			$sinonimos = $pesquisa->getResultado();
			//var_dump($sinonimos);
			foreach ($sinonimos as $sinonimos1) {
				if(!is_null($sinonimos1)) {
					foreach ($sinonimos1 as $sinonimo) {
						$sinonimo = $this->removeAcentos($sinonimo);
						var_dump($sinonimo);
						$dados['sinonimo'] = $sinonimo;
						$this->registrarAdverbio($dados);
					}
				}
			}
		}

		private function registrarAdverbio($dados) {
			try {
				$database = new Database;

	        	$sql = "INSERT INTO raf_adverbios VALUES (NULL, :sinonimo, :tipo, :opera, 0)";
	        	$database->query($sql);
	        	$database->bind(":sinonimo", $dados['sinonimo']);
	        	$database->bind(":tipo", $dados['tipo']);
	        	$database->bind(":opera", $dados['opera']);
	        	$database->execute();
			}
			catch(Exception $e) {
				trigger_error("Erro ao registrar palavra no banco!".$e->getMessage(), $e->getCode());
			}
		}

		private function registrarPalavra($dados) {
			try {
				$database = new Database;

	        	$sql = "INSERT INTO palavras_minerador VALUES (NULL, :sinonimo, :sentido, 0)";
	        	$database->query($sql);
	        	$database->bind(":sinonimo", $dados['sinonimo']);
	        	$database->bind(":sentido", $dados['sentido']);
	        	$database->execute();

	        	$id = $database->lastInsertId();
				//echo "hahaha";
				//var_dump($id);
	        	
				$database = new Database;
	        	$sql = "INSERT INTO sinonimos_minerador VALUES (NULL, :palavra, :sinonimo)";
	           	$database->query($sql);
	        	$database->bind(":palavra", $dados['id']);
	        	$database->bind(":sinonimo", $id);
	        	$database->execute();
			}
			catch(Exception $e) {
				trigger_error("Erro ao registrar palavra no banco!".$e->getMessage(), $e->getCode());
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

		public function getSentidos() {
			return $this->sentidos;
		}

		public function setSentidos($sentidos) {
			$this->validaArray($sentidos);
			$this->sentidos = $sentidos;
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
	if($minerador->getSentidos()[1] > 0) {
		echo "O dorneles gostou!";
	}
	else if($minerador->getSentidos()[1] == 0) {
		echo "O dorneles achou meio termo!";
	}
	else {
		echo "O dorneles não gostou!";
	}
	//$minerador->aprenderPalavras();
	//$minerador->aprenderStopWords();
	//$minerador->aprenderAdverbios();
?>