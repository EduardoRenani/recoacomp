<?php
require_once("../../config/base.php");

define("ID_USUARIO", 0);
define("ID_DISCIPLINA", 1);
define("ID_OA", 2);
define("TEMPO_REAL", 3);
if(isset($_POST['dadosEnviados'])) {
	$dadosEnviados = json_decode($_POST['dadosEnviados']);
	/* DEBUG */
	var_dump($dadosEnviados);
	echo intval($dadosEnviados[ID_USUARIO]);
	/* END DEBUG */
	$acessosOA = new AcessosOA;
	$acessosOA->setIdUsuario(intval($dadosEnviados[ID_USUARIO]));
	$acessosOA->setIdDisciplina(intval($dadosEnviados[ID_DISCIPLINA]));
	$acessosOA->setIdOA(intval($dadosEnviados[ID_OA]));
	$acessosOA->getTempoAcessoOA()->setTempoReal(intval($dadosEnviados[TEMPO_REAL]));
	$acessosOA->salvaDados();
}
?>