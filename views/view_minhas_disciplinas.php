<?php include_once('_header.php'); ?>

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
<script type="text/javascript">
function getDisciplinaId(id){
    var disciplinaId = id;
    document.getElementById('idDisciplina').value = id;
    //alert(id);
}
</script>

</head>

<div class="fixedBackgroundGradient"></div>
<!-- ============== SIDEBAR =============== -->
<?php include_once("sidebar.php"); ?>

<!-- ============== DISCIPLINAS DIPONIVEIS ============== -->

<div class="disciplinas">
<div class="top-disciplinas"><?php echo WORDING_AVAILABLE_COURSES?></div>
        <div class="disciplinas-content">           
            <ul class="disciplinas-list">
                

            <?php
                // Exibir todas as disciplinas disponiveis e permitir cadastros nas mesmas
                

                $carregamento = new Carregamento;
				$disciplians = $carregamento->carregaDadosAssociacao($_SESSION['user_id'], "usuario_disciplina", array('usuario_idusuario', 'disciplina_iddisciplina'));
				var_dump($dsiciplinas);
                /*for($i=0; $i<$contador;$i++){
                    echo
                        "<li class='disciplinas-item'>".
                            "<div class='disciplina-item-content'>".
                                "<div class='lista-disciplina'>".
                                    "<h3>".$listaDisciplina[0][$i][0]."</h3>".
                                    "<h4>".$listaDisciplina[1][$i][0]."</h4>".
                                    "<p>".$listaDisciplina[2][$i][0]."</p>"
                                    "<p><a href='#openModal' id=".$listaDisciplina[3][$i][0]." class='botao-cadastra' onClick='getDisciplinaId(this.id)'>Ver Disciplina</a></p>"
                                    "<br>".
                                    "<br><a href='#openModal' id=".$listaDisciplina[3][$i][0]." onClick='getDisciplinaId(this.id)'>Excluir</a>".
                                "</div>".
                            "</div>".
                                "<!--<div class='button'>".
                                    "<br><a href='#openModal' id=".$listaDisciplina[3][$i][0]." class='botao-cadastra' onClick='getDisciplinaId(this.id)'>Ver Disciplina</a>".
                                "</div>-->".

                        "</li>";
                
                ?>

                <div id="openModal" class="modalDialog">
                        <div>
                            <a href="#close" title="Close" class="close">X</a>
                            <div class="top-cadastro"><?php echo WORDING_FILL_PASSWORD; ?></div>
                                <!-- form action="home.html"--><!--action é só para mostrar, no site em si não tem isso"-->
                                <!--form method="post" action="register.php" name="registerform" -->
                                <form method="post" action="cadastro_disciplina_cha.php" name="senha_disciplina">
                                    <input id="senha" type="password" name="senha" placeholder="<?= WORDING_REGISTRATION_PASSWORD; ?>" pattern=".{6,}" required/>
                                    <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $_SESSION['user_id']; ?>" />
                                    <input type="hidden" id="idDisciplina" name="idDisciplina" value="" />
                                    <input type="hidden" name="okay" value="nope" />
                                    <input type='hidden' id='link' name='link' value='<?= $_SERVER['REQUEST_URI']; ?>' />
                                    <input type="submit" name="verifica_senha" action="" value="<?php echo WORDING_REGISTER_CHA; ?>" />
                                </form>                                                 
                        </div>
                        <!-- /.top-cadastro -->
                </div>
                <?php }*/ ?>
                <!-- /.modalDialog -->
            </ul>
         </div>  

</div>



