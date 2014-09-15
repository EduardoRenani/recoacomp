<?php
/**
 * User: Cláuser
 * Date: 02/09/14
 * Time: 09:40
 */

require_once("bd.class.php");

if(class_exists('Competencia') != true){
class Competencia {
    private $id;
    private $nome;
    //private $valor;

        //GETTERS AND SETTERS
            //Individuais
    public function getID(){return $this->id;}
    public function getNome(){return $this->nome;}
    //public function getValor(){return $this->valor;}
    public function setID($id){$this->id = $id;}
    public function setNome($nome){$this->nome = $nome;}
    //public function setValor($valor){$this->valor = $valor;}
            //Grupo de Atributos
    public function setCompetenciaByBD($id){
        //TODO
        //iteração com banco de dados para retornar $nome e $valor de acordo com o id;

        $nome='vem do bd'; //TODO MUDAR ISSO AQUI
        $valor=0;//vem do bd
        if($nome != '' && $id != 0)
            return true;
        else
            return false;
    }
    /**
     * @return objeto de classe Competencia
     */
    public function getObjeto(){return $this;}

        //CONSTRUTOR

    function __construct(){
        //$id = $valor = 0;
        $this->nome = '';
    }
    /*
     * Cria uma competência no banco de dados e armazena a mesma no objeto.
     */
    public function criaCompetencia($nome){
        $banco = new bd();
        if( $banco->connect() ){
            $this->nome = $nome;
            $banco->execQuery("INSERT INTO competencia (nome) VALUES (\"".$nome."\")");
            $this->id = $this->getID_byNome($banco);
            $banco->disconnect();
        }

        unset($banco);
    }
    /*
     * Retorna o ID da competência que possui o nome especificado.
     * @param $com é um objeto do tipo bd.
     */
    private function getID_byNome($con){

        $result = $con->execQuery("SELECT ID FROM usuario WHERE (nome = \"".$this->nome."\")");
        $result = mysql_fetch_array ($result);

        return $result[0];

    }

}
}