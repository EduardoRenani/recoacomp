<?php

if(class_exists('bd') != true){
class bd{

	public static function getIP(){
		return "127.0.0.1";
	}
	public static function user(){
		return "root";
	}
	public static function user_pass(){
		return "root";
	}

	public static function database(){
		return "cadastrousuarios";
	}
	
}
}

?>