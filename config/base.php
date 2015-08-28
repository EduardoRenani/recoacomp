<?php
/**
* Configuração base para o autoload funcionar 
*/
require_once('config.cfg');
require_once($_SERVER["DOCUMENT_ROOT"].'/recoacomp/libraries/PHPMailer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/recoacomp/translations/pt_br.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/recoacomp/Banco de dados/cfg.php');
//require_once($_SERVER["DOCUMENT_ROOT"].'/recoacomp/classes/bd.class.php");  Comentado para saber se dá algum bug
include_once('handlers.php'); //precisa para o autoload

?>