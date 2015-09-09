<?php
header('Content-type: text/html; charset=utf8');

function multiexplode ($delimiters,$string) {
    
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

function removeAcentos($string, $slug = false) {
  $string = strtolower($string);
  // Código ASCII das vogais
  $ascii['a'] = range(224, 230);
  $ascii['e'] = range(232, 235);
  $ascii['i'] = range(236, 239);
  $ascii['o'] = array_merge(range(242, 246), array(240, 248));
  $ascii['u'] = range(249, 252);
  // Código ASCII dos outros caracteres
  $ascii['b'] = array(223);
  $ascii['c'] = array(231);
  $ascii['d'] = array(208);
  $ascii['n'] = array(241);
  $ascii['y'] = array(253, 255);
  foreach ($ascii as $key=>$item) {
    $acentos = '';
    foreach ($item AS $codigo) $acentos .= chr($codigo);
    $troca[$key] = '/['.$acentos.']/i';
  }
  $string = preg_replace(array_values($troca), array_keys($troca), $string);
  // Slug?
  if ($slug) {
    // Troca tudo que não for letra ou número por um caractere ($slug)
    $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
    // Tira os caracteres ($slug) repetidos
    $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
    $string = trim($string, $slug);
  }
  return $string;
}

	$artigos = array("Olá, eu sou o Arthur. Tudo bem?", "Atribuir à sociedade como um todo a culpa por certos comportamentos errôneos não parece, em minha maneira de pensar, uma atitude sensata. Costumamos ouvir por aí coisas do tipo “O Brasil não tem mais jeito”, “O povo brasileiro é corrupto por natureza”, “Todas as pessoas são egoístas” e frases afins. Essa é uma visão já cristalizada no pensamento de boa parte de nosso povo.

Entretanto, se há equívocos, se existem erros, se modos ilícitos são verificados, eles sempre terão partido de um indivíduo. Mesmo que depois essas práticas se propaguem, somente serão contaminados por elas aqueles que assim o desejarem.  Uma corporação que, por exemplo, está sob investigação criminal em decorrência da ação de alguns de seus componentes, não estará necessariamente corrompida em sua totalidade. Aliás, a meu juízo, isso é quase impossível de acontecer. 

É preciso compreender que nem todo mundo se deixa influenciar por ações fraudulentas. De repente o que alguém acha interessante pode ser considerado totalmente inviável por outra pessoa e não acredito que seja justo um ser humano ser responsabilizado apenas por fazer parte de um grupo “contaminado”, mesmo sem ele, o cidadão, ter exercido qualquer coisa que comprometa a sua idoneidade moral.

Todos sabemos que um indivíduo é constituído suficientemente para pagar por suas falcatruas. Por isso, não concordo que haja julgamento geral. É preciso que saibamos separar o bom do ruim, o honesto do corrupto, o bom-caráter do mau-caráter, o dissimulado do verdadeiro. Todos têm consciência do que seja certo ou errado e devem carregar sozinhos o fardo de terem sido desleais, incorretos e vulgares, sem manchar a imagem daqueles que, por vias do destino, constituem certas facções que não apresentam, totalitariamente, uma conduta legal.", "No regime de sobrevivência de qualquer sociedade a água é tida como um dos elementos indispensáveis. Em sociedades antigas, como a Egípcia ou a Mesopotâmica, as chuvas eram recebidas com festas, uma vez que ocasionavam a cheia dos rios e assim a fartura das pessoas que viviam em suas proximidades.
Atualmente, não podemos atribuir um caráter tão alegre às chuvas, ao menos em grande parte do Brasil. Em função da falta de planejamento nos sistemas imobiliário e de infra-estrutura, um processo chuvoso que deveria naturalmente ser benéfico e não causar danos acabou se transformando em um dos principais problemas para as pessoas que viviam nas cidades atingidas. Em função da dificuldade de escoamento das águas das chuvas, diversos centros urbanos chegam a ficar completamente alagados durante períodos chuvosos. Tais alagamentos, aliados ás enchentes, trazem consigo não apenas prejuízos físicos (destruição de casas, deixando milhares de pessoas desabrigadas), mas também danos biológicos ao homem, uma vez que contribuem para a proliferação de doenças, especialmente através de transporte de lixo e de substancias infectadas por causadores de enfermidades, que por sua vez podem até causar a morte. É interessante notar que as regiões mais atingidas pelos fenômenos acima citados configuram-se em grandes centros.
Desta maneira, deve-se promover um estudo mais aprofundado que auxilie na dinâmica habitacional crescente, de maneira a evitar que água fique impossibilitada de ser escoada. Nas áreas que já sofrem com o problema, devem ser construídas obras que solucionem o mesmo, tais como os córregos, que servem para transportar a água das chuvas. ", "Assunto complexo é que envolve a discussão sobre o casamento para padres apostólicos romanos, um absurdo para alguns extremistas, mas que tem despertado interesse da sociedade, principalmente após o conhecimento de que, apenas no Brasil, existem mais de 7 mil sacerdotes em situação de matrimônio ou união estável.

Opinar sobre tão complexa matéria é deveras um desafio, no entanto, enquanto cidadãos, temos o direito e especialmente o dever de nos posicionarmos. Sabemos que a Santa Igreja Católica baseia-se em princípios e dogmas milenares, os quais respeito profundamente, mas é preciso, dada a nossa realidade, rever alguns desses preceitos, e o casamento envolvendo seus padres é um deles. Quando um individuo é ordenado sacerdote, acaba concordando em dedicar-se exclusivamente à obra de Deus, o que inclui também não relacionar-se de forma conjugal. No entanto, o simples fato de constituir uma orientação milenar não deve servir de argumento para não considerar a revisão de tais conceitos.

Tradições podem ser quebradas, sim. Não nego jamais a capacidade dos membros do Vaticano em tomar decisões acertadas, mas a realidade nos mostra traumas profundos que a Igreja tem sofrido nos últimos tempos, isso para não resgatarmos as atrocidades que a história remonta. Atos de pedofilia e casamentos ocultos são só alguns exemplos, o que torna a Instituição vulnerável. A proibição do matrimônio para sacerdotes gera uma série de outros erros, pois quando sentem a necessidade de estar ao lado de alguém, o fazem sem o devido consentimento de seus superiores e, assim, agem contra suas próprias concepções.

Não há - nem haveria por quê - qualquer empecilho entre um padre casar, constituir família, gerar filhos e continuar exercendo seu ofício. Em outras religiões, sem querer fazer comparações, isso é perfeitamente viável. É melhor rever certos preceitos do que alimentar hipocrisias, uma vez que os erros cometidos são concretos. Caso contrário, os membros da Igreja continuarão a desviar-se dos dogmas, mesmo que ocultamente, por serem homens comuns e terem as mesmas necessidades físicas e psicológicas de qualquer outra pessoa, ainda que tenham jurado servir somente à Igreja. O casamento direcionado aos padres seria, na certa, uma decisão revolucionária, sábia e benéfica à firme manutenção do Cristianismo.", "A classe média brasileira, egressa há pouquíssimo tempo de camadas socioeconômicas mais sofridas, se assusta com muita facilidade. Há uma tendência ao escândalo e à indignação vazia. Os “rolezinhos”, fenômeno social que inaugurou 2014, é prova desse desespero constante da classe média. De repente, mil, dez mil, 20 mil jovens aparecem não se sabe de onde nem como em lugares públicos em teoria, mas privados na prática, como os shoppings. E o que essa horda amealhada através das redes sociais deseja? A resposta é simples: se divertir.

Como quaisquer adolescentes, os meninos e as meninas dos rolezinhos querem se divertir. Sem embasamento filosófico, sociológico ou antropológico, mas embalados pela música ruim do funk ostentação, esse é um grupo que denota a maneira como veem a vida: o que importa é se divertir, é “causar”. Se as praias e outros espaços aparentemente mais democráticos não são mais, há anos, o Eldorado da diversão da classe média, por que os menos abastados continuariam relegados aos espaços a que foram tangidos? Eles exigem, mesmo sem a clareza da força que fazem, o espaço que lhes é (ou deveria ser) também de direito.

Enquanto isso, a classe média sonha com a distância que a classe A mantém dela: assim como os médios olham para cima para ver os mais abastados, esses médios também querem que alguém os veja de baixo, e assim vociferam através de uma polícia que age como um destacamento de capitães do mato. A classe média reclama, exige, que o fosso entre ela e os menos abastados seja mantido largo e profundo, mas como conter esse grupo que começou a perceber que, de direito, esses espaços também lhe pertencem?

Os shoppings fecham suas lojas, a polícia arrebenta os guris com cassetetes e sprays de pimenta e as moças de bom grado se horrorizam com os moleques que se sentam para pedir os itens mais baratos do cardápio das mesmas redes de fast food em que elas gastam muito.

Estou longe de ser sociólogo ou antropólogo: estou mais para lorotólogo mesmo, mas quando vejo o pessoal do rolezinho, me custa crer na organização de um movimento e acabo apostando mais na modinha Facebook, ainda que isso não signifique dizer que o rolezinho não tenha importância social. Creio que isso deixará marcas muito maiores que a orquestração do tal gigante sonâmbulo de 2013 numa sociedade que precisa compreender que os espaços são tomados quando se tenta excluir quem também é dono. Espero mesmo que esse seja um sintoma espontâneo desse reconhecimento de direitos de classe, ainda que despido de filosofias basilares, e que a galera do rolezinho possa fazer deste momento algo significativo para nosso tempo.");
foreach ($artigos as $key=>$artigo) {
	echo "Artigo ".($key+1).":<br>";
	$paragrafos = explode("\n", $artigo);
	foreach ($paragrafos as $key1 => $paragrafo) {
		$frases[$key1] = multiexplode(array(".", "?", "!"), $paragrafo);
		foreach ($frases[$key1] as $key2 => $frase) {
			$virgulas[$key2] = explode(",", $frase);
			foreach ($virgulas[$key2] as $key3 => $virgula) {
				$palavras[$key3] = explode(" ", $virgula);
				foreach ($palavras[$key3] as $key4 => $palavra) {
					$palavra = removeAcentos(utf8_decode($palavra));
					$palavras[$key3][$key4] = utf8_encode($palavra);
				}
				$novosParagrafos[$key1]["frases"][$key2]["virgulas"][$key3]["palavras"] = $palavras[$key3];
			}
		}
	}
	$analise[$key]['paragrafos'] = $novosParagrafos;
	echo "<pre>";
	var_dump($analise[$key]);
	echo "</pre><br><br><br>";
}
?>