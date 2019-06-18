<?php

return [
	'default'=>'p',
	'interfaces'=>[
		'p'=>[
			'name'=>'public',
			'htname'=>'',
			'deviation'=>'home',
			'home'=>'home',
			'index'=>null,
			'routes'=>null
		],
		'i'=>[
			'name'=>'private',
			'htname'=>'intranet/', # this should have the '/'
			'deviation'=>'login', # if p == ''
			'home'=>'dog', # main controller
			'index'=>'index', # main function on a controller
			'routes'=>[
				'login'=>'_auth',
				'dog'=>'dog'
			]
		]
	]
];

?>