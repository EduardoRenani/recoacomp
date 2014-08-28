<?php
/**
 * Created by Delton & Clauser.
 * Date: 28/08/14
 * Time: 14:42
 */
if(class_exists('bd') != true){
class db {
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