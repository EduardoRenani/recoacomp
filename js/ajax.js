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
	                return meu_ajax.responseText;
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