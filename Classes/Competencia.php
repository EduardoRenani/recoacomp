<?php
/**
 * User: Cláuser
 * Date: 02/09/14
 * Time: 09:40
 */
if(class_exists('Competencia') != true){
class Competencia {
    private $id;
    private $nome;
    private $valor;

        //GETTERS AND SETTERS
            //Individuais
    public function getID(){return $this->id;}
    public function getNome(){return $this->nome;}
    public function getValor(){return $this->valor;}
    public function setID($id){$this->id = $id;}
    public function setNome($nome){$this->nome = $nome;}
    public function setValor($valor){$this->valor = $valor;}
            //Grupo de Atributos
    public function setCompetenciaByBD($id){
        //TODO
        //iteração com banco de dados para retornar $nome e $valor de acordo com o id;

        $nome='vem do bd';
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
        $id = $valor = 0;
        $nome = '';
    }

}
}