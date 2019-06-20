<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>ADOPTPET</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= asset('libs/fontawesome.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/simpleform.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/simpletable.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/_private.css') ?>">
    <?php
        $links = [
            'message' => ['url' => url('admin/message'), 'active' => false, 'icon' => 'fa fa-envelope'],
            'dog' => ['url' => url('admin/dog'), 'active' => false, 'icon' => 'fa fa-paw'],
            'logout' => ['url' => url('admin/login'), 'active' => false, 'icon' => 'fa fa-sign-out']
        ];
        $width = round(100/sizeof($links), 2);
        if(isset($view)){
            $links[$view]['active'] = true;
        }
    ?>
</head>
<body>
    <?php if (isset($_SESSION['message'])) { ?><script type="text/javascript">alert("<?= $_SESSION['message'] ?>");</script><?php unset($_SESSION['message']); } ?>
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
        <p>Usuario actual: <strong><?= $_SESSION['admin']['username'] ?></strong></p>
    </div></footer>
</body>
<script type="text/javascript" src="<?= asset('libs/jquery.js'); ?>"></script>
<script type="text/javascript">url = "<?= url('') ?>";</script>
<script type="text/javascript" src="<?= asset('js/_private.js'); ?>"></script>
</html>