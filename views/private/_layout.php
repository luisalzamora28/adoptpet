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
				'--header-bgc'=>'#777',
				'--main-c'=>'#000',
				'--main-bgc'=>'#fff',
				'--main-bc'=>'#ccc',
				'--little-bgc'=>'#aaa',
				'--little-bgc-h'=>'#ddd',
				'--little-c'=>'#aaa',
				'--little-c-h'=>'#ddd'
			],
			'dark'=>[
				'--header-bgc'=>'#333',
				'--main-c'=>'#fff',
				'--main-bgc'=>'#333',
				'--main-bc'=>'#aaa',
				'--little-bgc'=>'#777',
				'--little-bgc-h'=>'#aaa',
				'--little-c'=>'#aaa',
				'--little-c-h'=>'#ddd',
			]
		];
	?>
	<link rel="stylesheet" type="text/css" href="<?= asset('css/public/global_font.css') ?>">
	<style type="text/css">:root{<?= css_vars(@$themes[THEME]) ?>}</style>
	<link rel="stylesheet" href="<?= asset('css/private/global.css') ?>">
	<link rel="stylesheet" href="<?= asset('css/private/'.$page['css'][0].'.css') ?>">
	<?php
		$links = [
			'dog'=>['url'=>route('dog','i'),'active'=>false,'icon'=>'fa fa-paw'],
			'logout'=>['url'=>route('login','i'),'active'=>false,'icon'=>'fa fa-sign-out']
		];
		$width = round(100/sizeof($links), 2);
		if(isset($view)){
			$links[$view]['active'] = true;
		}
	?>
</head>
<body>
	<?php if (isset($_SESSION['message'])) { ?>
	<script type="text/javascript">alert("<?= $_SESSION['message'] ?>");</script>
	<?php unset($_SESSION['message']); } ?>
	<div class="page-loader"><div class="loader">Cargando...</div></div>
	<header><div class="contentWrapper" style="height:100%;">
		<nav id="menu"><ul><?php foreach($links as $link) { ?><li style="width:<?= $width ?>%;">
			<a href="<?= $link['url'] ?>" class="trans <?= $link['active'] ? 'active' : '' ?>"><i class="<?= $link['icon'] ?>"></i></a>
		</li><?php } ?></ul></nav>
	</div></header>
	<section><div class="contentWrapper">
		<?php place('content'); ?>
	</div></section>
	<footer><div class="contentWrapper" style="padding:10px;text-align:center;">
		<p>Usuario actual: <strong><?= $_SESSION['user']['username'] ?></strong></p>
	</div></footer>
</body>
<script type="text/javascript" src="<?= asset('libs/jquery.js'); ?>"></script>
<?php $files_ = $page['js'][1]; foreach ($files_ as $file_) { ?>
	<script type="text/javascript" src="<?= asset('libs/'.$file_.'.js'); ?>"></script>
<?php } ?>
<script type="text/javascript">domain = "<?= env('domain'); ?>/";</script>
<script type="text/javascript" src="<?= asset('js/private/global.js'); ?>"></script>
<script type="text/javascript" src="<?= asset('js/private/'.$page['js'][0].'.js'); ?>"></script>
</html>