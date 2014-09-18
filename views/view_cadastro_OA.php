<?php
/**
 * Created by PhpStorm.
 * User: claus_000
 * Date: 10/09/14
 * Time: 09:33
 */

include('_header.php');
require_once("classes/OA.php");?>


<!-- clean separation of HTML and PHP -->
<h2><?php echo $_SESSION['user_name']; ?> <?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?></h2>

<?php


// Receber dados do formulário

if( $_SERVER["REQUEST_METHOD"] == "POST"){

    $nome = $_POST['nome'];
    $url = $_POST['url'];
    $palavraschave = $_POST['palavraschave'];
    $descricao = $_POST['descricao'];
    $idioma = $_POST['idioma'];


    if(!$_SESSION['user_id']) //TODO SUBSTITUIR SS_usuario_id pela session correta
        session_start();
    try{
        $usuarioProfessorID = $_SESSION['user_id']; //TODO SUBSTITUIR SS_usuario_id pela session correta
        $isProf = false;

        if($_SESSION['acesso'] >= 2)
            $isProf=true;
    }catch(Exception $e){
        echo "Exceção pega: ".  $e->getMessage(). "\n";
    }


    //Se não professor, é retirado da página.
    if(!$isProf){
        echo MESSAGE_YOU_SHOULDNT_BE_HERE."!";
        header('../Paginas/index.php');
        exit;
    }

    $oa = new OA();
    $oa->criaOA($nome,$descricao,$url,$palavraschave,$idioma);

}else{

}
?>

<!-- formulario para cadastro de disciplinas -->
<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="" name="registrar_nova_OA">
    <!--$this->criaDisc($_POST['nomeCurso'],$_POST['nomeDisciplina'],$_POST['descricao'], $_POST['user_id'], $_POST['senha']);-->
    <label for="nome"><?php echo WORDING_NAME; ?></label>
    <input id="nome" type="text" name="nome" pattern="[a-zA-Z0-9]{2,64}" required />

    <label for="url"><?php echo "URL"; ?></label>
    <input id="url" type="text" name="url" pattern="[a-zA-Z0-9]{2,64}" required />

    <label for="palavraschave"><?php echo WORDING_KEYWORDS; ?></label>
    <input id="palavraschave" type="text" name="palavraschave" required />

    <label for="idioma"><?php echo WORDING_LANGUAGE; ?></label>         <!--pt_br ou en-->
    <input id="idioma" type="text" name="idioma" required />

    <label for="descricao"><?php echo WORDING_DISCIPLINA_DESCRICAO; ?></label>
    <textarea name="descricao" ROWS="5" COLS="40"></textarea>


    <input type="submit" name="registrar_nova_OA" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
    <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

</form><hr/>



<!-- backlink -->
<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php');

?>