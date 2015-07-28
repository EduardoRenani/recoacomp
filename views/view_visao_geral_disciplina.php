<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 11/09/14
 * Time: 14:32
 */
include('_header.php');

?>
<head>
    <link rel="stylesheet" href="css/tooltip.css">
    <link href="css/base_cadastro_editar_disciplina.css" rel="stylesheet">
    <link href="css/jquery.nouislider.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">




    <style>
    .group { zoom: 1 }

    .tooltip {
    display: block;
    position: absolute;
    font: 400 12px/12px Arial;
    border-radius: 3px;
    background: #fff;
    top: -43px;
    padding: 5px;
    left: -9px;
    text-align: center;
    width: 50px;
    }
    .tooltip strong {
        display: block;
        padding: 2px;
    }

    body { font-size: 62.5%; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }

     /*!
     * Bootstrap Modal
     *
     * Copyright Jordan Schroter
     * Licensed under the Apache License v2.0
     * http://www.apache.org/licenses/LICENSE-2.0
     *
     * Boostrap 3 patch for for bootstrap-modal. Include BEFORE bootstrap-modal.css!
     */

    body.modal-open,
    .modal-open .navbar-fixed-top,
    .modal-open .navbar-fixed-bottom {
        margin-right: 0;
    }

    .modal {
        left: 50%;
        bottom: auto;
        right: auto;
        z-index: 1050;
        padding: 0;
        width: 500px;
        margin-left: -250px;
        background-color: #ffffff;
        border: 1px solid #999999;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 6px;
        -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
        box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
        background-clip: padding-box;
    }

    .modal.container {
        max-width: none;
    }

    .modal-backdrop {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1040;
    }



    </style>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="js/jquery.nouislider.all.min.js" type="text/javascript"></script> <!-- Slider -->
    <script type="text/javascript" src="js/jquery.form.js"></script>



<script type="text/javascript">

$(document).ready(function(){
    $('#tabela1, #tabela2')
        .accordion({
            header: "> div > h3"
        })
        .sortable({
            connectWith: "#tabela1, #tabela2",
            //axis: "y",
            handle: "h3",
            update: function(event, ui) {
                var arrayDados = $("#tabela2").sortable('toArray').toString();
                document.getElementById('nomeCompetencia').value = arrayDados;
            },
            stop: function( event, ui ) {
            // IE doesn't register the blur when sorting
            // so trigger focusout handlers to remove .ui-state-focus
            ui.item.children( "h3" ).triggerHandler( "focusout" );
            // Refresh accordion to handle new order
            $( this ).accordion( "refresh" );
            }
        });
});


$(function() {
    $( "#accordion" )
      .accordion({
        header: "> div > h3"
      })
      .sortable({
        //axis: "y",
        handle: "h3",
        stop: function( event, ui ) {
          // IE doesn't register the blur when sorting
          // so trigger focusout handlers to remove .ui-state-focus
          ui.item.children( "h3" ).triggerHandler( "focusout" );
 
          // Refresh accordion to handle new order
          $( this ).accordion( "refresh" );
        }
      });
  });


  $(function() {
    $( "#tabs" ).tabs();
  });

</script>



    </head>



<div class="fixedBackgroundGradient"></div>
<div class="cadastrobase">
    <?php 
    $nomeDisciplina = $disciplina->getNomeDisciplinaById($_POST['idDisciplina'])[0][0];
    $nomeCurso = $disciplina->getNomeCursoById($_POST['idDisciplina'])[0][0];
    $descricao = $disciplina->getDescricaoDisciplinaById($_POST['idDisciplina'])[0][0];
    $idDisciplina = $_POST['idDisciplina'];
    ?>
