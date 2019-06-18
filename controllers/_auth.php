<?php

if(notFirstTime()&&!empty($userdata=validUser($_POST))&&validCaptcha()){
	session_restart();
	$_SESSION['user'] = $userdata;
	$_SESSION['LAST_ACTIVITY'] = time();
	redirect(route(access_interface('home'),$_GET['i']));
}else{
	$error_login = notFirstTime();
	$message_err = !validCaptcha() ? 'Captcha no coincide' : ($error_login ? 'Usuario o clave no válidos' : '');
	if(!$error_login){
		session_restart();
		$_SESSION['times'] = 1;
	}else{
		$_SESSION['times']++;
		if($_SESSION['times']>=4){
			$_SESSION['captcha'] = rand(1000,1000000);
			$addend = rand(0,1000);
			$_SESSION['question'] = '¿Cuánto es '.($addend).' + '.($_SESSION['captcha']-$addend).'?';
		}
	}
	view('_login',[
		'error_login'=>$error_login,
		'message_err'=>$message_err
	]);
}

?>