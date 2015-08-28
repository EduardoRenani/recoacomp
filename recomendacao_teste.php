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
require_once('base.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();
include('views/_header.php');
?>
<script language='javascript'>
    $(document).ready(function(){
        $('.conteudo').find('button').click(function(){
            div = $(this).closest('div#conteudo').next('#conteudo-expansivel');
            if(!div.is(':visible')){
                div.css('height','auto').slideDown(1000);
                $(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            }else{
                div.slideUp();
                $(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            }

        });
    });

    $(document).ready(function(){
            $('.conteudo').next('#conteudo-expansivel').find('a').click(function(){
                div = $(this).closest('.recomendacao-item-content').find('#conteudo-expansivel');
                if(!div.is(':visible')){
                    div.css('height','auto').slideDown(1000);
                    //$(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
                }else{
                    div.slideUp();
                    //$(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
                }

            });
        });
</script>
<div class='fixedBackgroundGradient'></div>
<?php



require_once("views/sidebar.php");

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.

    //include("views/logged_in.php");

    if(isset($_POST['disc'])){

        $id = $_POST['disc'];
        $competencias = $_POST['competencias'];
        $conhecimento = $_POST['conhecimento'];
        $habilidade = $_POST['habilidade'];
        $atitude = $_POST['atitude'];
        //print_r($competencias);
        //print_r($conhecimento);
        //print_r($habilidade);

        $vet = null;
        /*$vet=array();
        $vet[0]=1;
        $vet[1]=2;*/

        echo
        "<div class='disciplinas-recomendacao'>".
        "<div class='top-disciplinas'>Recomendação</div><div class='recomendacao-content' style='padding: 0'>";
            
            $c= new RecomendacaoTeste($id,$vet);

        echo "</div></div></div>";


    }

    
} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("views/not_logged_in.php");
}
