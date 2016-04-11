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

define("ID_USUARIO", 0);
define("ID_DISCIPLINA", 1);

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$disciplina = new Disciplina();

$comp = new Competencia();
$idDisciplina = $_POST[ID_DISCIPLINA];
$idAluno = $_POST[ID_USUARIO];
$idCompetencias = $disciplina->getCompetenciasDisciplina($idDisciplina, 'idDisciplina');
foreach ($idCompetencias as $idCompetencia) {
	$chas[$idAluno][$idCompetencia[0]] = $comp->getCHAbyAluno($idCompetencia[0], $idAluno);
}
//var_dump($chas);


echo json_encode( $chas );
?>