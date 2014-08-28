
<!-- ----------------------------------------- -->


<html>
<head><title>Cadastro - Parte 2</title></head>

<body>

	<?php
	require_once("usuario.class.php");

	// Receber dados

	if( $_SERVER["REQUEST_METHOD"] == "POST"){

		$vetor = array();
		$vetor[0] = $_POST['tutoria'];
		$vetor[1] = $_POST['ava'];
		$vetor[2] = $_POST['capacitacaoAVA'];
		$vetor[3] = $_POST['conhecimentoOA'];
		$vetor[4] = $_POST['ead'];
		$vetor[5] = $_POST['infoEdu'];
		$vetor[6] = $_POST['temaCompetencia'];
		$vetor[7] = $_POST['monitoria'];

		// Instancia a classe Usuario
		$pessoa = new Usuario();
		session_start();
		//$pessoa->carregaUsuario( $_SESSION['ID'], true );

		$pessoa->cadastraSegundoQuestionario($_SESSION['ID'],$vetor);
		
		//header("Location: logado.php");
		//exit;
	exit;
	}else{
		session_start();
		echo "Por favor, ".$_SESSION['Name']." preencha a segunda (e ultima) parte do cadastro!";
		echo "O ID de cadastro eh: ".$_SESSION['ID'];
	}
	?>
	
		
	
	
	<br /><br />
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?> ">
				
		<p>Possui Experiencia em Tutoria?</p>
		<input type="radio" name="tutoria" value="1">Sim
		<input type="radio" name="tutoria" value="0">Nao<br />
		
		<p>Possui Experiencia em AVA?</p>
		<input type="radio" name="ava" value="1">Sim
		<input type="radio" name="ava" value="0">Nao<br />
		
		<p>Possui Experiencia em Capacitacao AVA?</p>
		<input type="radio" name="capacitacaoAVA" value="1">Sim
		<input type="radio" name="capacitacaoAVA" value="0">Nao<br />
		
		<p>Possui Conhecimento em OA?</p>
		<input type="radio" name="conhecimentoOA" value="1">Sim
		<input type="radio" name="conhecimentoOA" value="0">Nao<br />
		
		<p>Possui Experiencia em EAD?</p>
		<input type="radio" name="ead" value="1">Sim
		<input type="radio" name="ead" value="0">Nao<br />
		
		<p>Possui Experiencia em infoEdu?</p>
		<input type="radio" name="infoEdu" value="1">Sim
		<input type="radio" name="infoEdu" value="0">Nao<br />
		
		<p>Possui Experiencia em Competencia?</p>
		<input type="radio" name="temaCompetencia" value="1">Sim
		<input type="radio" name="temaCompetencia" value="0">Nao<br />
		
		<p>Possui Experiencia em Monitoria?</p>
		<input type="radio" name="monitoria" value="1">Sim
		<input type="radio" name="monitoria" value="0">Nao<br /><br />
		
		<input type="submit" value="Completar Cadastro" />
		<input type="reset" value="Limpar" />
	</form>

</body>
</html>