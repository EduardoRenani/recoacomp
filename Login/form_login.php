<?php 

require_once("../Classes/usuario.php");
require_once("../Classes/funcoes_aux.php.php");

// as variáveis email e senha recebem os dados digitados na página anterior
$email = $_POST['email'];
$senha = $_POST['senha'];
echo "Senha ".$senha." utilizada.";
$pessoa = new Usuario();
$senha = $pessoa->getPassEncrypt($senha,$pessoa->getSenha_byEmail($email));

if( $senha != $pessoa->getSenha_byEmail($email) ){
	echo ("Usuário inexistente ou dados inseridos incorretos!");
}
else{
	$id = $pessoa->getID_byEmail($email);
	$pessoa->carregaUsuario( $id , false);

	// session_start inicia a sessão
	session_start();

	// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
	$con = mysql_connect(bd::getIP(),bd::user(),bd::user_pass()) or die ("Sem conexão com o servidor");
	$select = mysql_select_db(bd::database(),$con) or die("Sem acesso ao DB, Entre em contato com o NUTED");

	// A vriavel $result pega as variaveis $email e $senha, faz uma pesquisa na tabela de usuarios
	$result = mysql_query("SELECT ID FROM usuario WHERE (Email = \"".$email."\" AND Password = \"".$senha."\")");
	echo ($result);
	/* Logo abaixo temos um bloco com if e else, verificando se a variável $result foi bem sucedida,
	ou seja se ela estiver encontrado algum registro idêntico o seu valor será igual a 1, se não,
	se não tiver registros seu valor será 0. Dependendo do resultado ele redirecionará para a pagina
	site.php ou retornara para a pagina do formulário inicial para que se possa tentar novamente realizar o email */

	if(mysql_num_rows ($result) != '0' ){
		$_SESSION['Email'] = $email;
		$_SESSION['Password'] = $senha;
		header('location:logado.php');
	} else{
		unset ($_SESSION['Email']);
		unset ($_SESSION['Password']);
		header('location:login.html');
	}

}

?>
