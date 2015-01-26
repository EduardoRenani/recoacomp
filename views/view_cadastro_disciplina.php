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

    <style>
        #tabela1, #tabela2 {
            border: 1px solid #eee;
            width: 142px;
            min-height: 20px;
            list-style-type: none;
            margin: 0;
            padding: 5px 0 0 0;
            float: left;
            margin-right: 10px;
        }
        #tabela1 li, #tabela2 li {
            margin: 0 5px 5px 5px;
            padding: 5px;
            font-size: 1.2em;
            width: 120px;
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
    </style>
    <!-- FUNÇÃO QUE FAZ O SORTABLE E ENVIA OS ID'S DAS COMPETÊNCIAS-->
    <script>





    $(function() {
        $('#tabela1, #tabela2').sortable({
            connectWith: "#tabela1, #tabela2",
            update: function(event, ui) {
            var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
            document.getElementById('arrayCompetencias').value = arrayCompetencias;
            }
            });
        });

    // Puipicklist do Primefaces UI (http://www.primefaces.org/primeui/demo.html)
    $(function() {
        $('#basic').puipicklist({transfer: function(event, ui) {  
            var  pl = document.getElementById("target");
            for (i = 0; i < pl.options.length; i++) {
               if (i % 2 == 0) {
                  pl.options[i].selected = true; 
                }
                //alert(pl[i].value);
                var arrayCompetencias = $("#target").puipicklist('toArray').toString();
                document.getElementById('arrayCompetencias').value = arrayCompetencias;
                document.getElementById('arrayCompetencias').value = pl[i].value;
            }}}); // End Basic 
    });

    // Bootstrap wizard, mais info em http://vadimg.com/twitter-bootstrap-wizard-example/
    $(function() {
       var $validator = $("#registrar_nova_disciplina").validate({
            rules: {
                url: {
                    required: true,
                    minlength: 3,
                    url: true
                }
            }
        });





   var dialog, form,
    // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
    emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
    name = $( "#name" ),
    email = $( "#email" ),
    password = $( "#password" ),
    allFields = $( [] ).add( name ).add( email ).add( password ),
    tips = $( ".validateTips" );

    // Mensagens
    var senha = "<?php echo WORDING_FILL_PASSWORD; ?>";
    var descricao = "<?php echo WORDING_FILL_DESCRIPTION; ?>";
    var nome = "<?php echo WORDING_FILL_NAME; ?>";
    var nomeDisciplina = "<?php echo WORDING_FILL_NAME_DISCIPLINA; ?>";
    var url = "<?php echo WORDING_FILL_URL; ?>";
    var palavrachave = "<?php echo WORDING_FILL_KEYWORD; ?>";
    var data = "<?php echo WORDING_FILL_DATE; ?>";
    var descricao_educacional = "<?php echo WORDING_FILL_EDUCACIONAL_DESCRIPTION; ?>";


    $('#rootwizard').bootstrapWizard({onNext: function(tab, navigation, index) {
    // Categoria geral
        if(index==1) {
            // Verifica se o nome foi preenchido caso contrário dá um aviso
            if(!$('#nomeCurso').val()) {
                $().toastmessage('showToast', {
                    text     : nome, // Mensagem está nas variáveis
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#nomeCurso').focus();
                return false;
            }
            // Verificar se o nome da disciplina foi preenchido
            if(!$('#nomeDisciplina').valid()) {
                $().toastmessage('showToast', {
                    text     : nomeDisciplina,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#nomeDisciplina').focus();
                return false;
            }
            // Verificar se a palavra chave foi preenchida
            if(!$('#senha').valid()) {
                $().toastmessage('showToast', {
                    text     : senha,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#senha').focus();
                return false;
            }
            // Verificar se a descrição foi preenchida
            if(!$('#descricao').val()) {
                $().toastmessage('showToast', {
                    text     : descricao,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#descricao').focus();
                return false;
            }
        }

        // Se estiver na aba da categoria vida, fazer verficações 
        if(index==2) {


  function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
 
    function addUser() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 
      valid = valid && checkLength( name, "username", 3, 16 );
      valid = valid && checkLength( email, "email", 6, 80 );
      valid = valid && checkLength( password, "password", 5, 16 );
 
      valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
      valid = valid && checkRegexp( email, emailRegex, "eg. ui@jquery.com" );
      valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 
      if ( valid ) {
        $( "#users tbody" ).append( "<tr>" +
          "<td>" + name.val() + "</td>" +
          "<td>" + email.val() + "</td>" +
          "<td>" + password.val() + "</td>" +
        "</tr>" );
        dialog.dialog("close");
      }
      return valid;
    }
 



    dialog = $("#dialog-form").dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
        "Create an account": addUser,
        Cancel: function() {
        dialog.dialog( "close" );
        }
        },
        Close: function() {
        //document.getElementById("dialog-form")[0].reset();
        form[0].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });
 
    $( "#create-user" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });

        /* Make sure we entered the date
            if(!$('#date').val()) {
                $().toastmessage('showToast', {
                    text     : data,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#date').focus();
                return false;
            }
            */
        }
        if(index==4) {
        // Make sure we entered the description
            if(!$('#descricao_educacional').val()) {
                $().toastmessage('showToast', {
                    text     : descricao_educacional,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#descricao_educacional').focus();
                return false;
            }
        }
        }, onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard').find('.bar').css({width:$percent+'%'});
            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $('#rootwizard').find('.pager .next').hide();
                $('#finisher').fadeIn("slow");
    
            } else {
                $('#rootwizard').find('.pager .next').show();
                $('#rootwizard').find('.pager .finish').hide();
            }
        }, onTabClick: function(tab, navigation, index) {
            return false;
        }
        });     




});
        
    




</script>
</head>
<h2><?php echo ($_SESSION['user_name']); ?></h2>
<h2><?php echo (WORDING_CREATE_DISCIPLINA); ?></h2>
<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN;?></a>
   <form method="post" action="" name="registrar_nova_disciplina" id="registrar_nova_disciplina">
    <!-- ID do usuário passado via hidden POST -->
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
        <div id="rootwizard">
            <div class="navbar">
              <div class="navbar-inner">
                <div class="container">
            <ul>
                <li><a href="#tab1" data-toggle="tab"><?php echo WORDING_GENERAL_INFORMATION; ?></a></li>
                <li><a href="#tab2" data-toggle="tab"><?php echo WORDING_COMPETENCIA; ?></a></li>
                <li><a href="#tab3" data-toggle="tab">Third</a></li>
                <li><a href="#tab4" data-toggle="tab">Forth</a></li>
                <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
                <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
                <li><a href="#tab7" data-toggle="tab">Seventh</a></li>
            </ul>
             </div>
              </div>
            </div>
                <div id="bar" class="progress progress-striped active">
                    <div class="bar">
                    </div>
                </div>
            <div class="tab-content">
                <div class="tab-pane" id="tab1">
                    <div class="control-group">
                        <label class="control-label" for="nomeCurso"><?php echo WORDING_COURSE_NAME; ?></label>
                        <div class="controls">
                            <input type="text" id="nomeCurso" name="nomeCurso" class="required">       
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="nomeDisciplina"><?php echo WORDING_DISCIPLINA_NAME; ?></label>
                        <div class="controls">
                            <input type="text" id="nomeDisciplina" name="nomeDisciplina" class="required">       
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="senha"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
                        <div class="controls">
                            <input type="text" id="senha" name="senha" class="required">       
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="descricao"><?php echo WORDING_DISCIPLINA_DESCRICAO; ?></label>
                            <div class="controls">
                                <textarea name="descricao" id="descricao" ROWS="5" COLS="40" class="required"></textarea>
                            </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab2">
                    <input type="hidden" id="arrayCompetencias" name="arrayCompetencias" value="" />
                    <ul id="tabela1">
                        <?php
                        $comp = new Competencia();
                        $idCompetencia = $comp->getArrayOfIDs();
                        $nomeCompetencia = $comp->getArrayOfNames();
                        $contador = count($nomeCompetencia);
                        for($i=0;$i<$contador;$i++){ ?>
                            <li id="<?php echo "".($idCompetencia[$i]["idcompetencia"]); ?>" class="ui-state-default"><?php echo "".($nomeCompetencia[$i]["nome"]); ?></li>
                        <?php } ?>
                    </ul>
                    <ul id="tabela2">
                    <!--<li class="ui-state-highlight">Item 1 selecionado</li>-->
                    </ul>



<div id="dialog-form" title="Create new user">
  <p class="validateTips">All form fields are required.</p>
 
  <form>
    <fieldset>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" value="Jane Smith" class="text ui-widget-content ui-corner-all">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="jane@smith.com" class="text ui-widget-content ui-corner-all">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" value="xxxxxxx" class="text ui-widget-content ui-corner-all">
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
 
 
<div id="users-contain" class="ui-widget">
  <h1>Existing Users:</h1>
  <table id="users" class="ui-widget ui-widget-content">
    <thead>
      <tr class="ui-widget-header ">
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John Doe</td>
        <td>john.doe@example.com</td>
        <td>johndoe1</td>
      </tr>
    </tbody>
  </table>
</div>
<button id="create-user">Create new user</button>
 


                </div>
                <div class="tab-pane" id="tab3">
                    3
                </div>
                <div class="tab-pane" id="tab4">
                    4
                </div>
                <div class="tab-pane" id="tab5">
                    5
                </div>
                <div class="tab-pane" id="tab6">
                    6
                </div>
                <div class="tab-pane" id="tab7">
                    7
                </div>
                <ul class="pager wizard">
                    <li class="previous"><a href="javascript:;">Anterior</a></li>
                    <li class="next"><a href="javascript:;">Próximo</a></li>
                </ul>
            </div>  
        </div>







        <br /><br />

        <input type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
        <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

    </form><hr/>




<?php include('_footer.php'); ?>