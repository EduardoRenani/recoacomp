<?php

if(class_exists('bd') != true){
class bd{

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
	
}
}

?>