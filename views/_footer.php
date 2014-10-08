

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
</script>
<div class="footer">
      Footer content goes in here
    </div>
</body>
</html>
