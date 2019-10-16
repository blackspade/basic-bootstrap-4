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

//PREPARED STATEMENTS 

$con = new mysqli(config::get('mysql|host'), config::get('mysql|user'), config::get('mysql|pass'), config::get('mysql|db'), 3306);

$SQL = "SQL STATEMENT HERE";	
	
$var = "";

if (!($stmt = $con->prepare($SQL))) {
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("s", $var)) {
	echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}else{
	echo $name.$bus_email.$other.$bus_name.$address.$city.$zip.$phone.$job.$domain.$provider.$pin;
	
}

?>


