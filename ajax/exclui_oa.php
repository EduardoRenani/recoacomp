<?php
require_once('../config/config.cfg');
require_once('../translations/pt_br.php');

$idOA = $_GET['idOA'];


try {
	// Deleta da tabela de relação de disciplina competência
	$db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
	$excluirOA = $db_connection->prepare("DELETE FROM disciplina_competencia WHERE discplina_iddisciplina = :idDisciplina");
	$excluirOA->bindValue(':idOA', $idOA, PDO::PARAM_INT);
	$excluirOA->execute();

	// Atualiza a tabela das disciplinas
	$excluirOA = $db_connection->prepare("UPDATE OA SET excluida = 1 WHERE idOA = :idOA");
	$excluirOA->bindValue(':idOA', $idOA, PDO::PARAM_INT);
	$excluirOA->execute();
	echo $idOA;
	return true;
	// If an error is catched, database connection failed
	} catch (PDOException $e) {
		$errors[] = MESSAGE_DATABASE_ERROR;
		print_r($errors);
		return false;
		}
?>
