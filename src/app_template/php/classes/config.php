<?php
class config{
    public static function get($path = null){
        if($path == ''){
            $result = 'Nothing Set!';
            return $result;
        }else{
            $config = $GLOBALS['config'];
            $path = explode('|', $path);

            foreach($path as $bit){
                if(isset($config[$bit])){
                   $config = $config[$bit];
                }
            }
            return $config;
        }
    }
}
