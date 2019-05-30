<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=pisquerito;charset=utf8', 'root', '');
$stmt = $db->query("SELECT * FROM producto ORDER BY id_producto DESC");
$productos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Catalogo | Pisquerito</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/catalogo.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/codigo.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="img\ico.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
</head>
<body>
	
	<div >
			<h1>Catalogo</h1>
		
		<div>
			<?php foreach ($productos as $n) { ?>

			<div >
				<div >
         			<img src="img/image.png"  alt="">
        	</div>
        		<div class="detalles">
						<h2><?php echo $n["nombre"] ?> <br> <span> <?php echo $n["categoria"] ?></span></h2>
				
					
					<form action="catalogo.php" method="GET">
                    
                        <button type="submit">Ver Catalogo</button>
                	</form>  

        	    </div>
    		</div>
			<?php } ?>

			
			
		</div>
	</div>	
	
</body>
</html>
