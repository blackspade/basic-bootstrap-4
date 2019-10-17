<?php
require_once '../php/core/init.php';
require_once '../php/functions/sanitize.php';

spl_autoload_register(function($class){
    require_once '../php/classes/'.$class.'.php';
});

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$con = new mysqli(config::get('mysql|host'), config::get('mysql|user'), config::get('mysql|pass'), config::get('mysql|db'), 3306);

	$sql = "INSERT INTO `users`(`full_name`, `user_type`, `account_status`, `email`, `password`, `ip`) VALUES (?,?,?,?,?,?)";	
	
	$options = ['cost' => 12];
	
	$name = hyper_escape($_POST['name']);
	$email = hyper_escape($_POST['email']);
	$pass = password_hash(hyper_escape($_POST['password']), PASSWORD_BCRYPT,$options);
	
	$type = "STANDARD";
	$status = "PENDING";
	$ip = hyper_escape($_SERVER['REMOTE_ADDR']);
	
	if (!($stmt = $con->prepare($sql))) {
		//TESTING PURPOSES ONLY
		//echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_param("ssssss", $name, $type, $status, $email, $pass, $ip)){
		//TESTING PURPOSES ONLY
		//echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if (!$stmt->execute()) {
		//TESTING PURPOSES ONLY
		//echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}else{
		$con->close();
		redirect::to($_SERVER['PHP_SELF']."?status=0");
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
<title>Anonymous | Create Account</title>
<style>
.top-justify{
	margin-top:50px;
}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../">Create Account</a>
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
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" id="createAccountForm" autocomplete="off" class="form" role="form">
                  <div id="errMsg"><div class='alert alert-danger' role='alert'><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
 JavaScript must be enabled to run this page.</div></div>
				  <div class="form-group">
                    <label for="inputName">Name</label> 
					<input name="name" class="form-control" onblur="st(event);" id="inputName" placeholder="Full name" type="text" maxlength="30" />
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3">Email</label> 
					<input name="email" onblur="cd(event);" class="form-control" id="inputEmail3" placeholder="Email" required="" type="email" maxlength="80">
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3">Password</label> 
					<input name="password" class="form-control" id="inputPassword3" placeholder="Password" required="" type="password"> 
					<small class="form-text text-muted" id="passwordHelpBlock">Your password must be 8-20 characters long, contain letters, numbers, and must contain special characters.</small>
                  </div>
                  <div class="form-group">
                    <label for="inputVerify3">Verify</label> 
					<input class="form-control" id="inputVerify3" placeholder="Password (again)" required="" type="password">
                  </div>
                  <div class="form-group">
                    <button class="btn btn-success btn-lg float-right" type="button" disabled="disabled" id="registerBtn">Register</button>
                  </div>
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
var nme = document.getElementById("inputName");
var eml = document.getElementById("inputEmail3");
var ps1 = document.getElementById("inputPassword3");
var ps2 = document.getElementById("inputVerify3");
var frm = document.getElementById("createAccountForm");
var err = document.getElementById("errMsg");
var btn = document.getElementById("registerBtn");

window.onload = function(){
	err.innerHTML = "";
	btn.disabled = "";
	var myParam = location.search.split('status=')[1];
	if(myParam == "0"){
		err.innerHTML = "<div class='alert alert-success' role='alert'>Account created successfully!</div>";
		btn.disabled = "disabled";
	}
}

btn.addEventListener("click", function(){
	if(nme.value != "" && nme.value.length > 3){
		if(ve(eml.value)){
			if(ps(ps1.value) > 70){
				if(ps1.value === ps2.value){
					frm.submit();
				}else{
					err.innerHTML = "<div class='alert alert-warning' role='alert'><i class='fa fa-info-circle' aria-hidden='true'></i> Password does not match!</div>";
					setTimeout(function(){err.innerHTML="";},3000);
				}
			}else{
				err.innerHTML = "<div class='alert alert-warning' role='alert'><i class='fa fa-info-circle' aria-hidden='true'></i> Password is weak. Please try again.</div>";
				setTimeout(function(){err.innerHTML="";},3000);
			}

		}else{
			err.innerHTML = "<div class='alert alert-warning' role='alert'><i class='fa fa-info-circle' aria-hidden='true'></i> Please check email address.</div>";
			setTimeout(function(){err.innerHTML="";},3000);
		}
	}else{
		err.innerHTML = "<div class='alert alert-warning' role='alert'><i class='fa fa-info-circle' aria-hidden='true'></i> Please type full name.</div>";
		setTimeout(function(){err.innerHTML="";},3000);
	}
});

function ps(p){
    var score = 0;
    if (!p)
        return score;

    var letters = new Object();
    for (var i=0; i<p.length; i++){
        letters[p[i]] = (letters[p[i]] || 0) + 1;
        score += 5.0 / letters[p[i]];
    }

    var variations = {
        digits: /\d/.test(p),
        lower: /[a-z]/.test(p),
        upper: /[A-Z]/.test(p),
        nonWords: /\W/.test(p),
    }

    variationCount = 0;
    for (var check in variations){
        variationCount += (variations[check] == true) ? 1 : 0;
    }
    score += (variationCount - 1) * 10;

    return parseInt(score);
}

function cd(event){
  var e = event.target.value;
	
  if(ve(e)){
	  var xhr = new XMLHttpRequest();
	  var url = '../php/json/checkduplicate.php?e=' + e;
	  xhr.open('GET',url, true);
	  xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');
	  xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			var s = JSON.parse(xhr.responseText);
			if(s.status == 1){
				err.innerHTML = "<div class='alert alert-danger' role='alert'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Account duplicate. Please contact support.</div>";
				btn.disabled = "disabled";
			}else{
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

function st(event){
  var str = event.target.value;
  var i = str.replace(/[&\/\\,'"?<>!@#$%^&*()_+=-]/g, '');
  event.target.value = i;
}
</script>
</body>
</html>