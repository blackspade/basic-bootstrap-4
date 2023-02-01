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
<title>Pending</title>
<style>
</style>
</head>
<body style="background-color: #F0F0F0;">

<section class="container g-py-100">
    <div class="row justify-content-center">
      <div class="col-sm-8 col-lg-5">
       
        <div class="g-brd-around g-brd-gray-light-v4 rounded g-py-40 g-px-30">
          <header class="text-center mb-4">
            <h2 class="h2 g-color-black g-font-weight-600">Account Pending</h2>
          </header>


            <div class="g-mb-35">
              <div class="row justify-content-between">
                <h6>Your account is still under pending status. Click the link sent to your email to confirm account. Then contact the administrator.</h6>
            
            </div>
            </div>

        </div>
      </div>
    </div>

</section>

<script src="../assets/vendor/jquery/jquery-3.6.3.min.js"></script>
<script src="../assets/vendor/jquery.tablesorter.min.js"></script>
<script src="../assets/vendor/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js" ></script>
<script>
    
</script>
</body>
</html>