<?php create('content',function(){ extract($GLOBALS['view_variables']); ?>
    <h2 style="margin:20px auto;">Nosotros</h2>
    <hr>
    <form action="<?= route('adopt?filters='.@$_GET['filters'], 'p') ?>" filters="<?= @$_GET['filters'] ?>" id="dog_filters">
        <select name="" id=""></select>
    </form>
    <hr>
    <div id="dogsWrapper" style="width:100%;">
        <?php foreach ($dogs as $dog) { ?><div class="dog" style="width:calc(25% - 10px);padding:5px;">
            <div class="image bgFull" style="height:150px;background-image:url(<?= asset('img/'.$dog['bg']) ?>)"></div>
            <div class="details">
                <h3><?= $dog['name'] ?></h3>
                <span><?= $dog['sex'] ?> | <?= $dog['age'] ?></span>
            </div>
        </div><?php } ?>
    </div>
<?php }); ?>

<?php include("_layout.php"); ?>