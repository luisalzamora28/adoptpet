<?php

# SESSION HELPERS
function session_restart () {
    session_unset();
    session_destroy();
    session_start();
}
function session_validate_time ($minutes) {
	if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $minutes * 60)) {
		session_restart();
	}
    $_SESSION['LAST_ACTIVITY'] = time();
}

# AUTHENTICATION HELPERS
function notFirstTime () {
    return @$_POST['email'] && @$_POST['password'];
}
function validCaptcha ($user) {
    return (!@$_SESSION[$user.'_captcha']) || (@$_POST['captcha'] == $_SESSION[$user.'_captcha']);
}
function validUSer($data, $user){
	return @get(
        "SELECT * FROM $user WHERE email = '". $data['email'] ."' AND password = md5('". $data['password'] ."')"
    )[0];
}

?>