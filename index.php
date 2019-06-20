<?php session_start();

header('Access-Control-Allow-Origin: *');

include("functions/global.php");
include("functions/connection.php");
include("functions/access.php");

$routes = [
    /* Private */
    'admin/login'                   =>  ['private', 'login'],
    'admin/message'                 =>  ['private', 'message_index'],
    'admin/message/status/edit'     =>  ['private', 'message_status_edit'],
    'admin/dog'                     =>  ['private', 'dog_index'],
    'admin/dog/show'                =>  ['private', 'dog_show'],
    'admin/dog/create'              =>  ['private', 'dog_create'],
    'admin/dog/edit'                =>  ['private', 'dog_edit'],
    /* Public */
    ''                              =>  ['public', 'home'],
    'home'                          =>  ['public', 'home'],
    'adopt'                         =>  ['public', 'adopt'],
    'about'                         =>  ['public', 'about'],
    'contact'                       =>  ['public', 'contact'],
    'contact/captcha'               =>  ['public', 'contact_captcha'],
    'contact/send'                  =>  ['public', 'contact_send'],
];

[$_controller, $_option] = @$routes[current_route()] ?: ['public', 'error'];

include("controllers/$_controller.php");

?>