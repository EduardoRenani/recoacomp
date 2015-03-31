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
                    <li style="z-index:1000;" id="home">
                        <a href="index.php" id="active">Disciplinas Disponíveis</a>
                            <ul > <!--nomes de cadeiras servem só de exemplo do funcionamento-->

                            </ul>
                    </li>
                    <li>
                        <a href="profile_show.php">Meu Perfil</a>
                    </li>
                     <li>
                        <a href="disciplinas.php">Minhas Disciplinas</a>
                    </li>
    				<li>
   						<?php 
						if ($_SESSION['acesso'] == 1)
							include('_options_aluno.php'); 
							//echo WORDING_USER_STUDENT . "<br />";
						else if ($_SESSION['acesso'] == 2){
							?>
							<a href="cadastro_disciplina.php"><?php echo WORDING_REGISTER_NOVA_DISCIPLINA; ?></a><br>
							</li>
							<li>
							<a href="cadastro_OA.php"><?php echo WORDING_REGISTER_NOVO_OA; ?></a><br>
							</li>
							<li>
							<a href="cadastro_competencia.php"><?php echo WORDING_REGISTER_NOVA_COMPETENCIA; ?></a><br>
							</li>
							<?php
							//include('_options_professor.php'); 
							//echo WORDING_USER_PROFESSOR . "<br/>";
						}else if($_SESSION['acesso'] == 3)
							echo WORDING_USER_ADMIN . "<br/>";
						?>
                    </li>
                </ul>
    	</div>  
</div>