$(document).ready(function(){
    $('#tabela1, #tabela2')
        .accordion({
            header: "> div > h3"
            })
        .sortable({
            //connectWith: "#tabela1, #tabela2",
            axis: "y",
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
        });
});

function mostrarCompetencias(){
    
}

function sortableRemove(idHTML){
    $('#'+idHTML).remove();
}