<?php create('content',function(){ extract($GLOBALS['view_variables']); ?>
    <main style="height:100%;">
        <?php
            $slides = [
                ['img'=>'home1.jpg', 'title'=>'Título 1'],
                ['img'=>'home2.jpg', 'title'=>'Título 2'],
                ['img'=>'4.jpg', 'title'=>'Título 3'],
            ];
        ?>
        <div id="slider"><?php foreach ($slides as $slide) { ?>
            <div class="slick-item bgFull" style="background-image:url('<?= asset("img/home/".$slide['img']) ?>')">
                <div class="slide-data">
                    <div class="title"><?= $slide['title'] ?></div>
                </div>
            </div>
        <?php } ?></div>
        <div style="clear:both;"></div>
    </main>
<?php }); ?>

<?php include("_layout.php"); ?>