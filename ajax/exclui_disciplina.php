<?php
require_once('../config/config.cfg');
require_once('../translations/pt_br.php');

$idDisciplina = $_GET['idDisciplina'];


try {
	// Deleta da tabela de relação de disciplina competência 
	$db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
	$excluirDisciplina = $db_connection->prepare("DELETE FROM disciplina_competencia WHERE discplina_iddisciplina = :idDisciplina");
	$excluirDisciplina->bindValue(':idDisciplina', $idDisciplina, PDO::PARAM_INT);
	$excluirDisciplina->execute();
	
	// Atualiza a tabela das disciplinas
	$excluirDisciplina = $db_connection->prepare("UPDATE disciplina SET excluida = 1 WHERE iddisciplina = :idDisciplina");
	$excluirDisciplina->bindValue(':idDisciplina', $idDisciplina, PDO::PARAM_INT);
	$excluirDisciplina->execute();
	echo $idDisciplina;
	return true;
	// If an error is catched, database connection failed
	} catch (PDOException $e) {
		$errors[] = MESSAGE_DATABASE_ERROR;
		print_r($errors);
		return false;
		}
?> 
