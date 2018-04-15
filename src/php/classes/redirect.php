<?php
class redirect{
    public static function to($location = null){
        if($location){
            if(is_numeric($location)){
                switch($location){
                    case 404:
                        header('Location: errors/404.php');
                         exit();
                        //header('HTTP/1.0 404 Not found');
                        //include 'includes/errors/404.php';
                        //..exit();
                    break;
                }
            }
            header('Location: '.$location);
            exit();
        }
    }
}
