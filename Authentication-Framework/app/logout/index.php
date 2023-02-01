<?php
session_start();

spl_autoload_register(function($class){
    require_once '../../php/classes/'.$class.'.php';
});

session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');

redirect::to("../../");
?>