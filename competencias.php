<?php
// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}
// include the config
require_once('config/config.cfg');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('translations/pt_br.php');

// include the PHPMailer library
require_once('libraries/PHPMailer.php');

// load the login class
require_once('classes/Login.php');

// load the disciplina class
require_once('classes/disciplina.php');
require_once('classes/Competencia.php');
// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
$disciplina = new Disciplina();

$comp = new Competencia();
$idCompetencia = $comp->getArrayOfIDs();
$nomeCompetencia = $comp->getArrayOfNames();
$descricaoCompetencia = $comp->getArrayOfDescricao();
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
	if($existeLi == 0) {
		$descricaoCompetencia[$i]['descricao_nome'] = urlencode($descricaoCompetencia[$i]['descricao_nome']);
		$descricaoCompetencia[$i]['descricao_nome'] = str_replace('%0D%0A', ' ', $descricaoCompetencia[$i]['descricao_nome']);
		$descricaoCompetencia[$i]['descricao_nome'] = urldecode($descricaoCompetencia[$i]['descricao_nome']);
		$arrayToReturn[] = '<li id="'.$idCompetencia[$i]["idcompetencia"].'" name="'.$nomeCompetencia[$i]["nome"].'" class="ui-state-default">'.$nomeCompetencia[$i]["nome"].'<div class="tooltipSort"><div onclick="toolTipSortable(\''.$idCompetencia[$i]["idcompetencia"].'\', \''.$descricaoCompetencia[$i]['descricao_nome'].'\')">?</div></div></li>';
	}
}
//onmouseout="deleteTooltipComp(\''.$idCompetencia[$i]["idcompetencia"].'\')"
echo json_encode( $arrayToReturn );
?>