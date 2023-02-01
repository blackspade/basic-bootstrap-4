<?php
require_once '../core/init.php';
require_once '../functions/sanitize.php';

spl_autoload_register(function($class){
    require_once '../classes/'.$class.'.php';
});

header('Content-Type: application/json');

if(is_ajax_request()){
$PASSWORD_LEVEL = config::get('settings|password_strength_level_req');

$array = array("level" => $PASSWORD_LEVEL);

echo json_encode($array);
}else{
	exit();
}