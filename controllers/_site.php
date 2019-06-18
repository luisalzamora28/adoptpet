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