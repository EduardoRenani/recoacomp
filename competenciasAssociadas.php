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
$disciplina = new Disciplina();

$comp = new Competencia();
$idCompetencia = $comp->getArrayOfIDs();
$nomeCompetencia = $comp->getArrayOfNames();
$contador = count($nomeCompetencia);
$listaExclusao = explode(",", $_POST['listaExclusao']);
$contadorLi = count($listaExclusao);

$arrayToReturn = array();
for($i=0;$i<$contador;$i++){
	$existeLi = 0; //Verifica se a li já está na #tabela2
	for($j = 0; $j < $contadorLi; $j++) {
		if($idCompetencia[$i]["idcompetencia"] == $listaExclusao[$j]) {
			$existeLi++;
		}
	}
	if($existeLi != 0) {
		$arrayToReturn[] = '<li id="'.$idCompetencia[$i]["idcompetencia"].'" name="'.$nomeCompetencia[$i]["nome"].'" class="ui-state-default">'.$nomeCompetencia[$i]["nome"].'</li>';
	}
}
echo json_encode( $arrayToReturn );
?>