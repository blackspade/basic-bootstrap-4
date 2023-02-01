<?php
class hash{
    public static function password($string){
        return password_hash($string,PASSWORD_DEFAULT);
    }
    
    public static function checkPassword($string,$hash){
        return password_verify($string,$hash);
    }
	
	public static function md5Make($string){
		return md5($string);
	}
    
    public static function unique(){
        return self::md5make(uniqid());
    } 
}