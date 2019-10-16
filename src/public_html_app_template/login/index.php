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
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="description" content=""/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
<title>Anonymous | Login</title>
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
        <a class="nav-link" href="../create-account/">Create Account <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../login">Login</a>
      </li>

    </ul>
  </div>
</nav>

<div class="container top-justify">
	<div class="row justify-content-center">
		<div class="col-md-6">
				<!-- form card login -->
				<div class="card card-outline-secondary">
				  <div class="card-header">
					<h3 class="mb-0">Login</h3>
				  </div>
				  <div class="card-body">
					<form autocomplete="off" class="form" id="formLogin" name="formLogin" role="form">
					  <div class="form-group">
						<label for="uname1">Username</label> 
											<input class="form-control" id="uname1" name="uname1" required="" type="text">
					  </div>
					  <div class="form-group">
						<label>Password</label> 
											<input autocomplete="new-password" class="form-control" id="pwd1" required="" type="password">
					  </div>
					  <div class="form-check small">
						<label class="form-check-label">
							<input class="form-check-input" type="checkbox"> 
							<span>Remember me on this computer</span>
						</label>
						<br/>
						<label class="forgot-password-link">
							<span><a href="../forgot-password/">Forgot Password</a></span>
						</label>
					  </div>
										<button class="btn btn-success btn-lg float-right" type="button">Login</button>
					</form>
				  </div><!--/card-block-->
				</div>
				<!-- /form card login -->
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