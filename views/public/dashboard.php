<?php create('content',function(){ extract($GLOBALS['view_variables']); ?>
    <h2 style="margin:20px auto;">Dashboard</h2>
    <hr>
    <a href="<?= url('customer/login') ?>" style="text-decoration:underline;"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
<?php }); ?>

<?php include("_layout.php"); ?>