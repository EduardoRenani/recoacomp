<?php
/**
* Configuração base para o autoload funcionar
*/
require_once(__DIR__.'/config.cfg');
require_once($_SERVER["DOCUMENT_ROOT"].'/recoacomp/libraries/PHPMailer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/recoacomp/translations/pt_br.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/recoacomp/Banco de dados/cfg.php');
//require_once($_SERVER["DOCUMENT_ROOT"].'/recoacomp/classes/bd.class.php");  Comentado para saber se dá algum bug
include_once($_SERVER["DOCUMENT_ROOT"].'/recoacomp/php/bibliotecas/autoload.php');       // autoload do composer das librarys
include_once(__DIR__.'/handlers.php'); //precisa para o autoload
include_once('credenciais_bancodedados.php');
$login = new Login();
?>