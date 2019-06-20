<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADOPTPET</title>
    <link rel="stylesheet" href="<?= asset('libs/fontawesome.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('libs/slick/slick.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/simpleform.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/_public.css') ?>">
    <?php
        $links = [
            'adopt' => ['url' => url('adopt'), 'weight' => 'normal', 'name' => 'Adopta', 'target' => '', 'active' => false],
            'about' => ['url' => url('about'), 'weight' => 'normal', 'name' => 'Nosotros', 'target' => '', 'active' => false],
            'contact' => ['url' => url('contact'), 'weight' => 'normal', 'name' => 'Contacto', 'target' => '', 'active' => false],
        ];
        if (isset($_SESSION['customer'])) {
            $links['dashboard'] = ['url' => url('customer/dog'), 'weight' => 'normal', 'name' => '<i class="fa fa-paw"></i> Perros', 'target' => '', 'active' => false];
        } else {
            $links['login'] = ['url' => url('customer/login'), 'weight' => 'normal', 'name' => '<i class="fa fa-sign-in"></i> Iniciar sesión', 'target' => '', 'active' => false];
        }
        if(isset($view)){
            $links[$view]['active'] = true;
        }
    ?>
</head>
<body>
    <?php if (isset($_SESSION['message'])) { ?><script type="text/javascript">alert("<?= $_SESSION['message'] ?>");</script><?php unset($_SESSION['message']); } ?>
    <div class="page-loader"><div class="loader">Cargando...</div></div>
    <header><div class="contentWrapper" style="height:100%;">
        <a href="<?= url('home'); ?>" id="logo">ADOPTPET</a>
        <a href="#" id="menu">☰</a>
        <nav><?php foreach ($links as $link) { ?>
            <a href="<?= $link['url'] ?>" class="<?= $link['active'] ? 'active' : '' ?>"><?= $link['name'] ?></a>
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
<script type="text/javascript" src="<?= asset('libs/slick/slick.min.js') ?>"></script>
<script type="text/javascript">url = "<?= url('') ?>";</script>
<script type="text/javascript" src="<?= asset('js/_public.js') ?>"></script>
</html>