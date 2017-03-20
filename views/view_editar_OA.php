<?php include_once('_header.php'); ?>

<!-- TODO TRADUZIR-->
<head>

    <!-- Home -->

    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
    <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/home-xs.css' />
    <link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/home-small.css' />
    <link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/home-large.css' />
    <link href="css/editar_OA.css" rel="stylesheet">
    <link href="css/jquery-customselect.css" rel="stylesheet" />
       

    <!-- Custom Fonts -->
    <link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


    
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.noty.packaged.min.js"></script>
    <script src="js/jquery-customselect.js"></script>
    
    <!-- Fim Home -->

    <script type="text/javascript">


    $(document).ready(function(){
        console.log("funfou!");
        $("#url").keyup(function () { //user types username on inputfiled
            console.log("funfou!");
            var url = $(this).val(); //get the string typed by user
            $.post('php/classes/check_URL.php', {'url':url}, function(data) { //make ajax call to check_username.php
            $("#status").html(data); //dump the data received from PHP page
            });
        });
    });

    var idOA;

    function getOAId(id){
        var idOA = id;
        document.getElementById('idOA').value = id;
        idOA = id;
    }

    function deletarOA() {
        //console.log(idDisciplina);
        jQuery.ajax({
            type: "GET",
            url: "ajax/exclui_oa.php",
            data: { 
                idOA : idOA,
            },
            cache: false,
            // importantinho.
            error: function(e){
                alert(e);
            },
            success: function(response){
                location.reload();
        }
    });
        
    }

    $(function() {
        $( "#tabs" ).tabs();
    });

    $(document).ready(function(){
      $("#area_conhecimento").customselect();
    });


</script>

</head>
<div class="fixedBackgroundGradient"></div>

<?php 

if (isset($oa)) {
    if ($oa->errors) {
        foreach ($oa->errors as $error) {
                        echo"<script type='text/javascript'>";

                echo "alert('".$error."');";

            echo "</script>";
        }
    }
    if ($oa->messages) {
        print_r($oa->messages);
        foreach ($oa->messages as $message) {
                        echo"<script type='text/javascript'>";

                echo "alert('".$message."');";
  
            echo "</script>";
        }
    }
}

