<?php 
	include "../Email/email.php";
	require_once("usuario.class.php");
	
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$name = $_POST['name'];
	$senha2 = $_POST['senha2'];
	$id_questionario=1;

	$pessoa = new Usuario();
	$pessoa->criaUsuario($name,$email,$senha,$senha2,$id_questionario);
	
	echo ("O usuario ".$pessoa->getNome() . " foi cadastrado com exito!");

?>
