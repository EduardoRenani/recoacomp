<?php
require_once('config/base.php');
$competencia = new Competencia();
$listaExclusao = explode(',', $_POST['listaExclusao']);
$string_result = NULL;
for($i = 0; $i < sizeof($listaExclusao)-1; $i++) {
	$string_result .= $competencia->getDescricaoConhecimentoById($listaExclusao[$i])['conhecimento_descricao']."¬";
}
$string_result .= "§";
for($i = 0; $i < sizeof($listaExclusao)-1; $i++) {
	$string_result .= $competencia->getDescricaoHabilidadeById($listaExclusao[$i])['habilidade_descricao']."¬";
}
$string_result .= "§";
for($i = 0; $i < sizeof($listaExclusao)-1; $i++) {
	$string_result .= $competencia->getDescricaoAtitudeById($listaExclusao[$i])['atitude_descricao']."¬";
}
echo $string_result;
?>