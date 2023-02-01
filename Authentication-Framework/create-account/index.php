<?php
require_once '../php/core/init.php';
require_once '../php/functions/sanitize.php';

spl_autoload_register(function($class){
    require_once '../php/classes/'.$class.'.php';
});

$SHOW_ACCOUNT_PAGE_FLAG = config::get('settings|show_create_account_public');

if($SHOW_ACCOUNT_PAGE_FLAG == 0){
    redirect::to('../login/?error=account_creation_disabled');
}

if (request::isPost()) {

    $table          = config::get('tables|table_name_for_users');
    $full_name 	    = text_escape(ucwords($_POST['fullName']));	
    $uid 		    = hash::md5Make($_POST['email'].$_POST['timestamp']);
    $email  	    = strtolower(email_escape($_POST['email']));
    $hashPass 	    = hash::password(escape($_POST['pass']));
    $type    	    = 'USER';
    $ip 			= escape($_SERVER['REMOTE_ADDR']);
    $json     	 	= trim('{"original_ip":"'.$ip.'","last_login_ip":"","last_password_udpate": 0,"password_reset_token_time":0,"view_only":0}');
    $email_confirm  = 'NO';

    $CREATE_NEW_USER_DB_CONN = mysqli_connect(config::get('mysql|host'), config::get('mysql|user'), config::get('mysql|pass'), config::get('mysql|db'), 3306);
    
    $SQL_STATEMENT = "INSERT INTO `{$table}` (`full_name`, `uid`, `email`, `password`, `account_type`, `json_data`,`email_confirm`) VALUES (?,?,?,?,?,?,?)";

    $STMT = $CREATE_NEW_USER_DB_CONN->prepare($SQL_STATEMENT);

    $STMT->bind_param("sssssss",$full_name, $uid, $email, $hashPass, $type, $json, $email_confirm);

    if($STMT->execute()){

        redirect::to('../login/?s=success');
        
    }else{
        redirect::to('./?s=failure');
    }
}

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
    <title>Create Account</title>
    <style>
    </style>
</head>
<body style="background-color: #F0F0F0;">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <a href="../"><img src="../assets/img/create-account.svg" height="50px" ></a>
                </div>
            
                <div class="card-body">

                    <div id="errLong">
                    </div>
                    <div id="err">
                    </div>

                    <form id="registerForm" method="POST" action="">
                    <div class="form-group">
                        <label for="email">Full Name</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" onblur="checkName()" class="form-control" id="fullName" name="fullName"  placeholder="Full Name" />
                            <input type="hidden" name="timestamp" id="ts" value="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            </div>
                            <input type="email" onblur="checkEmail()" class="form-control" id="email" name="email" placeholder="Email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" onblur="checkPass()" class="form-control" id="pass1" name="pass" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password" onblur="checkMatch()" class="form-control" id="pass2" placeholder="Confirm Password" />
                    </div>

                    <button type="submit" id="register" class="btn btn-primary float-right">Create Account</button>
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
var level  = 0;
var flag_1 = 0;
var flag_2 = 0;
var flag_3 = 0;

$(document).ready(function(){

    var ts = Math.round((new Date()).getTime() / 1000);
    $('#ts').val(ts);

    updatePasswordLevel();

});

document.getElementById('register').addEventListener('click', function(e){
    e.preventDefault();
    checkFlags();
});

function checkFlags(){
	var frm = document.getElementById('registerForm');
	if(flag_1 == 1 && flag_2 == 1 && flag_3 == 1){
		frm.submit();
	}
}

function updatePasswordLevel(){
    var xhr = new XMLHttpRequest();
  	var url = '../php/json/password_level.php';
	xhr.open('GET',url, true);
  	xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');
	xhr.onreadystatechange = function(){
    if (xhr.readyState == 4 && xhr.status == 200) {
            var stream = JSON.parse(xhr.responseText);
			level = stream.level;
    }
  };
  xhr.send();
}

function checkName(){
	var f   = document.getElementById('fullName');
	var err = document.getElementById('err');
	if(!isName(f.value)){
        createAlert("primary", "Please enter a valid full name.", 3000, err);
	}else{
		flag_1 = 1;
	}
}

function checkEmail(){
	var e   = document.getElementById('email');
	var el  = document.getElementById('errLong');
	var err = document.getElementById('err');
	var b = document.getElementById('register');
	if(!isEmail(e.value)){
        createAlert("primary", "Please enter a valid email.", 3000, err);
	}else{

		var xhr = new XMLHttpRequest();
		var url = '../php/json/check_email.php?email=' + e.value;
		xhr.open('GET',url, true);
		xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
				var s = JSON.parse(xhr.responseText);
				if(s.status !== 'true'){
					flag_2 = 1;
				}else{
					var div = document.createElement('div');
					var text = document.createTextNode('Account already exist. Please login.');
					div.className = 'alert alert-danger';
					div.setAttribute('role', 'alert');
					div.appendChild(text);
					el.appendChild(div);
					e.value = '';
					e.setAttribute('disabled','disabled');
					b.setAttribute('disabled','disabled');
				}
			}
		};
		xhr.send();	
	}
}

function checkPass(){
	var p  = document.getElementById('pass1');
	var err = document.getElementById('err');
	var score = passwordScore(p.value);

	if(score <= level){
		var div = document.createElement('div');
		var text = document.createTextNode('Weak Password Score '+ score +' out of 100');
		div.className = 'alert alert-danger';
		div.setAttribute('role', 'alert');
		div.appendChild(text);
		err.appendChild(div);
		p.setAttribute('disabled','disabled');

		setTimeout(function() {
			p.removeAttribute('disabled');
			err.innerHTML = '';
		}, 2000);
	}
}

function checkMatch(){
	var p1  = document.getElementById('pass1');
	var p2  = document.getElementById('pass2');
	var err = document.getElementById('err');

	if(p1.value !== p2.value){
		var div = document.createElement('div');
		var text = document.createTextNode('Password does not match!');
		div.className = 'alert alert-primary';
		div.setAttribute('role', 'alert');
		div.appendChild(text);
		err.appendChild(div);
		p2.value = '';
		p1.setAttribute('disabled','disabled');
		p2.setAttribute('disabled','disabled');

		setTimeout(function() {
			p1.removeAttribute('disabled');
			p2.removeAttribute('disabled');
			err.innerHTML = '';
		}, 2000);

	}else{
		flag_3 = 1;
	}
}

function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function isName(name) {
  return /^[a-zA-Z]+ [a-zA-Z]+$/.test(name);
}

function createAlert(className, message, duration,element){
    if (element.querySelector("." + className)) {
        return;
    }
    var alert = document.createElement("div");
    alert.className = "alert alert-" + className;
    alert.innerHTML = message;

    element.appendChild(alert);

    setTimeout(() => {
        alert.remove();
    }, duration);
}

function passwordScore(pass) {
    var score = 0;
    if (!pass)
        return score;

    var letters = new Object();
    for (var i=0; i<pass.length; i++){
        letters[pass[i]] = (letters[pass[i]] || 0) + 1;
        score += 5.0 / letters[pass[i]];
    }

    var variations = {
        digits: /\d/.test(pass),
        lower: /[a-z]/.test(pass),
        upper: /[A-Z]/.test(pass),
        nonWords: /\W/.test(pass),
    }

    variationCount = 0;
    for (var check in variations){
        variationCount += (variations[check] == true) ? 1 : 0;
    }
    score += (variationCount - 1) * 10;

    return parseInt(score);
}
</script>
</body>
</html>