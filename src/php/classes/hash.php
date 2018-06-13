<?php
class hash{
    public static function shaMake($string, $salt = ''){
        return hash('sha256', $string.$salt);
    }
    
    public static function salt($length){
        return mcrypt_create_iv($length);
    }
	
	public static function md5Make($string){
		return md5($string);
	}
    
    public static function unique(){
        return self::make(uniqid());
    } 
}

