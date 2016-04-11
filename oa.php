<?php
// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}
require_once('config/base.php');
// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$OA = new OA();
$idOA = $OA->getArrayOfId_OA();
$nomeOA = $OA->getArrayOfName_OA(); 
$contador = count($nomeOA);
$descricaoOA = $OA->getArrayOfDescricao_OA();
$urlOA = $OA->getArrayOfUrl_OA();
$listaExclusao = explode(",", $_POST['listaExclusao']);
$contadorLi = count($listaExclusao);

$arrayToReturn = array();
for($i = 0;$i < $contador; $i++){
	$existeLi = 0; //Verifica se a li já está na #tabela2
	for($j = 0; $j < $contadorLi; $j++) {
		if($idOA[$i]["idcesta"] == $listaExclusao[$j]) {
			$existeLi++;
		}
	}
	if($existeLi === 0) {
		$descricaoOA[$i]['descricao'] = urlencode($descricaoOA[$i]['descricao']); //retira quebras de linha
		$descricaoOA[$i]['descricao'] = str_replace('%0D%0A', ' ', $descricaoOA[$i]['descricao']); //retira quebras de linha
		$descricaoOA[$i]['descricao'] = urldecode($descricaoOA[$i]['descricao']); //retira quebras de linha
		$urlTratadoOA = urlencode($urlOA[$i]['url']);
		$urlTratadoOA = str_replace("%2F", "/", $urlTratadoOA);
		$urlTratadoOA = str_replace("%3A", ":", $urlTratadoOA);
		$arrayToReturn[] = '<li id="'.$idOA[$i]["idcesta"].'" name="'.$nomeOA[$i]["nome"].'" class="ui-state-default">'.$nomeOA[$i]["nome"].'<div class="tooltipSort"><div onclick="toolTipSortable(\''.$idOA[$i]["idcesta"].'\', \''.$descricaoOA[$i]['descricao'].'<br><a target=_blank href='.$urlTratadoOA.'>Url do OA</a>\')">[ ? ]</div></div></li>';
	}
}
echo json_encode($arrayToReturn);
?>