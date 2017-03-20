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
								Atividades Disponíveis
							</li>
						</a>
						<!-- Meu Perfil -->
						<a href="profile_show.php">
							<li>
								Meu Perfil
							</li>
						</a>
						<form method="post" action="#" id="tipoUsuario" name="tipoUsuario">
							<select name="codTipoUsuario" onchange ="this.form.submit()" onfocus="this.selectedIndex = -1;"> <!-- -->
								<option value="<?php echo VISAO_ALUNO ?>" selected >Visão de Aluno</option>
								<option value="<?php echo VISAO_PROFESSOR?>">Visão de Professor</option>
							</select>
						</form>
						<br>
				<?php
				}else{ // Se está vendo como aluno mas é professor ?>
					<!-- Minhas Disciplinas (que cadastrei) -->
					<a href="disciplinas.php">
						<li class="active">
							Minhas Atividades
						</li>
					</a>
					<!-- Disciplina Disponíveis -->
					<a href="disciplinas_disponiveis.php">
						<li>
							Atividades Disponíveis
						</li>
					</a>
					<!-- Disciplinas em que estou matriculado (que cadastrei) -->
					<a href="disciplinas_fixed.php">
						<li>
							Atividades em que estou matriculado(a)
						</li>
					</a>
					<!-- Meu Perfil -->
					<a href="profile_show.php">
						<li>
							Meu Perfil
						</li>
					</a>
					<!-- Cadastrar novo OA -->
					<a href="cadastro_OA.php">
						<li>
							<?= WORDING_REGISTER_NOVO_OA; ?>
						</li>
					</a>
					<a href="cadastro_disciplina.php">
						<li>
							<?= WORDING_REGISTER_NOVA_DISCIPLINA; ?>
						</li>
					</a>
					<li>
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
				<!-- Disciplina Disponíveis -->
				<a href="disciplinas_disponiveis.php">
					<li>
						Disciplinas Disponíveis
					</li>
				</a>
				
				<!-- Disciplinas em que estou matriculado (que cadastrei) -->
				<a href="disciplinas_fixed.php">
					<li>
						Disciplinas em que estou matriculado(a)
					</li>
				</a>
				<!-- Meu Perfil -->
				<a href="profile_show.php">
					<li>
						Meu Perfil
					</li>
				</a>
					<a href="instrumento.php">
					<li>
								Cadastrar Instrumento de Avaliação
					</li>
					</a>
				<a href="preferences.php">
							<li>
								Preferências
							</li>
						</a>
				<!-- Ver como -->
				
				<li class="visao">
					<form method="post" action="#" id="tipoUsuario" name="tipoUsuario">
						<select name="codTipoUsuario" onchange ="this.form.submit()" onfocus="this.selectedIndex = -1;"> <!-- -->
							<option value="<?php echo VISAO_ALUNO ?>" selected>Visão de Aluno</option>
							<option value="<?php echo VISAO_PROFESSOR?>">Visão de Professor</option>
						</select>
					</form>
				</li>
			
	<?php
		}
	?>




