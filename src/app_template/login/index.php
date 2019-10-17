<?php
require_once '../php/core/init.php';
require_once '../php/functions/sanitize.php';

spl_autoload_register(function($class){
    require_once '../php/classes/'.$class.'.php';
});

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$con = new mysqli(config::get('mysql|host'), config::get('mysql|user'), config::get('mysql|pass'), config::get('mysql|db'), 3306);

	$sql = "SELECT `uid`, `full_name`,`user_type`, `account_status`,`email`,`password` FROM `users` WHERE `email` = ?";	
	
	$email = hyper_escape($_POST['email']);
	$pass = hyper_escape($_POST['pass']);	
	
	
	
	if (!($stmt = $con->prepare($sql))) {
		//TESTING PURPOSES ONLY
		//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_param("s",$email)){
		//TESTING PURPOSES ONLY
		//echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if (!$stmt->execute()) {
		//TESTING PURPOSES ONLY
		//echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}else{
		$stmt->store_result();
		$c = $stmt->num_rows;
		
		if($c >= 1){
			
			$arr = [];
			
			$stmt->bind_result($a,$b,$c,$d,$e,$f);
			
			while ($stmt->fetch()) {
				$arr["uid"] = $a;
				$arr["name"] = $b;
				$arr["usertype"] = $c;
				$arr["status"] = $d;
				$arr["email"] = $e;
				$arr["pass"] = $f;
			}
			
			if(password_verify($pass,$arr["pass"])  && $arr['status'] == "ACTIVE"){
				
				if($arr["usertype"] == 'ADMIN'){
					$_SESSION['sessionType'] = $arr["usertype"];
					$_SESSION['sessionId'] = $arr["uid"];
					$_SESSION['email'] = $arr["email"];
					$_SESSION['name'] = $arr["name"];
					redirect::to("../app/");
				}else if($arr["usertype"] == 'STANDARD'){
					$_SESSION['SessionType'] = $arr["usertype"];
					$_SESSION['SessionId'] = $arr["uid"];
					$_SESSION['email'] = $arr["email"];
					$_SESSION['name'] = $arr["name"];
					redirect::to("../app/");
				}
				
			}else{
				redirect::to($_SERVER['PHP_SELF']."?status=0");
			}
		}
		$con->close();		
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<title>Anonymous | Login</title>
	<style>
	.top-justify{
		margin-top:50px;
	}
	</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../">Login</a>
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
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form" id="formLogin" name="formLogin" role="form">
						<div id="errMsg"><div class='alert alert-danger' role='alert'><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
 JavaScript must be enabled to run this page.</div></div>	
					  <div class="form-group">
						<label for="uname1">Email</label> 
						<input class="form-control" onblur="cs(event);" id="email" name="email" required="" type="text">
					  </div>
					  <div class="form-group">
						<label>Password</label> 
						<input autocomplete="new-password" class="form-control" name="pass" id="pass" required="" type="password">
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
						<button class="btn btn-success btn-lg float-right" id="loginSubBtn"  type="button">Login</button>
					</form>
				  </div>
				</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
<script>
var eml = document.getElementById("email");
var pwd = document.getElementById("pass");
var err = document.getElementById("errMsg");
var frm = document.getElementById("formLogin");
var btn = document.getElementById("loginSubBtn");

window.onload = function(){
	err.innerHTML = "";
	btn.disabled = "";
	var myParam = location.search.split('status=')[1];
	if(myParam == "0"){
		err.innerHTML = "<div class='alert alert-danger' role='alert'> Incorrect password. Please try again.</div>";
	}
}

btn.addEventListener("click",function(){
	if(ve(eml.value)){
		if(pwd.value != "" && pwd.value.length > 3){
			frm.submit();
		}else{
			err.innerHTML = "<div class='alert alert-warning' role='alert'><i class='fa fa-info-circle' aria-hidden='true'></i> Please enter a password.</div>";
			setTimeout(function(){err.innerHTML="";},3000);
		}
	}else{
		err.innerHTML = "<div class='alert alert-warning' role='alert'><i class='fa fa-info-circle' aria-hidden='true'></i> Please check email format.</div>";
		setTimeout(function(){err.innerHTML="";},3000);
	}
});

function cs(event){
  var e = event.target.value;
	
  if(ve(e)){
	  var xhr = new XMLHttpRequest();
	  var url = '../php/json/checkaccountstatus.php?e=' + e;
	  xhr.open('GET',url, true);
	  xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');
	  xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			var s = JSON.parse(xhr.responseText);
			if(s.status == "PENDING"){
				err.innerHTML = "<div class='alert alert-danger' role='alert'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Account pending. Please contact support.</div>";
				eml.disabled = "disabled";
				btn.disabled = "disabled";
			}else if(s.status == "DISABLED"){
				err.innerHTML = "<div class='alert alert-danger' role='alert'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Account disabled. Please contact support.</div>";
				eml.disabled = "disabled";
				btn.disabled = "disabled";
				
			}else if(s.status == "ACTIVE"){
				err.innerHTML = "";
				btn.disabled = "";	
			}
		}
	  };
	  xhr.send();
  }
  
}

function ve(e) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(e);
}
</script>
</body>
</html>