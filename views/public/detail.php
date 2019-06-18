<?php create('content',function(){ extract($GLOBALS['view_variables']); ?>
	<div class="contentPanel">
		<h2 id="title"><?= $gallery['title'] ?></h2>
		<div id="description"><strong><?= $gallery['description'] ?></strong></div>
		<div id="details">
			<div>Fecha: <?= date("Y-m-d", strtotime($gallery['created_at'])) ?></div>
			<div>Cliente: <?= $gallery['client'] ?></div>
			<div>Rol: <?= $gallery['role'] ?></div>
			<div>Tags: <?= $gallery['tags'] ?></div>
		</div>
		<div style="clear:both;"></div>
		<div id="imagesWrapper"><?php foreach($gallery['resources'] as $k=>$resource){ ?>
			<?php if($resource['type']=="img"){ ?>
			<img src="<?= asset('img/'.$resource['body']) ?>" alt="<?= 'Multimedia '.($k+1) ?>">
			<?php } ?>
			<?php if($resource['type']=="vid"){ ?>
			<video controls>
				<source src="<?= asset('vid/'.$resource['body']) ?>" type="video/mp4">
			</video>
			<?php } ?>
		<?php } ?></div>
	</div>
<?php }); ?>

<?php include("_layout.php"); ?>