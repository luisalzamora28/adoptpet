<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ADOPTPET</title>
	<?php
		$themes = [
			'light'=>[
				'--main-c'=>'#2e5391',
				'--main-bgc'=>'#fff',
				'--main-bc'=>'#4e73b1'
			],
			'dark'=>[
				'--main-c'=>'#fff',
				'--main-bgc'=>'#333',
				'--main-bc'=>'#777'
			]
		];
	?>
	<link rel="stylesheet" type="text/css" href="<?= asset('css/public/global_font.css') ?>">
	<style type="text/css">
		:root{<?= css_vars(@$themes[THEME]) ?>}
		@font-face{
			font-family:'Raleway';
			src:url('<?= asset("fonts/Raleway/raleway_thin.otf") ?>') format('opentype');
			src:url('<?= asset("fonts/Raleway/raleway_thin.eot") ?>'),
				url('<?= asset("fonts/Raleway/raleway_thin.ttf") ?>') format('truetype'),
				url('<?= asset("fonts/Raleway/raleway_thin.svg") ?>'),
				url('<?= asset("fonts/Raleway/raleway_thin.woff") ?>') format('woff');
		}
		*{margin: 0px;padding: 0px;font-family:"Segoeuisl";color:var(--main-c);}
		html{height: 100%;}
		body{background-color: var(--main-bgc);height: 100%;min-height: 400px;position:relative;}
		#title{font-size: 54px;text-align: center;color: var(--main-c);font-family: "Segoe UI";}
		#title{font-weight:normal;/*position:absolute;right:0;bottom:0px;*/}
		section{width: calc(100% - 40px);padding: 20px;max-width: 1200px;}
		section{position: absolute;left: 50%;top: 50%;transform: translate(-50%,-50%);}
		#welcome{margin: auto;max-width: 360px;padding-bottom: 0px;}
		#error{text-decoration:underline;margin:10px 0px;text-align:center;}
		#captcha{font-weight:bold;}
		#business{font-size: 20px;text-align: right;}
		form{max-width: 360px;margin: auto;width: calc(100%);}
		input{border: none;display: block;padding: 5px;width: calc(100% - 12px);}
		input{border-bottom: 1px solid var(--main-bc);background-color: var(--main-bgc);color: var(--main-c);}
		input[type=text],input[type=password]{margin-bottom:10px;font-size: 16px;}
		input:focus{outline: none;}
		input::-webkit-input-placeholder{color: var(--main-c);}
		input::-moz-placeholder{color: var(--main-c);}
		input:-ms-input-placeholder{color: var(--main-c);}
		input:-moz-placeholder{color: var(--main-c);}
		button{border: 1px solid var(--main-bc);padding: 5px;color: #fff;font-size: 16px;}
		button{background-color: #2e5391;width: 100%;margin-bottom: 10px;}
		button:hover{cursor: pointer;}
	</style>
</head>
<body>
	<section>
		<div id="welcome">
			<div id="title">ADOPTPET</div>
			<?php if($error_login) { ?>
				<div id="error"><?= $message_err ?></div>
			<?php } ?>
		</div>
		<form action="<?= route('login','i')/*.'&t='.rand(1000,1000000)*/ ?>" method="post" autocomplete="off">
			<input type="text" placeholder="Usuario" name="user" required>
			<input type="password" placeholder="Contraseña" name="pass" required>
			<?php if(isset($_SESSION['captcha'])){ ?>
			<div>Más de 3 intentos. Resuelve el capctha:</div>
			<div id="captcha"><?= $_SESSION['question'] ?></div>
			<input type="text" placeholder="Respuesta" name="captcha" required>
			<?php } ?>
			<button>Ingresar</button>
		</form>
	</section>
</body>
</html>