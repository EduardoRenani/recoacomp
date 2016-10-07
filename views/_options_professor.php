	<?php
		$usuario = new User($_SESSION['user_id']);
		if(isset($_POST['codTipoUsuario'])){
				// Update no banco de dados para o tipo de visão
				//print_r($usuario);
                //$usuario->updateTipoVisao(1);
				//print_r($usuario->updateTipoVisao(1));
				// Se está vendo como aluno
				$tipoUsuario = $_POST['codTipoUsuario'];
				if ($tipoUsuario  == 1){
						$usuario->updateTipoVisao(1);
						//print_r($usuario);
						?>
						<!-- Disciplina Disponíveis -->
						<a href="disciplinas_disponiveis.php">
							<li>
								Disciplinas Disponíveis
							</li>
						</a>
						<!-- Meu Perfil -->

						<li class="visao">
						<form method="post" action="#" id="tipoUsuario" name="tipoUsuario">
							<select name="codTipoUsuario" onchange ="this.form.submit()" onfocus="this.selectedIndex = -1;"> <!-- -->
								<option value="<?php echo VISAO_ALUNO ?>" selected >Visão de Aluno</option>
								<option value="<?php echo VISAO_PROFESSOR?>">Visão de Professor</option>
							</select>
						</form>
						</li>
						<br>
				<?php
				}else{ // Se está vendo como professor ?>
					<!-- Meu Perfil -->
					<!-- Minhas Disciplinas (que cadastrei) -->
					<a href="disciplinas.php">
						<li class="active">
							Minhas Atividades
						</li>
					</a>
					<!-- Disciplinas em que estou matriculado (que cadastrei) -->
					<a href="disciplinas_fixed.php">
						<li>
							Atividades em que estou matriculado(a)
						</li>
					</a>
					<!-- Disciplina Disponíveis -->
					<a href="disciplinas_disponiveis.php">
						<li>
							Atividades Disponíveis
						</li>
					</a>
					<!-- Cadastrar novo OA -->
					<a href="cadastro_OA.php">
						<li>
							<?= WORDING_REGISTER_NOVO_OA; ?>
						</li>
					</a>
					<!-- Editar novo OA -->
					<a href="editar_OA.php">
						<li>
							Editar Objetos de Aprendizagem
						</li>
					</a>
					<a href="#openModalCreateDisciplina">
					<li id="cadastro">
						Cadastrar...
					</li>
					</a>
					<li class="visao">
						<br><br>
						<form method="post" action="#" id="tipoUsuario" name="tipoUsuario">
							<select name="codTipoUsuario" onchange ="this.form.submit()" onfocus="this.selectedIndex = -1;"> <!-- -->
								<option value="<?php echo VISAO_ALUNO ?>">Visão de Aluno</option>
								<option value="<?php echo VISAO_PROFESSOR?>" selected>Visão de Professor</option>
							</select>
						</form>
					</li>

			<?php
				} // end if
		} else { // Se nao tiver setado o tipo de visão
			$usuario->updateTipoVisao(2);
			//print_r($usuario);
			?>
				<!-- Meu Perfil -->

			<!-- Minhas Disciplinas (que cadastrei) -->
				<a href="disciplinas.php">
					<li>
						Minhas Atividades
					</li>
				</a>

				<!-- Disciplinas em que estou matriculado (que cadastrei) -->
				<a href="disciplinas_fixed.php">
					<li>
						Atividades em que estou matriculado(a)
					</li>
				</a>
				<!-- Disciplina Disponíveis -->
				<a href="disciplinas_disponiveis.php">
					<li>
						Atividades Disponíveis
					</li>
				</a>

				<!-- Cadastrar OA -->
				<a href="cadastro_OA.php">
					<li>
						<?= WORDING_REGISTER_NOVO_OA; ?>
					</li>
				</a>
					<!-- Editar novo OA -->
					<a href="editar_OA.php">
						<li>
							Editar Objetos de Aprendizagem
						</li>
					</a>
				<!-- Cadastrar novo...-->
				<!--<a href="cadastro_disciplina.php">
					<li>
						<?= WORDING_REGISTER_NOVA_DISCIPLINA; ?>
					</li>
				</a>-->
				<a href="#openModalCreateDisciplina">
					<li id="cadastro">
						Cadastrar...
					</li>
					</a>

				<!-- Ver como -->

				<li class="visao">
					<form method="post" action="#" id="tipoUsuario" name="tipoUsuario">
						<select name="codTipoUsuario" onchange ="this.form.submit()" onfocus="this.selectedIndex = -1;"> <!-- -->
							<option value="<?php echo VISAO_ALUNO ?>">Visão de Aluno</option>
							<option value="<?php echo VISAO_PROFESSOR?>" selected>Visão de Professor</option>
						</select>
					</form>
				</li>

	<?php
		}
	?>




