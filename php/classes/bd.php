<?php

/*
 * Created by Delton & Cláuser
 * Classe que controla iterações com o banco de dados.
 */

define("_SERVER", "localhost");
define("_USUARIO", "clauser");
define("_SENHA", "root");
define("_BD", "recomendador-test");

if(class_exists('bd') != true){
class bd{

    private $mysql;

    function __construct(){
        $mysql=null;
    }

    /*
     * Método que conecta o banco de dados.
     */
    public function connect(){
        $this->mysql = new mysqli(_SERVER,_USUARIO, _SENHA, _BD);

        //Checa se conectou.
        if ($this->mysql->connect_errno) {
            echo "Connect failed: ".$this->mysql->connect_error."<br />";
            exit();
        }
        return true;
    }
    /*
     * Método que fecha o banco de dados.
     */
    public function disconnect(){
        $this->mysql->close();
    }

    public function execQuery($comando, $desconectar = null ){
        if($this->mysql == null)
            $this->connect();

        $resposta = $this->mysql->query($comando);
        //Se for passado true como segundo parâmetro, desconecta o banco de dados.
        if($desconectar)
            $this->disconnect();

        return $resposta;
    }

        //DEIXAR POR QUESTÕES DE COMPATIBILIDADE!
	public static function getIP(){
		return "localhost";
	}
	public static function user(){
		return "root";
	}
	public static function user_pass(){
		return "root";
	}

	public static function database(){
		return "recomendador-test";
	}
	    //FIM DO TRECHO DE COMPATIBILIDADE
}
}

?>