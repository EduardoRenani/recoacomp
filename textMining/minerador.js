/* @author Rob W, created on 16-17 September 2011, on request for Stackoverflow (http://stackoverflow.com/q/7085454/938089)
 * Modified on 17 juli 2012, fixed bug by replacing [,] with [null]
 * This script will calculate words. For the simplicity and efficiency,
 * there's only one loop through a block of text.
 * A 100% accuracy requires much more computing power, which is usually unnecessary
 **/

var reps = "a à agora ainda alguém algum alguma algumas alguns ampla amplas amplo amplos ante antes ao aos após aquela aquelas aquele aqueles aquilo as até através cada coisa coisas com como contra contudo da daquele daqueles das de dela delas dele deles depois dessa dessas desse desses desta destas deste deste destes deve devem devendo dever deverá deverão deveria deveriam devia deviam disse disso disto dito diz dizem do dos e é e' ela elas ele eles em enquanto entre era essa essas esse esses esta está estamos estão estas estava estavam estávamos este estes estou eu fazendo fazer feita feitas feito feitos foi for foram fosse fossem grande grandes há isso isto já la la lá lhe lhes lo mas me mesma mesmas mesmo mesmos meu meus minha minhas muita muitas muito muitos na não nas nem nenhum nessa nessas nesta nestas ninguém no nos nós nossa nossas nosso nossos num numa nunca o os ou outra outras outro outros para pela pelas pelo pelos pequena pequenas pequeno pequenos per perante pode pôde podendo poder poderia poderiam podia podiam pois por porém porque posso pouca poucas pouco poucos primeiro primeiros própria próprias próprio próprios quais qual quando quanto quantos que quem são se seja sejam sem sempre sendo será serão seu seus si sido só sob sobre sua suas talvez também tampouco te tem tendo tenha ter teu teus ti tido tinha tinham toda todas todavia todo todos tu tua tuas tudo última últimas último últimos um uma umas uns vendo ver vez vindo vir vos vós estou está estamos estão estive esteve estivemos estiveram estava estávamos estavam estivera estivéramos esteja estejamos estejam estivesse estivéssemos estivessem estiver estivermos estiverem hei há havemos hão houve houvemos houveram houvera houvéramos haja hajamos hajam houvesse houvéssemos houvessem houver houvermos houverem houverei houverá houveremos houverão houveria houveríamos houveriam sou somos são era éramos eram fui foi fomos foram fora fôramos seja sejamos sejam fosse fôssemos fossem for formos forem serei será seremos serão seria seríamos seriam tenho tem temos tém tinha tínhamos tinham tive teve tivemos tiveram tivera tivéramos tenha tenhamos tenham tivesse tivéssemos tivessem tiver tivermos tiverem terei terá teremos terão teria teríamos teriam último é acerca agora algmas alguns ali ambos antes apontar aquela aquelas aquele aqueles aqui atrás bem bom cada caminho cima com como comprido conhecido corrente das debaixo dentro desde desligado deve devem deverá direita diz dizer dois dos e ela ele eles em enquanto então está estão estado estar estará este estes esteve estive estivemos estiveram eu fará faz fazer fazia fez fim foi fora horas iniciar inicio ir irá ista iste isto ligado maioria maiorias mais mas mesmo meu muito muitos nós não nome nosso novo o onde os ou outro para parte pegar pelo pessoas pode poderá podia por porque povo promeiro quê qual qualquer quando quem quieto são saber sem ser seu somente têm tal também tem tempo tenho tentar tentaram tente tentei teu teve tipo tive todos trabalhar trabalho tu um uma umas uns usa usar valor veja ver verdade verdadeiro você brasil".split(" "); // Variável gigante de stop words, nao tive outra ideia

var atLeast = 2;       // Show results with at least .. occurrences
var numWords = 1;      // Show statistics for one to .. words
var ignoreCase = true; // Case-sensitivity

var REallowedChars = /[^a-zA-Z'\-]+/g;
 // RE pattern to select valid characters. Invalid characters are replaced with a whitespace
var REnotallowedChars = /[-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/g;

var i, j, k, textlen, len, s;
// Prepare key hash
var keys = [null]; //"keys[0] = null", a word boundary with length zero is empty
var results = [];
var text;

numWords++; //for human logic, we start counting at 1 instead of 0



function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) { 
       if(haystack[i] == needle) return true;
    }
    return false;
}

function createHash(){
	// Create a hash
	if (ignoreCase) text = text.toLowerCase();
	text = text.split(/\s+/);
	for (i=0, textlen=text.length; i<textlen; i++) {
		s = text[i];
		if(inArray(s, reps)) continue;
		keys[1][s] = (keys[1][s] || 0) + 1;
		for (j=2; j<=numWords; j++) {
			if(i+j <= textlen) {
				s += " " + text[i+j-1];
				keys[j][s] = (keys[j][s] || 0) + 1;
			} else break;
		}
	}
}

function prepareResults(){
	// Prepares results for advanced analysis
	for (var k=1; k<=numWords; k++) {

		results[k] = [];
		var key = keys[k];

		for (var i in key) {
			if(key[i] >= atLeast) results[k].push({"word":i, "count":key[i]});
		}
	}
}


//Função para fazer a mineração no editor do ETC
function doTheMining(){
	//text = $("#editor").contents().find('body').text();
	/*var ce = $("<pre />").html($("#texto").contents().find('body').html());
    if($.browser.webkit)
      ce.find("div").replaceWith(function() { return "\n" + this.innerHTML; });    
    if($.browser.msie)
      ce.find("p").replaceWith(function() { return this.innerHTML  +  "<br>"; });
    if($.browser.mozilla || $.browser.opera ||$.browser.msie )
      ce.find("br").replaceWith("\n");
	text = ce.text();
	*/
	text = "Oi, eu sou o Arthur Adolfo. Legal não é mesmo?";
	// Remove all irrelevant characters
	text = text.replace(REnotallowedChars, " ");
	results = [];
	keys = [null];
	for (i=1; i<=2; i++) {
		keys.push({});
	}
	
	createHash();
	prepareResults();
	var f_sortAscending = function(x,y) {return y.count - x.count;};
	//console.log(results);
	k = 1;
	results[k].sort(f_sortAscending);//sorts results
	
	var words = results[k];
	words = words.slice(0 , 10);
	
	var kwords = []; 


	for(i = 0; i < words.length; i++){
		kwords[i] = words[i].word;
	}
	
	return kwords;

}