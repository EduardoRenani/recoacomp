<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 14/10/14
 * Time: 13:41
 */
require_once("config/config.cfg");
class Recomendacao {

    private $mysqli;

    private $userID;

    private $disciplinaID;

    private $is_cadastrado; //O usuário está cadastrado na disciplina em questão?

    private $id_competencias_disciplina; //Quais competências estão associadas à disciplina em questão?

    private $cha_disc_comp; //Matriz com o cha das competências para essa disciplina
        //Coluna 0: ID competências
        //Coluna 1: Conhecimento
        //Coluna 2: Habilidade
        //Coluna 3: Atitude

    private $cha_user_comp; //Matriz com o cha das competências desse usuário
        //Coluna 0: ID competências
        //Coluna 1: Conhecimento
        //Coluna 2: Habilidade
        //Coluna 3: Atitude

    private $objetosDaCompetencia;

    private $cha_obj_comp;//Matriz com o cha dos objetos para essa competência
    //Coluna 0: ID da comp
    //Coluna 1: ID do objeto
    //Coluna 2: Conhecimento
    //Coluna 3: Habilidade
    //Coluna 4: Atitude

    //Matriz A é a primeira matriz na subtração. Realmente não imaginei um nome melhor... Sei lá, A-B parece tão aceitável.
    private $A;

    private $matrizSubtraida;

    function __construct($user,$disciplina){

        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        //if (mysqli_connect_errno())
            //return "Erro de conexão";

        //Get id do usuário
        $this->userID = $user;

        //Get id da disciplina
        $this->disciplinaID = $disciplina;

        //Verifica se o usuário está cadastrado na disciplina
        $this->is_cadastrado = $this->get_iscadastrado();

        //Get id das competências da disciplina em questão
        $this->id_competencias_disciplina= array();
        $this->get_competencias_disciplina();

        $this->cha_disc_comp=array(
            'ID' => array(),
            'C' => array(),
            'H' => array(),
            'A' => array()
        );
        $this->cha_user_comp = $this->cha_disc_comp;
        $this->objetosDaCompetencia = array(
            'Competencia' => array(),
            'Objeto'=>array()
        );
        $this->cha_obj_comp=array(
            'ID_comp' => array(),
            'ID_oa' => array(),
            'C' => array(),
            'H' => array(),
            'A' => array()
        );

    }
    //Método que faz a recomendação em si.
    public function recomenda(){
        //todo transformar esses comentários abaixo em ação.

        //Get do cha de cada competência para a disciplina.
        $this->getCHAcomp_disciplina();
        //Get do cha do usuário para cada competência.
        $this->getCHAuser_comp();
        //Get objetos da compêtencia.
        $this->getObjetosCompetencia();
        //Pegar o CHA de cada objeto para aquela competência
        $this->getCHAobjetocompetencia();

        //Montar matrizes
        //Cada competência possui duas matrizes!
        //A primeira possui a seguinte montagem:
        // A = [Conhecimento OA para essa comp | Habilidade OA para essa comp | Atitude OA pra essa comp], sendo cada linha
        // um OA diferente.
        // B = [Conhecimento pessoa para essa comp | Habilidade pessoa para essa comp | Atitude pessoa para essa comp]
        // Está tudo mais documentado nos arquivos .doc que eu fiz. Dá uma lida lá, é mais fácil do que peneirar códigos.
        // Vai por mim. (;

        $this->getMatrizes();

        //Subtração das matrizes.

        $this->subtraiMatrizes();

        //Usar classe Lista para ordenar

        //Retornar pro usuário usando método mostraRecomendacao.
        $this->mostraRecomendacao();
    }

    private function mostraRecomendacao(){

        //Faz o que tem que fazer..

        //e depois:
        $this->mysqli->close();
    }

