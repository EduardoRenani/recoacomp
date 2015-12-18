<?php
	include("base.php");

	function removeAcentos($string, $slug = false) {
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
		$database = new Database;

		$sql = "SELECT * FROM raf_lexico";
		$database->query($sql);
		$database->execute();

		$palavras = $database->resultSet();
		foreach ($palavras as $palavra) {
			$palavra['palavra'] = removeAcentos(utf8_decode($palavra['palavra']));
			$palavra['palavra'] = utf8_encode($palavra['palavra']);
			if($palavra['quadrante'] == 1 || $palavra['quadrante'] == 4) {
				$sentido = 1;
			}
			else {
				$sentido = -1;
			}

			$sql = "SELECT * FROM palavras_minerador WHERE palavra = :palavra";
			$database->query($sql);
		   	$database->bind(":palavra", $palavra['palavra']);
			$database->execute();
			if($database->rowCount() == 0) {
				$sql = "INSERT INTO palavras_minerador VALUES (NULL, :palavra, :sentido, 0)";
				$database->query($sql);
		    	$database->bind(":palavra", $palavra['palavra']);
		    	$database->bind(":sentido", $sentido);
				$database->execute();
	 	    }

		}

?>