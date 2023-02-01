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
<title>Forgot Password</title>
<style>
</style>
</head>
<body style="background-color: #F0F0F0;">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <a href="../"><img src="../assets/img/forgot-password.svg" height="50px" ></a>
                </div>
            
                <div class="card-body">
                    <form>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            </div>
                            <input type="email" class="form-control" id="email" placeholder="Email" />
                        </div>
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