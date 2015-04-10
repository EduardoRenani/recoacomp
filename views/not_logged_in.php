<?php 	
include('_header.php'); 
// include the config
require_once('config/config.cfg');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('translations/pt_br.php');

// include the PHPMailer library
require_once('libraries/PHPMailer.php');

// load the registration class
require_once('classes/Registration.php');

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
$registration = new Registration();

?>
<!-- ============== MAIN LOGIN ============== -->
<div class="intro-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
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
						<div id="openModal" class="modalDialog">
								<div>
									<a href="#close" title="Close" class="close">X</a>
									<div class="top-cadastro"><?php echo WORDING_REGISTER_NEW_ACCOUNT; ?></div>
									<?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>
										<!-- form action="home.html"--><!--action é só para mostrar, no site em si não tem isso"-->
										<!--form method="post" action="register.php" name="registerform" -->
										<form method="post" action="index.php" name="registerform">
											<div><?= WORDING_REGISTRATION_EMAIL; ?></div><input id="user_email" type="email" placeholder="Você receberá um emal de verificação com um link de ativação" name="user_email" required />
	                                        <div><?= WORDING_REGISTRATION_USERNAME; ?></div><input id="user_name" type="text" placeholder="Somente letras e numeros, de 2 a 64 caracteres" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required>
    										<div><?= WORDING_REGISTRATION_PASSWORD; ?></div><input id="user_password_new" type="password" placeholder="Min. 6 caracteres!" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
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
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->
</div>
<!-- /.intro-header -->



    <!-- Page Content -->
<!--precisa de javascript pra ser lindo-->
<section id="scroll">
    <a href="#page-content"></a>
</section>


    <div class="content-section-a" id="page-content">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">O que é?</h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/tablet.png" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Como Funciona?</h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="img/nutedYellow.png" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-b -->

    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Cadastre-se!</h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <div class="wololo"><form>
                        <input type="submit" value="Cadastre-se"></br></br>
                    </form></div>

                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/blur_tabletalk.png" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

    <!-- Footer -->
    <footer>
        <div class="container-footer">
            <div class="row" style="width:100%">
                <div class="span1">
                    <a href="http://www.nuted.ufrgs.br/"><img src="img/nutedYellow.png" class="footer-logo"></a> 
                    <a href="http://www.ufrgs.br/sead"><img src="img/ufrgs_sead.png" class="footer-logo"></a>
                </div>
                <div class="span2">
                     <ul class="list-inline">
                        <li>
                           <a href="#home">Home</a>
                        </li>
                        <li class="footer-menu-divider">.</li>
                         <li>
                           <a href="#sobre">Sobre</a>
                        </li>
                        <li class="footer-menu-divider">.</li>
                         <li>
                           <a href="#contato">Contato</a>
                        </li>
                        <li class="footer-menu-divider">.</li>
                         <li>
                           <a href="#equipe">Equipe</a>
                        </li>
                        <li class="footer-menu-divider">.</li>
                     </ul>
               </div>
            </div>
        </div>
    </footer>



</body>

</html>















<!-- <?php include('_footer.php'); ?> -->
