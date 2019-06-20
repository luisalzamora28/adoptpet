<?php create('main', function () { extract($GLOBALS['view_variables']); ?>
    <main>
        <?php
            $slides = [
                ['img'=>'home_slide_1.jpg', 'title'=>'Título 1'],
                ['img'=>'home_slide_2.jpg', 'title'=>'Título 2'],
                ['img'=>'home_slide_3.jpg', 'title'=>'Título 3'],
            ];
        ?>
        <div id="slider"><?php foreach ($slides as $slide) { ?>
            <div class="slick-item bgFull" style="background-image:url('<?= asset("img/site/".$slide['img']) ?>')">
                <div class="slide-data">
                    <div class="title"><?= $slide['title'] ?></div>
                </div>
            </div>
        <?php } ?></div>
        <div style="clear:both;"></div>
    </main>
<?php }); ?>

<?php include("_layout.php"); ?>