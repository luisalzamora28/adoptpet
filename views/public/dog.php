<?php create('content',function(){ extract($GLOBALS['view_variables']); ?>
    <h2 style="margin:20px auto;">Conoce a <?= $dog['name'] ?></h2>
    <hr>
    <div style="float:left;width:calc(50% - 20px);height:400px;padding:10px;" id="dog_slide"><?php foreach ($dog['resources'] as $resource) { ?>
        <div class="slick-item bgFull" style="background-image:url('<?= asset("img/dog/".$resource['body']) ?>')"></div>
    <?php } ?></div>
    <div style="float:left;width:calc(50% - 20px);padding:10px;" id="dog_details">
        <div><label>Sexo:</label><span><?= $dog['sex'] ?></span></div>
        <div><label>Edad aprox.:</label><span><?= $dog['age'] ?> años</span></div>
        <div><label>Tamaño:</label><span><?= $dog['size'] ?></span></div>
        <div><label>Tipo de pelo:</label><span><?= $dog['fur'] ?></span></div>
        <div><label>Nivel de eactividad:</label><span><?= $dog['activity'] ?></span></div>
        <div><label>Espacio abierto requerido:</label><span><?= $dog['required_space'] ?></span></div>
        <div><label>Puede estar solo:</label><span><?= $dog['time_alone'] ?></span></div>
        <div><label>Código:</label><span><?= $dog['code'] ?></span></div>
        <div><label>Contribución de adopción:</label><span>S/ <?= $dog['adoption_contribution'] ?></span></div>
        <a href="<?= url('dog/adoption/inscribe?id='.$dog['id']) ?>" id="dog_inscribe_adoption">Inscribirse en la lista de espera</a>
    </div>

    <div style="clear:both;"></div>
<?php }); ?>

<?php include("_layout.php"); ?>