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
<title>Reset Password</title>
<style>
</style>
</head>
<body style="background-color: #F0F0F0;">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <img src="../assets/img/password-reset.svg" height="50px" > 
                </div>
            
                <div class="card-body">
                    <form>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password" class="form-control" id="passwordConfirm" placeholder="Confirm Password" />
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/vendor/jquery/jquery-3.6.3.min.js"></script>
<script src="../assets/vendor/jquery.tablesorter.min.js"></script>
<script src="../assets/vendor/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js" ></script>
<script>
    
</script>
</body>
</html>