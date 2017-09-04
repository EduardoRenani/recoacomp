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
require_once('config/base.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
include('views/_header.php');
?>
<style>
body {
    font-family: "Lato", sans-serif;
}
#mySidenav .parent .sub-nav {
  display: none;
}

.sidenav {
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    right: 0;
    background-color: #fff;
    overflow-x: hidden;
    transition: 0s;
    bottom: 0;
    width: 0px;
    border-left: solid 30px #108ac0;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 23px;
    color: #818181;
    display: block;
    transition: 0s;
	right: 0;
}

.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    left: 23px;
    font-size: 36px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.sidenav label {
    margin: initial;
}
</style>
<script language='javascript'>
      $(document).ready(function() {
        $('#showmenu1').click(function() {
                $('.subnav1').slideToggle("fast");

        });
    });
      $(document).ready(function() {
        $('#showmenu2').click(function() {
                $('.subnav2').slideToggle("fast");
        });
    });
      $(document).ready(function() {
        $('#showmenu3').click(function() {
                $('.subnav3').slideToggle("fast");
        });
    });
      $(document).ready(function() {
        $('#showmenu4').click(function() {
                $('.subnav4').slideToggle("fast");
        });
    });
      $(document).ready(function() {
        $('#showmenu5').click(function() {
                $('.subnav5').slideToggle("fast");
        });
    });
    $(document).ready(function(){
        $('.conteudo').find('button').click(function(){
            div = $(this).closest('div#conteudo').next('#conteudo-expansivel');
            if(!div.is(':visible')){
                $(this).closest('div#conteudo').next('#conteudo-expansivel').next('#texto').show();
                div.slideDown(1000);
                div.next('#texto').next('#conteudo-expansivel').slideDown(1000);
                $(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            }else{
                $(this).closest('div#conteudo').next('#conteudo-expansivel').next('#texto').hide();
                div.slideUp();
                div.next('#texto').next('#conteudo-expansivel').slideUp();
                $(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            }

        });

            $('.conteudo').next('#conteudo-expansivel').find('a').click(function(){
                div = $(this).closest('.recomendacao-item-content').find('#conteudo-expansivel');
                if(!div.is(':visible')){
                    //$(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
                }else{
                    div.slideUp();
                    //$(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
                }

            });

  var $filterCheckboxes = $('input[type="checkbox"');

$filterCheckboxes.on('change', function() {

  var selectedFilters = {};

  $filterCheckboxes.filter(':checked').each(function() {

    if (!selectedFilters.hasOwnProperty(this.name)) {
      selectedFilters[this.name] = [];
    }

    selectedFilters[this.name].push(this.value);

  });

  // cria uma seleção de todos os elementos que podem ser filtrados
  var $filteredResults = $('.disciplinas-item');

  // loop over the selected filter name -> (array) values pairs
  $.each(selectedFilters, function(name, filterValues) {

    // filtra cada elemento de classe .disciplinas-item
    $filteredResults = $filteredResults.filter(function() {

      var matched = false,
        currentFilterValues = $(this).data('category').split(' ');

      // loop over each category value in the current .flower's data-category
      $.each(currentFilterValues, function(_, currentFilterValue) {

        // if the current category exists in the selected filters array
        // set matched to true, and stop looping. as we're ORing in each
        // set of filters, we only need to match once

        if ($.inArray(currentFilterValue, filterValues) != -1) {
          matched = true;
          return false;
        }
      });

      // se o match ocorreu, o elemento .disciplinas-item é retornado
      return matched;

    });
  });

  $('.disciplinas-item').hide().filter($filteredResults).show();





});
});
	function openNav() {
    document.getElementById("mySidenav").style = "width: 250px; top: 55px;border-left:solid 30px #108ac0";
    document.getElementById("seta-filtro2").style = "cursor: pointer;cursor:hand;color: white; position: fixed; top: 550px; right: 220px; font-size: 90px";
    document.getElementById("seta-filtro").style = "visibility:hidden";
}

	function closeNav() {
    document.getElementById("mySidenav").style = "width: 0px; top: 55px;";
    document.getElementById("seta-filtro").style = "cursor: pointer;cursor:hand;color: white; position: fixed; top: 550px; right: 2px; font-size: 90px";
    document.getElementById("seta-filtro2").style = "visibility:hidden";
}
function toggle(el) {
var tag=document.getElementById(el);
  tag.style.display = tag.style.display === 'block' ? 'none' : 'block';
}





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

        $vet = null;
        /*$vet=array();
        $vet[0]=1;
        $vet[1]=2;*/

        echo
        "<div class='disciplinas-recomendacao'>".
        "<div class='top-disciplinas'>Recomendação</div><div class='recomendacao-content' style='padding: 0'>";

            $c= new Recomendacao($id,$vet);

        echo "</div></div></div>";


    }


} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("views/not_logged_in.php");
}
?>
<div style= "top:55px;" id="mySidenav" class="sidenav"><h1  onclick="openNav()" id="seta-filtro" style="cursor: pointer;cursor:hand;color: white; position: fixed; top: 550px; right: 1px; font-size: 90px;">&#x2039;</h1>
  <h1  onclick="closeNav()" id="seta-filtro2" style="visibility:hidden">&#x203A;</h1>
  <div id="showmenu1" style="padding-bottom: 20px;"><p style="font-size:23px;cursor: pointer;cursor:hand;"><strong>Idioma &#x203A;</strong></p></div>
  <div class="subnav1" style="display:none">
    <form>
      <label >
        <input type="checkbox" style="font-size: 16px" name="oa-ling" value="portugues" id="portugues" /> Português</label>
      <br>
      <label >
        <input type="checkbox" style="font-size: 16px" name="oa-ling" value="ingles" id="ingles" /> Inglês</label>
      <br>
      <label >
        <input type="checkbox" style="font-size: 16px" name="oa-ling" value="espanhol" id="espanhol" /> Espanhol</label>
      <br>
      <label >
        <input type="checkbox" style="font-size: 16px" name="oa-ling" value="alemao" id="alemao" /> Alemão</label>
    </form>
  </div>
  <div id="showmenu2" style="padding-bottom: 20px;border-style: solid;border-color: grey white white white;border-width: 1px;"><p style="font-size:23px;cursor: pointer;cursor:hand;"><strong>Modo de visualização &#x203A;</strong></p></div>
  <div class="subnav2" style="display:none">
  <form>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-visual" value="download" id="download" /> Download</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-visual" value="navegador" id="navegador" /> Web</label>
  </form>
