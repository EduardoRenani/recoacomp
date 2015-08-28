<?php 	
include('_header.php'); 
require_once('base.php');

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
$registration = new Registration();

?>
<!-- ============== MAIN LOGIN ============== -->

<div class="intro-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
                <div class="fixedBackgroundGradient"></div>
				<div class="login">
					<div class="top-login">Login:</div></br>
					
					<!-- <form action="home.html"><!--action é só para mostrar, no site em si não tem isso"--> 
					<form method="post" action="index.php" name="loginform">
						<input id="user_name" type="text" name="user_name" placeholder="<?= WORDING_USERNAME; ?>" required>
						<input id="user_password" type="password" name="user_password" autocomplete="off" required placeholder="<?= WORDING_PASSWORD;?>" required>
						<input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" /> <label for="user_rememberme">Lembrar Usuário</label>
						<input type="submit" name="login" value="<?= WORDING_LOGIN; ?>">
					
						<!-- TODO Fazer tradução dessa parte -->
						<span>Não tem uma conta? &nbsp <a href="#openModal" class="text-right">Cadastre-se</a></span><br />
                        <span class="light"><a href="password_reset.php"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a></span>
                    </form>	

                        <!-- MODAL DO CADASTRO -->
						<div id="openModal" class="modalDialog">
								<div>
									<a href="#close" title="Close" class="close">X</a>
									<div class="top-cadastro"><?php echo WORDING_REGISTER_NEW_ACCOUNT; ?></div>
									<?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>
										<!-- form action="home.html"--><!--action é só para mostrar, no site em si não tem isso"-->
										<!--form method="post" action="register.php" name="registerform" -->
										<form method="post" action="index.php" name="registerform">
											<div><?= WORDING_REGISTRATION_EMAIL; ?></div><input id="user_email" type="email" placeholder="E-mail" name="user_email" required />
	                                        <div><?= WORDING_REGISTRATION_USERNAME; ?></div><input id="user_name" type="text" placeholder="Somente letras e numeros, de 2 a 64 caracteres" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required>
    										<div><?= WORDING_REGISTRATION_PASSWORD; ?></div><input id="user_password_new" type="password" placeholder="Min. 6 caracteres" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
											<div><?= WORDING_REGISTRATION_PASSWORD_REPEAT; ?></div><input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
											<!-- img src="tools/showCaptcha.php" alt="captcha" />
											<input type="text" name="captcha" placeholder="<?= WORDING_REGISTRATION_CAPTCHA; ?>" required / -->
											<input type="submit" name="register" value="<?php echo WORDING_REGISTER; ?>" />
										</form>
									 <?php } ?>
								</div>
								<!-- /.top-cadastro -->
    					</div>
    					<!-- /.modalDialog -->
				</div>
				<!-- /.login -->

                <!-- SELOS PATROCINIO ETC ABAIXO DO LOGIN -->
                <div class="patrocinio">
                    <div class="patrocinio-content">
                        <div class="patrocinio-content-item">
                            <span for="ufrgs">Incentivo:</span><br /><img src="img/ufrgs.png" alt="selo-ufrgs" value="ufrgs">
                        </div>
                        <div class="patrocinio-content-item">
                            <span for="sead">Financiamento:</span><br /><img src="img/ufrgs-sead.png" alt="selo-ufrgs-sead" value="sead">
                        </div>
                        <div class="patrocinio-content-item">
                            <span for="nuted">Realização:</span><br /><img src="img/nuted.png" alt="selo-nuted" value="nuted">
                        </div>
                    </div>
                </div>
                <!-- /.patrocinio -->
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->
</div>
<!-- /.intro-header -->
</body>

</html>

