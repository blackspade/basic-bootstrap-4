<?php
require_once 'php/core/init.php';
require_once 'php/functions/sanitize.php';

spl_autoload_register(function($class){
    require_once 'php/classes/'.$class.'.php';
});

?>


