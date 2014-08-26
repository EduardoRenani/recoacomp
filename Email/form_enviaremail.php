<?php

include "email.php";

$name = $_POST["name"];
$email = $_POST["email"];
$msg = $_POST["msg"];
$subject = $_POST["subject"];

$isValidName = validFullName($name);
$isValidEmail = validEmail($email);

//VARIÁVEIS TESTES
$to = "clauser.mc@gmail.com";
$anexos = null;

if($isValidName && $isValidEmail){
		
	echo ("".$name." ".$email." ". $subject . " ".$msg);
	if( multi_attach_email ( $to, $subject, $msg, $email, $anexos) )
		echo "Email enviado com sucesso!";
	else{
		echo "Ops! Algum erro ocorreu! Tente Novamente mais tarde!";
	}

}if(!$isValidEmail){
	echo ("Endereço de email inválido.");
}if(!$isValidName){
	echo ("Nome inválido. Digite seu nome completo.");
}

?>