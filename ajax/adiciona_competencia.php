<?php
require_once('../config/config.cfg');
require_once('../translations/pt_br.php');

$idCompetencia = $_GET['idCompetencia'];
$idDisciplina = $_GET['idDisciplina'];

//echo $idCompetencia.", ".$idDisciplina;
try {
	$db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
	$adicionarCompetencia = $db_connection->prepare("INSERT INTO disciplina_competencia(competencia_idcompetencia, disciplina_iddisciplina, conhecimento, habilidade, atitude) VALUES(:idCompetencia, :idDisciplina, 0, 0, 0)");
	$adicionarCompetencia->bindValue(':idCompetencia', $idCompetencia, PDO::PARAM_INT);
	$adicionarCompetencia->bindValue(':idDisciplina', $idDisciplina, PDO::PARAM_INT);
	$adicionarCompetencia->execute();
	return true;
	// If an error is catched, database connection failed
	} catch (PDOException $e) {
		$errors[] = MESSAGE_DATABASE_ERROR;
		print_r($errors);
		return false;
		}
?> 
