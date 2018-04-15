<?php
//este tutorial se encuentra en oopls 19 2min 30se

class cookie{
    public static function exists($name){
        return (isset($_COOKIE[$name])) ? true : false;
    }
    
    public static function get($name){
        return $_COOKIE[$name];
    }
    
    public static function put($name, $value, $expiry){
        if(setcookie($name, $value, time() + $expiry, '/')){
            return true;
        }
        
        return false;
        
    }
    
    public static function delete($name){
      //delete cookie
      //cambiar informacion del cookie 
      self::put($name, '', time() -1);
    }
}
