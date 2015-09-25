	<?php 
		if(isset($_POST['codTipoUsuario'])){
				 $tipoUsuario = $_POST['codTipoUsuario'];
				 // Se está vendo como aluno
				 if ($tipoUsuario  == 1){ ?>
						<!-- Disciplina Disponíveis -->
						<a href="disciplinas_disponiveis.php">
							<li>
								Disciplinas Disponíveis
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
								<option value="1" selected >Aluno</option>
								<option value="2">Professor</option>
							</select>
						</form>
						<br>
				<?php
				}else{ // Se está vendo como professor ?>
					<!-- Minhas Disciplinas (que cadastrei) -->
					<a href="disciplinas.php">
						<li class="active">
							Minhas Disciplinas
						</li>
					</a>
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
						Ver como:
						<br><br>
						<form method="post" action="#" id="tipoUsuario" name="tipoUsuario">
							<select name="codTipoUsuario" onchange ="this.form.submit()" onfocus="this.selectedIndex = -1;"> <!-- -->
								<option value="1">Aluno</option>
								<option value="2" selected>Professor</option>
							</select>
						</form>
					</li>

			<?php
				} // end if
		} else { // Se nao tiver setado o tipo de visão ?>
			<!-- Minhas Disciplinas (que cadastrei) -->
			<a href="disciplinas.php">
				<li>
					Minhas Disciplinas
				</li>
			</a>
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
				Ver como:
				<br><br>
				<form method="post" action="#" id="tipoUsuario" name="tipoUsuario">
					<select name="codTipoUsuario" onchange ="this.form.submit()" onfocus="this.selectedIndex = -1;"> <!-- -->
						<option value="1">Aluno</option>
						<option value="2" selected>Professor</option>
					</select>
				</form>
			</li>
	<?php
		}
	?>
