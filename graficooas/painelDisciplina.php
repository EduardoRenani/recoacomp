<?php
require_once("indicesoa.php");
require_once("disciplina.php");
require_once("acessosoa.php");
require_once("tempoacessooa.php");
/*$oa = array(5, 15, 20);
$idDisciplina = 10;
foreach($oa as $index => $idOA) {
	echo $index;
	echo $idOA;
	$indicesOA[$index] = new IndicesOA;
	$indicesOA[$index]->setIdOA($idOA);
	$indicesOA[$index]->setIdDisciplina($idDisciplina);
	$indicesOA[$index]->calculaIndiceRejeicao();
	$indicesRejeicao[$idOA] = $indicesOA[$index]->getIndiceRejeicao();
	echo "<br>";
}
arsort($indicesRejeicao);
var_dump($indicesRejeicao);*/
$disciplina = new Disciplina;
$disciplina->setIdDisciplina(44);
$indicesRejeicao = $disciplina->getIndicesRejeicao();
var_dump($indicesRejeicao);
?>