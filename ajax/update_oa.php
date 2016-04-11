<?php
require_once('../config/config.cfg');
require_once('../translations/pt_br.php');

//$id = $_POST['id'];
$tipo = $_POST['tipo'];
$dados = $_POST;

try {
	$db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
	//echo 'ID competência: '.$id . '/n';
	//echo $valor;
	//echo "Id Disciplina: ".$idDisciplina;
	
	echo $_POST['nomeOA'];
	echo $_POST['id'];


	switch ($tipo) {
		case 'alterarNome':
				$editarOA = $db_connection->prepare("UPDATE cesta SET nome = :nome WHERE idcesta = :idOA");
            	$editarOA->bindValue(':nome', $_POST['nomeOA'], PDO::PARAM_INT);
            	$editarOA->bindValue(':idOA', $_POST['id'], PDO::PARAM_INT);
            	$editarOA->execute();
			break;
		case 'habilidade':
				$editarCompetencia = $db_connection->prepare("UPDATE disciplina_competencia SET habilidade = :habilidade WHERE competencia_idcompetencia = :idCompetencia AND disciplina_iddisciplina = :idDisciplina");
            	$editarCompetencia->bindValue(':habilidade', $valor, PDO::PARAM_INT); // bind no value
            	$editarCompetencia->bindValue(':idCompetencia', $id, PDO::PARAM_INT);
            	$editarCompetencia->bindValue(':idDisciplina', $idDisciplina, PDO::PARAM_INT);
            	$editarCompetencia->execute();
			break;
		case 'atitude':
				$editarCompetencia = $db_connection->prepare("UPDATE disciplina_competencia SET atitude = :atitude WHERE competencia_idcompetencia = :idCompetencia AND disciplina_iddisciplina = :idDisciplina");
            	$editarCompetencia->bindValue(':atitude', $valor, PDO::PARAM_INT); // bind no value
            	$editarCompetencia->bindValue(':idCompetencia', $id, PDO::PARAM_INT);
            	$editarCompetencia->bindValue(':idDisciplina', $idDisciplina, PDO::PARAM_INT);
            	$editarCompetencia->execute();
		default:
				
			break;
	}
	return true;
	// If an error is catched, database connection failed
	} catch (PDOException $e) {
		$errors[] = MESSAGE_DATABASE_ERROR;
		print_r($errors);
		return false;
		}
?> 
