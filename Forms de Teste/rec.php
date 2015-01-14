<?php

require_once '../classes/recomendacao.php';

$user=(int)$_POST['IDusuario'];
$disc=(int)$_POST['IDdisciplina'];

$a = new Recomendacao($user,$disc);
$a->recomenda();

?>