// Importante! Não remover essa linha
if(!isset($_POST['editar_OA'])){  

?>

<?php require_once("sidebar-disciplina.php"); ?>

<!-- ============== OBJETOS QUE CRIEI ============== -->

<div class="objetos">
    <div class="top-objetos">Meus Objetos de Aprendizagem</div>
        <div class="objetos-content">
            <ul class="objetos-list">
            <?php
                    // Exibir todos os objetos que foi cadastrado pelo usuário no sistema               
    				//print_r($oa->getListaOAbyUser($_SESSION['user_id']));
    				$objetos = $oa->getListaOAbyUser($_SESSION['user_id']);
    				foreach($objetos as $objetosSistema => $oa){
    					//echo $oa['nome'].'<br>';
    					echo "<li class='objetos-item'>".
    							"<div class='objetos-item-content'>".
    								"<div class='lista-objeto'>".
    									"<h3>".$oa['nome']."</h3>".
                                        "<p>".$oa['descricao'].
                                        "<br>".
                                        "<form method='post' action='#' name='editar_OA'>".
                                            "<input type='hidden' id='idOA' name='idOA' value=".$oa['idcesta']." />".
                                            "<input type='submit' class='botao-excluir' name='editar_OA' action='' value='Informações do Objeto' />".
                                        "</form>                               
                                        <a href='#openModalDeleteDisciplina' id=".$oa['idcesta']." class='botao-excluir' onClick='getOAId(this.id)'>Excluir</a>". // 
                                    "</div>".
                                "</div>".
                            "</li>";				
    				} // end for each
			?>
                    <!-- Modal -->
                    <div id="openModalDeleteDisciplina" class="modalDialog" id="excluirDisciplinaDialog">
                            <div>
                                <a href="#close" title="Close" class="close">X</a>
                                <div class="top-cadastro"><?php echo 'Excluir OA?'; ?></div>
                                    <a href="#close" class="botao-med" id="<?php echo $oa['idcesta']?>" onClick="deletarOA();" title="Deletar">Excluir</a>
                                    <br><br>
                                    <a href="#close" class="botao-med" title="Cancelar">Cancelar</a>
                                <!--/div-->
                            </div>
                            <!-- /.top-cadastro -->
                    </div> <!-- div modal -->
            </ul>
         </div>  

</div>


<?php  
}else{ // aqui vem o código lindo da parte de edição de objetos TODO 
        $objeto = $oa->getDadosOA($_POST['idOA']);
    ?>
    <div class='cadastrobase'>
        <div class="top-cadastrobase">
            <div class="text-left"><?php echo (WORDING_GLOBAL_COURSE).' do OA: '.$objeto[0]['nome'];; ?></div>
            <div class="text-right" ><!-- <a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a>--></div>
        </div>
        <!--div class="cadastrobase-content"-->
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">Alterar dados gerais</a></li>
                    <li><a href="#tabs-2">Alterar categoria técnica</a></li>
                    <li><a href="#tabs-3">Alterar categoria educacional</a></li>
                </ul>
                <div id="tabs-1">
                    <!-- Editar nome -->
                    <form method="post" action="editar_OA.php" name="editar_nome_OA">
                        <label for="oa_name"><?php echo WORDING_NEW_OA_NAME; ?></label>
                        <input id="oa_name" type="text" name="oa_name" required/> (<?php echo WORDING_CURRENTLY; ?>: <?php echo $objeto[0]['nome']; ?>)<br/>
                        <input type="hidden" name="idOA" value="<?php echo $objeto[0]['idcesta'] ?>" />
                        <input type="submit" name="editar_nome_OA" value="<?php echo WORDING_CHANGE_OA_NAME; ?>" />
                    </form><hr/>
                    <!-- Editar descricao -->
                    <form method="post" action="editar_OA.php" name="editar_descricao_OA">
                        <label for="oa_descricao"><?php echo WORDING_NEW_OA_DESCRIPTION; ?></label>
                        <textarea rows="4" cols="50" name="oa_descricao" placeholder="<?php echo 'Atual: '.$objeto[0]['descricao']; ?>" required></textarea><br/>
                        <input type="hidden" name="idOA" value="<?php echo $objeto[0]['idcesta'] ?>" />
                        <input type="submit" name="editar_descricao_OA" value="<?php echo WORDING_CHANGE_OA_DESCRIPTION; ?>" />
                    </form><hr/>
                    <!-- Editar keyword -->
                    <form method="post" action="editar_OA.php" name="editar_keyword_OA">
                        <label for="oa_keyword"><?php echo WORDING_NEW_OA_KEYWORD; ?></label>
                        <input type="text" data-role="tagsinput" id="palavrachave" name="palavrachave" class="required" />(<?php echo WORDING_CURRENTLY; ?>: <?php echo $objeto[0]['palavraChave']; ?>)<br/>
                        <input type="hidden" name="idOA" value="<?php echo $objeto[0]['idcesta'] ?>" />
                        <input type="submit" name="editar_keyword_OA" value="<?php echo WORDING_CHANGE_OA_KEYWORD; ?>" />
                    </form><hr/>
                    <!-- Editar idioma -->
                    <form method="post" action="editar_OA.php" name="editar_idioma_OA">
                        <label for="oa_keyword"><?php echo WORDING_NEW_OA_LANGUAGE; ?></label>
                        <select id ="idioma" name="idioma">
                            <option value = "portugues"><?php echo WORDING_PORTUGUES ?></option>
                            <option value = "espanhol"><?php echo WORDING_SPANISH ?></option>
                            <option value = "ingles"><?php echo WORDING_ENGLISH ?></option>
                        </select>
                        (<?php echo WORDING_CURRENTLY; ?>: <?php echo $objeto[0]['idioma']; ?>)<br/>
                        <input type="hidden" name="idOA" value="<?php echo $objeto[0]['idcesta'] ?>" />
                        <input type="submit" name="editar_idioma_OA" value="<?php echo WORDING_CHANGE_OA_LANGUAGE; ?>" />
                    </form><hr/>
                    <!-- Editar URL -->
                    <form method="post" action="editar_OA.php" name="editar_URL_OA">
                        <label for="oa_URL"><?php echo WORDING_NEW_OA_URL; ?></label>
                        <input type="url" id="url" name="url" value="http://" class="required url"> <!-- Deixar type URL pq buga no banco de dados -->
                        <div id="status"></div>
                        (<?php echo WORDING_CURRENTLY; ?>: <?php echo $objeto[0]['url']; ?>)<br/>
                        <input type="hidden" name="idOA" value="<?php echo $objeto[0]['idcesta'] ?>" />
                        <input type="submit" name="editar_URL_OA" value="<?php echo WORDING_CHANGE_OA_URL; ?>" />
                    </form><hr/>
                    <!-- Editar URL -->
                    <form method="post" action="editar_OA.php" name="editar_area_conhecimento_OA">
                        <label for="oa_area_conhecimento"><?php echo WORDING_NEW_OA_KNOWLEDGE_AREA; ?></label>
                        <?php 
                            $OA = new OA();
                            $OA = $OA->getAreasConhecimento();
                        ?>
                        <select id="area_conhecimento" name="area_conhecimento" class="custom-select">
                        <option value=''>Selecione..</option>
                            <?php 
                            foreach ($OA as $AC) {
                                echo '<option value="'.$AC['area_conhecimento_id'].'">'.$AC['nome_area_conhecimento'].'';
                            }
                            ?>
                        </select>
                        (<?php 
                            echo WORDING_CURRENTLY.': '; 
                            $idAC = $objeto[0]['area_conhecimento']; 
                            $OA = new OA();
                            echo $OA->getNomeAreaConhecimentobyId($idAC)[0]['nome_area_conhecimento'];
                        ?>)
                        <br/>
                        <input type="hidden" name="idOA" value="<?php echo $objeto[0]['idcesta'] ?>" />
                        <input type="submit" name="editar_area_conhecimento_OA" value="<?php echo WORDING_CHANGE_OA_KNOWLEDGE_AREA; ?>" />
                    </form><hr/>
                    <!-- Formulário para editar o nome do curso -->
                </div> <!-- END TAB 1-->
                <div id="tabs-2">
                    <?php 
                        $idCategoriaVida = $objeto[0]['idcategoria_vida']; 
                        $idCategoriaTecnica = $objeto[0]['idcategoria_tecnica']; 
                        $idCategoriaEducacional = $objeto[0]['idcategoria_eduacional']; 
                        $OA = new OA();
                        $date = date_create($OA->getDadosCategoriaVidaOA($idCategoriaVida)[0]['data_2']);
                        $formaUtilizacao = $OA->getDadosCategoriaTecnicaOA($idCategoriaTecnica)[0]['tipoTecnologia'];
                        $tipoOA = substr($OA->getDadosCategoriaTecnicaOA($idCategoriaTecnica)[0]['tipoFormato'], 1);
                        $descricaoEducacional = $OA->getDadosCategoriaEducacionalOA($idCategoriaEducacional)[0]['descricao'];
                        $faixaEtaria = substr($OA->getDadosCategoriaEducacionalOA($idCategoriaEducacional)[0]['faixaEtaria'], 1);
                        $recursoAprendizagem = $OA->getDadosCategoriaEducacionalOA($idCategoriaEducacional)[0]['recursoAprendizagem'];
                        $grauInteratividade = $OA->getDadosCategoriaEducacionalOA($idCategoriaEducacional)[0]['grauInteratividade'];

                    ?>
                    <!-- Editar forma de utilização categoria técnica -->
                    <form method="post" action="editar_OA.php" name="editar_formaUtilizacao">
                        <label for="oa_formaUtilizacao"><?php echo WORDING_NEW_OA_UTILITY_TYPE; ?></label>
                        <select id = "oa_formaUtilizacao" name="oa_formaUtilizacao" required="true" style="height: 40px;">
                            <option value = "navegador"><?php echo WORDING_THROUGH_BROWSER ?></option>
                            <option value = "download"><?php echo WORDING_THROUGH_DOWNLOAD ?></option>
                        </select>
                        (<?php echo WORDING_CURRENTLY; ?>: <?php echo $formaUtilizacao; ?>)<br />
                        <input type="hidden" name="idCT" value="<?php echo $idCategoriaTecnica ?>" />
                        <input type="submit" name="editar_formaUtilizacao" value="<?php echo WORDING_CHANGE_OA_UTILITY_TYPE; ?>" />
                    </form><hr/>
                    <!-- Editar tipo de OA categoria técnica -->
                    <form method="post" action="editar_OA.php" name="editar_tipoOA">
                        <label for="oa_tipoOA"><?php echo WORDING_NEW_OA_TYPE; ?> (Utilizar o CTRL para selecionar mais de um)</label>
                        <select id = "oa_tipoOA[]" name="oa_tipoOA[]" required="true" multiple>
                            <option value = "material multimidia"><?php echo WORDING_MULTIMIDIA_MATERIAL ?></option>
                            <option value = "animacao"><?php echo WORDING_ANIMATION ?></option>
                            <option value = "livro digital"><?php echo WORDING_DIGITAL_BOOK ?></option>
                            <option value = "jogo"><?php echo WORDING_GAME ?></option>
                            <option value = "documento"><?php echo WORDING_DOCUMENT ?></option>
                            <option value = "pagina web"><?php echo WORDING_WEB_PAGE ?></option>
                        </select>
                        (<?php echo WORDING_CURRENTLY; ?>: <?php echo $tipoOA; ?>)<br />
                        <input type="hidden" name="idCT" value="<?php echo $idCategoriaTecnica ?>" />
                        <input type="submit" name="editar_tipoOA" value="<?php echo WORDING_CHANGE_OA_TYPE; ?>" />
                    </form><hr/>
                </div> <!-- END TAB 2-->
                <div id="tabs-3">
                    <!-- Editar descricao educacional -->
                    <form method="post" action="editar_OA.php" name="editar_descricao_educacional_OA">
                        <label for="oa_descricao_educacional"><?php echo WORDING_NEW_OA_DESCRIPTION; ?></label>
                        <textarea rows="4" cols="50" name="oa_descricao_educacional" placeholder="<?php echo 'Atual: '.$descricaoEducacional; ?>" required></textarea><br/>
                        <input type="hidden" name="idCE" value="<?php echo $idCategoriaEducacional ?>" />
                        <input type="submit" name="editar_descricao_educacional_OA" value="<?php echo WORDING_CHANGE_OA_DESCRIPTION; ?>" />
                    </form><hr/>
                    
                    <!-- Editar faixa etária -->
                    <form method="post" action="editar_OA.php" name="editar_faixa_OA">
                        <label for="oa_faixaEtaria"><?php echo WORDING_NEW_OA_AGE_GROUP; ?></label>
                            <select id = "oa_faixaEtaria[]" name="oa_faixaEtaria[]" required="true" multiple>
                                <option value = "educacao infantil"><?php echo WORDING_CHILD_EDUCATION ?></option>
                                <option value = "ensino fundamental"><?php echo WORDING_BASIC_EDUCATION ?></option>
                                <option value = "ensino medio"><?php echo WORDING_HIGHSCOOL ?></option>
                                <option value = "ensino profissionalizante"><?php echo WORDING_PROFESSIONAL_EDUCATION ?></option>
                                <option value = "ensino superior"><?php echo WORDING_COLLEGE ?></option>
                            </select>
                        (<?php echo WORDING_CURRENTLY; ?>: <?php echo $faixaEtaria; ?>)<br />
                        <input type="hidden" name="idCE" value="<?php echo $idCategoriaEducacional ?>" />
                        <input type="submit" name="editar_faixa_OA" value="<?php echo WORDING_CHANGE_OA_AGE_GROUP; ?>" />
                    </form><hr/>

                    <!-- Editar recurso aprendizagem -->
                    <form method="post" action="editar_OA.php" name="editar_recurso_OA">
                        <label for="oa_recursoAprendizagem"><?php echo WORDING_NEW_OA_LEARNING_RESOURCE; ?></label>
                            <select id = "oa_recursoAprendizagem" name="oa_recursoAprendizagem" required="true" style="height: 40px;">
                                <option value = "exercício"><?php echo WORDING_EXERCISE ?></option>
                                <option value = "simulação"><?php echo WORDING_SIMULATION ?></option>
                                <option value = "questionário"><?php echo WORDING_QUESTIONNAIRE ?></option>
                                <option value = "diagrama"><?php echo WORDING_DIAGRAM ?></option>
                                <option value = "figura"><?php echo WORDING_FIGURE ?></option>
                                <option value = "gráfico"><?php echo WORDING_GRAPHIC ?></option>
                                <option value = "video"><?php echo WORDING_VIDEO ?></option>
                                <option value = "indice"><?php echo WORDING_INDICE ?></option>
                                <option value = "slide"><?php echo WORDING_SLIDE ?></option>
                                <option value = "tabela"><?php echo WORDING_TABLE ?></option>
                                <option value = "teste"><?php echo WORDING_TEST ?></option>
                                <option value = "experiência"><?php echo WORDING_EXPERIENCE ?></option>
                                <option value = "texto"><?php echo WORDING_TEXT ?></option>
                                <option value = "problema"><?php echo WORDING_PROBLEM ?></option>
                                <option value = "auto avaliação"><?php echo WORDING_AUTO_AVALIATION ?></option>
                                <option value = "palestra"><?php echo WORDING_LECTURE ?></option>
                                <option value = "palestra"><?php echo WORDING_MULTIMIDIA_MATERIAL?></option>
                            </select>
                        (<?php echo WORDING_CURRENTLY; ?>: <?php echo $recursoAprendizagem; ?>)<br />
                        <input type="hidden" name="idCE" value="<?php echo $idCategoriaEducacional ?>" />
                        <input type="submit" name="editar_recurso_OA" value="<?php echo WORDING_CHANGE_OA_LEARNING_RESOURCE; ?>" />
                    </form><hr/>

                    <!-- Editar grau de interatividade categoria educacional -->
                    <form method="post" action="editar_OA.php" name="editar_grau_interatividade_OA">
                        <label for="oa_grauInteratividade"><?php echo WORDING_NEW_OA_UTILITY_TYPE; ?></label>
                        <select id = "oa_grauInteratividade" name="oa_grauInteratividade" required="true" style="height: 40px;">
                                <option value = "1">Muito Baixa</option>
                                <option value = "2">Baixa</option>
                                <option value = "3">Média</option>
                                <option value = "4">Alta</option>
                                <option value = "5">Muito Alta</option>
                        </select>
                        (<?php echo WORDING_CURRENTLY; ?>: <?php echo $grauInteratividade; ?>)<br />
                        <input type="hidden" name="idCE" value="<?php echo $idCategoriaEducacional ?>" />
                        <input type="submit" name="editar_grau_interatividade_OA" value="Alterar grau de interatividade" />
                    </form><hr/>

                </div> <!-- END TAB 3 -->
            </div> <!-- END TABS -->
        <!--/div--> <!-- END CADASTROBASE-CONTENT -->
    </div><!--END CADASTROBASE -->





<?php } // end set if isset post ?>
<?php include('_footer.php'); ?>

