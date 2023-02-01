<?php
require_once '../php/core/init.php';
require_once '../php/functions/sanitize.php';

spl_autoload_register(function($class){
    require_once '../php/classes/'.$class.'.php';
});

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="shortcut icon" href="../assets/icon/favicon.ico">
<link rel="stylesheet" href="../assets/vendor/icon-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css" >
<title>App</title>
<style>
</style>
</head>
<body style="background-color: #F0F0F0;">

<script src="../assets/vendor/jquery/jquery-3.6.3.min.js"></script>
<script src="../assets/vendor/jquery.tablesorter.min.js"></script>
<script src="../assets/vendor/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js" ></script>
<script>
    
</script>
</body>
</html>