<?php include('_header.php'); ?>

<!-- clean separation of HTML and PHP -->
<h2><?php echo $_SESSION['user_name']; ?> <?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?></h2>

<!-- formulario para cadastro de disciplinas -->
<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="view_cadastro_disciplina.php" name="registrar_nova_disciplina">
    <!--$this->criaDisc($_POST['nomeCurso'],$_POST['nomeDisciplina'],$_POST['descricao'], $_POST['user_id'], $_POST['senha']);-->
    <label for="nomeCurso"><?php echo WORDING_COURSE_NAME; ?></label>
    <input id="nomeCurso" type="text" name="nomeCurso" pattern="[a-zA-Z0-9]{2,64}" required />

    <label for="nomeDisciplina"><?php echo WORDING_COURSE_NAME; ?></label>
    <input id="nomeDisciplia" type="text" name="nomeDisciplina" pattern="[a-zA-Z0-9]{2,64}" required />





    <input type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_NEW_COURSE; ?>" />
</form><hr/>



<!-- backlink -->
<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php'); ?>
