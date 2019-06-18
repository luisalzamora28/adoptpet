<?php

# ACCESSING HELPERS
function access_interface($attr='name'){return int($attr,$_GET['i']);}
function access_page($obj){$i=$_GET['i'];return@$obj?(@$_GET['p']?:int('home',$i)):int('deviation',$i);}
function access_function(){$default=int('index',$_GET['i']);return@$_GET['f']?:$default;}

# SESSION HELPERS
function session_restart(){session_unset();session_destroy();session_start();}
function session_validate_time($minutes){
	if(isset($_SESSION['LAST_ACTIVITY'])&&(time()-$_SESSION['LAST_ACTIVITY']>$minutes*60)){
		session_restart();
	}$_SESSION['LAST_ACTIVITY']=time();
}

# AUTHENTICATION HELPERS
function notFirstTime(){return isset($_POST['user'])&&isset($_POST['pass']);}
function validCaptcha(){return (!isset($_SESSION['captcha']))||@$_POST['captcha']==$_SESSION['captcha'];}
function validUSer($data){
	$user=$data['user'];$pass=$data['pass'];
	$sql="SELECT * FROM admin WHERE username='$user' AND password=md5('$pass')";
	return @get($sql)[0];
}

?>