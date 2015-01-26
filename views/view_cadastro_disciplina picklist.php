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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">


    <!-- FUNÇÃO QUE FAZ O SORTABLE E ENVIA OS ID'S DAS COMPETÊNCIAS-->
    <script>
    $(function() {
        $('#basic').puipicklist({
            transfer: function(event, ui) {  
                      var  pl = document.getElementById("target");
    for (i = 0; i < pl.options.length; i++) {
       if (i % 2 == 0) {
          pl.options[i].selected = true;
          
       }
    alert(pl[i].value);
    var arrayCompetencias = $("#target").puipicklist('toArray').toString();
    document.getElementById('arrayCompetencias').value = arrayCompetencias;
    document.getElementById('arrayCompetencias').value = pl[i].value;
    }


            }  

        }); 
 

   
    });
        
    




    </script>
</head>
<!-- FIM IMPORTAÇÃO JQUERY-->
<h2><?php echo ($_SESSION['user_name']); ?></h2>
<h2><?php echo (WORDING_CREATE_DISCIPLINA); ?></h2>

<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN;?></a>
   <form method="post" action="" name="registrar_nova_disciplina">
        <label for="nomeCurso"><?php echo WORDING_COURSE_NAME; ?></label>
        <input id="nomeCurso" type="text" name="nomeCurso" pattern="[a-zA-Z0-9]{2,64}" required />
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />

        <label for="nomeDisciplina"><?php echo WORDING_DISCIPLINA_NAME; ?></label>
        <input id="nomeDisciplia" type="text" name="nomeDisciplina" pattern="[a-zA-Z0-9]{2,64}" required />

        <label for="senha"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
        <input id="senha" type="text" name="senha" required />

        <label for="descricao"><?php echo WORDING_DISCIPLINA_DESCRICAO; ?></label>
        <textarea name="descricao" ROWS="5" COLS="40"></textarea>
        <br />

        <input type="hidden" id="arrayCompetencias" name="arrayCompetencias" value="" />

        <div id="basic">  
        <select name="source">  
                <?php
                $comp = new Competencia();
                $idCompetencia = $comp->getArrayOfIDs();
                $nomeCompetencia = $comp->getArrayOfNames();
                $contador = count($nomeCompetencia);

                for($i=0;$i<$contador;$i++){ ?>
                    <option id="<?php echo "".($idCompetencia[$i]["idcompetencia"]); ?>"><?php echo "".($nomeCompetencia[$i]["nome"]); ?></option>
                <?php } ?>
        </select>  
        <select name="target" id="target" multiple="multiple">  
        </select>  
        <button id="mostrar" type="button">Mostrar</button>  
        </div>  


        <br /><br />

        <input type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
        <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

    </form><hr/>




<?php include('_footer.php'); ?>