</div>

<!--   <div id="showmenu3" style="padding-bottom: 20px;border-style: solid;border-color: grey white white white;border-width: 1px;"><p style="font-size:23px;cursor: pointer;cursor:hand;"><strong>Público Alvo &#x203A;</strong></p></div>
  <div class="subnav3" style="display:none">
  <form>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-pub" value="infantil" id="infantil" /> Ensino Infantil</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-pub" value="fundamental" id="fundamental" /> Ensino Fundamental</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-pub" value="medio" id="medio" /> Ensino Médio</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-pub" value="adultos" id="adultos" /> Educação de Jovens e Adultos</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-pub" value="profissionalizante" id="profissionalizante" /> Educação Profissionalizante</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-pub" value="superior" id="superior" /> Ensino Superior</label>
  </form>
  </div>
  <div id="showmenu4" style="padding-bottom: 20px;border-style: solid;border-color: grey white white white;"><p style="font-size:23px;cursor: pointer;cursor:hand;"><strong>Sistema Operacional &#x203A;</strong></p></div>
  <div class="subnav4" style="display:none">
  <form>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-so" value="windows" id="windows" /> Windows</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-so" value="linux" id="linux" /> Linux</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-so" value="mac" id="mac" /> Mac OS</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-so" value="ios" id="ios" /> iOS</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-so" value="android" id="android" /> Android</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-so" value="phone" id="phone" /> Windows Phone</label>
  </form>
  </div> -->
  <div id="showmenu5" style="padding-bottom: 20px;border-style: solid;border-color: grey white white;border-width: 1px;"><p style="font-size:23px;cursor: pointer;cursor:hand;"><strong>Recurso de Aprendizagem &#x203A;</strong></p></div>
  <div class="subnav5" style="display:none">
  <form>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="exercício" id="exercício" /> Exercício</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="gráfico" id="gráfico" /> Gráfico</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="diagrama" id="diagrama" /> Diagrama</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="simulação" id="simulação" /> Simulação</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="problema" id="problema" /> Problema</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="video" id="video" /> Vídeo</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="documento" id="documento" /> Documento</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="jogo" id="jogo" /> Jogo</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="animacao" id="animacao" /> Animação</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="audio" id="audio" /> Áudio</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="pagina" id="pagina" /> Página da Web</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="livro" id="livro" /> Livro Digital</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="conteúdo" id="conteúdo" /> Conteúdo Teórico e Atividades</label>
    <br>
    <label >
      <input type="checkbox" style="font-size: 16px" name="oa-recurso" value="multimídia" id="multimídia" /> Material Multimídia</label>
  </form>
</div>

</div>