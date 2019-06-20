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

function create_message($data){
    insertIntoTable('message',$data);return 1;
}

switch ($_option) {
    case 'home':
        view('public/home');
        break;
    case 'about':
        view('public/about');
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
            'filters' => $filters__
        ]);
        break;
    case 'contact':
        view('public/contact');
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
    case 'error':
        view('public/_error');
        break;
}

?>