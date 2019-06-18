<?php session_start();

header('Access-Control-Allow-Origin: *');

include("functions/global.php");
include("functions/connection.php");
include("functions/access.php");
$redirect = ''; $function = '';
switch(access_interface('name')){
	case 'private':
		session_validate_time(120);
		$routes = access_interface('routes');
		$controller = @$routes[access_page(@$_SESSION['user'])] ?: 'error';
		if($controller=='error') redirect(route('error','p'));
		$function = access_function();
		break;
	case 'public':
		$controller = "_site";
		$function = access_page(@$_GET['p']);
		break;
	default:break;
}
$redirect = "controllers/$controller.php";
include($redirect);

?>