    //Altera a matriz cha_disc_comp que armazena o CHA das competências para a disciplina em questão.
    private function getCHAcomp_disciplina(){

        //$this->id_competencias_disciplina
            //vetor de IDs das competências presentes na disciplina
        //$this->cha_disc_comp;
            //Matriz com o cha das competências para essa disciplina
            //Coluna 1: ID competência
            //Coluna 2: Conhecimento
            //Coluna 3: Habilidade
            //Coluna 4: Atitude

        $cont=count($this->id_competencias_disciplina);
        //var_dump($this->id_competencias_disciplina);
        //var_dump($this->disciplinaID);
        for($i=0;$i<$cont;$i++){

            $idcomp=$this->id_competencias_disciplina[$i];

            $sql="SELECT `conhecimento`,`habilidade`, `atitude` FROM `disciplina_competencia` WHERE `disciplina_iddisciplina`=$this->disciplinaID AND `competencia_idcompetencia`=$idcomp";
            $query = $this->mysqli->query($sql);
            $dados = $query->fetch_array(MYSQLI_NUM);
            if($dados != NULL){
                array_push($this->cha_disc_comp['ID'],$idcomp);
                array_push($this->cha_disc_comp['C'],(int)$dados[0]);
                array_push($this->cha_disc_comp['H'],(int)$dados[1]);
                array_push($this->cha_disc_comp['A'],(int)$dados[2]);
            }
            unset($query);
            unset($sql);
            unset($dados);

        }
        //var_dump($this->cha_disc_comp);
    }
    private function getCHAuser_comp(){

        //$dados = array('C'=>array(),'H'=>array(),'A'=>array());
        $cont=count($this->id_competencias_disciplina);
        for($i=0;$i<$cont;$i++){
            $idcomp=$this->id_competencias_disciplina[$i];
            $sql="SELECT `conhecimento`,`habilidade`, `atitude` FROM `usuario_competencias` WHERE `usuario_idusuario`=$this->userID AND `competencia_idcompetencia`=$idcomp";
            $query = $this->mysqli->query($sql);
            do{
                $result = $query->fetch_array(MYSQLI_ASSOC);
                if($result != NULL){

                    array_push($this->cha_user_comp['ID'],$idcomp);
                    array_push($this->cha_user_comp['C'],(int)$result['conhecimento']);
                    array_push($this->cha_user_comp['H'],(int)$result['habilidade']);
                    array_push($this->cha_user_comp['A'],(int)$result['atitude']);
                }
            }while($result !=NULL);
        }
    }
    private function get_iscadastrado(){

        // Executa uma consulta
        $sql = "SELECT `usuario_idusuario` FROM `usuario_disciplina` WHERE `usuario_idusuario` = $this->userID AND `disciplina_iddisciplina` = $this->disciplinaID";
        $query = $this->mysqli->query($sql);
        //var_dump($query);
        $dados = $query->fetch_assoc();
        //var_dump($dados);

        if(count($dados) >= 1)
            return true;
        else
            return false;

    }
    private function get_competencias_disciplina(){
        $dados = array();

        // Executa uma consulta
        $sql = "SELECT `competencia_idcompetencia` FROM `disciplina_competencia` WHERE `disciplina_iddisciplina` = $this->disciplinaID";
        $query = $this->mysqli->query($sql);
        do{
            $result = $query->fetch_array(MYSQLI_NUM);
            if($result != NULL)
                array_push($dados,$result[0]);
        }while($result !=NULL);

        if($dados != NULL){
            $cont = count($dados);
            for($i=0;$i<$cont;$i++){
                array_push($this->id_competencias_disciplina,(int)$dados[$i]);
            }
        }
        //var_dump($this->id_competencias_disciplina);
        return true;
    }
    private function getObjetosCompetencia(){


        $cont=count($this->id_competencias_disciplina);
        for($i=0;$i<$cont;$i++){
            $competencia=$this->id_competencias_disciplina[$i];
            $sql="SELECT `id_OA` FROM `competencia_oa` WHERE `id_competencia`=$competencia";
            $query = $this->mysqli->query($sql);
            do{
                $result = $query->fetch_array(MYSQLI_NUM);
                if($result != NULL){
                    array_push($this->objetosDaCompetencia['Competencia'],(int)$competencia);
                    array_push($this->objetosDaCompetencia['Objeto'],(int)$result[0]);
                }
            }while($result !=NULL);
        }
    }
    private function getCHAobjetocompetencia(){
        $cont = count($this->objetosDaCompetencia['Competencia']);

        for($linha=0;$linha<$cont;$linha++){

            $competencia=$this->objetosDaCompetencia['Competencia'][$linha];
            $oa=$this->objetosDaCompetencia['Objeto'][$linha];

            $sql="SELECT `conhecimento`, `habilidade`, `atitude` FROM `competencia_oa` WHERE `id_competencia`=$competencia AND `id_OA`=$oa";
            $query = $this->mysqli->query($sql);
            do{
                $result = $query->fetch_assoc();
                if($result != NULL){
                    array_push($this->cha_obj_comp['ID_comp'],(int)$competencia);
                    array_push($this->cha_obj_comp['ID_oa'],(int)$oa);
                    array_push($this->cha_obj_comp['C'],(int)$result['conhecimento']);
                    array_push($this->cha_obj_comp['H'],(int)$result['habilidade']);
                    array_push($this->cha_obj_comp['A'],(int)$result['atitude']);
                }
            }while($result !=NULL);

        }
        //var_dump($this->cha_obj_comp);
        //unset($this->objetosDaCompetencia);
    }
    private function getMatrizes(){

        // Array de matrizes da competência atual
        $this->A=array();

        //Conta quantas competências a disciplina possui
        $numComp=count($this->id_competencias_disciplina);

        /**/
        for($j=0;$j<$numComp;$j++){

            $compAtual=$this->id_competencias_disciplina[$j];

            //Array de OAs da competência atual
            unset($objetosDaCompetencia);
            $objetosDaCompetencia = array();
            $cont = count($this->objetosDaCompetencia['Competencia']);
            //Filtra os OAs em $this->objetosDaCompetencia que são ligados à competência compAtual para $objetosDaCompetencia
            for($i=0;$i<$cont;$i++){
                if($this->objetosDaCompetencia['Competencia'][$i] == $compAtual){
                    array_push($objetosDaCompetencia,$this->objetosDaCompetencia['Objeto'][$i]);
                }
            }
            $cont = count($objetosDaCompetencia);
            for($i=0;$i<$cont;$i++){
                //Retorna o CHA do OA para essa competência e armazena em $matrizFiltrada.
                $matrizFiltrada=$this->filtraMatrizCHAobj($compAtual,$objetosDaCompetencia[$i]);

                array_push($this->A,
                    array('ID_comp' => $compAtual,
                            'ID_OA' => $objetosDaCompetencia[$i],
                            'C' => $matrizFiltrada['C'],
                            'H' => $matrizFiltrada['H'],
                            'A' => $matrizFiltrada['A']
                    )
                );
            }

        }

        unset($objetosDaCompetencia);

        /**/
        $this->testaMatrizCHA($this->A,'ID_OA',$compAtual);
        echo "<br/>";
        $this->testaMatrizCHA($this->cha_user_comp);

        //Matriz A: Primeira Matriz.
        //Matriz $this->cha_user_comp: Seria a matriz B.
        //Agora é só subtrair com o método pra isso.
        //" A - B "
        //As aspas são porque do jeito que estão salvas, não funcionaria a subtração. Precisa de uma lógica antes.
    }
    private function filtraMatrizCHAobj($competencia,$objeto){

        //tamanho = quantas competências há
        $tamanho=count($this->cha_obj_comp['C']);

        //Filtra a matriz $this->cha_obj_comp. O filtrado é o CHA do OA para essa competência.
        for($i=0;$i<$tamanho;$i++){
            if($this->cha_obj_comp['ID_comp'][$i] == $competencia && $this->cha_obj_comp['ID_oa'][$i] == $objeto){
                return array(
                    'C'=>$this->cha_obj_comp['C'][$i],
                    'H'=>$this->cha_obj_comp['H'][$i],
                    'A'=>$this->cha_obj_comp['A'][$i]
                );
            }
        }
    }
    private function testaMatrizCHA($matriz,$stringID='ID',$comp=0){

        if($stringID=='ID'){
            $cont = count($matriz['C']);
            echo ("".$stringID."   C   H   A<br/>");
            for($linha=0;$linha<$cont;$linha++){
                echo ("".$matriz[$stringID][$linha]."    ".$matriz['C'][$linha]."    ".$matriz['H'][$linha]."    ".$matriz['A'][$linha]."<br/>");
            }
        }else if ($stringID == 'ID_OA'){
            $cont = count($matriz);
            echo ("ID_comp   ".$stringID."   C   H   A<br/>");
            for($linha=0;$linha<$cont;$linha++){
                echo ("".$matriz[$linha]['ID_comp']."   ".$matriz[$linha][$stringID]."    ".$matriz[$linha]['C']."    ".$matriz[$linha]['H']."    ".$matriz[$linha]['A']."<br/>");
            }
        }

    }
    private function subtraiMatrizes(){

        $this->matrizSubtraida = array(
            'ID_comp'=>array(),
            'ID_oa'=>array(),
            'C'=>array(),
            'H'=>array(),
            'A'=>array()
        );

        $compAtual=1;

        $contador=count($this->A);
        $listaObjetos=array();
        for($p=0;$p<$contador;$p++){
            if($this->A[$p]['ID_comp'] == $compAtual)
                array_push($listaObjetos,$this->A[$p]['ID_OA']);
        }

        $cont=count($listaObjetos);
        for($i=0;$i<$cont;$i++){

            //Saber CHA do objeto $listaObjetos[$i] para a competência $compAtual
            $cont1=count($this->A['ID_OA']);
            for($j=0;$j<$cont1;$j++){
                if($this->A['ID_OA'][$j] == $listaObjetos[$i] && $this->A['ID_comp'][$j] == $compAtual){
                    $chaA=array($this->A[$j]['C'],$this->A[$j]['H'],$this->A[$j]['A']);
                    break;
                }
            }

            //Saber CHA da competência para o usuário.
            $cont2=count($this->cha_user_comp['C']);
            for($k=0;$k<$cont2;$k++){
                if($this->cha_user_comp['ID']==$compAtual){
                    $chaB=array($this->cha_user_comp['C'],$this->cha_user_comp['H'],$this->cha_user_comp['A']);
                    break;
                }
            }

            array_push($this->matrizSubtraida,
                array(
                    'ID_comp'=>$compAtual,
                    'ID_oa'=>$listaObjetos[$i],
                    'C'=>$chaA[0]-$chaB[0],
                    'H'=>$chaA[1]-$chaB[1],
                    'A'=>$chaA[2]-$chaB[2]
                )
            );
        }
        //var_dump($this->A);
        //var_dump($this->matrizSubtraida);
    }
} 