<?php include('_header.php'); ?>

<!-- show registration form, but only if we didn't submit already -->
    <form method="post" action="cadastro_disciplina.php" name="formCadastroDisciplina">
        <!--$this->criaDisc($_POST['nomeCurso'],$_POST['nomeDisciplina'],$_POST['descricao'], $_POST['user_id'], $_POST['senha']);-->
        <label for="nomeCurso"><?php echo WORDING_REGISTRATION_USERNAME; ?></label>
        <input id="nomeCurso" type="text" pattern="[a-zA-Z0-9]{2,64}" name="nomeCurso" required />

        <label for="nomeDisciplina"><?php echo WORDING_REGISTRATION_EMAIL; ?></label>
        <input id="nomeDisciplina" type="text" name="nomeDisciplina" required />

        <label for="descricao"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
        <input id="descricao" type="text" pattern="[a-zA-Z0-9]{2,64}" name="descricao" required />

        <label for="senha"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
        <input id="senha" type="password" name="senha" pattern=".{6,}" required autocomplete="off" />

        <input type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_REGISTER; ?>" />
    </form>

<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php'); ?>
