<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 11/09/14
 * Time: 14:32
 */
include('_header.php');

?>
<!-- IMPORTAÇÃO JQUERY-->
<head>
    <link rel="stylesheet" href="css/tooltip.css">
    <link href="css/base_cadastro.css" rel="stylesheet">
    <link href="css/jquery.nouislider.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <link rel="stylesheet" href="primeui-2.0/production/primeui-2.0-min.css" />




    <style>
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
    <!-- BREADCRUMB BONITO-->
    <script type="text/javascript" src="primeui-2.0/production/primeui-2.0-min.js"></script>
    <script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript"></script>
    <script src="js/jquery.nouislider.all.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/picklist_prime.js"></script>


    <script type="text/javascript">
        $(function() {

        var themes = new Array('afterdark', 'afternoon', 'afterwork', 'aristo', 'black-tie', 'blitzer', 'bluesky', 'bootstrap', 'casablanca', 'cruze',
            'cupertino', 'dark-hive', 'dot-luv', 'eggplant', 'excite-bike', 'flick', 'glass-x', 'home', 'hot-sneaks', 'humanity', 'le-frog', 'midnight',
            'mint-choc', 'overcast', 'pepper-grinder', 'redmond', 'rocket', 'sam', 'smoothness', 'south-street', 'start', 'sunny', 'swanky-purse', 'trontastic',
            'ui-darkness', 'ui-lightness', 'vader');

        $('#basic').puipicklist();

        $('#advanced').puipicklist({
            effect: 'clip',
            showSourceControls: true,
            showTargetControls: true,
            sourceCaption: 'Available',
            targetCaption: 'Selected',
            filter: true,
            sourceData: themes
        });


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

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Alterar dados Gerais
                    </a>
                    </h4>
                </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <!-- Formulário para editar o nome da disciplina  -->
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

                    <h3>Basic</h3>
                    <div id="basic">
                        <select name="source">
                            <option value="1">Volkswagen</option>
                            <option value="2">Ford</option>
                            <option value="3">Mercedes</option>
                            <option value="4">Audi</option>
                            <option value="5">BMW</option>
                            <option value="6">Honda</option>
                            <option value="6">Porsche</option>
                            <option value="6">Chevrolet</option>
                            <option value="6">Jaguar</option>
                        </select>
                        <select name="target">
                        </select>
                    </div>

                    <h3>Advanced</h3>
                    <div id="advanced">
                        <select name="source">
                        </select>
                        <select name="target">
                        </select>
                    </div>



                </div>
            </div>
            </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Alunos Matriculados
                         </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
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
                                           //print_r($dadosUsuario);
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
                        </div>
                    </div>
                </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Relatório da Recomendação
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- style="background-color: rgba(0, 0, 0, 0.8); height: 100%; width: 100%; position: fixed; top: 55px; left: 0px;"-->
<?php include('_footer.php'); ?>