<?php include('_header.php'); ?>

<!-- TODO TRADUZIR-->
<head>

<!-- Home -->

<!-- Custom CSS -->
<link href="css/perfil.css" rel="stylesheet">
<link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/perfil-xs.css' />
<link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/perfil-small.css' />
<link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/perfil-large.css' />

<!-- Custom Fonts -->
<link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

<!-- Fim Home -->

</head>

<div class="sidebar"> 
	<div class="top-sidebar">Bem Vindo, <?php echo $_SESSION['user_name']?></div>
        <div class="sidebar-content">           
                <ul class="sidebar-menu">
                    <a href="index.php">
                    	<li style="z-index:1000;" id="home">
                        	Disciplinas Disponíveis
                    	</li>
                    </a>
                   	<a href="profile_show.php">
                   		<li id="active">
                        	Meu Perfil
                    	</li>
                    </a>
                     <a href="disciplinas.php">
                     	<li>
                        	Minhas Disciplinas
                    	</li>
                    </a>
    				<a href="cadastro_disciplina.php">
    					<li>
	   						<?php 
							if ($_SESSION['acesso'] == 1)
								include('_options_aluno.php'); 
								//echo WORDING_USER_STUDENT . "<br />";
							else if ($_SESSION['acesso'] == 2){
								?>
								<?php echo WORDING_REGISTER_NOVA_DISCIPLINA; ?><br>
						</li>
					</a>
					<a href="cadastro_OA.php">
						<li>
								<?php echo WORDING_REGISTER_NOVO_OA; ?><br>
								<!-- </li></a>
								<a href="cadastro_competencia.php"><li>
								<?php echo WORDING_REGISTER_NOVA_COMPETENCIA; ?><br>
								</li></a> -->
								<?php
								//include('_options_professor.php'); 
								//echo WORDING_USER_PROFESSOR . "<br/>";
							}else if($_SESSION['acesso'] == 3)
								echo WORDING_USER_ADMIN . "<br/>";
							?>
                    	</li>
                    </a>
                </ul>
    	</div>  
</div>