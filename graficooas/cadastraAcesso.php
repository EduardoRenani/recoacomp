<?php
require_once("acessosoa.php");
require_once("tempoacessooa.php");
if(isset($_POST['dadosEnviados'])) {
	$dadosEnviados = $_POST['dadosEnviados'];
	var_dump($dadosEnviados);
	echo intval($dadosEnviados['idUsuario']);
	$acessosOA = new AcessosOA;
	$acessosOA->setIdUsuario(intval($dadosEnviados['idUsuario']));
	$acessosOA->setIdDisciplina(intval($dadosEnviados['idDisciplina']));
	$acessosOA->setIdOA(intval($dadosEnviados['idOA']));
	$acessosOA->getTempoAcessoOA()->setTempoReal(intval($dadosEnviados['tempoReal']));
	$acessosOA->salvaDados();
}
?>