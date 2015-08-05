<html>
	<head>

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
		<script language="javascript">
			function TempoGasto() {
			    var tempoTotal = 0;
			    var tempoOcioso = 0;

			    var setTempoTotal = function(tempo) {
			    	tempoTotal = tempo;
			    };

			    var getTempoTotal = function() {
			    	return tempoTotal;
			    };

			    var setTempoOcioso = function(tempo1) {
			    	tempoOcioso = tempo1;
			    };

			    var getTempoOcioso = function() {
			    	return tempoOcioso;
			    };

			    this.iniciaRotina = function() {
			    	tempo = getTempoTotal();
			    	tempo++;
			    	setTempoTotal(tempo);
			    	rotina = setInterval(this.iniciaRotina, 1000);
			    };

			    var iniciaTempoOcioso = function() {
			    	tempo1 = getTempoOcioso();
			    	tempo1++;
			    	setTempoOcioso(tempo1);
			    	tIniciaTempoOcioso = setInterval(iniciaTempoOcioso, 1000);
			    };

			    var paraTempoOcioso = function() {
			    	clearTimeout(window.tIniciaTempoOcioso);
			    };

			    window.onblur = function() { 
			    	iniciaTempoOcioso();
			    };

			    window.onfocus = function() { 
			    	paraTempoOcioso();
			    };

			    window.onbeforeunload = function (evt) {
				  return "Tempo decorrido: "+getTempoTotal()+"\nTempo Ocioso: "+getTempoOcioso();
				};
			}

			function document_OnLoad() {
			    oTempoGasto = new TempoGasto();
			    oTempoGasto.iniciaRotina();
			}
		</script>
	</head>
	<body onload="document_OnLoad();">
	</div>
	</body>
</html>