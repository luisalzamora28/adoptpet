<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PETADOPT</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
</head>
<body>
	<header><div class="wrapper">
		<div id="logo">PETADOPT</div>
		<?php $links = [
		    ['url' => 'index.php', 'name' => 'Inicio'],
		    ['url' => 'adopta.php', 'name' => 'Catálogo'],
		    ['url' => 'nosotros.php', 'name' => 'Nosotros'],
		    ['url' => 'contacto.php', 'name' => 'Contacto'],
		    (isset($_SESSION["nombre"]) ?
		        ['url' => 'admin/index.php', 'name' => 'Dashboard'] :
		        ['url' => 'login.php', 'name' => '<i class="fa fa-sign-in"></i> Iniciar sesión']
		    )
		]; ?>
		<a href="#" id="menu">☰</a>
		<nav><?php foreach ($links as $link) { ?>
			<a href="<?= $link['url'] ?>"><?= $link['name'] ?></a>
		<?php } ?></nav>
	</div></header>
	<section><div class="wrapper">
