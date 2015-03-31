<?php
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}
// include the config
require_once('config/config.cfg');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('translations/pt_br.php');

// include the PHPMailer library
require_once('libraries/PHPMailer.php');

// load the login class
require_once('classes/Login.php');

// Carrega classe de competências
require_once('classes/Competencia.php');

// Carrega classe dos objetos para serem associados
require_once("classes/OA.php");

$login = new Login();
// ... ask if we are logged in here:
if (($login->isUserLoggedIn() == true) && ($login->getUserAccess() == 2) || ($login->getUserAccess() == 3)){
    include("views/view_cha_disciplina.php");

} else {
    include("views/not_logged_in.php");
}
