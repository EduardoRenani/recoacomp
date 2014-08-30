<?php

if(class_exists('bd') != true){
class bd{

	public static function getIP(){
		return "127.0.0.1";
	}
	public static function user(){
		return "clauser";
	}
	public static function user_pass(){
		return "senha";
	}

	public static function database(){
		return "cadastrousuarios";
	}
	
}
}

?>