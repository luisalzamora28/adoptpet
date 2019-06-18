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
function get_gallery($id,$resources=0){
	$gallery = @get("SELECT * FROM gallery WHERE id = $id AND status = 1")[0];
	if(!empty($gallery)&&$resources){
		$sql = "SELECT * FROM resource WHERE gallery_id = $id AND status = 1 ORDER BY id ASC";
		$gallery['resources'] = @get($sql);
	}
	return $gallery;
}
function create_message($data){
	insertIntoTable('message',$data);return 1;
}

$GLOBALS['layout_variables'] = [
	'site'=>@get("SELECT * FROM site")[0]
];

switch ($function) {
	case 'home':
		view('public/home');
		break;
	case 'adopt':
		$filters = str_replace(';', ' AND ', str_replace('__', ' = ', @$_GET['filters'] ?: ''));
		view('public/adopt',[
			'dogs' => get_dogs($filters)
		]);
		break;
	case 'about':
		view('public/about');
		break;
	case 'error':view('_error_404');break;
	default:redirect(route('error','p'));break;
}

?>