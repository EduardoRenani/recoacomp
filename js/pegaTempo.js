function Ajax() {
	var meu_ajax = new XMLHttpRequest();

    //Declara um "conteiner" de dados para serem enviados por POST
    var formData = new FormData();

    var dadosEnviados = [];

    var getDadosEnviados = function () {
    	return dadosEnviados;
    };

    this.setDadosEnviados = function (dados, index) {
    	dadosEnviados[index] = dados;
    	console.log(dadosEnviados[index]);
    };

    this.adicionaDataPost = function () {
	    //Adiciona uma variável ao "contêiner", no caso, a variável 'variavel' que contém o dado 'dado'
	    console.log(getDadosEnviados());
	    console.log(JSON.stringify(getDadosEnviados()));
	    formData.append('dadosEnviados', JSON.stringify(getDadosEnviados())); //$_POST['variavel'] === 'dado
    };
    
    this.abreAjax = function (pagina, tipoData) {
    	//( o último parâmetro, um booleano, é para especificar se é assíncrono (true) ou síncrono (false) )
    	meu_ajax.open(tipoData, pagina, true);
	};
    
	this.getRetornoAjax = function () {
		meu_ajax.onreadystatechange = function () {
	        if ( meu_ajax.readyState === 4 ) { //readyState === 4: terminou/completou a requisição
	            if ( meu_ajax.status === 200 ) { //status === 200: sucesso
	                console.log(meu_ajax.responseText);
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

function TempoGasto(id, idUser, idDisci) {
	const ID_USUARIO = 0;
	const ID_DISCIPLINA = 1;
	const ID_OA = 2;
	const TEMPO_REAL = 3;

	var tempoReal = 0;
    var tempoTotal = 0;
    var tempoOcioso = 0;
    var idUsuario = idUser;
    var idDisciplina = idDisci;
    var idOA = id;

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

    var getIdUsuario = function() {
    	return idUsuario;
    };

    var getIdDisciplina = function() {
    	return idDisciplina;
    };

    var getIdOA = function() {
    	return idOA;
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

    var registraAcesso = function() {
	    oAjax = new Ajax();
	    oAjax.setDadosEnviados(getIdUsuario(), ID_USUARIO);
	    oAjax.setDadosEnviados(getIdDisciplina(), ID_DISCIPLINA);
	    oAjax.setDadosEnviados(getIdOA(), ID_OA);
	    oAjax.setDadosEnviados(getTempoReal(), TEMPO_REAL);
	    oAjax.adicionaDataPost();
	    oAjax.abreAjax("php/actions/cadastraAcesso.php", "POST");
	    oAjax.getRetornoAjax();
	    oAjax.sendAjaxRequest();
    };

    window.onblur = iniciaTempoOcioso;

    window.onfocus = paraTempoOcioso;

	$(window).bind('beforeunload', function(){ 
		return registraAcesso();
	});
}

function document_OnLoad(id, idUser, idDisci) {
    oTempoGasto = new TempoGasto(id, idUser, idDisci);
    oTempoGasto.iniciaTempoTotal();
}