
<!-- ERRO QUE TAVA DANDO DA MENSAGEM DUPLA  <?php //include('_header.php'); ?> -->

<!-- TODO TRADUZIR-->
<head>

<!-- Home -->

<!-- Custom CSS -->
<link href="css/home.css" rel="stylesheet">
<link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/home-xs.css' />
<link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/home-small.css' />
<link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/home-large.css' />

<!-- Custom Fonts -->
<link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

<!-- Fim Home -->

</head>

<div class="sidebar"> 
	<div class="top-sidebar">Bem-Vindo, <?php echo $_SESSION['user_name']?></div>
        <div class="sidebar-content">           
                <ul class="sidebar-menu">
    					
	   						<?php 
							if ($_SESSION['acesso'] == 1) // Se aluno
								include_once('_options_aluno.php'); 
								//echo WORDING_USER_STUDENT . "<br />";
							else if ($_SESSION['acesso'] == 2){ // Se professor
							?> 
								<!-- Minhas Disciplinas -->
								<a href="disciplinas.php">
									<li> <!--li style="z-index:1000; font-weight: 100;" class="active"-->
			                        	<?php echo WORDING_MY_COURSES;?>
			                 		</li>								
								</a>
								<!-- Meu perfil -->
								<a href="profile_show.php">
			                    	<li>
			                    		<?php echo WORDING_MY_PROFILE;?>
			                    	</li>
				                </a>
								<a href="disciplinas_disponiveis.php">
									<li>
			                        	<?php echo WORDING_AVAILABLE_COURSES;?>
			                 		</li>
								</a>
								<a href="cadastro_disciplina.php">
									<li>
			                        	<?php echo WORDING_REGISTER_NOVA_DISCIPLINA;?>
			                 		</li>
								</a>
								<!-- Cadastro de novo objeto -->													
				                <a href="cadastro_OA.php">
									<li> <!--class="activeOA"-->
										<?php echo WORDING_REGISTER_NOVO_OA; ?><br>
									</li>
								</a>								
								<?php
							}else if($_SESSION['acesso'] == 3)
								echo WORDING_USER_ADMIN . "<br/>";
							?>
                    	
                	
                </ul>
    	</div>  
</div>