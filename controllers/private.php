<?php

function get_dogs(){
    $sql = "SELECT d.id, d.name, d.sex, d.age, d.created_at, d.updated_at, d.adoption_status,
            (SELECT COUNT(*) FROM resource WHERE dog_id = d.id AND type = 'img') as c_img
            FROM dog d
            ORDER BY d.id DESC";
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
function create_dog($data){
    insertIntoTable('dog',$data);return 1;
}
function create_resource($data){
    insertIntoTable('resource',$data);return 1;
}
function update_dog($data){
    updateTableTuple('dog',$data,'id');return 1;
}
function update_resource($data){
    updateTableTuple('resource',$data,'id');return 1;
}
function delete_resource($id){
    $resource = @get("SELECT * FROM resource WHERE id = $id")[0];
    unlink('assets/'.$resource['type'].'/dog/'.$resource['body']);
    exe("DELETE FROM resource WHERE id = $id");return 1;
}

function get_messages(){
    return @get("SELECT * FROM message ORDER BY id DESC");
}
function update_message($data){
    updateTableTuple('message',$data,'id');return 1;
}

if (!@$_SESSION['admin'] && $_option != 'login') {
    redirect('admin/login');
    exit();
}

switch ($_option) {
    case 'login':
        if(notFirstTime() && !empty($userdata = validUser($_POST, 'admin')) && validCaptcha('admin')){
            session_restart();
            $_SESSION['admin'] = $userdata;
            $_SESSION['LAST_ACTIVITY'] = time();
            redirect('admin/dog');
        }else{
            $error_login = notFirstTime();
            $message_err = !validCaptcha('admin') ? 'Captcha no coincide' : ($error_login ? 'Usuario o clave no válidos' : '');
            if(!$error_login){
                session_restart();
                $_SESSION['admin_times'] = 1;
            }else{
                $_SESSION['admin_times']++;
                if($_SESSION['admin_times'] >= 4){
                    $_SESSION['admin_captcha'] = rand(1000, 1000000);
                    $addend = rand(0, 1000);
                    $_SESSION['admin_question'] = '¿Cuánto es ' . ($addend) . ' + ' . ($_SESSION['admin_captcha'] - $addend) . '?';
                }
            }
            view('private/_login', [
                'error_login' => $error_login,
                'message_err' => $message_err
            ]);
        }
        break;
    case 'message_index':
        $messages = get_messages();
        view('private/message', [
            'messages' => $messages,
            'view' => 'message'
        ]);
        break;
    case 'message_status_edit':
        $s = update_message([
            'id' => $_GET['id'],
            'status' => 1
        ]);
        out(['status' => $s]);
        break;
    case 'dog_index':
        $dogs = get_dogs();
        view('private/dog',[
            'dogs' => $dogs,
            'view' => 'dog'
        ]);
        break;
    case 'dog_show':
        $dog = get_dog($_GET['id'],1);
        out($dog);
        break;
    case 'dog_create':
        $s = create_dog([
            'name'=>$_POST['name'],
            'sex'=>$_POST['sex'],
            'age'=>$_POST['age'],
            'size'=>$_POST['size'],
            'fur'=>$_POST['fur'],
            'activity'=>$_POST['activity'],
            'required_space'=>$_POST['required_space'],
            'time_alone'=>$_POST['time_alone'],
            'code'=>$_POST['code'],
            'adoption_contribution'=>$_POST['adoption_contribution'],
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'admin_id'=>$_SESSION['admin']['id']
        ]);
        $dog_id = getLastId('dog');
        foreach($_FILES['resource']['name']['body'] as $k=>$body){
            if($_FILES['resource']['error']['body'][$k]==1) continue;
            $body = explode('.',$body);
            $resource = [
                'type'=>$_POST['resource']['type'][$k],
                'body'=>md5(uniqid(mt_rand())).'.'.$body[sizeof($body)-1],
                'name'=>implode('.',$body),
                'created_at'=>date('Y-m-d H:i:s'),
                'status'=>1,
                'dog_id'=>$dog_id,
                'admin_id'=>$_SESSION['admin']['id']
            ];
            $temp = $_FILES['resource']['tmp_name']['body'][$k];
            $path = 'assets/'.$resource['type'].'/dog/'.$resource['body'];
            if(array_search($resource['type'],['img'])===-1) continue;
            umask(0);
            move_uploaded_file($temp,$path);
            $s = $s&&create_resource($resource);
        }
        $_SESSION['message'] = $s ? 'Perro agregado' : 'ERROR';
        redirect('admin/dog');
        break;
    case 'dog_edit':
        $s = update_dog([
            'name'=>$_POST['name'],
            'sex'=>$_POST['sex'],
            'age'=>$_POST['age'],
            'size'=>$_POST['size'],
            'fur'=>$_POST['fur'],
            'activity'=>$_POST['activity'],
            'required_space'=>$_POST['required_space'],
            'time_alone'=>$_POST['time_alone'],
            'code'=>$_POST['code'],
            'adoption_contribution'=>$_POST['adoption_contribution'],
            'updated_at'=>date('Y-m-d H:i:s'),
            'id'=>$_POST['id']
        ]);
        if(isset($_FILES['resource'])){foreach($_FILES['resource']['name']['body'] as $k=>$body){
            if($_FILES['resource']['error']['body'][$k]==1) continue;
            $body = explode('.',$body);
            $resource = [
                'type'=>$_POST['resource']['type'][$k],
                'body'=>md5(uniqid(mt_rand())).'.'.$body[sizeof($body)-1],
                'name'=>implode('.',$body),
                'created_at'=>date('Y-m-d H:i:s'),
                'status'=>1,
                'dog_id'=>$_POST['id'],
                'admin_id'=>$_SESSION['admin']['id']
            ];
            $temp = $_FILES['resource']['tmp_name']['body'][$k];
            $path = 'assets/'.$resource['type'].'/dog/'.$resource['body'];
            if(array_search($resource['type'],['img'])===-1) continue;
            umask(0);
            move_uploaded_file($temp,$path);
            $s = $s&&create_resource($resource);
        }}
        if(isset($_POST['resource_del'])){foreach ($_POST['resource_del'] as $id){
            delete_resource($id);
        }}
        $_SESSION['message'] = $s ? 'Perro actualizado' : 'ERROR';
        redirect('admin/dog');
        break;
    case '_status-edit':
        $dog = get_dog($_POST['id']);
        $response = [0=>0,
            'message'=>@['ACTIVO','INACTIVO'][$dog['status']],
            'color'=>@['#00f','#f00'][$dog['status']],
            'status'=>@[1,0][$dog['status']]
        ];
        update_dog([
            'id'=>$dog['id'],
            'status'=>$response['status']
        ]);
        out($response);
        break;
}

?>