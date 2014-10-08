<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 11/09/14
 * Time: 14:32
 */
include('_header.php');?>
<h2><?php echo ($_SESSION['user_name']); ?></h2>
<h2><?php echo (WORDING_CREATE_DISCIPLINA); ?></h2>

<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN;?></a>
   <form method="post" action="" name="registrar_nova_disciplina">
        <label for="nomeCurso"><?php echo WORDING_COURSE_NAME; ?></label>
        <input id="nomeCurso" type="text" name="nomeCurso" pattern="[a-zA-Z0-9]{2,64}" required />
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />

        <label for="nomeDisciplina"><?php echo WORDING_DISCIPLINA_NAME; ?></label>
        <input id="nomeDisciplia" type="text" name="nomeDisciplina" pattern="[a-zA-Z0-9]{2,64}" required />

        <label for="senha"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
        <input id="senha" type="text" name="senha" required />

        <label for="descricao"><?php echo WORDING_DISCIPLINA_DESCRICAO; ?></label>
        <textarea name="descricao" ROWS="5" COLS="40"></textarea>
        <br />

        <input type="hidden" id="arrayCompetencias" name="arrayCompetencias" value="" />

		<ul id="tabela1">
			<?php
			$comp = new Competencia();
			$idCompetencia = $comp->getArrayOfIDs();
			$nomeCompetencia = $comp->getArrayOfNames();
			$contador = count($nomeCompetencia);

			for($i=0;$i<$contador;$i++){ ?>
				<li id="<?php echo "".($idCompetencia[$i]["idcompetencia"]); ?>" class="ui-state-default"><?php echo "".($nomeCompetencia[$i]["nome"]); ?></li>
			<?php } ?>
		</ul>
		<ul id="tabela2">
			<!--<li class="ui-state-highlight">Item 1 selecionado</li>-->
		</ul>
        <br /><br />

        <input type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
        <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

    </form><hr/>
<?php include('_footer.php'); ?>