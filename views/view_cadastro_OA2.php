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

<!-- formulario para cadastro de disciplinas -->
<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="" name="registrar_novo_OA">
    <!--$this->criaDisc($_POST['nomeCurso'],$_POST['nomeDisciplina'],$_POST['descricao'], $_POST['user_id'], $_POST['senha']);-->
    <label for="nome"><?php echo WORDING_NAME; ?></label>
    <input id="nome" type="text" name="nome" pattern="[a-zA-Z0-9]{2,64}" required />

    <label for="url"><?php echo "URL"; ?></label>
    <input id="url" type="text" name="url" pattern="[a-zA-Z0-9]{2,64}" required />

    <label for="palavraschave"><?php echo WORDING_KEYWORDS; ?></label>
    <input id="palavraschave" type="text" name="palavraschave" required />

    <label><?php echo WORDING_LANGUAGE; ?></label>
    <select id = "idioma" name="idioma" required="true">
        <option value = "espanhol"><?php echo WORDING_SPANISH ?></option>
        <option value = "ingles"><?php echo WORDING_ENGLISH ?></option>
        <option value = "portugues"><?php echo WORDING_PORTUGUES ?></option>
    </select> <br>






    <label for="descricao"><?php echo WORDING_DISCIPLINA_DESCRICAO; ?></label>
    <textarea name="descricao" ROWS="5" COLS="40"></textarea>


    <input type="submit" name="registrar_nova_OA" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
    <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

</form><hr/>



<!-- backlink -->
<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php');

?>