<?php
	function funcaoLinear($x) {
		return 0.9*$x+0.3;
	}
	$x = 9999999999999999;
	$funcao = funcaoLinear($x);
	for($i = 0; $i < 1000000; $i++) {
		$funcao = funcaoLinear($funcao);
	}
	$x1 = 0.00000000000000001;
	for($i = 0; $i < 1000000; $i++) {
		$funcao1 = funcaoLinear($funcao1);
	}
	echo $funcao;
	echo "<br>";
	echo $funcao1;
?>