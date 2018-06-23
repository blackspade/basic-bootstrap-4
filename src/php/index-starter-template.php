<?php
require_once 'php/core/init.php';
require_once 'php/functions/sanitize.php';

spl_autoload_register(function($class){
    require_once 'php/classes/'.$class.'.php';
});

//Database Connection Call 

$con = mysqli_connect(config::get('mysql|host'), config::get('mysql|user'), config::get('mysql|pass'), config::get('mysql|db'), 3306);


//JSON REQUEST Check Sanitize.php in Functions
if(is_ajax_request()){
	
}else{
	exit();
}

?>


