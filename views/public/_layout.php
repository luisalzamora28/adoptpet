<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>ADOPTPET</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?= asset('libs/fontawesome.min.css') ?>">
	<?php $files_ = $page['css'][1]; foreach ($files_ as $file_) { ?>
		<link rel="stylesheet" type="text/css" href="<?= asset('libs/'.$file_.'.css') ?>">
	<?php } ?>
	<?php
		$themes = [
			'light'=>[
				'--main-c'=>'#000',
				'--main-bgc'=>'#fff',
				'--main-bc'=>'#ccc',
				'--little-bgc'=>'#aaa',
				'--little-bgc-h'=>'#ddd',
				'--little-c'=>'#aaa',
				'--little-c-h'=>'#ddd',
				'--gallery-mb'=>'40px'
			],
			'dark'=>[
				'--main-c'=>'#fff',
				'--main-bgc'=>'#333',
				'--main-bc'=>'#aaa',
				'--little-bgc'=>'#777',
				'--little-bgc-h'=>'#aaa',
				'--little-c'=>'#aaa',
				'--little-c-h'=>'#ddd',
				'--gallery-mb'=>'40px'
			]
		];
	?>
	<link rel="stylesheet" type="text/css" href="<?= asset('css/public/global_font.css') ?>">
	<style type="text/css">:root{<?= css_vars(@$themes[THEME]) ?>}</style>
	<link rel="stylesheet" href="<?= asset('css/public/global.css') ?>">
	<link rel="stylesheet" href="<?= asset('css/public/'.$page['css'][0].'.css') ?>">
	<?php
		$links = [
			['url'=>route('adopt','p'),'weight'=>'normal','name'=>'Adopta','target'=>''],
			['url'=>route('about','p'),'weight'=>'normal','name'=>'Nosotros','target'=>''],
			['url'=>route('contact','p'),'weight'=>'normal','name'=>'Contacto','target'=>''],
			(isset($_SESSION['customer']) ?
		        ['url'=>route('dog','p'),'weight'=>'normal','name'=>'Dashboard','target'=>''] :
		        ['url'=>route('login','p'),'weight'=>'normal','name'=>'<i class="fa fa-sign-in"></i> Iniciar sesión','target'=>'']
		    )
		];
	?>
</head>
<body>
	<?php if (isset($_SESSION['message'])) { ?>
	<script type="text/javascript">alert("<?= $_SESSION['message'] ?>");</script>
	<?php unset($_SESSION['message']); } ?>
	<div class="page-loader"><div class="loader">Cargando...</div></div>
	<header><div class="contentWrapper" style="height:100%;">
		<a href="<?= route('home','p'); ?>" id="logo">ADOPTPET</a>
		<a href="#" id="menu">☰</a>
		<nav><?php foreach ($links as $link) { ?>
			<a href="<?= $link['url'] ?>"><?= $link['name'] ?></a>
		<?php } ?></nav>
	</div></header>
	<?php place('main'); ?>
	<section><div class="contentWrapper">
		<?php place('content'); ?>
	</div></section>
	<footer><div class="contentWrapper">
		<div style="text-align:center;padding:10px 0px;">Todos los derechos reservados</div>
	</div></footer>
</body>
<script type="text/javascript" src="<?= asset('libs/jquery.js') ?>"></script>
<?php $files_ = $page['js'][1]; foreach ($files_ as $file_) { ?>
	<script type="text/javascript" src="<?= asset('libs/'.$file_.'.js') ?>"></script>
<?php } ?>
<script type="text/javascript">domain = "<?= env('domain') ?>";</script>
<script type="text/javascript" src="<?= asset('js/public/global.js') ?>"></script>
<script type="text/javascript" src="<?= asset('js/public/'.$page['js'][0].'.js') ?>"></script>
</html>