<?php include('_header.php'); ?>

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
	<div class="top-sidebar">Bem Vindo, <?php echo $_SESSION['user_name']?></div>
        <div class="sidebar-content">           
                <ul class="sidebar-menu">
                    <li style="z-index:1000;" id="home">
                        <a href="#" id="active">Home</a>
                            <ul > <!--nomes de cadeiras servem só de exemplo do funcionamento-->

                            </ul>
                    </li>
                    <li>
                        <a href="profile_show.php">Meu Perfil</a>
                    </li>
                     <li>
                        <a href="#">Disciplinas</a>
                    </li>
                    <li>
    					<a href="index.php?logout"><?php echo WORDING_LOGOUT; ?></a>
    				</li>
    				<li>
   						<?php 
						if ($_SESSION['acesso'] == 1)
							include('_options_aluno.php'); 
							//echo WORDING_USER_STUDENT . "<br />";
						else if ($_SESSION['acesso'] == 2){
							?>
							<li>
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


<!-- ============== DISCIPLINAS ============== -->

<div class="disciplinas">
<div class="top-disciplinas">Minhas Disciplinas</div>
        <div class="disciplinas-content">           
            <ul class="disciplinas-list">
                        <li class="disciplinas-item">
                            <div class="disciplina-item-content">
                                <h3>Ergonomia Aplicada ao Design II</h3> <!--nomes de cadeiras servem só de exemplo do funcionamento-->
                                <h4>Júlio Van der Linden - ARQ03140</h4>
                                <p>Conhecimento dos fundamentos da ergonomia Cognitiva, da Interação Homem Computador e da Experiência do Usuário.</p>
                            </div>
                            <div class="button"><form action="#"><!--action é só para mostrar, no site em si não tem isso"-->
                                <input type="submit" value="Receber Recomendação"></br></br>
                            </form></div>
                        </li>
                         <li class="disciplinas-item">
                            <div class="disciplina-item-content">
                                <h3>Ciência e Tecnologia dos Materiais</h3>
                                <h4>Annelise Alves - ENG02033</h4>
                                <p>Correlação entre propriedades, estrutura, processos de fabricação e desempenho dos diferentes materiais utilizados em produtos
industriais.</p>
                            </div>
                            <div class="button"><form action="#"><!--action é só para mostrar, no site em si não tem isso"-->
                                <input type="submit" value="Receber Recomendação"></br></br>
                            </form></div>
                        </li>
                         <li class="disciplinas-item">
                            <div class="disciplina-item-content">
                                <h3>Design Contenporâneo: Teoria e História</h3>
                                <h4>Maria do Carmo Curtis - ARQ03114</h4>
                                <p>Correntes atuais e as diferentes práticas e resultados obtidos por profissionais do design no âmbito internacional. Os vários graus de
industrialização no mundo. Países na periferia da industrialização.</p>
                            </div>
                            <div class="button"><form action="#"><!--action é só para mostrar, no site em si não tem isso"-->
                                <input type="submit" value="Receber Recomendação"></br></br>
                            </form></div>
                        </li>
                </ul>
         </div>  
</div>


</div>


<?php include('_footer.php'); ?>
