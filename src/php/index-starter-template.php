<?php
require_once 'php/core/init.php';
require_once 'php/functions/sanitize.php';

spl_autoload_register(function($class){
    require_once 'php/classes/'.$class.'.php';
});

//Database Connection Call 
$con = mysqli_connect(config::get('mysql|host'), config::get('mysql|user'), config::get('mysql|pass'), config::get('mysql|db'), 3306);


//IP Address
$ip = $_SERVER['REMOTE_ADDR'];

//JSON REQUEST Check Sanitize.php in Functions
if(is_ajax_request()){
	
}else{
	exit();
}

//STANDARD QUERY LOOP OF SQL QUERY
$sql = "SELECT * FROM `table`";
$query = mysqli_query($con, $sql);

while ($row = mysqli_fetch_row($query)){
	//Index Data
	$data = $row[0];
}

//CHECK FOR A POST REQUEST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
}
?>


