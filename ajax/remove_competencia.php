<?php
require_once('../config/config.cfg');
require_once('../translations/pt_br.php');

$idCompetencia = $_GET['idCompetencia'];
$idDisciplina = $_GET['idDisciplina'];

//echo $idCompetencia.", ".$idDisciplina;
try {
	$db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
	$removerCompetencia = $db_connection->prepare("DELETE FROM disciplina_competencia WHERE competencia_idcompetencia = :idCompetencia AND disciplina_iddisciplina = :idDisciplina");
	$removerCompetencia->bindValue(':idCompetencia', $idCompetencia, PDO::PARAM_INT);
	$removerCompetencia->bindValue(':idDisciplina', $idDisciplina, PDO::PARAM_INT);
	$removerCompetencia->execute();
	return true;
	// If an error is catched, database connection failed
	} catch (PDOException $e) {
		$errors[] = MESSAGE_DATABASE_ERROR;
		print_r($errors);
		return false;
		}
?> 
