<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Adoptpet :: Error</title>
	<?php
		$themes = [
			'light'=>[
				'--main-bgc'=>'#fff'
			],
			'dark'=>[
				'--main-bgc'=>'#333'
			]
		];
	?>
	<link rel="stylesheet" type="text/css" href="<?= asset('css/public/global_font.css') ?>">
	<style type="text/css">
		:root{<?= css_vars(@$themes[THEME]) ?>}
		*{margin: 0px;padding: 0px;font-family:"Segoeuisl";}
		html{height: 100%;}
		body{background-color: var(--main-bgc);height: 100%;min-height: 400px;position:relative;}
		section{width: calc(100% - 40px);padding: 20px;max-width: 1200px;}
		section{position: absolute;left: 50%;top: 50%;transform: translate(-50%,-50%);}
		#message{font-size:32px;color:#aaa;}
	</style>
</head>
<body>
	<section>
		<div id="message">Esta página no está disponible</div>
	</section>
</body>
</html>