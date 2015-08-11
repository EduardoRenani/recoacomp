<html>
	<head>
	    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
		<script language="javascript">
			function Ajax() {
				var meu_ajax = new XMLHttpRequest();

			    //Declara um "conteiner" de dados para serem enviados por POST
			    var formData = new FormData();

			    var dadosEnviados;

			    var getDadosEnviados = function () {
			    	return dadosEnviados;
			    };

			    var setDadosEnviados = function (dados, index) {
			    	dadosEnviados[index] = dados;
			    };

			    this.adicionaDataPost = function () {
				    //Adiciona uma variável ao "contêiner", no caso, a variável 'variavel' que contém o dado 'dado'
				    formData.append('dadosEnviados', getDadosEnviados()); //$_POST['variavel'] === 'dado
			    };
			    
			    this.abreAjax = function (pagina, tipoData) {
			    	//( o último parâmetro, um booleano, é para especificar se é assíncrono (true) ou síncrono (false) )
			    	meu_ajax.open(tipoData, pagina, true);
				};
			    
				this.getRetornoAjax = function () {
					meu_ajax.onreadystatechange = function () {
				        if ( meu_ajax.readyState === 4 ) { //readyState === 4: terminou/completou a requisição
				            if ( meu_ajax.status === 200 ) { //status === 200: sucesso
				                return true;
				            } else if ( meu_ajax.status !== 0 ) { //status !== 200: erro ( meu_ajax.status === 0: ajax não enviado )
				                console.log( 'DEU ERRO NO AJAX: '+meu_ajax.responseText );
				            }
				        }
			    	}
			    };

			    this.sendAjaxRequest = function() {
			    	meu_ajax.send( formData );
			    };
			}

			function TempoGasto() {
				var tempoReal = 0;
			    var tempoTotal = 0;
			    var tempoOcioso = 0;

			    var setTempoReal = function(tempo) {
			    	tempoReal = tempo;
			    };

			    var getTempoReal = function() {
			    	return tempoReal;
			    };

			    var setTempoTotal = function(tempo) {
			    	tempoTotal = tempo;
			    };

			    var getTempoTotal = function() {
			    	return tempoTotal;
			    };

			    var setTempoOcioso = function(tempo) {
			    	tempoOcioso = tempo;
			    };

			    var getTempoOcioso = function() {
			    	return tempoOcioso;
			    };

			    var calculaTempoReal = function() {
			    	tempo = getTempoTotal()-getTempoOcioso();
			    	setTempoReal(tempo);
			    };

			    var calculaTempoTotal = function() {
			    	tempo = getTempoTotal();
			    	tempo++;
			    	setTempoTotal(tempo);
			    };

			    var calculaTempoOcioso = function() {
			    	tempo = getTempoOcioso();
			    	tempo++;
			    	setTempoOcioso(tempo);
			    };

			    var iniciaTempoOcioso = function() {
			    	tCalculaTempoOcioso = setInterval(calculaTempoOcioso, 1000);
			    }

			    this.iniciaTempoTotal = function() {
			    	tCalculaTempoReal = setInterval(calculaTempoReal, 1000);
			    	tCalculaTempoTotal = setInterval(calculaTempoTotal, 1000);
			    };

			    var paraTempoOcioso = function() {
			    	clearTimeout(window.tCalculaTempoOcioso);
			    };

			    this.registraAcesso = function() {
			    	alert("oi");
				    oAjax = new Ajax();
				    oAjax.adicionaDataPost(1, "idUsuario");
				    oAjax.adicionaDataPost(1, "idDisciplina");
				    oAjax.adicionaDataPost(1, "idOA");
				    oAjax.adicionaDataPost(getTempoReal(), "tempoReal");
				    oAjax.adicionaDataPost();
				    oAjax.abreAjax("cadastraAcesso.php", "POST");
				    oAjax.getRetornoAjax();
				    oAjax.sendAjaxRequest();
			    };

			    window.onblur = iniciaTempoOcioso;

			    window.onfocus = paraTempoOcioso;

			    window.onbeforeunload = function (evt) {
					//registraAcesso();
					return "Tempo decorrido: "+getTempoTotal()+"\nTempo ocioso: "+getTempoOcioso()+"\nTempo real: "+getTempoReal();
				};
			}

			function document_OnLoad() {
			    oTempoGasto = new TempoGasto();
			    oTempoGasto.iniciaTempoTotal();
			    oTempoGasto.registraAcesso();
			}
		</script>
	</head>
	<body onload="document_OnLoad();">
	</div>
	</body>
</html>