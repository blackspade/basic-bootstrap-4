<?php
require_once './php/core/init.php';
require_once './php/functions/sanitize.php';

spl_autoload_register(function($class){
    require_once './php/classes/'.$class.'.php';
});

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="keywords" content="Authentication Framework">
<meta name="author" content="BCRWEBDEV">
<meta name="description" content="A simple complete authentication system made with PHP 8.2 and Bootstrap 4"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="shortcut icon" href="./assets/icon/favicon.ico">
<link rel="stylesheet" href="./assets/vendor/icon-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="./assets/css/bootstrap.min.css" >
<title>Homepage</title>
<style>
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <img src="./assets/img/company-app-white.svg" alt="Company App" height="50px" />
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./login/">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./create-account/">Create Account</a>
                </li>
            </ul>

        </div>
    </div>
</nav>


<div class="container">

  <div class="jumbotron">
    <h2>Application Authentication</h2>
    <p class="lead">User authentication is the process of verifying the identity of a user or device. It is an important security measure that helps to protect against unauthorized access to systems and data.</p>
    <p><a class="btn btn-lg btn-primary" href="./create-account/" role="button">Create Account</a></p>
  </div>

  <div class="row justify-content-center">
    <div class="col-lg-6">
      <h4>Protecting Sensitive Data</h4>
      <p>User authentication helps to ensure that only authorized users can access sensitive data or systems. This helps to prevent data breaches and unauthorized access to sensitive information.</p>

      <h4>Maintaining Security</h4>
      <p>User authentication helps to maintain the security of systems and networks by preventing unauthorized access. This can help to prevent security breaches and unauthorized access to resources.</p>


    </div>

    <div class="col-lg-6">
      <h4>Ensuring Compliance</h4>
      <p>Many industries have strict regulations regarding access to sensitive data. User authentication helps to ensure that these regulations are followed, helping organizations to remain compliant.</p>

      <h4>Enhancing User Experience</h4>
      <p>By requiring users to authenticate themselves, organizations can tailor the user experience to the specific needs and preferences of each user. This can improve the overall user experience and make it easier for users to access the resources they need.</p>

    </div>
  </div>

  <br />
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header d-flex justify-content-center">
                <img src="./assets/img/company-app-blue.svg" alt="Company App" height="50px" />
            </div>
            <div class="card-body text-center">
                <ul class="list-unstyled">
                    <li>Additional Pages</li>
                    <li><a href="./forgot-password">Forgot Password</a></li>
                </ul>
            </div>
            </div>
        </div>
    </div>
</div>

<footer class="bg-light py-3" style="position: fixed; bottom: 0; width: 100%;">
  <div class="container">
    <p class="text-center">BCRWEBDEV &copy; 2023</p>
  </div>
</footer>


<script src="./assets/vendor/jquery/jquery-3.6.3.min.js"></script>
<script src="./assets/vendor/jquery.tablesorter.min.js"></script>
<script src="./assets/vendor/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js" ></script>
<script>

</script>
</body>
</html>