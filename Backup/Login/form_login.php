<?php 

require_once("../Classes/usuario.php");
require_once("../Classes/funcoes_aux.php");

// as variáveis email e senha recebem os dados digitados na página anterior
$email = $_POST['email'];
$senha = $_POST['senha'];
$pessoa = new Usuario();
$senha = $pessoa->getPassEncrypt($senha,$pessoa->getSenha_byEmail($email));

if( $senha != $pessoa->getSenha_byEmail($email) ){
	echo ("Usuário inexistente ou dados inseridos incorretos!");
}
else{
	$id = $pessoa->getID_byEmail($email);
	$pessoa->carregaUsuario($id);

    header("Location: ../Paginas/index.php");
    exit;
}

?>
