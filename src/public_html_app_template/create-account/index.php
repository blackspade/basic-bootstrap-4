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
    <meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="description" content=""/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
	<title>Anonymous | Create Account</title>
	<style>
	.top-justify{
		margin-top:50px;
	}
	</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../">Coincentage</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link active" href="../create-account/">Create Account <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../login/">Login</a>
      </li>

    </ul>
  </div>
</nav>

<div class="container top-justify">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<!-- form card register -->
            <div class="card card-outline-secondary">
              <div class="card-header">
                <h3 class="mb-0">Create Account</h3>
              </div>
              <div class="card-body">
                <form autocomplete="off" class="form" role="form">
                  <div class="form-group">
                    <label for="inputName">Name</label> 
										<input class="form-control" id="inputName" placeholder="Full name" type="text">
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3">Email</label> 
										<input class="form-control" id="inputEmail3" placeholder="Email" required="" type="email">
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3">Password</label> 
										<input class="form-control" id="inputPassword3" placeholder="Password" required="" type="password"> 
										<small class="form-text text-muted" id="passwordHelpBlock">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</small>
                  </div>
                  <div class="form-group">
                    <label for="inputVerify3">Verify</label> 
										<input class="form-control" id="inputVerify3" placeholder="Password (again)" required="" type="password">
                  </div>
                  <div class="form-group">
                    <button class="btn btn-success btn-lg float-right" type="submit">Register</button>
                  </div>
                </form>
              </div>
            </div>
			<!-- /form card register -->		
		</div>
	</div>
</div>	


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
<script>
</script>
</body>
</html>