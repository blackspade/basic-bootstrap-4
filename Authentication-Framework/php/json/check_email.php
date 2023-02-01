<?php
require_once '../core/init.php';
require_once '../functions/sanitize.php';

spl_autoload_register(function($class){
    require_once '../classes/'.$class.'.php';
});

header('Content-Type: application/json');

if(is_ajax_request()){
 
    $table                  = config::get('tables|table_name_for_users');
    $email                  = email_escape($_GET['email']);

    $SELECT_EMAIL_DB_CONN = mysqli_connect(config::get('mysql|host'), config::get('mysql|user'), config::get('mysql|pass'), config::get('mysql|db'), 3306);

    $SQL_SELECT_EMAIL = "SELECT `email` FROM  `{$table}`  WHERE `email` = '{$email}' ";

    $SQL_QUERY = mysqli_query($SELECT_EMAIL_DB_CONN,$SQL_SELECT_EMAIL);

    mysqli_fetch_row($SQL_QUERY);

    $result = mysqli_affected_rows($SELECT_EMAIL_DB_CONN);
    
    if($result == 1){
        $array = array("status" => "true");
        echo json_encode($array);
    }else{
        $array = array("status" => "false");
        echo json_encode($array);
    }

    mysqli_close($SELECT_EMAIL_DB_CONN);

}else{
	exit();
}