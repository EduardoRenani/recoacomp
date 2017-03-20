<?php
/**
 * Created by PhpStorm.
 * User: Delton
 * Date: 11/09/14
 * Time: 14:32
 */
include('_header.php');
?>
    <!-- CSS -->
    <link rel="stylesheet" href="css/tooltip.css">
    <link href="css/editar_disciplina.css" rel="stylesheet">
    <link href="css/jquery.nouislider.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
    <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/home-xs.css' />
    <link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/home-small.css' />
    <link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/home-large.css' />


    <!-- JS -->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script src="js/jquery.nouislider.all.min.js" type="text/javascript"></script> <!-- Slider -->
    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script type="text/javascript" src="js/jquery.noty.packaged.min.js"></script>
    
    <!-- Pega Tempo de acesso -->
    <script type="text/javascript" src="js/ajax.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function(){
        // Tabela com competências do sistema
        var removeCompInput = false;
        $( "#competenciasDisponiveis" )
          .accordion({
            header: "> div > h3",
            active: false,
            collapsible: true,
            heightStyle: "content"
          })
          .sortable({
            //axis: "y",
            handle: 'h3',
            connectWith: "#competenciasDisciplina",
            //items: '> div > h3',
            stop: function( event, ui ) {
              // IE doesn't register the blur when sorting
              // so trigger focusout handlers to remove .ui-state-focus
              ui.item.children( "h3" ).triggerHandler( "focusout" );
              // Refresh accordion to handle new order
              $( this ).accordion( "refresh" );
            },
            update: function(event, ui) {
                var arrayDados = $("#competenciasDisciplina").sortable('toArray').toString();
                //console.log(arrayDados);
                document.getElementById('nomeCompetencia').value = arrayDados;
            },
            receive: function( event, ui ) {
                // Não deixa alterar os valores das competências
                var input = $(this).find('input')
                //console.log(input);
                input.attr('disabled','disabled');
                <?php
                $comp = new Competencia();
                $numComp = $comp->getListaCompetencia();
                $numComp = count($numComp);
                //echo 'var numComp = '..';';
                ?>;

                var numComp = <?php echo $numComp;?>
                //$numComp =  ?>

                //console.log(this.children.length);
                //console.log(numComp-1);
                // Verifica se o número de competências é minimo
                if(this.children.length > numComp-1){
                    $(ui.sender).sortable('cancel');
                    var n = noty({
                            text: 'É necessário no mínimo uma competência',
                            layout: 'topCenter',
                            theme: 'relax', // or 'relax'
                            type: 'error',
                            killer: true, // MATA OS OUTROS NOTYS MWHAHAHA
                            animation: {
                                open: {height: 'toggle'}, // jQuery animate function property object
                                close: {height: 'toggle'}, // jQuery animate function property object
                                easing: 'swing', // easing
                                speed: 500 // opening & closing animation speed
                            },
                            timeout: 1000
                            // Desaparecer

                    });
                }
            }
          });
        // Tabela com competências da disciplina
        $( "#competenciasDisciplina" )
          .accordion({
            header: "> div > h3",
            active: false,
            collapsible: true,
            heightStyle: "content"
          })
          .sortable({
            //axis: "y",
            handle: "h3",
            connectWith: "#competenciasDisponiveis",
            //items: '> div > h3',
            stop: function( event, ui ) {
              // IE doesn't register the blur when sorting
              // so trigger focusout handlers to remove .ui-state-focus
              ui.item.children( "h3" ).triggerHandler( "focusout" );

              // Refresh accordion to handle new order
              $( this ).accordion( "refresh" );
            },
            // Preencher array das competências
            update: function(event, ui) {
                var arrayDados = $("#competenciasDisciplina").sortable('toArray').toString();
                //console.log(arrayDados);
                document.getElementById('nomeCompetencia').value = arrayDados;
            },
            // Inicializar array com IDs das competências
            create: function( event, ui ) {
                var arrayDados = $("#competenciasDisciplina").sortable('toArray').toString();
                document.getElementById('nomeCompetencia').value = arrayDados;
            },
            over: function (e, ui) {
                removeCompInput = false;

            },
            out: function (event, ui) {
                removeCompInput = true;

            },
            // não deixa multiplicar os elementos
            // Remove competencia
            beforeStop: function (event, ui) {
                var idDisciplina = <?php echo $_POST["idDisciplina"] ?>;
                var idCompetencia = ui.item.context.id;
                if(removeCompInput == true){
                    //Remove do BD a competência
                    removeCompetenciaComAjax(idCompetencia, idDisciplina);
                }
            },
            // Deixa alterar os valores das competências
            receive: function( event, ui ) {
                var idDisciplina = <?php echo $_POST["idDisciplina"] ?>;
                var idCompetencia = ui.item.context.id;
                var input = $(this).find('input')
                input.removeAttr('disabled');
                // Adiciona a competência
                adicionaCompetenciaComAjax(idCompetencia, idDisciplina);
            }
          });
        }); //end document ready
        //função que remove competência da disciplina
        function removeCompetenciaComAjax(idCompetencia, idDisciplina) {
            jQuery.ajax({
                type: "GET",
                url: "ajax/remove_competencia.php",
                data: {
                    idCompetencia : idCompetencia,
                    idDisciplina : idDisciplina,
                },
                cache: false,
                // importantinho.
                error: function(e){
                    alert(e);
                },
                success: function(response){
                    //console.log(response);
                    var n = noty({
                        text: 'Competência removida com sucesso',
                        layout: 'topCenter',
                        theme: 'relax', // or 'relax'
                        type: 'information',
                        killer: true, // MATA OS OUTROS NOTYS MWHAHAHA
                        animation: {
                            open: {height: 'toggle'}, // jQuery animate function property object
                            close: {height: 'toggle'}, // jQuery animate function property object
                            easing: 'swing', // easing
                            speed: 500 // opening & closing animation speed
                        },
                        timeout: 500
                        // Desaparecer

                    });
                }
            });
        }
        //função que adiciona competência na disciplina
        function adicionaCompetenciaComAjax(idCompetencia, idDisciplina) {
            jQuery.ajax({
                type: "GET",
                url: "ajax/adiciona_competencia.php",
                data: {
                    idCompetencia : idCompetencia,
                    idDisciplina : idDisciplina,
                },
                cache: false,
                // importantinho.
                error: function(e){
                    alert(e);
                },
                success: function(response){
                    console.log(response);
                    var n = noty({
                        text: 'Competência adicionada com sucesso',
                        layout: 'topCenter',
                        theme: 'relax', // or 'relax'
                        type: 'information',
                        killer: true, // MATA OS OUTROS NOTYS MWHAHAHA
                        animation: {
                            open: {height: 'toggle'}, // jQuery animate function property object
                            close: {height: 'toggle'}, // jQuery animate function property object
                            easing: 'swing', // easing
                            speed: 500 // opening & closing animation speed
                        },
                        timeout: 500
                        // Desaparecer

                    });
                }
            });
        }
        // Tabs function
        $(function() {
            $( "#tabs" ).tabs();
        });
        //Tooltips
        $(function() {
            $( document ).tooltip();
        });
        $(function(){
            $('.input-dados').on('change', function(){
                var valor = this.value;
                var id = this.id;
                var tipo = this.name; // no nome está se é conhecimento, habilidade ou atitude
                var titulo = $(this).prev('h3').text();
                var idDisciplina = <?php echo $_POST["idDisciplina"] ?>;
                jQuery.ajax({
                    type: "GET",
                    url: "ajax/update_competencia.php",
                    data: {
                        valor: valor,
                        id : id,
                        tipo : tipo,
                        idDisciplina : idDisciplina,
                    },
                    cache: false,
                    // importantinho.
                    error: function(e){
                        alert(e);
                    },
                    success: function(response){
                        console.log(response);
                        var n = noty({
                            text: 'Competência atualizada com sucesso',
                            layout: 'topCenter',
                            theme: 'relax', // or 'relax'
                            type: 'information',
                            killer: true, // MATA OS OUTROS NOTYS MWHAHAHA
                            animation: {
                                open: {height: 'toggle'}, // jQuery animate function property object
                                close: {height: 'toggle'}, // jQuery animate function property object
                                easing: 'swing', // easing
                                speed: 500 // opening & closing animation speed
                            },
                            timeout: 500
                            // Desaparecer

                        });
                    }
                });
                //console.log(this.value);
            });
        });
        $(document).ready(function(){
            var icons = {
            //"header": "ui-icon-plus", "activeHeader": "ui-icon-minus"
            header: "ui-icon-plus",
            activeHeader: "ui-icon-minus"
            };
            $("#objetos").accordion({
                header: "> div > h3",
                active: false,
                collapsible: true,
                icons: icons,
                heightStyle: "content"
            });
            $("#alunos").accordion({
                header: "> div > h3",
                active: false,
                collapsible: true,
                icons: icons,
                heightStyle: "content"
            });

        var iframe = document.getElementById('graficos');    
        $(window).mouseup(function(){iframe.src = iframe.src;});
        });

        opacityModal = 0;
        function fadeInModal() {
            div = document.getElementById('modal-competencia');
            divDelete = document.getElementById('closeModal');
            divFundo = document.getElementsByClassName('fundoPreto')[0];
            divFundo.style.display = "block";
            divFundo.style.opacity = opacityModal;
            div.style.opacity = opacityModal;
            divDelete.style.opacity = opacityModal;
            opacityModal+=0.01;
            tModal = setTimeout(function() {fadeInModal()}, 1);
            if (opacityModal >= 1) {
                clearTimeout(tModal);
            }
        }

        function fadeOutModal() {
            div = document.getElementById('modal-competencia');
            div1 = document.getElementById('closeModal');
            divFundo = document.getElementsByClassName('fundoPreto')[0];
            divFundo.style.opacity = opacityModal;
            div1.style.opacity = opacityModal;
            div.style.opacity = opacityModal;
            opacityModal-=0.01;
            tFadeOutModal = setTimeout(function() {fadeOutModal()}, 1);
            if (opacityModal <= 0) {
                divFundo.style.display = "none";
                divDelete = document.getElementById('modal-competencia');
                divDelete.parentNode.removeChild(divDelete);
                divDeleteClose = document.getElementById('closeModal');
                divDeleteClose.parentNode.removeChild(divDeleteClose);
                clearInterval(window.tDeleteModal);
                clearTimeout(tFadeOutModal);
            }
        }

        function deleteModal() {
            if(document.getElementById('modal-competencia')) {
                if(document.getElementById('modal-competencia').contentDocument.getElementsByClassName('disciplinas-list').length != 0) {
                    fadeOutModal();
                    clearInterval(window.tDeleteModal);
                    location.reload();
                }
            }
        }

        function modalCompetencia() {
            modalClose = document.createElement('div');
            modalClose.setAttribute("id", "closeModal");
            modalClose.setAttribute("class", "text-right");
            modalClose.setAttribute("onclick", "fadeOutModal()");
            modalClose.setAttribute("style", "position: absolute; top: 12%; left: 0; font-size: 20px; background-color: ; z-index: 9999; width: 100%; padding-right: 33px;l");
            modalClose.innerHTML = '<a href="#"><span class="glyphicon glyphicon-remove"></span></a>';
            modal = document.createElement("iframe");
            modal.setAttribute("src", "modal_cadastro_competencia.php");
            modal.setAttribute("id", "modal-competencia");
            modal.setAttribute("style", "position: absolute; z-index: 9998; top: 10%; left: 2.5%; background-color: #fff; width: 95%; height: 980px; overflow: hidden; opacity: 0; -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; margin-bottom: 50px;");
            modal.setAttribute("frameborder", "0");

            document.getElementsByClassName('cadastrobase')[0].appendChild(modal);
            document.getElementsByClassName('cadastrobase')[0].appendChild(modalClose);
            fadeInModal();
            tDeleteModal = setInterval("deleteModal()", 1);
        }

        $(function() {
            $("#conhecimento_user").attr("title", $("#conhecimento").attr("title"));
            $("#habilidade_user").attr("title", $("#habilidade").attr("title"));
            $("#atitude_user").attr("title", $("#atitude").attr("title"));
        });
    </script>

    <div class="fixedBackgroundGradient">
    </div>
    <div class="cadastrobase">
        <?php
        $nomeDisciplina = $disciplina->getNomeDisciplinaById($_POST['idDisciplina'])[0][0];
        $nomeCurso = $disciplina->getNomeCursoById($_POST['idDisciplina'])[0][0];
        $descricao = $disciplina->getDescricaoDisciplinaById($_POST['idDisciplina'])[0][0];
        $idDisciplina = $_POST['idDisciplina'];
        ?>
        <div class="top-cadastrobase">
            <div class="text-left"><?php echo $nomeDisciplina; ?>
            </div>
            <div class="text-right" ><!-- <a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a>-->
            </div>
        </div>
            <div class="cadastrobase-content">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">Visão geral</a></li>
                        <li><a href="#tabs-2">Alterar dados gerais</a></li>
                        <li><a href="#tabs-3">Alunos Matriculados</a></li>
                        <li><a href="#tabs-4">OAs Vinculados</a></li>
                        <li><a href="#tabs-5">Alterar competências</a></li>
                        <li><a href="#tabs-6">Relatório</a></li>
                    </ul>
                    <div id="tabs-1">
                        <div id="nome-disciplina">
                            Nome da atividade: <?php echo $nomeDisciplina; ?>
                        </div>
                        <div id="nome-curso">
                            Nome da unidade: <?php echo $nomeCurso; ?>
                        </div>
                        <div id="descricao">
                            Descrição: <?php echo $descricao; ?>
                        </div>
                        <form action="responder_instrumento.php" method="POST">
                            <input type="hidden" name="iddisciplina" value="<?php echo $_POST['idDisciplina']; ?>">
                            <input type="submit" value="Responder instrumento">
                        </form>
                    </div> <!-- END TAB 1-->
                    <div id="tabs-2">
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
                            <br>(<?php echo WORDING_CURRENTLY; ?>:
                            <?php echo $descricao; ?>)<br/>
                            <textarea name="descricao" id="descricao" rows="5" cols="40" class="required" aria-required="true" style="width: 100%; height: 150px;"></textarea>
                            <input type="hidden" name="idDisciplina" value="<?php echo $idDisciplina ?>" />
                            <input type="submit" name="editar_descricao" value="<?php echo WORDING_EDIT_DESCRIPTION; ?>" />
                        </form>
                    </div> <!-- END TAB 2-->
                    <div id="tabs-3">

                        <div id="alunos">
                         <?php
                            $listaAlunosMatriculados = $disciplina->listaAlunosMatriculados($_POST['idDisciplina']);
                            if (empty($listaAlunosMatriculados))
                               echo 'Nenhum aluno matriculado';
                            else{ ?>
                                    <?php
                                    $qtde = count($listaAlunosMatriculados);
                                    for($i=0; $i < $qtde; $i++){
                                    $idUser = $listaAlunosMatriculados[$i]['usuario_idusuario'];
                                    $dadosUsuario = $disciplina->getUserData($idUser);
                                    $idCompetencias = $disciplina->getCompetenciasDisciplina($_POST['idDisciplina'], 'idDisciplina');
                                    foreach ($idCompetencias as $idCompetencia) {
                                        $chas[$idUser][$idCompetencia[0]] = $comp->getCHAbyAluno($idCompetencia[0], $idUser);
                                    }
                                    echo '
                                        <div class="group">
                                            <h3>'.$dadosUsuario[0]['user_name'];
                                    echo   '</h3>
                                            <div>
                                                <dl>
                                                    <dt>Email</dt>
                                                        <dd>'.$dadosUsuario[0]['user_email'].'</dd><br>
                                                    <dt>Função</dt>';
                                                    if ($dadosUsuario[0]['acesso'] == 1)
                                                        echo "<dd>".WORDING_USER_STUDENT."</dd><br>";
                                                    elseif ($dadosUsuario[0]['acesso'] == 2)
                                                        echo "<dd>".WORDING_USER_PROFESSOR."</dd><br>";
                                                    elseif ($dadosUsuario[0]['acesso'] == 3)
                                                        echo "<dd>".WORDING_USER_ADMIN."</dd><br>";

                                    foreach($chas[$idUser] as $key => $cha) {
                                        $comp = new Competencia;
                                        $nome = $comp->getArrayOfNamesById($key);
                                        if($nome) {
                                            $chaConhecimento = "Sem dados";
                                            $chaHabilidade = "Sem dados";
                                            $chaAtitude = "Sem dados";
                                            if($cha) {
                                                switch($cha[0]["conhecimento"]) {
                                                    case '0':
                                                        $chaConhecimento = HINT_CHA_0;
                                                        break;
                                                    case '1':
                                                        $chaConhecimento = HINT_CHA_1;
                                                        break;
                                                    case '2':
                                                        $chaConhecimento = HINT_CHA_2;
                                                        break;
                                                    case '3':
                                                        $chaConhecimento = HINT_CHA_3;
                                                        break;
                                                    case '4':
                                                        $chaConhecimento = HINT_CHA_4;
                                                        break;
                                                }
                                                switch($cha[0]["habilidade"]) {
                                                    case '0':
                                                        $chaHabilidade = HINT_CHA_0;
                                                        break;
                                                    case '1':
                                                        $chaHabilidade = HINT_CHA_1;
                                                        break;
                                                    case '2':
                                                        $chaHabilidade = HINT_CHA_2;
                                                        break;
                                                    case '3':
                                                        $chaHabilidade = HINT_CHA_3;
                                                        break;
                                                    case '4':
                                                        $chaHabilidade = HINT_CHA_4;
                                                        break;
                                                }
                                                switch($cha[0]["atitude"]) {
                                                    case '0':
                                                        $chaAtitude = HINT_CHA_0;
                                                        break;
                                                    case '1':
                                                        $chaAtitude = HINT_CHA_1;
                                                        break;
                                                    case '2':
                                                        $chaAtitude = HINT_CHA_2;
                                                        break;
                                                    case '3':
                                                        $chaAtitude = HINT_CHA_3;
                                                        break;
                                                    case '4':
                                                        $chaAtitude = HINT_CHA_4;
                                                        break;
                                                }
                                            }
                                            echo "<dt>".$nome[0][0]."</dt>
                                                    <dd><label id='conhecimento_user' for='conhecimento_user' title=''>Conhecimento: <span class='glyphicon glyphicon-question-sign'></span></label> ".$chaConhecimento."</dd>
                                                    <dd><label id='habilidade_user' for='habilidade_user' title=''>Habilidade: <span class='glyphicon glyphicon-question-sign'></span></label> ".$chaHabilidade."</dd>
                                                    <dd><label id='atitude_user' for='atitude_user' title=''>Atitude: <span class='glyphicon glyphicon-question-sign'></span></label> ".$chaAtitude."</dd>
                                            ";
                                        }
                                    }
                                    echo        '</dl>
                                            </div>
                                        </div>';
                                        
                                        
                               }
                           }
                           ?>
                           </div>
                    </div> <!-- END TAB 3 -->
                    <!-- Objetos associados a disciplina -->
                    <div id="tabs-4">
                        <!-- TODO -->
                        <div id="objetos">
                        <?php
                        $disciplina = new Disciplina();
                        $OA = new OA();
                        $listaOAS = $disciplina->listaObjetosDisciplina($_POST['idDisciplina']);
                        $qtdeComp = count($listaOAS);
                        $arrayObjetos = array();
                        for ($i=0; $i < $qtdeComp; $i++){
                            $qtdeOA = count($listaOAS[$i]);
                            for($j=0; $j < $qtdeOA; $j++){
                                $idObjeto = $listaOAS[$i][$j]['id_OA'];
                                array_push($arrayObjetos, $idObjeto);
                            }
                        }
                        // Remove Objetos Duplicados (talvez queiram saber quantas vezes esse objeto está aparecendo (?))
                        $arrayObjetos = array_unique($arrayObjetos);
                        foreach ($arrayObjetos as $idObjeto) {
                            $dadosObjeto = $OA->getDadosOA($idObjeto);
                            // Pega dados da categoria vida
                            $idCategoriaVida = $dadosObjeto[0]['idcategoria_vida'];
                            $dadosCategoriaVida = $OA->getDadosCategoriaVidaOA($idCategoriaVida);
                            //echo '<pre>';
                            //print_r($dadosCategoriaVida);

                            // Faz explode nas palavras chaves do objeto
                            $keyWords  = $dadosObjeto[0]['palavraChave'];
                            $palavrasChaves = explode(",", $keyWords);

                            echo '
                                <div class="group">
                                    <h3>'.$dadosObjeto[0]['nome'].'</h3>
                                    <div>
                                        <dl>
                                            <dt>Descrição</dt>
                                                <dd>'.$dadosObjeto[0]['descricao'].'</dd>
                                            <br>
                                            <dt>URL</dt>
                                                <dd><a href="visualizarOA.php?url='.$dadosObjeto[0]['url'].'&idOA='.$dadosObjeto[0]['idcesta'].'&idDisciplina='.$_POST['idDisciplina'].'&idUsuario='.$_SESSION['user_id'].'" target="_blank">'.$dadosObjeto[0]['url'].'</a></dd>
                                            <br>
                                            <dt>Idioma</dt>';
                                            // Reescreve com acentos
                                            if ($dadosObjeto[0]['idioma'] == 'portugues'){
                                                echo '<dd>Português</dd>';
                                            } else if($dadosObjeto[0]['idioma'] == 'espanhol'){
                                                echo '<dd>Espanhol</dd>';
                                            } else if($dadosObjeto[0]['idioma'] == 'ingles'){
                                                echo '<dd>Inglês</dd>';
                                            };
                                            echo '<br>
                                            <dt>Palavra(s)-chave</dt>';
                                                foreach ($palavrasChaves as $palavra) {
                                                    echo '<dd>'.ucfirst($palavra).'</dd>';
                                                };
                                            echo '
                                            <br>
                                            <dt>Categoria Vida</dt>';
                                                //$data = date("d-m-Y", strtotime($originalDate));
                                                $originalDate = $dadosCategoriaVida [0]['data_2'];
                                                $status = $dadosCategoriaVida [0]['status_2'];
                                                $versao = $dadosCategoriaVida [0]['versao'];
                                                $entidade = $dadosCategoriaVida [0]['entidade'];
                                                $contribuicao = $dadosCategoriaVida [0]['contribuicao'];
                                                if ($originalDate == NULL){
                                                    echo 'nada';
                                                }
                                                echo '<dd> Data: '.date("d-m-Y", strtotime($originalDate)).'</dd>';
                                                echo '<dd> Status: '.$status.'</dd>';
                                                echo '<dd> Versao: '.$versao.'</dd>';
                                                echo '<dd> Entidade: '.$entidade.'</dd>';
                                                echo '<dd> Contribuição: '.$contribuicao.'</dd>';
                                            echo '
                                        </dl>
                                    </div>
                                </div>';
                        }
                        ?>
                        </div><!-- END DIV objetos -->
                    </div><!-- END TAB 4-->
                    <!-- Dados da competência -->
                    <div id="tabs-5">
                        <!-- Lista de competências -->
                        <form method="post" action="editar_disciplina.php" name="editar_competencia" class="editarCompetencia">
                                <input type="hidden" id="nomeCompetencia" value="" />
                                <h3>Editar Competências</h3>
                                    <!-- DIV com as competências do sistema -->

                                    <div id="competenciasDisponiveis">
                                        <?php
                                        $comp = new Competencia();
                                        $competencias = $comp->getListaCompetenciaDisciplina($_POST['idDisciplina'],false);
                                        $numComp = $comp->getListaCompetencia();
                                        $numComp = count($numComp);
                                        $_SESSION["numComp"] = $numComp;
                                        $contador = count($competencias);
                                        for($i=0;$i<$contador;$i++){
                                            $idCompetencia = $competencias[$i]['idcompetencia'];
                                            $descricaoConhecimento = $comp->getDescricaoConhecimentoById($idCompetencia);
                                            $descricaoHabilidade = $comp->getDescricaoHabilidadeById($idCompetencia);
                                            $descricaoAtitude = $comp->getDescricaoAtitudeById($idCompetencia);
                                            ?>
                                            <div class="group" id="<?php echo "".$competencias[$i]['idcompetencia']; ?>">
                                                <h3 >
                                                <?php echo "".$competencias[$i]['nome']; ?>
                                                </h3>
                                                <div> <!-- div com as competencias -->
                                                    Descrição:
                                                    <div class="alert alert-info" role="alert">
                                                        <p><?php echo "".$competencias[$i]['descricao_nome']; ?></p>

                                                    </div>
                                                    <!-- Conhecimento -->
                                                    <div class="content-valor-conhecimento">
                                                        <label id="conhecimento" for="conhecimento" title="<?php echo "".$descricaoConhecimento['conhecimento_descricao']; ?>">Conhecimento: <span class="glyphicon glyphicon-question-sign"></span></label>
                                                        <br>
                                                        <input class="input-dados" id="<?php echo "".$idCompetencia; ?>" name="conhecimento" type="number" min="0" max="4" value="0" disabled></input>
                                                    </div>
                                                    <br>
                                                    <!-- Habilidade -->
                                                    <div class="content-valor-habilidade">
                                                        <label id="habilidade" for="habilidade" title="<?php echo "".$descricaoHabilidade['habilidade_descricao']; ?>">Habilidade: <span class="glyphicon glyphicon-question-sign"></span></label>
                                                        <br>
                                                        <input class="input-dados" id="<?php echo "".$idCompetencia; ?>" name="habilidade" type="number" min="0" max="4" value="0" disabled></input>

                                                    </div>
                                                    <br>
                                                    <!-- Atitude -->
                                                    <div class="content-valor-atitude">
                                                        <label id="atitude" for="atitude" title="<?php echo "".$descricaoAtitude['atitude_descricao']; ?>">Atitude: <span class="glyphicon glyphicon-question-sign"></span></label>
                                                        <br>
                                                        <input class="input-dados" id="<?php echo "".$idCompetencia; ?>" name="atitude" type="number" min="0" max="4" value="0" disabled></input>
                                                    </div>


                                                </div>

                                            </div>
                                    <?php
                                        } //end for
                                    ?>
                                    </div>

                                    <!-- DIV com competências da disciplina a ser editada -->
                                    <div id="competenciasDisciplina">
                                        <?php
                                        $comp = new Competencia();
                                        $competencias = $comp->getListaCompetenciaDisciplina($_POST['idDisciplina'],true);
                                        // Pega os dados das competências para essa disciplina
                                        $conhecimento = $disciplina->getCompetenciasDisciplina($_POST['idDisciplina'], 'conhecimento');
                                        $habilidade = $disciplina->getCompetenciasDisciplina($_POST['idDisciplina'], 'habilidade');
                                        $atitude = $disciplina->getCompetenciasDisciplina($_POST['idDisciplina'], 'atitude');
                                        $contador = count($competencias);
                                        // Preenche a tabela
                                        for($i=0;$i<$contador;$i++){
                                            $idCompetencia = $competencias[$i]['idcompetencia'];
                                            $descricaoConhecimento = $comp->getDescricaoConhecimentoById($idCompetencia);
                                            $descricaoHabilidade = $comp->getDescricaoHabilidadeById($idCompetencia);
                                            $descricaoAtitude = $comp->getDescricaoAtitudeById($idCompetencia);
                                            ?>
                                            <div class="group" id="<?php echo "".$idCompetencia; ?>">
                                                <h3 >
                                                <?php echo "".$competencias[$i]['nome']; ?>
                                                </h3>
                                                <div>
                                                    Descrição:
                                                    <div class="alert alert-info" role="alert">
                                                        <p><?php echo "".$competencias[$i]['descricao_nome']; ?></p>
                                                    </div>
                                                    <!-- Conhecimento -->
                                                    <div class="content-valor-conhecimento">
                                                        <label for="conhecimento" title="<?php echo "".$descricaoConhecimento['conhecimento_descricao']; ?>">Conhecimento: <span class="glyphicon glyphicon-question-sign"></span></label>
                                                        <br>
                                                        <input class="input-dados" id="<?php echo "".$idCompetencia; ?>" name="conhecimento" type="number" min="0" max="4" value="<?php echo "".$conhecimento[$i]['conhecimento']; ?>" ></input>
                                                    </div>
                                                    <br>
                                                    <!-- Habilidade -->
                                                    <div class="content-valor-habilidade">
                                                        <label for="habilidade" title="<?php echo "".$descricaoHabilidade['habilidade_descricao']; ?>">Habilidade: <span class="glyphicon glyphicon-question-sign"></span></label>
                                                        <br>
                                                        <input class="input-dados" id="<?php echo "".$idCompetencia; ?>" name="habilidade" type="number" min="0" max="4" value="<?php echo "".$habilidade[$i]['habilidade']; ?>" ></input>

                                                    </div>
                                                    <br>
                                                    <!-- Atitude -->
                                                    <div class="content-valor-atitude">
                                                        <label for="atitude" title="<?php echo "".$descricaoAtitude['atitude_descricao']; ?>">Atitude: <span class="glyphicon glyphicon-question-sign"></span></label>
                                                        <br>
                                                        <input class="input-dados" id="<?php echo "".$idCompetencia; ?>" name="atitude" type="number" min="0" max="4" value="<?php echo "".$atitude[$i]['atitude']; ?>" ></input>
                                                    </div>
                                                </div>

                                            </div>
                                    <?php
                                        } //end for
                                    ?>
                                    </div>
                        </form>
                        <center><div onclick="modalCompetencia();" class='botao-cadastra' style='width: 250px'><?=WORDING_CREATE_NEW_COMPETENCIA?></div></center>
                    </div> <!-- END Dados da competencia-->
                    <div id="tabs-6">
                        <?php
                            echo "<iframe id='graficos' charset='utf-8' style='width: 100%; height: 1350px;' frameborder='0' scrolling='no' src='painel_disciplina.php?idDisciplina=".$_POST['idDisciplina']."'>";
                            echo "</iframe>";
                        ?>

                    </div> <!-- END TAB 6-->
                    <!-- Objetos associados a disciplina -->
            </div> <!-- END DIV TABS -->
        </div> <!-- END cadastrobase-content -->
    </div> <!-- END cadastrobase -->
    <div class="fundoPreto"></div>






<!-- style="background-color: rgba(0, 0, 0, 0.8); height: 100%; width: 100%; position: fixed; top: 55px; left: 0px;"-->
<?php include('_footer.php'); ?>