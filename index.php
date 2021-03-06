<?php

/**
 * A simple PHP Login Script / ADVANCED VERSION
 * For more versions (one-file, minimal, framework-like) visit http://www.php-login.net
 *
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login-advanced/
 * @license http://opensource.org/licenses/MIT MIT License
 */

//require_once('classes/OA.php');
// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}
require_once('./config/base.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$disciplina = new Disciplina();
$registration = new Registration();
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    include("views/logged_in.php");
    if ( isset($_SESSION['cadastro_disciplina_cha'] ) ) {
        echo"<script type='text/javascript'>";
        echo "alert('".MESSAGE_PASSWORD_WRONG."');";
        echo "</script>";
        unset( $_SESSION['cadastro_disciplina_cha'] );
    }
} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("views/not_logged_in.php");
}
?>