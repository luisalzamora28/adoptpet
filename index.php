<?php session_start();

header('Access-Control-Allow-Origin: *');

include("functions/global.php");
include("functions/connection.php");
include("functions/access.php");

$routes = [
    /* Private */
    'admin'                         =>  ['private', 'dog_index'],
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
    'dog/show'                      =>  ['public', 'dog_show'],
    'dog/adoption/inscribe'         =>  ['public', 'dog_inscribe_adoption'],
    'about'                         =>  ['public', 'about'],
    'contact'                       =>  ['public', 'contact'],
    'contact/captcha'               =>  ['public', 'contact_captcha'],
    'contact/send'                  =>  ['public', 'contact_send'],
    'customer/login'                =>  ['public', 'customer_login'],
    'customer/dog'                  =>  ['public', 'customer_dog'],
];

[$_controller, $_option] = @$routes[current_route()] ?: ['public', 'error'];

include("controllers/$_controller.php");

?>