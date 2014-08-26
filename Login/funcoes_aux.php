<?php

// FUNCAO DO PLANETA
function gen_salt($length) {
		$alph = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$max = strlen($alph) - 1;
		$salt = '';
		for ($i = 0; $i < $length; $i++) {
			$salt .= substr($alph, rand(0,$max), 1);
		}
		return $salt;
}

?>