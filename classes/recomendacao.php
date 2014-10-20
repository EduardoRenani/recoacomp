<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 14/10/14
 * Time: 13:41
 */
require_once("config/config.cfg");
class Recomendacao {

    private $userID;
    private $disciplinaID;
    private $is_cadastrado; //O usuário está cadastrado na disciplina em questão?
    private $id_competencias_disciplina; //Quais competências estão associadas à disciplina em questão?

    function __construct($user,$disciplina){
        //Get id do usuário
        $this->userID = $user;

        //Get id da disciplina
        $this->disciplinaID = $disciplina;

        //Verifica se o usuário está cadastrado na disciplina
        $this->is_cadastrado = $this->get_iscadastrado();

        //Get id das competências da disciplina em questão
        $this->id_competencias_disciplina= array();
        $this->get_competencias_disciplina();
        $cont = count($this->id_competencias_disciplina);
        for($i=0;$i<$cont;$i++){
            $this->id_competencias_disciplina[$i] = (int)($this->id_competencias_disciplina);
        }
    }
    //Método que faz a recomendação em si.
    public function recomenda(){
        //todo transformar esses comentários abaixo em ação.

        //Get do cha da disciplina para cada competência.

        //Get do cha do usuário para cada competência.

        //Get objetos da compêtencia e montar matriz.

        //Subtração das matrizes.

        //Usar classe Lista para ordenar

        //Retornar pro usuário usando método mostraRecomendacao.
    }
    private function mostraRecomendacao(){

    }

    private function get_iscadastrado(){
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // Caso algo tenha dado errado, retorna erro
        if (mysqli_connect_errno())
            return "Erro de conexão";

        // Executa uma consulta
        $sql = "SELECT `usuario_idusuario` FROM `usuario_disciplina` WHERE `usuario_idusuario` = $this->userID AND `disciplina_iddisciplina` = $this->disciplinaID";
        $query = $mysqli->query($sql);
        //var_dump($query);
        $dados = $query->fetch_assoc();
        //var_dump($dados);

        if(count($dados) >= 1)
            return true;
        else
            return false;

    }
    private function get_competencias_disciplina(){

        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // Caso algo tenha dado errado, retorna erro
        if (mysqli_connect_errno())
            return "Erro de conexão";

        // Executa uma consulta
        $sql = "SELECT `competencia_idcompetencia` FROM `disciplina_competencia` WHERE `disciplina_iddisciplina` = $this->disciplinaID";
        $query = $mysqli->query($sql);
        do{
            $dados = $query->fetch_array(MYSQLI_NUM);
            if($dados != NULL)
                array_push($this->id_competencias_disciplina,$dados[0]);
        }while($dados != NULL);
        return $dados;
    }

} 