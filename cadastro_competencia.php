<?php
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}
require_once('config/base.php');

$competencia = new Competencia();
// ... ask if we are logged in here:
if (($login->isUserLoggedIn() == true) && ($login->getUserAccess() == 2) || ($login->getUserAccess() == 3)){
    include("views/view_cadastro_competencia.php");

} else {
    include("views/not_logged_in.php");
}
