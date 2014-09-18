<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 11/09/14
 * Time: 14:32
 */

 include('_header.php'); ?>

<!-- clean separation of HTML and PHP -->
<h2><?php echo $_SESSION['user_name']; ?></h2>
<h2> <?php echo WORDING_CREATE_DISCIPLINA; ?></h2>

<!-- formulario para cadastro de disciplinas -->
<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="cadastro_disciplina.php" name="registrar_nova_disciplina">
    <label for="nomeCurso"><?php echo WORDING_COURSE_NAME; ?></label>
    <input id="nomeCurso" type="text" name="nomeCurso" pattern="[a-zA-Z0-9]{2,64}" required />
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>"

    <label for="nomeDisciplina"><?php echo WORDING_DISCIPLINA_NAME; ?></label>
    <input id="nomeDisciplia" type="text" name="nomeDisciplina" pattern="[a-zA-Z0-9]{2,64}" required />

    <label for="senha"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
    <input id="senha" type="text" name="senha" required />

    <label for="descricao"><?php echo WORDING_DISCIPLINA_DESCRICAO; ?></label>
    <textarea name="descricao" ROWS="5" COLS="40"></textarea>


    <input type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
    <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

</form><hr/>





<!-- backlink -->
<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<a href=""><?php echo WORDING_CREATE_NEW_COMPETENCIA; ?></a>
<?php
require_once("classes/conexao.php");
//$bd = new conexao()
$bd = new conexao('localhost','recomendador-test','root','root');

?>



<ul id="sortable1" class="connectedSortable">
    <li class="ui-state-default">Item 1</li>
    <li class="ui-state-default">Item 2</li>
    <li class="ui-state-default">Item 3</li>
    <li class="ui-state-default">Item 4</li>
    <li class="ui-state-default">Item 5</li>
</ul>
<br>
<ul id="sortable2" class="connectedSortable">
    <li class="ui-state-highlight">Item 1</li>
    <li class="ui-state-highlight">Item 2</li>
    <li class="ui-state-highlight">Item 3</li>
    <li class="ui-state-highlight">Item 4</li>
    <li class="ui-state-highlight">Item 5</li>
</ul>

<br>



<?php include('_footer.php'); ?>
