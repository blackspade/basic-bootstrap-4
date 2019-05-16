<?php
require_once './php/core/init.php';
require_once './php/functions/sanitize.php';
require './php/plugins/JasonGrimes/Paginator.php';

use JasonGrimes\Paginator;

spl_autoload_register(function($class){
    require_once './php/classes/'.$class.'.php';
});

$first_connection = mysqli_connect(config::get('mysql|host'), config::get('mysql|user'), config::get('mysql|pass'), config::get('mysql|db'), 3306);
$count_sql = "SELECT COUNT(*) FROM `table_name`";
$count = mysqli_query($first_connection,$count_sql);
$r = mysqli_fetch_array($count);

$totalItems = $r[0];
$itemsPerPage = 15;
$currentPage = 0;

if( isset($_GET['page']) ){
	$currentPage = $_GET['page'];
}else{
	$currentPage = 1;
}

$urlPattern = '?page=(:num)&view=';
$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

$limit = ($currentPage - 1) * $itemsPerPage.',' .$itemsPerPage;

$con = mysqli_connect(config::get('mysql|host'), config::get('mysql|user'), config::get('mysql|pass'), config::get('mysql|db'), 3306);
$sql = "SELECT * FROM `table_name`ORDER BY `date_created` DESC LIMIT ".$limit;
$result = mysqli_query($con, $sql);


?>