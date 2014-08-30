<?php 
	require_once("../Classes/usuario.php");
    require_once("../Classes/funcoes_aux.php");


	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$name = $_POST['name'];
	$senha2 = $_POST['senha2'];
	$id_questionario=1;

	$pessoa = new Usuario();
	$pessoa->criaUsuario($name,$email,$senha,$senha2,$id_questionario);
	
	echo ("O usuario ".$pessoa->getNome() . " foi cadastrado com exito!");
	
	header("Location: ../Paginas/index.php");
	exit;
?>