<div class="top-cadastrobase"><div class="text-left"><?php echo (WORDING_GLOBAL_COURSE).': '.$nomeDisciplina; ?></div><div class="text-right" ><!-- <a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a>--></div></div>
    <div class="cadastrobase-content">
        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">Alterar dados gerais</a></li>
                <li><a href="#tabs-2">Alunos Matriculados</a></li>
                <li><a href="#tabs-3">OAS Vinculados</a></li>
            </ul>
            <div id="tabs-1">
                <form method="post" action="editar_disciplina.php" name="editar_nome_disciplina">
                    <label for="disciplina_name"><?php echo WORDING_NEW_DISCIPLINA_NAME; ?></label>
                    <input id="disciplina_name" type="text" name="disciplina_name"/> (<?php echo WORDING_CURRENTLY; ?>: <?php echo $nomeDisciplina; ?>)<br />
                    <input type="hidden" name="idDisciplina" value="<?php echo $idDisciplina ?>" />
                    <input type="submit" name="editar_nome_disciplina" value="<?php echo WORDING_CHANGE_DISCIPLINA_NAME; ?>" />
                </form><hr/>
                <!-- Formulário para editar o nome do curso -->
                <form method="post" action="editar_disciplina.php" name="editar_nome_curso">                  
                    <label for="curso_name"><?php echo WORDING_NEW_COURSE_NAME; ?></label>
                    <input id="curso_name" type="text" name="curso_name" required /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo $nomeCurso; ?>)<br />
                    <input type="hidden" name="idDisciplina" value="<?php echo $idDisciplina ?>" />
                    <input type="submit" name="editar_nome_curso" value="<?php echo WORDING_CHANGE_COURSE_NAME; ?>" />
                </form><hr/>
                <!-- Alterar a senha da disciplina -->
                <form method="post" action="editar_disciplina.php" name="editar_senha">
                    <input type="hidden" name="idDisciplina" value="<?php echo $idDisciplina ?>" />
                    <label for="senha_antiga"><?php echo WORDING_NEW_PASSWORD; ?></label>
                    <input id="senha_antiga" type="password" name="senha_antiga" autocomplete="off" />
                    <label for="senha_nova"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
                    <input id="senha_nova" type="password" name="senha_nova" autocomplete="off" />
                    <input type="submit" name="editar_senha" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" />
                </form>
                <!-- Alterar a descrição da disciplina -->
                <form method="post" action="editar_disciplina.php" name="editar_descricao">
                    <label for="descricao"><?php echo WORDING_NEW_DESCRIPTION; ?></label>
                    <?php echo WORDING_CURRENTLY; ?>:<br/>
                    <?php echo $descricao; ?>
                    <br/>
                    <textarea name="descricao" id="descricao" rows="5" cols="40" class="required" aria-required="true" style="width: 100%; height: 150px;"></textarea>
                    <input type="hidden" name="idDisciplina" value="<?php echo $idDisciplina ?>" />
                    <input type="submit" name="editar_descricao" value="<?php echo WORDING_EDIT_DESCRIPTION; ?>" />
                </form>  
                <!-- Lista de competências -->
                <form method="post" action="editar_disciplina.php" name="editar_competencia">
                        <input type="hidden" id="nomeCompetencia" value="" />
                        <h3>Competências</h3>
                            
                            <ul id="tabela1">
                            <?php
                                $comp = new Competencia();
                                $competencias = $comp->getListaCompetenciaDisciplina($_POST['idDisciplina'],false);
                                $contador = count($competencias);
                                //echo $competencias[0]['idcompetencia'];
                                for($i=0;$i<$contador;$i++){  ?>
                                    <li id="<?php echo "".$competencias[$i]['idcompetencia']; ?>" class="ui-state-default"><?php echo "".$competencias[$i]['nome']; ?></li>                 
                            <?php                                        
                                } //end for
                            ?>

                            </ul>
                            
                            <br>

                            <ul id="tabela2">
                            <?php
                                $comp = new Competencia();
                                $competencias = $comp->getListaCompetenciaDisciplina($_POST['idDisciplina'],true);
                                $contador = count($competencias);
                                for($i=0;$i<$contador;$i++){ ?>                           
                                    <li id="<?php echo "".$competencias[$i]['idcompetencia']; ?>" class="ui-state-default">
                                       <!--div id="accordion"-->
                                          <div class="group">
                                            <h3><?php echo "".$competencias[$i]['nome']; ?></h3>
                                            <div>
                                              <p>Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.</p>
                                            </div>
                                          </div>
                                        <!--/div-->
                                        
                                      

                                        <!--button type="button" id="mostra_dados_competencia" onclick="abrirModal(event)">+</button-->
                                    </li>
                            <?php 
                                } //end for
                            ?>
                            </ul>
                </form>
                        <!-- Teste -->



            </div> <!-- END TAB 1-->
            <div id="tabs-2">
                 <?php
                    $listaAlunosMatriculados = $disciplina->listaAlunosMatriculados($_POST['idDisciplina']);
                    if (empty($listaAlunosMatriculados))
                       echo 'Nenhum aluno matriculado';
                    else{ ?>
                       <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>Nome de Usuário</th>
                            <th>Email</th>
                            <th>Tipo de Usuário</th>
                        </tr>
                        </thead>
                            <tbody>
                            <?php
                            $qtde = count($listaAlunosMatriculados);
                            for($i=0; $i < $qtde; $i++){
                            $idUser = $listaAlunosMatriculados[$i]['usuario_idusuario'];
                            $dadosUsuario = $disciplina->getUserData($idUser);
                            echo
                                "<tr>".
                                "<td>".$dadosUsuario[0]['user_name']."</td>".
                                "<td>".$dadosUsuario[0]['user_email']."</td>";
                                if ($dadosUsuario[0]['acesso'] == 1)
                                    echo "<td>".WORDING_USER_STUDENT."</td>";
                                elseif ($dadosUsuario[0]['acesso'] == 2)
                                    echo "<td>".WORDING_USER_PROFESSOR."</td>";
                                elseif ($dadosUsuario[0]['acesso'] == 3)
                                    echo "<td>".WORDING_USER_ADMIN."</td>";
                                echo "</tr>";
                       }
                   }
                   ?>
                            </tbody>
                        </table>        
            </div> <!-- END TAB 2 -->
          <div id="tabs-3">
            <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
          </div>
        </div>

        </div>
    </div>
</div>


<!-- style="background-color: rgba(0, 0, 0, 0.8); height: 100%; width: 100%; position: fixed; top: 55px; left: 0px;"-->
<?php include('_footer.php'); ?>