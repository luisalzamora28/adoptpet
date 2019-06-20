<?php

function get_dogs($filters){
    $filters = $filters ?: 1;
    $sql = "SELECT d.id, d.name, d.sex, d.age, r.body as bg
            FROM dog d
            LEFT JOIN resource r ON r.dog_id = d.id
            WHERE r.type = 'img' AND d.adoption_status = 0
            AND $filters
            GROUP BY d.id
            ORDER BY d.id DESC, r.id ASC";
    return @get($sql);
}
function get_dog($id, $resources = 0){
    $dog = @get("SELECT * FROM dog WHERE id = $id")[0];
    if(!empty($dog)&&$resources){
        $sql = "SELECT * FROM resource WHERE dog_id = $id ORDER BY id DESC";
        $dog['resources'] = @get($sql);
    }
    return $dog;
}

function create_message($data){
    insertIntoTable('message',$data);return 1;
}

switch ($_option) {
    case 'customer_dog':
        if (!@$_SESSION['customer'] && $_option != 'customer_login') {
            redirect('customer/login');
        }
        break;
}

switch ($_option) {
    case 'home':
        view('public/home');
        break;
    case 'about':
        view('public/about', ['view' => 'about']);
        break;
    case 'adopt':
        $filters_ = array_map(function ($filter) {
            return explode('__', $filter);
        }, @$_GET['filters'] ? explode(';', @$_GET['filters']) : []);
        $filters__ = [];
        $filters___ = [];
        foreach ($filters_ as $filter_) { if ($filter_[1] != '') {
            $filters__[$filter_[0]] = $filter_[1];
            $filters___[] = $filter_[0]." = '".$filter_[1]."'";
        }}
        $filters = implode(';', $filters___);
        view('public/adopt', [
            'dogs' => get_dogs($filters),
            'filters' => $filters__,
            'view' => 'adopt'
        ]);
        break;
    case 'dog_show':
        $dog = get_dog($_GET['id'],1);
        if (!@$dog) {
            redirect('error');
        }
        view('public/dog', [
            'dog' => $dog,
            'view' => 'adopt'
        ]);
        break;
    case 'dog_inscribe_adoption':
        break;
    case 'contact':
        view('public/contact', [
            'view' => 'contact'
        ]);
        break;
    case 'contact_captcha':
        $captcha_length = 5;
        $set = implode('',[
            "0123456789",
            "abcdefghijklmnopqrstuvwxyz",
            "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
            #"@#&%/+*_¿?¡!"
        ]);
        $rand_gen="";
        for($i=0;$i<$captcha_length;$i++)
            $rand_gen.=$set[rand(0,strlen($set)-1)];
        # $angle = rand(0,30);
        $lines = rand(1,3);
        $image = imagecreatetruecolor(111, 39);
        $black = imagecolorallocate($image, 0, 0, 0);
        $color = imagecolorallocate($image, 180, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,111,39,$white);
        for($i=0;$i<$lines;$i++){
            imageline($image, rand(0,111), 0, rand(0,111), 39, $color);
            imageline($image, 0, rand(0,39), 111, rand(0,39), $color);
        }
        ini_set('display_errors',1);
        error_reporting(E_ALL);
        imagettftext($image, 19, 0, 8, 29, $color, __DIR__."/../assets/fonts/Century_Gothic_Regular.ttf", $rand_gen);
        $_SESSION['contact_captcha'] = $rand_gen;
        header('Content-type: image/png');
        imagepng($image,NULL,0);
        break;
    case 'contact_send':
        if(!@$_SESSION['contact_captcha']||!@$_POST['captcha']||$_SESSION['contact_captcha']!=$_POST['captcha']){
            $_SESSION['message'] = 'Captcha incorrecto';
            redirect('contact');break;
        }
        $message = [
            'name'=>@$_POST['name'],
            'email'=>@$_POST['email'],
            'body'=>@$_POST['body'],
            'created_at'=>date('Y-m-d H:i:s')
        ];
        $_SESSION['message'] = (@create_message($message) ?
            'Su mensaje ha sido enviado exitosamente!' :
            'En estos momentos tenemos problemas para enviar el mensaje.'
        );
        redirect('contact');
        break;
    case 'customer_login':
        if(notFirstTime() && !empty($userdata = validUser($_POST, 'customer')) && validCaptcha('customer')){
            session_restart();
            $_SESSION['customer'] = $userdata;
            $_SESSION['LAST_ACTIVITY'] = time();
            redirect('customer/dog');
        }else{
            $error_login = notFirstTime();
            $message_err = !validCaptcha('customer') ? 'Captcha no coincide' : ($error_login ? 'Usuario o clave no válidos' : '');
            if(!$error_login){
                session_restart();
                $_SESSION['customer_times'] = 1;
            }else{
                $_SESSION['customer_times']++;
                if($_SESSION['customer_times'] >= 4){
                    $_SESSION['customer_captcha'] = rand(1000, 1000000);
                    $addend = rand(0, 1000);
                    $_SESSION['customer_question'] = '¿Cuánto es ' . ($addend) . ' + ' . ($_SESSION['customer_captcha'] - $addend) . '?';
                }
            }
            view('public/_login', [
                'error_login' => $error_login,
                'message_err' => $message_err,
                'view' => 'login'
            ]);
        }
        break;
    case 'customer_dog':
        view('public/dashboard', [
            'view' => 'dashboard'
        ]);
        break;
    case 'error':
        view('public/_error');
        break;
}

?>