$(document).ready(function(){
    $('#tabela1, #tabela2').sortable({
        connectWith: "#tabela1, #tabela2",
        update: function(event, ui) {
            var arrayDados = $("#tabela2").sortable('toArray').toString();
            document.getElementById('nomeCompetencia').value = arrayDados;
        },
        remove: function(event, ui) {
            $('#lista-competencias').html('OI!');
            //sortableRemove(ui.item.context.id);
        }
    });
});

function mostrarCompetencias(){
    
}

function sortableRemove(idHTML){
    $('#'+idHTML).remove();
}